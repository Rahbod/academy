<?php

namespace App\Observers;

use App\Path;

class PathObserver
{
    /**
     * Handle the setting "created" event.
     * @return void
     * @internal param Path $path
     * @internal param \App\Setting $setting
     */
    public function created()
    {
        makeRouteFile();
    }

    /**
     * Handle the setting "updated" event.
     * @return void
     * @internal param Path $path
     * @internal param \App\Setting $setting
     */
    public function updated()
    {
        makeRouteFile();
    }

    /**
     * Handle the setting "deleted" event.
     * @return void
     * @internal param Path $path
     * @internal param \App\Setting $setting
     */
    public function deleted()
    {
        makeRouteFile();
    }

    /**
     * Handle the setting "restored" event.
     *
     * @param Path $path
     * @return void
     * @internal param \App\Setting $setting
     */
    public function restored(Path $path)
    {
        //
    }

    /**
     * Handle the setting "force deleted" event.
     *
     * @param Path $path
     * @return void
     * @internal param \App\Setting $setting
     */
    public function forceDeleted(Path $path)
    {
        //
    }
}
