<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use App\Action;
use App\Department;
use App\Path;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;
use Illuminate\Validation\Rule;

class PathController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Path';
    }

    protected function getOrderScopes(){
        return ['department_id'];
    }

    protected function getDataActions($department_id)
    {
        $actions = Action::where(function ($query) use ($department_id) {
            if ($department_id !== null) {
                $query->whereHas('resource', function ($query) use ($department_id) {
                    $query->whereHas('resource_group', function ($query) use ($department_id) {
                        $query->whereHas('department', function ($query) use ($department_id) {
                            $query->where('id', $department_id);
                        });
                    });
                });
            }
        })->orderBy('id')->get(['id', 'display_name  AS text']);

        return $actions;

    }

    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        return [
            'department_id' => 'required|exists:departments,id',
            'action_id' => 'required|exists:actions,id',
            'name' => [
                'required',
                Rule::unique('paths', 'name')->where(function ($query) use ($request, $id) {
                    $query->where('department_id', $request->department_id);
                    $query->where('method', $request->method);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'display_name' => [
                'required',
                Rule::unique('paths', 'display_name')->where(function ($query) use ($request, $id) {
                    $query->where('department_id', $request->department_id);
                    $query->where('method', $request->method);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'slug' => [
                'required',
                Rule::unique('paths', 'slug')->where(function ($query) use ($request, $id) {
                    $query->where('department_id', $request->department_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'method' => 'required|in:get,post,put,delete',
            'order' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * @param array $data
     * @param null $model
     * @return array
     */
    protected function getFormData($data, $model = null)
    {
        $department_id = null;
        if ($model !== null) {
            $department_id = $model->department_id;
        }

        return [
            'model' => $data,
            'options' => [
                'department_id' => Department::orderBy('id')->get(['id', 'display_name  AS text']),
                'action_id' => $this->getDataActions($department_id)
            ],
            'image_path' => [],
            'name' => 'path',

        ];
    }


    public function changeDepartment(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required|exists:departments,id'
        ]);

        return response()->json($this->getDataActions($request->department_id));
    }

}