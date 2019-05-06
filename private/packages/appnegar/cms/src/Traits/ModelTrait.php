<?php

namespace Appnegar\Cms\Traits;
use ErrorException;
use Illuminate\Database\Eloquent\Relations\Relation;
use ReflectionClass;
use ReflectionMethod;


trait ModelTrait
{
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public function relationships() {

        $model = new static;

        $relationships = [];

        foreach((new ReflectionClass($model))->getMethods(ReflectionMethod::IS_PUBLIC) as $method)
        {
            if ($method->class != get_class($model) ||
                !empty($method->getParameters()) ||
                $method->getName() == __FUNCTION__ ||
                in_array($method->getName(),['nextNodes','nextSiblings','prevNodes','prevSiblings','saveAsRoot','activities','profile']) ) {
                continue;
            }

            try {
                $return = $method->invoke($model);

                if ($return instanceof Relation) {
                    $relationships[$method->getName()] = [
                        'type' => (new ReflectionClass($return))->getShortName(),
                        'model' => (new ReflectionClass($return->getRelated()))->getName()
                    ];
                }
            } catch(ErrorException $e) {}
        }

        return $relationships;
    }

    public static function relatedFields(){
        return [];
    }

    public static function getFields()
    {
        return array_merge([static ::mainFields()],static::relatedFields());
    }

    public function getRelationInfo($relation_name)
    {
        $info = [
            'table' => null,
            'foreign_key' => null,
            'local_key' => null,
        ];

        $relation = $this->$relation_name();


        $related_model_name = get_class($relation->getRelated());
        $related_model = (new $related_model_name());
        $info['table'] = $related_model->getTable();


        $relation_type = get_class($relation);
        if ($pos = strrpos($relation_type, '\\')) {
            $relation_type = substr($relation_type, $pos + 1);
        }

        $info['relation_type'] = $relation_type;
        $info['related_model_name'] = $related_model_name;
        $info['name'] = $relation_name;

        switch ($relation_type) {
            case 'HasOne':
                $info['foreign_key'] = $relation->getExistenceCompareKey();
                $info['local_key'] = $relation->getQualifiedParentKeyName();
                break;
            case 'HasMany':
                $info['foreign_key'] = $relation->getExistenceCompareKey();
                $info['local_key'] = $relation->getQualifiedParentKeyName();
                break;
            case 'BelongsTo':
                $info['foreign_key'] = $this->getTable() . '.' . $relation->getForeignKey();
                $info['local_key'] = $info['table'] . '.' . $related_model->getKeyName();
                break;
            case 'BelongsToMany':
                $info['table'] = $related_model->getTable();
                $info['pivot_table'] = $relation->getTable();
                $info['foreign_key'] = $info['table'] . '.' . $related_model->getKeyName();
                $info['pivot_foreign_key'] = $relation->getQualifiedRelatedPivotKeyName();
                $info['pivot_local_key'] = $relation->getQualifiedForeignPivotKeyName();
                $info['local_key'] = $relation->getQualifiedParentKeyName();
                break;
            case 'MorphMany':
                $info['table'] = $related_model->getTable();
                $info['morph_type'] = $relation->getQualifiedMorphType();
                $info['foreign_key'] = $relation->getQualifiedForeignKeyName();
                $info['local_key'] = $this->getTable().'.'.$this->getKeyName();
                break;
            case 'MorphOne':
                $info['table'] = $related_model->getTable();
                $info['morph_type'] = $relation->getQualifiedMorphType();
                $info['foreign_key'] = $relation->getQualifiedForeignKeyName();
                $info['local_key'] = $this->getTable().'.'.$this->getKeyName();
//                dd($info);
                break;
            default:
                throw new \Exception($relation_type.' relation is not valid');
                break;
        }
        return $info;
    }

    public static function getSubFields()
    {
        $fields = static::mainFields();
        $main_fields = $fields['items'];
        foreach ($main_fields as $index => $item) {
            if (isset($item['show_in_sub_table'])) {
                $main_fields[$index]['show_in_table'] = $item['show_in_sub_table'];
                unset($main_fields[$index]['show_in_sub_table']);
            }
            if (isset($item['show_in_sub_form'])) {
                $main_fields[$index]['show_in_form'] = $item['show_in_sub_form'];
                unset($main_fields[$index]['show_in_sub_form']);
            }
        }
        return $main_fields;
    }

    protected static function getSelectFields($relations=[])
    {
        $table_fields = static::getFields();
        $fields = [];
        foreach ($table_fields as $table_field) {
            $prefix = '';
            if ($table_field['name'] !== static::getTableName()) {
                $prefix .= $table_field['name'] . '.';
            }

            if ($prefix == '' or in_array($table_field['name'], $relations)) {
                foreach ($table_field['items'] as $item) {

                    $fields[] = $prefix . $item['name'];
                }
            }


        }
        return $fields;
    }
    protected static function getFieldsName()
    {
        $fields = static::getFields();
        $fields_name = [];

        foreach ($fields as $field) {
            $prefix = null;
            if ($field['name'] !== static::getTableName()) {
                $prefix = $field['name'];
            }
            if ($prefix == null || (isset($field['show_in_form']) && $field['show_in_form'] == true)) {
                foreach ($field['items'] as $item) {
                    if (
                        (isset($item['is_table_field']) and $item['is_table_field'] === false) ||
                        (isset($item['show_in_form']) and $item['show_in_form'] === false)
                    ) {
                        continue;
                    }

                    $is_related_field=false;
                    if(isset($item['is_related_field']) && $item['is_related_field'] ==true){
                        $is_related_field=true;
                    }
                    if ($prefix == null) {
                        $fields_name[$item['name']] = [
                            'is_related_field'=>$is_related_field,
                            'type'=>$item['input_type']
                        ];
                        continue;
                    }
                    $fields_name[$prefix]['is_relation'] = true;
                    $fields_name[$prefix][$item['name']] =[
                        'is_related_field'=>$is_related_field,
                        'type'=>$item['input_type']
                    ];;
                }
            }

        }
        return $fields_name;
    }

