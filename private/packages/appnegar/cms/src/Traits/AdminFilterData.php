<?php

namespace Appnegar\Cms\Traits;

trait AdminFilterData
{
    protected function filterModels(&$models)
    {
        foreach ($models as $model) {

            foreach ($model as $key => $value) {
                switch ($key) {
                    case 'status':
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
                    case 'profile.gender': {
                        if ($model->{$key} === 1) {
                            $model->{$key} = __('main.values.female');
                        }
                        if ($model->{$key} === 0) {
                            $model->{$key} = __('main.values.male');
                        }
                        break;
                    }
                    case 'type': {
                        if ($model->{$key} === 'general') {
                            $model->{$key} = "<span class='badge badge-primary'>" . __('main.values.general') . "</span>";
                        }
                        if ($model->{$key} === 'page_loader') {
                            $model->{$key} = "<span class='badge badge-success'>" . __('main.values.page_loader') . "</span>";
                        }
                        if ($model->{$key} === 'frame_loader') {
                            $model->{$key} = "<span class='badge badge-success'>" . __('main.values.frame_loader') . "</span>";
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
                }
            }
        }
        return $models;
    }

    /**
     * @param $date
     * @return null
     */
    protected function filterDate($date)
    {
        if ($date) {
            $date = new \Verta($date);
            $dateTime = $date->format('Y/m/d');
            return $dateTime;
        }
        return null;
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