<?php

namespace App\Observers;

use App\Action;

class ActionObserver
{
    use DestroyCacheTrait;
    /**
     * Handle the action "created" event.
     *
     * @param  \App\Action  $action
     * @return void
     */
    public function created(Action $action)
    {
        $this->deleteCacheActions($action);
        $this->deleteCacheDepartments();
    }

    /**
     * Handle the action "updated" event.
     *
     * @param  \App\Action  $action
     * @return void
     */
    public function updated(Action $action)
    {
        $this->deleteCacheActions($action);
        $this->deleteCacheDepartments();
    }

    /**
     * Handle the action "deleted" event.
     *
     * @param  \App\Action  $action
     * @return void
     */
    public function deleted(Action $action)
    {
        $this->deleteCacheActions($action);
        $this->deleteCacheDepartments();
    }

    /**
     * Handle the action "restored" event.
     *
     * @param  \App\Action  $action
     * @return void
     */
    public function restored(Action $action)
    {
        //
    }

    /**
     * Handle the action "force deleted" event.
     *
     * @param  \App\Action  $action
     * @return void
     */
    public function forceDeleted(Action $action)
    {
        //
    }
}
