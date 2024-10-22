<?php

namespace App\Models;

use App\Observers\RolePermissionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([RolePermissionObserver::class])]
class RolePermission extends Model
{
    use SoftDeletes;

    protected $table = 'role_permission';

    protected $fillable = [
        'role_id', 'permission_id'
    ];
}
