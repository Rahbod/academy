<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use App\Action;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;

use App\Template;
use App\Frame;

class FrameController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Frame';
    }

    protected function setModel($model)
    {
        $actions = $model->actions()->get(['id'])->pluck('id');
        $model->action_id = $actions;
        return $model;
    }

    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        return [
            'template_id' => 'required|exists:templates,id',
            'action_id' => 'required',
            'action_id.*' => [
                'required',
                Rule::exists('actions', 'id')->where('type', 'frame_loader')
            ],
            'name' => ['required', Rule::unique('frames')->where(function ($query) use ($request, $id) {
                $query->where('template_id', $request->template_id);
                if ($id !== null) {
                    $query->where('id', '<>', $id);
                }
            })],
            'display_name' => ['required', Rule::unique('frames')->where(function ($query) use ($request, $id) {
                $query->where('template_id', $request->template_id);
                if ($id !== null) {
                    $query->where('id', '<>', $id);
                }
            })],
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getFormData($data)
    {
        return [
            'model' => $data,
            'options' => [
                'template_id' => Template::orderBy('id')->get(['id', 'display_name  AS text']),
                'action_id' => Action::where('type', 'frame_loader')->get(['id', 'display_name  AS text'])
            ],
        ];
    }


}