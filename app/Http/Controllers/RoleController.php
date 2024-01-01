<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $loginUser = auth()->user();
        $roles = Role::all();
        return view('roles.roles', compact('roles','loginUser'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.creatrole', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'roleName' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create([
            'name' => $request->input('roleName'),
        ]);

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.editrole', compact('role', 'permissions'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'roleName' => 'required|unique:roles,name,' . $id,
            'permissions' => 'array',
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->input('roleName'),
        ]);

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
}
