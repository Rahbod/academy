<?php

namespace App\Observers;

use App\Department;
use Illuminate\Support\Facades\Cache;

class DepartmentObserver
{
    use DestroyCacheTrait;
    /**
     * Handle the department "created" event.
     *
     * @param  \App\Department  $department
     * @return void
     */
    public function created(Department $department)
    {
        $this->deleteCacheDepartments();
    }

    /**
     * Handle the department "updated" event.
     *
     * @param  \App\Department  $department
     * @return void
     */
    public function updated(Department $department)
    {
        $this->deleteCacheDepartments();
    }

    /**
     * Handle the department "deleted" event.
     *
     * @param  \App\Department  $department
     * @return void
     */
    public function deleted(Department $department)
    {
       $this->deleteCacheDepartments();
    }

    /**
     * Handle the department "restored" event.
     *
     * @param  \App\Department  $department
     * @return void
     */
    public function restored(Department $department)
    {
        //
    }

    /**
     * Handle the department "force deleted" event.
     *
     * @param  \App\Department  $department
     * @return void
     */
    public function forceDeleted(Department $department)
    {
        //
    }
}
