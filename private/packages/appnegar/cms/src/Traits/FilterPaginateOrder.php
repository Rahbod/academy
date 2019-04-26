<?php

namespace Appnegar\Cms\Traits;

use Mockery\CountValidator\Exception;
use Validator;

trait FilterPaginateOrder
{

    protected $operatos = [
        'equal_to' => '=',
        'not_equal' => '<>',
        'less_than' => '<',
        'greater_than' => '>',
        'less_than_or_equal_to' => '<=',
        'greater_than_or_equal_to' => '>=',
        'in' => 'IN',
        'not_in' => 'NOT_IN',
        'like' => 'LIKE',
        'between' => 'BETWEEN'
    ];

    public function filterPaginateOrder($models,$conditions=null)
    {
        $request = request();
        $main_model_name=ucfirst(array_keys($models)[0]);
        $main_model_ful_name = '\\App\\' . $main_model_name;
        $main_model = (new $main_model_ful_name());
        $main_table = $main_model->getTable();
        $sort_column="id";

        $v = Validator::make($request->all(), [
            'column' => 'required|in:' . implode(',', $main_model->filter),
            'direction' => 'required|in:asc,desc',
            'per_page' => 'required|integer|min:1',
            'search_operator' => 'required|in:' . implode(',', array_keys($this->operatos)),
            'search_column' => 'required|in:' . implode(',', $main_model->filter),
            'search_query_1' => 'max:255',
            'search_query_2' => 'max:255',
        ]);
        if ($v->fails()) {
            dd($v->messages());
        }

        $query = null;
        $select = [];
        $i = 0;
        foreach ($models as $key => $value) {
            if ($i == 0) {
                $main_relation_name = $key;
                $query = \DB::table($main_table);

                foreach ($value as $item) {
                    $select[] = $main_table . '.' . $item;
                }
            } else {
                $relation_name = $key;
                $relation = $main_model->$relation_name();
                $relation_type = get_class($relation);
                if ($pos = strrpos($relation_type, '\\')) {
                    $relation_type = substr($relation_type, $pos + 1);
                }

                $related_model_name = get_class($relation->getRelated());
                $related_model = (new $related_model_name());
                $related_table = $related_model->getTable();

                $foreign_key = null;
                $local_key = null;

                switch ($relation_type) {
                    case 'HasOne':
                        $foreign_key = $related_table . '.' . $related_model->$main_relation_name()->getForeignKey();
                        $local_key = $main_table . '.' . $main_model->getKeyName();
                        break;
                    case 'BelongsTo':
                        $foreign_key = $main_table . '.' . $relation->getForeignKey();
                        $local_key = $related_table . '.' . $related_model->getKeyName();
                        break;
                    default:
                        dd('relation is not valid');
                        break;
                }

                foreach ($value as $item) {
                    $select[] = $related_table . '.' . $item . ' as ' . $relation_name . '.' . $item;
                }

                $query->join($related_table, function ($join) use ($local_key, $foreign_key, $relation_name, $request,$related_table) {
                    $join->on($local_key, '=', $foreign_key);

                    if ($this->isRelatedColumn($request->search_column) ) {
                        list($relation_request_name, $relatedColumn) = explode('.', $request->search_column);
                        if($relation_name == $relation_request_name){
                            $join->where(function ($query) use ($related_table,$relatedColumn, $request) {
                                return $this->buildQuery(
                                    $related_table.'.'.$relatedColumn,
                                    $request->search_operator,
                                    $request->search_query_1
                                    ,$request->search_query_2,
                                    $query
                                );
                            });
                        }
                    }
                });
                if ($this->isRelatedColumn($request->column) ) {

                    list($relation_request_name, $relatedColumn) = explode('.', $request->column);

                    if ($relation_name == $relation_request_name) {

                        $sort_column = $related_table . '.' . $relatedColumn; //
                    }
                }

            }
            $i++;
        }

        if (!$this->isRelatedColumn($request->search_column)) {
            $query->where(function ($query) use ($request,$main_table) {
                return $this->buildQuery(
                    $main_table . '.' . $request->search_column,
                    $request->search_operator,
                    $request->search_query_1,
                    $request->search_query_2,
                    $query
                );
            });
        }
        if (!$this->isRelatedColumn($request->column)) {
            $sort_column=$main_table . '.' .$request->column;
        }

        if($conditions !== null){
            foreach ($conditions as $column=>$condition){
                $query->where(function ($query) use ($main_table,$column,$condition) {
                    return $this->buildQuery(
                        $main_table . '.' . $column,
                        $condition['operator'],
                        $condition['value'],
                        null,
                        $query
                    );
                });
            }
        }
//        dd($conditions);
        return ($query->select($select)->orderBy($sort_column,$request->direction)->paginate($request->per_page));


    }

    protected function isRelatedColumn($search_column)
    {
        return strpos($search_column, '.') != false;
    }

    protected function buildQuery($column, $operator, $search_query_1,$search_query_2, $query)
    {
//        if($search_query_1 !==null){
            switch ($operator) {
                case 'equal_to':
                case 'not_equal':
                case 'less_than':
                case 'greater_than':
                case 'less_than_or_equal_to':
                case 'greater_than_or_equal_to':
                    $query->where($column, $this->operatos[$operator], $search_query_1);
                    break;
                case 'in':
                    $query->whereIn($column, explode(',', $search_query_1));
                    break;
                case 'not_in':
                    $query->whereNotIn($column, explode(',', $search_query_1));
                    break;
                case 'like':
                    $query->where($column, 'like', '%' . $search_query_1 . '%');
                    break;
                case 'between':
                    if($search_query_2 !==null){
                        $query->whereBetween($column, [
                            $search_query_1,
                            $search_query_2,
                        ]);
                    }

                    break;
                default:
                    throw new Exception('Invalid Search Operatoe', 1);
                    break;
//            }
        }

        return $query;
    }
}