<?php

namespace App\Observers;

use App\ResourceGroup;

class ResourceGroupObserver
{
    use DestroyCacheTrait;
    /**
     * Handle the resource group "created" event.
     *
     * @param  \App\ResourceGroup  $resourceGroup
     * @return void
     */
    public function created(ResourceGroup $resourceGroup)
    {
        $this->deleteCacheDepartments();
    }

    /**
     * Handle the resource group "updated" event.
     *
     * @param  \App\ResourceGroup  $resourceGroup
     * @return void
     */
    public function updated(ResourceGroup $resourceGroup)
    {
        $this->deleteCacheDepartments();
    }

    /**
     * Handle the resource group "deleted" event.
     *
     * @param  \App\ResourceGroup  $resourceGroup
     * @return void
     */
    public function deleted(ResourceGroup $resourceGroup)
    {
        $this->deleteCacheDepartments();
    }

    /**
     * Handle the resource group "restored" event.
     *
     * @param  \App\ResourceGroup  $resourceGroup
     * @return void
     */
    public function restored(ResourceGroup $resourceGroup)
    {
        //
    }

    /**
     * Handle the resource group "force deleted" event.
     *
     * @param  \App\ResourceGroup  $resourceGroup
     * @return void
     */
    public function forceDeleted(ResourceGroup $resourceGroup)
    {
        //
    }
}
