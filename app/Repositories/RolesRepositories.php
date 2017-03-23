<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/23
 * Time: 11:45
 */

namespace App\Repositories;

use App\Role;
use Illuminate\Support\Facades\Redirect;

class RolesRepositories
{
    public function newRole($request)
    {
        $role = Role::create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
        ]);
        if ($request->perm){
            $role->attachPermissions($request->perm);
        }
    }

    public function editRole($request, $id)
    {
        $role = Role::findOrFail($id);

        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;

        $role->savePermissions($request->perm);
    }
}