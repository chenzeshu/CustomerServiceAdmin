<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Redirect;

class ProtectAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route('role');
        $role = Role::findOrFail($id);
        if($role->name !== 'admin'){
            return $next($request);
        }
        return Redirect::back();
    }
}