    protected function getRelationsName()
    {
        $table_fields = static::getFields();
        $relations = [];
        foreach ($table_fields as $field) {

            $relation_info = null;
            if ($field['name'] !== static::getTableName()) {
                $relations[] = $field['name'];
            }
        }


        return $relations;
    }

    public static function getFilters()
    {
        $table_fields = static::getFields();
        $fields = [];
        foreach ($table_fields as $table_field) {

            $prefix = '';
            if ($table_field['name'] !== static::getTableName()) {
                $prefix .= $table_field['name'] . '.';
            }


            foreach ($table_field['items'] as $item) {
                if (!isset($item['searchable']) || $item['searchable'] === true) {
                    $fields[] = $prefix . $item['name'];
                }
            }

        }
        return $fields;
    }

    public static function getTableFields()
    {
        $table_fields = static::getFields();
        foreach ($table_fields as $index => $table_field) {
            $prefix = '';
            if ($table_field['name'] !== static::getTableName()) {
                $prefix .= $table_field['name'] . '.';
            }
            if (isset($table_field['show_in_form'])) {
                unset($table_fields[$index]['show_in_form']);
            }
            foreach ($table_field['items'] as $item_index => $item) {
                if (isset($item['searchable']) and $item['searchable'] === false) {
                    unset($table_fields[$index]['items'][$item_index]);
                } else {
                    if (isset($item['input_type'])) {
                        unset($table_fields[$index]['items'][$item_index]['input_type']);
                    }
                    if (isset($item['show_in_form'])) {
                        unset($table_fields[$index]['items'][$item_index]['show_in_form']);
                    }
                    if (isset($item['show_in_sub_form'])) {
                        unset($table_fields[$index]['items'][$item_index]['show_in_sub_form']);
                    }
                    if (isset($item['show_in_sub_table'])) {
                        unset($table_fields[$index]['items'][$item_index]['show_in_sub_table']);
                    }
                    if (isset($item['searchable'])) {
                        unset($table_fields[$index]['items'][$item_index]['searchable']);
                    }
                    $table_fields[$index]['items'][$item_index]['name'] = $prefix . $item['name'];
                }

            }
        }

        return $table_fields;
    }

    public static function getOrderableFields()
    {
        $table_fields = static::getFields();
        $fields = [];
        foreach ($table_fields as $table_field) {

            $prefix = '';
            if ($table_field['name'] !== static::getTableName()) {
                $prefix .= $table_field['name'] . '.';
            }

            if ((!isset($table_field['show_in_table']) || $table_field['show_in_table'] === true)) {
                foreach ($table_field['items'] as $item) {
                    if (!isset($item['searchable']) || $item['searchable'] === true) {
                        if (!isset($item['orderable']) || $item['orderable'] === true) {
                            $fields[] = $prefix . $item['name'];
                        }
                    }
                }

            }
        }
        return $fields;
    }

    public static function getFormFields()
    {
        $table_fields = static::getFields();
        $fields = [];
        foreach ($table_fields as $table_field) {
            if ($table_field['name'] === static::getTableName()) {
                foreach ($table_field['items'] as $item) {
                    if (!isset($item['show_in_form']) || $item['show_in_form'] === true) {
                        $field = [];
                        $field['name'] = $item['name'];
                        $field['type'] = $item['input_type'];
                        if (isset($item['options'])) {
                            $options=$item['options'];
                            foreach ($options as $index=>$option){
                                $text=$options[$index]['text'];
                                $options[$index]['text']=__('main.values.'.$text);
                            }
                            $field['options'] = $options;
                        }
                        $field['required'] = true;
                        if (!isset($item['required']) || $item['required'] == false) {
                            $field['required'] = false;
                        }
                        $fields[] = $field;
                    }
                }

            } elseif ($table_field['show_in_form'] == true) {
                $sub_field['name'] = $table_field['name'];
                foreach ($table_field['items'] as $item) {
                    if (!isset($item['show_in_form']) || $item['show_in_form'] === true) {
                        $field = [];
                        $field['name'] = $item['name'];
                        $field['type'] = $item['input_type'];
                        if (isset($item['options'])) {
                            $options=$item['options'];
                            foreach ($options as $index=>$option){
                                $text=$options[$index]['text'];
                                $options[$index]['text']=__('main.values.'.$text);
                            }
                            $field['options'] = $options;
                        }
                        $field['required'] = true;
                        if (!isset($item['required']) || $item['required'] == false) {
                            $field['required'] = false;
                        }
                        $sub_field['info'][] = $field;
                    }
                }
                $fields['items'] = $sub_field;
            }
        }
        return $fields;
    }

    public static function getFieldType($name)
    {
        $table_fields = static::getFields();
        foreach ($table_fields as $index => $table_field) {
            $prefix = '';
            if ($table_field['name'] !== static::getTableName()) {
                $prefix .= $table_field['name'] . '.';
            }
            foreach ($table_field['items'] as $item_index => $item) {
                if ($prefix . $item['name'] == $name) {
                    return $item['type'];
                }
            }
        }

        return 'text';
    }
}
