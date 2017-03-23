<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Repositories\RolesRepositories;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{
    protected $repo;
    function __construct(RolesRepositories $repo)
    {
        $this->middleware('role:admin');
        $this->middleware(['permission:delete_role', 'protectAdminRole'],['only' => 'destroy']);
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //预加载方法，减少查询次数，常用于查一个数据时，关联查询其相关数据。
        $roles = Role::with('perms')->get();  //取得role，同时每个role附加与其有关的permissions附加数组传递，$roles中的每个$role都有一个$perms数组
        $perms = Permission::get();
        return view('auth.roles.index',compact('roles','perms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->repo->newRole($request);

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repo->editRole($request, $id);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        //相当于admin这个角色永不能被删除
        if($role->name !=='admin'){
            $role->delete();
        }
        return Redirect::back();
    }
}
