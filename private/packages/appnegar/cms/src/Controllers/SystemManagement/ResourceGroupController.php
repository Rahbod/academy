<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use Illuminate\Validation\Rule;

use App\Department;
use App\Resource;
use Appnegar\Cms\Controllers\AdminController;

class ResourceGroupController extends AdminController
{

    public function __construct()
    {
        $this->resource = 'ResourceGroup';
    }


    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        $rules = [
            'department_id' => 'required|exists:departments,id',
            'name' => [
                'required',
                Rule::unique('resource_groups', 'name')->where(function ($query) use ($request, $id) {
                    $query->where('department_id', $request->department_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'display_name' => [
                'required',
                Rule::unique('resource_groups', 'display_name')->where(function ($query) use ($request, $id) {
                    $query->where('department_id', $request->department_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'namespace' => [
                Rule::unique('resource_groups', 'display_name')->where(function ($query) use ($request, $id) {
                    $query->where('department_id', $request->department_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ]
        ];


        if ($request->resources) {
            foreach ($request->resources as $index => $resource) {
                $rules['resources.' . $index . '.id'] = 'required';
                $rules['resources.' . $index . '.parent_id'] = [
                    Rule::exists('resources', 'id')->where(function ($query) use ($request, $id, $resource) {
                        if ($id !== null) {
                            $query->where('resource_group_id', $id);
                        }
                        if ($resource['id'] != 0) {
                            $query->where('id', '<>', $resource['id']);
                        }
                    })
                ];
                $rules['resources.' . $index . '.name'] = [
                    'required',
                    Rule::unique('resources', 'name')->where(function ($query) use ($resource, $id) {
                        if ($resource['id'] != 0) {
                            $query->where('id', '<>', $resource['id']);
                        }
                        $query->where('resource_group_id', $id);
                    })
                ];
                $rules['resources.' . $index . '.display_name'] = [
                    'required',
                    Rule::unique('resources', 'display_name')->where(function ($query) use ($resource, $id) {
                        if ($resource['id'] != 0) {
                            $query->where('id', '<>', $resource['id']);
                        }
                        $query->where('resource_group_id', $id);
                    })
                ];
                if ($resource['id'] != 0) {
                    $rules['resources.' . $index . '.id'] .= '|exists:resources,id';
                }
            }
        }
        return $rules;
    }

    /**
     * @param array $data
     * @param $resources
     * @return array
     */
    protected function getFormData($data)
    {
        if( $data['id']== 0){
            $resources = Resource::orderBy('id')->get(['id', 'display_name  AS text']);
        }else{
            $resources = Resource::where('resource_group_id', $data['id'])->orderBy('id')->get(['id', 'display_name  AS text']);
        }
        return [
            'model' => $data,
            'options' => [
                'department_id' => Department::orderBy('id')->get(['id', 'display_name  AS text']),
                'resources.parent_id' => $resources
            ],
            'image_path' => [],
            'name' => 'resource_group',

        ];
    }

}