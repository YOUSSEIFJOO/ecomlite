<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

trait PermissionTrait
{
    /**
     * Check user can make a permission
     *
     * @param $permission
     * @param $guardName
     * @return bool
     */
    public function hasPermission($permission, $guardName): bool
    {
        return $this->getAuthUserPermissions()->contains(function ($value) use ($permission, $guardName) {
            return $value['name'] === $permission && $value['guard_name'] === $guardName;
        });
    }

    private function getPermissions()
    {
        return Cache::remember('permissions', 60 * 24, function () {
            return Permission::all();
        });
    }

    private function getRolePermissions()
    {
        return Cache::remember('role_permissions', 60 * 24, function () {
            return RolePermission::all();
        });
    }

    private function getAuthUserPermissions()
    {
        $cachedPermissions = $this->getPermissions();
        $authUserPermissionsIds = $this->getAuthUserPermissionsIds();

        return $cachedPermissions->whereIn('id', $authUserPermissionsIds)->map(function ($permission) {
            return [
                'name' => $permission->name,
                'guard_name' => $permission->guard_name,
            ];
        });
    }

    private function getAuthUserPermissionsIds()
    {
        $cachedRolePermissions = $this->getRolePermissions();

        $roleId = Auth::user()->role_id;
        return $cachedRolePermissions->where('role_id', $roleId)->pluck('permission_id')->toArray();
    }

    public function clearCachedPermissions(): void
    {
        Cache::forget('permissions');
    }

    public function clearCachedRolePermissions(): void
    {
        Cache::forget('role_permissions');
    }
}
