<?php

namespace App\Observers;

use App\SettingGroup;

class SettingGroupObserver
{
    /**
     * Handle the setting group "created" event.
     *
     * @param  \App\SettingGroup  $settingGroup
     * @return void
     */
    public function created(SettingGroup $settingGroup)
    {
        makeSettingFile();
    }

    /**
     * Handle the setting group "updated" event.
     *
     * @param  \App\SettingGroup  $settingGroup
     * @return void
     */
    public function updated(SettingGroup $settingGroup)
    {
        makeSettingFile();
    }

    /**
     * Handle the setting group "deleted" event.
     *
     * @param  \App\SettingGroup  $settingGroup
     * @return void
     */
    public function deleted(SettingGroup $settingGroup)
    {
        makeSettingFile();
    }

    /**
     * Handle the setting group "restored" event.
     *
     * @param  \App\SettingGroup  $settingGroup
     * @return void
     */
    public function restored(SettingGroup $settingGroup)
    {
        //
    }

    /**
     * Handle the setting group "force deleted" event.
     *
     * @param  \App\SettingGroup  $settingGroup
     * @return void
     */
    public function forceDeleted(SettingGroup $settingGroup)
    {
        //
    }
}
