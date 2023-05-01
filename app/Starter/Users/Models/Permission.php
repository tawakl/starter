<?php

namespace App\Starter\Users\Models;

use Laratrust\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    protected $table = "permissions";
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
}
