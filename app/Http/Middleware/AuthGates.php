<?php

namespace App\Http\Middleware;

use App\Model\Role;
use Closure;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();

        if (!app()->runningInConsole() && $user) {
            $roles            = Role::with('permission')->get();
            $permissionsArray = [];

            foreach ($roles as $role) {
                foreach ($role->permission as $permissions) {
                    $permissionsArray[$permissions->per_name][] = $role->role_id;
                }
            }

            foreach ($permissionsArray as $title => $roles) {
                Gate::define($title, function (\App\User $user) use ($roles) {
                    return count(array_intersect($user->roles->pluck('role_id')->toArray(), $roles)) > 0;
                });
            }
        }
        return $next($request);
    }
}
