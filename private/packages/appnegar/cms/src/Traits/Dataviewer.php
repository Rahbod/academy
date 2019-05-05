<?php

namespace Appnegar\Cms\Traits;

use Mockery\CountValidator\Exception;
use Validator;

trait Dataviewer
{
    protected $class_name;
    protected $model;
    protected $table;
    protected $fields;

    protected $is_first = true;

    protected $query_builder = null;
    protected $relations = [];
    protected $selected_fields = [];
    protected $group_by_fields = [];



    protected function init($resource=null)
    {
        if($resource == null){
            $resource=$this->resource;
        }
        $this->class_name = '\\App\\' .$resource;

        $this->model = (new $this->class_name());
        $this->table = $this->model->getTable();
        $this->fields = $this->class_name::getFields();

        $this->setRelationsInfo();
        $this->setSelectedFields();
    }

    protected function getTableConditions(){
        return null;
    }

    public function getData($conditions = null,$resource=null)
    {
        if($conditions == null){
            $conditions=$this->getTableConditions();
        }
        $this->init($resource);
        $data = request()->all();

        $this->query_builder = \DB::table($this->table);

        foreach ($this->relations as $relation_info) {
            if ($this->canJoin($relation_info)) {
                switch ($relation_info['relation_type']) {
                    case 'HasOne';
                    case 'BelongsTo';
                    case 'HasMany';
                        $this->query_builder->leftJoin($relation_info['table'], $relation_info['local_key'], '=', $relation_info['foreign_key']);
                        break;
                    case 'BelongsToMany':
                        $this->query_builder->leftJoin($relation_info['pivot_table'], $relation_info['local_key'], '=', $relation_info['pivot_local_key']);
                        $this->query_builder->leftJoin($relation_info['table'], $relation_info['pivot_foreign_key'], '=', $relation_info['foreign_key']);
                        break;
                    case 'MorphMany';
                    case 'MorphOne';
                        $this->query_builder->leftJoin($relation_info['table'], function($q) use ($relation_info){
                            $q->on( $relation_info['local_key'], '=', $relation_info['foreign_key']);
                            $q->where($relation_info['morph_type'], '=', get_class($this->model));
                        });
                        break;
                }

            }

        }

        if (isset($data['f'])) {
            foreach ($data['f'] as $index => $filter) {
                if ($index > 0) {
                    $this->is_first = false;
                }
                $this->setFilterValue($filter);
                $filter['match'] = isset($data['filter_match']) ? $data['filter_match'] : 'and';
                $this->makeFilter($filter);
            }

        }
        if ($conditions !== null and is_array($conditions)) {
            foreach ($conditions as $key=>$value) {
                if(!$this->filterExist($key)){

                    $filter['column']=$key;
                    $filter['operator']='equal_to';
                    $filter['query_1']=$value;
                    $this->setFilterValue($filter);
                    $filter['match'] = 'and';
                    $this->makeFilter($filter);
                }
            }
        }
        $this->query_builder->select($this->selected_fields);

        $order_column = request('order_column');
        if (strpos($order_column, '.') !== false) {
            list($relation_name, $order_column) = explode('.', $order_column);
            $order_column = $this->relations[$relation_name]['table'] . '.' . $order_column;
        }
        return ($this->query_builder->orderBy($order_column, request('order_direction'))->groupBy($this->group_by_fields)->paginate(request('limit')));

    }

    protected function filterExist($key){
        $data = request()->all();
        if(isset($data['f'])){
            foreach ($data['f'] as $index => $filter) {
                if($filter['column']==$key){
                    return true;
                }
            }
        }

        return false;
    }

    protected function setFilterValue(&$filter)
    {
        $type = $this->class_name::getFieldType($filter['column']);
        if (!isset($filter['query_1'])) {
            $filter['query_1'] = null;
        }
        if (!isset($filter['query_2'])) {
            $filter['query_2'] = null;
        }
        if ($type == 'date') {
            $filter['query_1'] = $this->getDate($filter['query_1']);
            $filter['query_2'] = $this->getDate($filter['query_2']);
        }
    }

    protected function getDate($date)
    {
        if (is_string($date)) {
            $date = explode('/', $date);
            $date = \Verta::createJalaliDate($date[0], $date[1], $date[2])->DateTime();
            return $date;
        } else {
            return null;
        }
    }

    protected function setRelationsInfo()
    {
        $relations = [];
        foreach ($this->fields as $field) {

            $relation_info = null;
            if ($field['name'] !== $this->table) {
                $relation_name = $field['name'];

                $relations[$relation_name] = $this->model->getRelationInfo($relation_name);
                if ($this->isSelectable($field)) {
                    $relations[$relation_name]['show'] = true;
                } else {
                    $relations[$relation_name]['show'] = false;
                }
            }
        }

        return $this->relations = $relations;
    }

