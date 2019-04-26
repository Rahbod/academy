<?php

namespace Appnegar\Cms\Traits;

use Illuminate\Database\Eloquent\Model;

trait AdminUpdateOrder
{
    protected function updateOrder($model = null, $order = null, $conditions = [], $resource = null)
    {

        if ($resource == null) {
            $resource = $this->resource;
        }
        $new_order = $this->getNewOrder($resource, $conditions, $model, $order);

        $is_new_model = $this->isNewModel($model);
        $is_new_node = $this->isNewNode($model, $conditions);

//        dd($new_order,$model->order,$is_new_model,$is_new_node,$order);


        if ($is_new_model || $is_new_node) { //when inserted new node to parent

            $query = $this->getOrderQuery($resource, $conditions);
            $query->where('order', '>=', $new_order)->increment('order', 1);

            if ($is_new_node) {
                $this->decrementOrder($model, array_keys($conditions));
//                $query = $this->getOrderQuery($resource, $conditions, $model);
//                $query->where('order', '>', $model->order)->decrement('order', 1);
            }
        } elseif ($this->isNewOrder($model, $new_order)) { //when updated model order
            if ($new_order < $model->order) {
                $query = $this->getOrderQuery($resource, $conditions);
                $query->where('id','<>',$model->id)->where('order', '>=', $new_order)->where('order', '<', $model->order)->increment('order', 1);
            }
            if ($new_order > $model->order) {
                $query = $this->getOrderQuery($resource, $conditions);
                $query->where('id','<>',$model->id)->where('order', '<=', $new_order)->where('order', '>', $model->order)->decrement('order', 1);
            }

        }

        return $new_order;
    }

    private function getOrderQuery($resource, $conditions, $model = null)
    {
        $model_name = 'App\\' . $resource;
        $query = $model_name::query();
        foreach ($conditions as $key => $value) {
            if ($model) {
                $value = $model->$key;
            }
            $query->where($key, $value);
        }
        return $query;
    }

    /**
     * @param array $order_scopes
     * @param  Model $model
     * @return mixed
     */
    public function decrementOrder($model, $order_scopes)
    {
        $class_name = get_class($model);
        $query = $class_name::query();
        foreach ($order_scopes as $key) {
            $query->where($key, $model->$key);
        }
//        dd($order_scopes);
        $query->where('order', '>', $model->order)->decrement('order', 1);
    }

    /**
     * @param array $order_scopes
     * @param  Model $model
     * @return mixed
     */
    public function incrementOrder($model, $order_scopes)
    {
        $class_name = get_class($model);
        $query = $class_name::query();
        foreach ($order_scopes as $key) {
            $query->where($key, $model->$key);
        }
        $query->where('order', '>', $model->order)->increment('order', 1);
    }

    private function getNewOrder($resource, $conditions, $model, $order)
    {
        $query = $this->getOrderQuery($resource, $conditions);
        if (isset($model->id)) {
            $query->where('id', '<>', $model->id);
        }
        $max = $query->max('order');
        if($max == null){
            $max=1;
        }
        if ($order == null || $order > $max) {
            $order = $max;
            if ($this->isNewNode($model, $conditions) || $this->isNewModel($model)) {
                $order += 1;
            }
        } elseif ($order < 1) {
            $order = 1;
        }

        return $order;
    }

    private function isNewModel($model)
    {
        return !isset($model->id);
    }

    private function isNewNode($model, $conditions)
    {
//        dd($model->toArray(),$conditions);
        if (!$this->isNewModel($model)) {
            foreach ($conditions as $key => $value) {
                if ($model->$key != $value) {
                    return true;
                }
            }
        }
        return false;
    }

    private function isNewOrder($model, $new_order)
    {
        return !($model->order == $new_order);
    }
}