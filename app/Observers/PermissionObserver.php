<?php

namespace App\Observers;

use App\Traits\PermissionTrait;

class PermissionObserver
{
    use PermissionTrait;

    /**
     * Handle the Permission "created" event.
     */
    public function created(): void
    {
        $this->clearCachedPermissions();
    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(): void
    {
        $this->clearCachedPermissions();
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(): void
    {
        $this->clearCachedPermissions();
    }

    /**
     * Handle the Permission "restored" event.
     */
    public function restored(): void
    {
        $this->clearCachedPermissions();
    }

    /**
     * Handle the Permission "force deleted" event.
     */
    public function forceDeleted(): void
    {
        $this->clearCachedPermissions();
    }
}
