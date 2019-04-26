<?php

namespace Appnegar\Cms\Traits;

use Illuminate\Http\Request;
use App\Setting;
use App\SettingGroup;

trait AdminSettingTrait
{
    public function updateSettings(Request $request)
    {
        $setting_group_name = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $this->resource)), '_');
        $setting_groups = SettingGroup::where('name', $setting_group_name)->get();
        if ($request->isMethod('get')) {
            $setting_groups ->load(['settings' => function ($query) {
                $query->orderBy('order', 'asc');
            }]);
            foreach ($setting_groups as $index=>$model_group) {
                foreach ($model_group['settings'] as $inner_index=>$model) {
                    if ($model['details']) {
                        if (!strpos($model['details'], ':')) {
                            $object = app($model['details']);
                            $models = $object::get(['id', 'display_name']);
                            $details = [];
                            foreach ($models as $model) {
                                $details[] = ['text' => $model->display_name, 'id' => $model->id];
                            }

                            $setting_groups[$index]['settings'][$inner_index]['details']=$details;

                        }
                        else {
                            $array = explode(',', $model['details']);
                            $details = [];
                            foreach ($array as $detail) {
                                if (strpos($detail, ':')) {
                                    list($name, $value) = explode(':', $detail);
                                    $details[] = ['text' => trim($name), 'id' => trim($value)];
                                }
                            }
                            $setting_groups[$index]['settings'][$inner_index]['details']=$details;
                        }
                    }

                }
            }
            return response()->json([
                'model'=>$setting_groups
            ]);
        } elseif ($request->isMethod('put')) {
            $this->validate($request, [
                'settings.*.id' => 'required',
                'settings.*.value' => 'required',
            ]);
            $setting_group=$setting_groups->first();
            foreach ($request->settings as $setting) {
                $model = Setting::where('setting_group_id',$setting_group->id)->findOrFail($setting['id']);
                $model->value = $setting['value'];
                $model->save();
            }
            makeSettingFile();
            return response()->json([
                'message' => ' تنظیمات با موفقیت بروزرسانی شد'
            ]);
        }

    }
}