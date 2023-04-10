<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $role=Role::whereNotIn('name', ['superadmin'])->get();
        return view('admin.role.index',compact('role'));
    }

/*     public function create()
    {
         $role=Role::all();
        return view('admin.role.create');
    }

    public function store(Request  $request)
    {
        $validated=$request->validate(['name'=>['required','min:3']]);
        Role::create($validated);
        return to_route('admin.roles.index')->with('message', 'Role Created Successfuly');

    } */

    public function edit (Role $role)
    {
        $permission = Permission::all();
        return view('admin.role.edit' , compact('role', 'permission'));
    }

    public function update(Request  $request, Role $role)
    {
        $validated=$request->validate(['name' => 'required']);
        $role->update($validated);

        return to_route('admin.roles.index')->with('message', 'Role Updated Successfuly');

    }

    public function destroy (Role $role)
    {
        $role->delete();

        return back()->with('message','Role Deleted Successfuly ' );
    }

    public function givePermission(Request $request, Role $role)
    {

        if($role->hasPermissionTo($request->permission)){
            return back()->with('message','Permission exists. ' );
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message','Permission added. ' );

    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message','Permission revoked.' );
        }
        return back()->with('message','Permission not exists. ' );
    }


}
