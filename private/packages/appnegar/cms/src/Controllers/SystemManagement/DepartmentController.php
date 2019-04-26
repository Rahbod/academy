<?php

namespace Appnegar\Cms\Controllers\SystemManagement;


use App\Department;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;
use App\SpNameSpace;
use App\ResourceGroup;
use Illuminate\Validation\Rule;

class DepartmentController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Department';
    }

    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        $rules = [
            'namespace_id' => 'required|exists:sp_namespaces,id',
            'name' => 'required|unique:departments,name',
            'display_name' => 'required|unique:departments,display_name',
            'resource_groups.*.name' => 'required',
            'resource_groups.*.display_name' => 'required',
        ];
        if ($id !== null) {
            $rules['name'] .= ',' . $id;
            $rules['display_name'] .= ',' . $id;
        }

        if ($request->resource_groups) {
            foreach ($request->resource_groups as $index => $resource_group) {
                $rules['resource_groups.' . $index . '.id'] = 'required';
                $rules['resource_groups.' . $index . '.name'] = [
                    'required',
                    Rule::unique('resource_groups', 'name')->where(function ($query) use ($resource_group, $id) {
                        if ($resource_group['id'] != 0) {
                            $query->where('id', '<>', $resource_group['id']);
                        }
                        if ($id !== null) {
                            $query->where('department_id', $id);
                        }
                    })
                ];
                $rules['resource_groups.' . $index . '.display_name'] = [
                    'required',
                    Rule::unique('resource_groups', 'display_name')->where(function ($query) use ($resource_group, $id) {
                        if ($resource_group['id'] != 0) {
                            $query->where('id', '<>', $resource_group['id']);
                        }
                        if ($id !== null) {
                            $query->where('department_id', $id);
                        }
                    })
                ];
                if ($resource_group['id'] != 0) {
                    $rules['resource_groups.' . $index . '.id'] .= '|exists:resource_groups,id';
                }
            }
        }

        return $rules;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getFormData($data)
    {
        return [
            'model' => $data,
            'options' => ['namespace_id' => SpNameSpace::get(['id', 'display_name AS text'])],
            'image_path' => [],
            'name' => 'department',

        ];
    }

}