<?php

namespace Appnegar\Cms\Controllers\Admin;

use App\Department;
use Appnegar\Cms\Controllers\AdminController;

class RoleController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Role';
    }

    protected function setModel($model)
    {
        $actions=$model->actions()->select(['id'])->pluck('id')->toArray();
        $model->action_id = $actions;
        return $model;
    }

    protected function getDepartments()
    {
        $departments = Department::whereHas('resource_groups.resources.actions', function ($query) {
            $query->where('need_allow', 1);
        })->with(['resource_groups' => function ($query) {
            $query->whereHas('resources.actions', function ($query) {
                $query->where('need_allow', 1);
            });
            $query->with(['resources' => function ($query) {
                $query->whereHas('actions', function ($query) {
                    $query->where('need_allow', 1);
                });
                $query->with(['actions' => function ($query) {
                    $query->where('need_allow', 1);
                    $query->select(['actions.id', 'resource_id', 'actions.name', 'actions.display_name']);
                }]);
                $query->select(['resources.id', 'resource_group_id', 'resources.name', 'resources.display_name']);
            }]);
            $query->select(['resource_groups.id', 'department_id', 'resource_groups.name', 'resource_groups.display_name']);

        }])->get(['id', 'name', 'display_name']);
        return $departments;
    }


    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request,$id = null)
    {
        $rules = [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required|unique:roles,display_name',
        ];
        if ($id !== null) {
            $rules['name'] = 'required|unique:roles,name,' . $id;
            $rules['display_name'] = 'required|unique:roles,display_name,' . $id;
        }

        return $rules;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getFormData($data)
    {
        $departments = $this->getDepartments();
        if(!isset($data['action_id'])){
            $data['action_id']=[];
        }
        return [
            'model' => $data,
            'options' => ['departments' => $departments],
            'name' => 'role',

        ];
    }


}