<?php

namespace Appnegar\Cms\Traits;

trait AdminFilterData
{
    protected function filterModels(&$models)
    {
        foreach ($models as $model) {

           $model=$this->filterModel($model);
        }
        return $models;
    }

    protected function filterModel(&$model){
        if($model){
            foreach ($model as $key => $value) {
                switch ($key) {
                    case 'confirmed':
                    case 'archive':
                    case 'is_admin':
                    case 'is_global':
                    case 'is_news': {
                        if ($model->{$key} === 1) {
                            $model->{$key} = "<span class='badge badge-primary'>" . __('main.values.active') . "</span>";
                        }
                        if ($model->{$key} === 0) {
                            $model->{$key} = "<span class='badge badge-danger'>" . __('main.values.inactive') . "</span>";
                        }
                        break;
                    }
                    case 'status':{
                        if ($model->{$key} === 1) {
                            $model->{$key} = "<span class='badge badge-primary'>" . __('main.values.active') . "</span>";
                        }
                        if ($model->{$key} === 0) {
                            $model->{$key} = "<span class='badge badge-danger'>" . __('main.values.inactive') . "</span>";
                        }
                        if ($model->{$key} === 'INIT') {
                            $model->{$key} = "<span class='badge badge-primary'>" . __('main.values.INIT') . "</span>";
                        }
                        if ($model->{$key} === 'SUCCEED') {
                            $model->{$key} = "<span class='badge badge-success'>" . __('main.values.SUCCEED') . "</span>";
                        }
                        if ($model->{$key} === 'FAILED') {
                            $model->{$key} = "<span class='badge badge-danger'>" . __('main.values.FAILED') . "</span>";
                        }
                        if ($model->{$key} === 'PENDING') {
                            $model->{$key} = "<span class='badge badge-info'>" . __('main.values.PENDING') . "</span>";
                        }
                        if ($model->{$key} === 'AWAITING_PAYMENT') {
                            $model->{$key} = "<span class='badge badge-warning'>" . __('main.values.AWAITING_PAYMENT') . "</span>";
                        }
                        if ($model->{$key} === 'PAID') {
                            $model->{$key} = "<span class='badge badge-primary'>" . __('main.values.PAID') . "</span>";
                        }
                        if ($model->{$key} === 'REJECTED') {
                            $model->{$key} = "<span class='badge badge-danger'>" . __('main.values.REJECTED') . "</span>";
                        }
                        if ($model->{$key} === 'TRANSLATED') {
                            $model->{$key} = "<span class='badge badge-success'>" . __('main.values.TRANSLATED') . "</span>";
                        }
                        if ($model->{$key} === 'CRASH') {
                            $model->{$key} = "<span class='badge badge-info'>" . __('main.values.CRASH') . "</span>";
                        }

                        if ($model->{$key} === 'GATEWAY') {
                            $model->{$key} = "<span class='badge badge-success'>" . __('main.values.GATEWAY') . "</span>";
                        }
                        break;
                    }
                    case 'profile.gender':
                    case 'gender': {
                        if ($model->{$key} === 1) {
                            $model->{$key} = __('main.values.female');
                        }
                        if ($model->{$key} === 0) {
                            $model->{$key} = __('main.values.male');
                        }

                        break;
                    }
                    case 'type': {
                        if ($model->{$key} === 'article') {
                            $model->{$key} = "<span class='badge badge-primary'>" . __('main.values.article') . "</span>";
                        }
                        if ($model->{$key} === 'news') {
                            $model->{$key} = "<span class='badge badge-success'>" . __('main.values.news') . "</span>";
                        }
                        if ($model->{$key} === 'course') {
                            $model->{$key} = "<span class='badge badge-danger'>" . __('main.values.course') . "</span>";
                        }
                        if ($model->{$key} === 'translate') {
                            $model->{$key} = "<span class='badge badge-info'>" . __('main.values.translate') . "</span>";
                        }
                        if ($model->{$key} === 'action') {
                            $model->{$key} = "<span class='badge badge-primary'>" . __('main.values.action') . "</span>";
                        }
                        if ($model->{$key} === 'page') {
                            $model->{$key} = "<span class='badge badge-success'>" . __('main.values.page') . "</span>";
                        }
                        if ($model->{$key} === 'link') {
                            $model->{$key} = "<span class='badge badge-info'>" . __('main.values.link') . "</span>";
                        }
                        if ($model->{$key} === 'admin') {
                            $model->{$key} = "<span class='badge badge-primary'>" . __('main.values.admin') . "</span>";
                        }
                        if ($model->{$key} === 'operator') {
                            $model->{$key} = "<span class='badge badge-success'>" . __('main.values.operator') . "</span>";
                        }
                        if ($model->{$key} === 'teacher') {
                            $model->{$key} = "<span class='badge badge-info'>" . __('main.values.teacher') . "</span>";
                        }
                        if ($model->{$key} === 'user') {
                            $model->{$key} = "<span class='badge badge-pill'>" . __('main.values.user') . "</span>";
                        }
                        break;
                    }
                    case 'lang': {
                        if ($model->{$key} === 'fa') {
                            $model->{$key} = "<span class='badge badge-primary'>" . __('main.values.fa') . "</span>";
                        }
                        if ($model->{$key} === 'en') {
                            $model->{$key} = "<span class='badge badge-success'>" . __('main.values.en') . "</span>";
                        }
                        if ($model->{$key} === 'ar') {
                            $model->{$key} = "<span class='badge badge-success'>" . __('main.values.ar') . "</span>";
                        }
                        break;
                    }
                    case 'access_level': {
                        switch ($model->{$key}) {
                            case 0:
                                $model->{$key} = "<span class='badge badge-danger'>" . __('main.values.not_access') . "</span>";
                                break;
                            case 1:
                                $model->{$key} = "<span class='badge badge-warning'>" . __('main.values.limited_access') . "</span>";
                                break;
                            case 2:
                                $model->{$key} = "<span class='badge badge-primary'>" . __('main.values.normal_access') . "</span>";
                                break;
                            case 3:
                                $model->{$key} = "<span class='badge badge-success'>" . __('main.values.full_access') . "</span>";
                                break;
                        }
                        break;
                    }
                    case 'created_at':
                    case 'updated_at':
                    case 'profile.birthday': {
                        $model->{$key} = $this->filterDate($model->{$key});
                        break;
                    }
                    case 'direction': {
                        if (isset($model->value) and $model->value !== 'default') {
                            $direction = 'ltr';
                            if ($model->direction == 'right_to_left') {
                                $direction = 'rtl';
                            }
                            $model->value = "<div style='direction:{$direction}'>$model->value</div>";
                        }
                        break;
                    }

                    case 'profile':
                    case 'transaction': {
                        $model->{$key} = $this->filterModel($model->{$key});
                        break;
                    }
                }
            }
        }
        return $model;
    }

