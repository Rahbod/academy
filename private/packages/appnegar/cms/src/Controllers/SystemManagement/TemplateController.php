<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use App\Action;
use App\Template;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;
use Illuminate\Validation\Rule;

class TemplateController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Template';
    }

    protected function setModel($model)
    {
        foreach ($model->frames as $frame){
            $frame->load('actions');
        }
        $data = $model->toArray();

        $modelFrames = $data['frames'];
        foreach ($modelFrames as $index => $model_frame) {
            $modelFrames[$index]['action_id']=[];
            if (isset($model_frame['actions']) and count($model_frame['actions'])) {
                $action_ids = [];
                foreach ($model_frame['actions'] as $action) {
                    $action_ids[] = $action['id'];
                }
                $modelFrames[$index]['action_id'] = $action_ids;
            }
            unset( $modelFrames[$index]['actions']);
        }
        $data['frames'] = $modelFrames;
        return $data;
    }

    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        $rules = [
            'name' => 'required|unique:templates,name',
            'display_name' => 'required|unique:templates,display_name',
            'frames.*.action_id' => 'required',
            'frames.*.action_id.*' => Rule::exists('actions', 'id')->where('type', 'frame_loader'),

        ];
        if ($id !== null) {
            $rules['name'] .= ',' . $id;
            $rules['display_name'] .= ',' . $id;
        }
        if ($request->master_pages) {
            foreach ($request->master_pages as $index => $master_page) {
                $rules['master_pages.' . $index . '.name'] = [
                    'required',
                    Rule::unique('master_pages', 'name')->where(function ($query) use ($master_page, $id) {
                        if ($id !== null) {
                            $query->where('template_id', $id);
                        }
                        if ($master_page['id'] != 0) {
                            $query->where('id', '<>', $master_page['id']);
                        }
                    })
                ];
                $rules['master_pages.' . $index . '.display_name'] = [
                    'required',
                    Rule::unique('master_pages', 'display_name')->where(function ($query) use ($master_page, $id) {
                        if ($id !== null) {
                            $query->where('template_id', $id);
                        }
                        if ($master_page['id'] != 0) {
                            $query->where('id', '<>', $master_page['id']);
                        }
                    })
                ];
            }
        }
        if ($request->frames) {
            foreach ($request->frames as $index => $frame) {
                $rules['frames.' . $index . '.name'] = [
                    'required',
                    Rule::unique('frames', 'name')->where(function ($query) use ($request, $frame, $id) {
                        if ($id !== null) {
                            $query->where('template_id', $id);
                        }
                        if ($frame['id'] != 0) {
                            $query->where('id', '<>', $frame['id']);
                        }
                    })
                ];
                $rules['frames.' . $index . '.display_name'] = [
                    'required',
                    Rule::unique('master_pages', 'display_name')->where(function ($query) use ($frame, $id) {
                        if ($id !== null) {
                            $query->where('template_id', $id);
                        }
                        if ($frame['id'] != 0) {
                            $query->where('id', '<>', $frame['id']);
                        }
                    })
                ];
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
            'options' => [
                'frames.action_id' => Action::where('type', 'frame_loader')->get(['id', 'display_name  AS text'])
            ],
            'image_path' => [],
            'name' => 'template',

        ];
    }
}