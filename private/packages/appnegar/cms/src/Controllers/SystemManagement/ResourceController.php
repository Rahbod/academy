<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use App\Department;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;
use App\Action;
use App\Resource;
use App\ResourceGroup;

class ResourceController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Resource';
    }

    protected function setRequest($request,$model)
    {
        if(isset($request->actions)){
            $actions=[];
            foreach ($request->actions as $index=>$action){

                $action['resource_name']=$request['name'];
                $actions[]=$action;
            }
            $request['actions']=$actions;
        }
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
            'resource_group_id' => 'required|exists:resource_groups,id',
            'name' => [
                'required',
                Rule::unique('resources', 'name')->where(function ($query) use ($request, $id) {
                    $query->where('resource_group_id', $request->resource_group_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'display_name' => [
                'required',
                Rule::unique('resources', 'display_name')->where(function ($query) use ($request, $id) {
                    $query->where('resource_group_id', $request->resource_group_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'parent_id' => [
                Rule::exists('resources', 'id')->where(function ($query) use ($request, $id) {
                    $query->where('resource_group_id', $request->resource_group_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'actions.*.type' => 'required|in:general,page_loader,frame_loader',
            'actions.*.need_allow' => 'required|between:0,1',
            'actions.*.status' => 'required|between:0,1',
        ];


        if ($request->actions) {
            foreach ($request->actions as $index => $action) {
                $rules['actions.' . $index . '.id'] = 'required';
                $rules['actions.' . $index . '.name'] = [
                    'required',
                    Rule::unique('actions', 'name')->where(function ($query) use ($action, $id) {
                        if ($action['id'] != 0) {
                            $query->where('id', '<>', $action['id']);
                        }
                        $query->where('resource_id', $id);
                    })
                ];
                $rules['actions.' . $index . '.display_name'] = [
                    'required',
                    Rule::unique('actions', 'display_name')->where(function ($query) use ($action, $id) {
                        if ($action['id'] != 0) {
                            $query->where('id', '<>', $action['id']);
                        }
                        $query->where('resource_id', $id);
                    })
                ];
                if ($action['id'] != 0) {
                    $rules['actions.' . $index . '.id'] .= '|exists:actions,id';
                }
            }
        }
        return $rules;
    }

    /**
     * @param array $data
     * @param null $model
     * @return array
     */
    protected function getFormData($data, $model = null)
    {
        if ($model !== null) {
            $data['department_id'] = $model->resource_group->department_id;
        }
        $resources = Resource::where(function ($query) use ($model) {
            if ($model !== null) {
                $query->where('resource_group_id', $model->resource_group_id)->where('id', '<>', $model->id);
            }
        })->get(['id', 'display_name  AS text']);

        $resource_groups = ResourceGroup::where(function ($query) use ($model, $data) {
            if ($model !== null) {
                $query->where('department_id', $data['department_id']);
            }
        })->get(['id', 'display_name  AS text']);


        return [
            'model' => $data,
            'options' => [
                'department_id' => Department::orderBy('id')->get(['id', 'display_name  AS text']),
                'resource_group_id' => $resource_groups,
                'parent_id' => $resources
            ],
            'image_path' => [],
            'name' => 'resource',

        ];
    }

//    /**
//     * @param $request
//     * @param $model
//     * @param $action
//     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
//     */
//    protected function transaction($request, $model, $action)
//    {
//        try {
//            $status = \DB::transaction(function () use ($request, $model, $action) {
//                $status = $this->saveModel($model, $request, $action);
//                return $status;
//            });
//            $message = null;
//            if (isset($status['message'])) {
//                $message = $status['message'];
//                $status = $status['status'];
//            }
//            if (isset($status['status'])) {
//                $status = $status['status'];
//            }
//            return $this->getResponseMessage($status, $this->resource, $action, $message);
//        } catch (\Exception $e) {
//            return response(['message' => $e->getMessage()], 500);
////            throw $e;
//        }
//
//    }

    public function changeDepartment(Request $request)
    {
        $this->validate($request, [
            'resource_id' => 'required',
        ]);

        $resources = Resource::whereHas('resource_group', function ($query) use ($request) {
            if ($request->department_id) {
                $query->where('department_id', $request->department_id);
            }

        })->where('id', '<>', $request->resource_id)->select(['id', 'display_name  AS text'])->get();

        $resource_groups = ResourceGroup::where(function ($query) use ($request) {
            if ($request->department_id) {
                $query->where('department_id', $request->department_id);
            }

        })->select(['id', 'display_name  AS text'])->get();

        return ['resources' => $resources, 'resource_groups' => $resource_groups];
    }

    public function changeResourceGroup(Request $request)
    {
        $this->validate($request, [
            'resource_group_id' => 'required|exists:resource_groups,id',
            'resource_id' => 'required',
        ]);

        $resources = Resource::where('resource_group_id', $request->resource_group_id)->where('id', '<>', $request->resource_id)->select(['id', 'display_name  AS text'])->get();

        return ['resources' => $resources];
    }

}