    protected function setSelectedFields()
    {
        $select_items = [];
        $group_by_items = [];
        foreach ($this->fields as $field) {
            if ($this->isSelectable($field)) {
                $relation_info = null;
                if ($field['name'] !== $this->table) {
                    $relation_name = $field['name'];
                    $relation_info = $this->relations[$relation_name];
                }
                foreach ($field['items'] as $item) {
                    if ($this->isSearchable($item) && $this->isSelectable($item)) {
                        if ($relation_info == null) {
                            $item_name = $this->table . '.' . $item['name'];
                            $group_by_item_item_name = $item_name;
                        } else {
                            $item_name = $relation_info['table'] . '.' . $item['name'] . ' as ' . $relation_name . '.' . $item['name'];
                            $group_by_item_item_name=  $relation_info['table'] . '.' . $item['name'];                      }
                        $select_items[] = $item_name;
                        $group_by_items[]= $group_by_item_item_name;                   }

                }
            }
        }
         $this->selected_fields = $select_items;
         $this->group_by_fields = $group_by_items;
    }

    protected function canJoin($relation_info)
    {
        $data = request()->all();
        $can_join = $relation_info['show'];
        if (isset($data['f'])) {
            foreach ($data['f'] as $filter) {
                if (strpos($filter['column'], '.') !== false) {
                    list($relation_name, $order_column) = explode('.', $filter['column']);
                    if ($relation_name == $relation_info['name']) {
                        $can_join = true;
                    }
                }
            }
        }
        return $can_join;
    }

    protected function isSearchable($item)
    {
        return (!isset($item['searchable']) || $item['searchable'] == true);
    }

    protected function isSelectable($item)
    {
        return (!isset($item['show_in_table']) || $item['show_in_table'] == true);
    }

//    protected function getRelationInfo($model=null,$relation_name)
//    {
//        if($model==null){
//            $model=$this->model;
//        }
//        $info = [
//            'table' => null,
//            'foreign_key' => null,
//            'local_key' => null,
//        ];
//
//        $relation = $model->$relation_name();
//
//
//        $related_model_name = get_class($relation->getRelated());
//        $related_model = (new $related_model_name());
//        $info['table'] = $related_model->getTable();
//
//
//        $relation_type = get_class($relation);
//        if ($pos = strrpos($relation_type, '\\')) {
//            $relation_type = substr($relation_type, $pos + 1);
//        }
//
//        $info['relation_type'] = $relation_type;
//        $info['name'] = $relation_name;
//        switch ($relation_type) {
//            case 'HasOne':
//                $info['foreign_key'] = $relation->getExistenceCompareKey();
//                $info['local_key'] = $relation->getQualifiedParentKeyName();
//                break;
//            case 'HasMany':
//                $info['foreign_key'] = $relation->getExistenceCompareKey();
//                $info['local_key'] = $relation->getQualifiedParentKeyName();
//                break;
//            case 'BelongsTo':
//                $info['foreign_key'] = $this->table . '.' . $relation->getForeignKey();
//                $info['local_key'] = $info['table'] . '.' . $related_model->getKeyName();
//                break;
//            case 'BelongsToMany':
//                $info['table'] = $related_model->getTable();
//                $info['pivot_table'] = $relation->getTable();
//                $info['foreign_key'] = $info['table'] . '.' . $related_model->getKeyName();
//                $info['pivot_foreign_key'] = $relation->getQualifiedRelatedPivotKeyName();
//                $info['pivot_local_key'] = $relation->getQualifiedForeignPivotKeyName();
//                $info['local_key'] = $relation->getQualifiedParentKeyName();
//                break;
//            default:
//                dd('relation is not valid');
//                break;
//        }
//
//        return $info;
//    }

    protected function makeFilter($filter)
    {
        if (strpos($filter['column'], '.') !== false) {
            list($relation_name, $column) = explode('.', $filter['column']);
            $relation_info = $this->relations[$relation_name];
            $filter['column']=$relation_info['table'].'.'.$column;
            if ($column == 'count') {
                $this->query_builder->whereExists(function ($query) use ($relation_name, $relation_info, $filter) {
                    $relation_count = $relation_name . '_count';
                    $query->select(\DB::raw("count(*) as {$relation_count}, status"))
                        ->from($relation_info['table']);
                    $this->setWhereRaw($relation_info, $query);
                    $filter['match'] = 'and';
                    $this->{camel_case($filter['operator'])}($query, $filter, $relation_count);
                });
            } else {
                $where_method = 'whereExists';
                if ($this->is_first === false and $filter['match'] == 'or') {
                    $where_method = 'orWhereExists';
                }
                $this->query_builder->{$where_method}(function ($query) use ($relation_info, $filter) {
                    $query->select(\DB::raw(1))
                        ->from($relation_info['table']);
                    $this->setWhereRaw($relation_info, $query);
                    $filter['match'] = 'and';
                    $this->{camel_case($filter['operator'])}($query, $filter);
                });
            }
        } else {
            $filter['column'] = $this->table . '.' . $filter['column'];
            $this->{camel_case($filter['operator'])}($this->query_builder, $filter);
        }

    }

