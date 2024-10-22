<?php

namespace App\Observers;

use App\Traits\PermissionTrait;

class RolePermissionObserver
{
    use PermissionTrait;

    /**
     * Handle the RolePermission "created" event.
     */
    public function created(): void
    {
        $this->clearCachedRolePermissions();
    }

    /**
     * Handle the RolePermission "updated" event.
     */
    public function updated(): void
    {
        $this->clearCachedRolePermissions();
    }

    /**
     * Handle the RolePermission "deleted" event.
     */
    public function deleted(): void
    {
        $this->clearCachedRolePermissions();
    }

    /**
     * Handle the RolePermission "restored" event.
     */
    public function restored(): void
    {
        $this->clearCachedRolePermissions();
    }

    /**
     * Handle the RolePermission "force deleted" event.
     */
    public function forceDeleted(): void
    {
        $this->clearCachedRolePermissions();
    }
}
