<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/23
 * Time: 11:45
 */

namespace App\Repositories;

use App\Permission;
use Illuminate\Support\Facades\Redirect;

class PermissionsRepositories
{
    public function newPermission($request)
    {
        Permission::create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
        ]);
    }
}