    protected function setWhereRaw($relation_info, &$query)
    {
        switch ($relation_info['relation_type']) {
            case 'HasOne';
            case 'HasMany';
            case 'BelongsTo';
                $query->whereRaw("{$relation_info['foreign_key']} = {$relation_info['local_key']}");
                break;
            case 'BelongsToMany':
                $query->whereRaw("{$relation_info['local_key']} = {$relation_info['pivot_local_key']} and {$relation_info['foreign_key']} = {$relation_info['pivot_foreign_key']}");
                break;
            case 'MorphMany':
            case 'MorphOne':
                $query->whereRaw("{$relation_info['local_key']} = {$relation_info['foreign_key']}");
                break;
        }
    }


    public function equalTo($query, $filter)
    {
        $query->where($filter['column'], '=', $filter['query_1'], $filter['match']);
    }

    public function notEqualTo($query, $filter)
    {
        $query->where($filter['column'], '<>', $filter['query_1'], $filter['match']);
    }

    public function lessThan($query, $filter)
    {
        $query->where($filter['column'], '<', $filter['query_1'], $filter['match']);
    }

    public function greaterThan($query, $filter)
    {
        $query->where($filter['column'], '>', $filter['query_1'], $filter['match']);
    }

    public function between($query, $filter)
    {
        $query->whereBetween($filter['column'], [
            $filter['query_1'],
            $filter['query_2'],
        ], $filter['match']);
    }

    public function notBetween($query, $filter)
    {
        $query->whereNotBetween($filter['column'], [
            $filter['query_1'],
            $filter['query_2'],
        ], $filter['match']);
    }

    public function contains($query, $filter)
    {
        $query->where($filter['column'], 'like', '%' . $filter['query_1'] . '%', $filter['match']);
    }

    public function startsWith($query, $filter)
    {
        $query->where($filter['column'], 'like', $filter['query_1'] . '%', $filter['match']);
    }

    public function endsWith($query, $filter)
    {
        $query->where($filter['column'], 'like', '%' . $filter['query_1'], $filter['match']);
    }

    public function inThePast($query, $filter)
    {
        $end = now()->endOfDay();
        $begin = now();

        switch ($filter['query_2']) {
            case 'hours':
                $begin->subHours($filter['query_1'])->startOfDay();
                break;
            case 'days':
                $begin->subDays($filter['query_1'])->startOfDay();
                break;
            case 'months':
                $begin->subMonths($filter['query_1'])->startOfDay();
                break;
            case 'years':
                $begin->subYears($filter['query_1'])->startOfDay();
                break;
            default:
                $begin->subHourS($filter['query_1'])->startOfDay();
                break;
        }

        return $query->whereBetween($filter['column'], [$begin, $end], $filter['match']);

    }

    public function inTheNext($query, $filter)
    {
        $end = now()->startOfDay();
        $begin = now();

        switch ($filter['query_2']) {
            case 'hours':
                $end->addHours($filter['query_1'])->endOfDay();
                break;
            case 'days':
                $end->addDays($filter['query_1'])->endOfDay();
                break;
            case 'months':
                $end->addMonths($filter['query_1'])->endOfDay();
                break;
            case 'years':
                $end->addYears($filter['query_1'])->endOfDay();
                break;
            default:
                $end->addHourS($filter['query_1'])->endOfDay();
                break;
        }

        return $query->whereBetween($filter['column'], [$begin, $end], $filter['match']);

    }

    public function inThePeriod($query, $filter)
    {
        $begin = now();
        $end = now();

        switch ($filter['query_1']) {
            case 'today':
                $begin->startOfDay();
                $end->endOfDay();
                break;
            case 'yesterday':
                $begin->subDay(1)->startOfDay();
                $end->subDay(1)->endOfDay();
                break;
            case 'tomorrow':
                $begin->addDay(1)->startOfDay();
                $end->addDay(1)->endOfDay();
                break;
            case 'last_month':
                $begin->subMonth(1)->startOfMonth();
                $end->subMonth(1)->endOfMonth();
                break;
            case 'this_month':
                $begin->startOfMonth();
                $end->endOfMonth();
                break;
            case 'next_month':
                $begin->addYear(1)->startOfYear();
                $end->addYear(1)->endOfYear();
                break;
            case 'last_year':
                $begin->subYear(1)->startOfYear();
                $end->subYear(1)->endOfYear();
                break;
            case 'this_year':
                $begin->startOfYear();
                $end->endOfYear();
                break;
            case 'next_year':
                $begin->addYear(1)->startOfYear();
                $end->addYear(1)->endOfYear();
                break;
            default:
                break;
        }

        return $query->whereBetween($filter['column'], [$begin, $end], $filter['match']);

    }

    public function equalToCount($filter, $query, $relation_count)
    {
        $query->where($relation_count, '=', $filter['query_1']);
    }

    public function notEqualToCount($filter, $query, $relation_count)
    {
        $query->where($relation_count, '<>', $filter['query_1']);
    }

    public function lessThanCount($filter, $query, $relation_count)
    {
        $query->where($relation_count, '<', $filter['query_1']);
    }

    public function greaterThanCount($filter, $query, $relation_count)
    {
        $query->where($relation_count, '>', $filter['query_1']);
    }

}