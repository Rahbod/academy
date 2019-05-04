<?php

namespace Appnegar\Cms\Controllers\SystemManagement;

use App\Basesetting;
use App\Setting;
use App\SettingGroup;
use Illuminate\Http\Request;
use Appnegar\Cms\Controllers\AdminController;
use Illuminate\Validation\Rule;

class SettingGroupController extends AdminController
{
    public function __construct()
    {
        $this->resource = 'SettingGroup';
    }

    /**
     * @param $request
     * @param null $id
     * @return array
     */
    protected function validationRules($request = null, $id = null)
    {
        $rules = [
            'name' => 'required|unique:setting_groups,name',
            'display_name' => 'required|unique:setting_groups,display_name',
            'settings.*.name' => 'required',
            'settings.*.display_name' => 'required',
            'settings.*.value' => 'required',
            'settings.*.type' => 'required',
            'settings.*.direction' => 'required',
            'settings.*.order' => 'required|numeric|min:0',
        ];
        if ($id !== null and $request !== null)
            $rules['name'] = 'required|unique:setting_groups,name,' . $id;
        $rules['display_name'] = 'required|unique:setting_groups,display_name,' . $id;
        if (isset($request->settings)) {
            foreach ($request->settings as $index => $setting) {
                $rules['settings.' . $index . '.name'] = [
                    'required',
                    Rule::unique('settings', 'name')->where(function ($query) use ($id, $setting) {
                        $query->where('setting_group_id', $id);
                        if ($setting['id'] !== 0) {
                            $query->where('id', '<>', $setting['id']);
                        }
                    })
                ];
                $rules['settings.' . $index . '.display_name'] = [
                    'required',
                    Rule::unique('settings', 'display_name')->where(function ($query) use ($id, $setting) {
                        $query->where('setting_group_id', $id);
                        if ($setting['id'] !== 0) {
                            $query->where('id', '<>', $setting['id']);
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
            'name' => 'setting_group',
        ];
    }
}