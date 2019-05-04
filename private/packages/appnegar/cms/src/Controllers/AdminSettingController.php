<?php

namespace Appnegar\Cms\Controllers;

use App\Setting;
use App\SettingGroup;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;
use Illuminate\Validation\Rule;

class AdminSettingController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'Setting';
    }

    protected function getOrderScopes()
    {
        return ['setting_group_id'];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Http\JsonResponse|static[]
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function updateAllSettings(Request $request)
    {
        if ($request->isMethod('get')) {
            $model_groups = SettingGroup::with(['settings' => function ($query) {
                $query->orderBy('order', 'asc');
            }])->get()->toArray();
            foreach ($model_groups as $index => $model_group) {
                foreach ($model_group['settings'] as $inner_index => $model) {
                    if ($model['details']) {

                            $array = explode(',', $model['details']);
                            $details = [];
                            foreach ($array as $detail) {
                                if (strpos($detail, ':')) {
                                    list($name, $value) = explode(':', $detail);
                                    $details[] = ['text' => trim($name), 'id' => trim($value)];
                                }
                                else{
                                    $details[] = ['text' => trim($detail), 'id' => trim($detail)];
                                }
                            }
                            $model_groups[$index]['settings'][$inner_index]['details'] = $details;
                    }

                }
            }
            return response()->json([
                'model'=>$model_groups
            ]);
//            return ($model_groups);
        } elseif ($request->isMethod('put')) {
            $this->validate($request, [
                'settings.*.id' => 'required',
                'settings.*.value' => 'required',
            ]);

            foreach ($request->settings as $setting) {
                $model = Setting::findOrFail($setting['id']);
                $model->value = $setting['value'];
                $model->save();
            }
            return response()->json([
                'message' => ' تنظیمات با موفقیت بروزرسانی شد'
            ]);
        }

    }

    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request, $id = null)
    {
        $rules = [
            'setting_group_id' => 'required|exists:setting_groups,id',
            'name' => [
                'required',
                Rule::unique('settings', 'name')->where(function ($query) use ($request, $id) {
                    $query->where('setting_group_id', $request->department_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'display_name' => [
                'required',
                Rule::unique('settings', 'display_name')->where(function ($query) use ($request, $id) {
                    $query->where('setting_group_id', $request->department_id);
                    if ($id !== null) {
                        $query->where('id', '<>', $id);
                    }
                })
            ],
            'value' => 'required',
            'type' => 'required',
            'direction' => 'required',
            'order' => 'numeric|min:0',

        ];

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
            'options' => ['setting_group_id' => SettingGroup::get(['id', 'display_name  AS text'])],
            'image_path' => [],
            'name' => 'setting',

        ];
    }
}