    /**
     * @param $date
     * @return null
     */
    protected function filterDate($date)
    {
        if ($date) {
            try{
                $date = new \Verta($date);
                $dateTime = $date->format('Y/m/d');
                return $dateTime;
            }catch (\Exception $exception){
                return $date;
            }

        }
        return $date;
    }

    /**
     * @param $inputs
     * @return mixed
     */
    protected function filterInputs($inputs)
    {
        $user = session('user_info_' . session('department'));
        if ($user['access_level'] < 3) {
            foreach ($inputs as $index => $input) {
                if (isset($input['name'])) {
                    switch ($input['name']) {
                        case "is_admin":
                        case "access_level":
                        case "roles":
                        case "departments":
                        case "status":
                        case "featured":
                            unset($inputs[$index]);
                            break;
                        case "rate":
                        case "view_count":
                        case "order":
                            $inputs[$index]['type'] = 'disable';
                            break;
                    }
                }

            }
        }
        return $inputs;
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function filterRequestInputs(&$request)
    {
        $user = session('user_info_' . session('department'));
        if ($user['access_level'] < 3) {
            $request->status = null;
            $request->featured = null;
            $request->show_in_nav = null;
            $request->like = null;
            $request->view_count = null;
            $request->rate = null;
            $request->order = null;
            $request->departments = null;
            $request->is_admin = null;
            $request->is_main = null;
            $request->access_level = null;
            $request->roles = null;
        }
        return $request;
    }
}