<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use App\Department;
use Illuminate\Validation\Rule;

use App\Resource;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;

class ActionController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Action';
    }


    protected function setRequest($request,$model){
        $request['resource_name'] = Resource::findOrFail($request->resource_id)->name;
        return $request;
    }


    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        $rules = [
            'resource_id' => 'required|exists:resources,id',
            'name' => [
                'required',
                Rule::unique('actions', 'name')->where(function ($query) use ($request, $id) {
                    $query->where('resource_id', $request->resource_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'display_name' => [
                'required',
                Rule::unique('actions', 'display_name')->where(function ($query) use ($request, $id) {
                    $query->where('resource_id', $request->resource_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'type' => 'required|in:general,page_loader,frame_loader',
            'need_allow' => 'required|between:0,1',
            'status' => 'required|between:0,1',
        ];
        return $rules;
    }

    /**
     * @param array $data
     * @param null $model
     * @return array
     */
    protected function getFormData($data, $model = null)
    {
        $resources=[];
        if ($model['id'] !== 0) {

            $data['department_id'] = Resource::findOrFail($data['resource_id'])->resource_group->department_id;
            $resources = Resource::whereHas('resource_group', function ($query) use ($data, $model) {
                if ($model !== null) {
                    $query->where('department_id', $data['department_id']);
                }
            })->get(['id', 'display_name  AS text']);
        }

        return [
            'model' => $data,
            'options' => [
                'department_id' => Department::orderBy('id')->get(['id', 'display_name  AS text']),
                'resource_id' => $resources,
            ],
        ];
    }

    public function changeDepartment(Request $request)
    {

        $resources = Resource::whereHas('resource_group', function ($query) use ($request) {
            if ($request->department_id) {
                $query->where('department_id', $request->department_id);
            }

        })->select(['id', 'display_name  AS text'])->get();


        return response()->json($resources);
    }

}