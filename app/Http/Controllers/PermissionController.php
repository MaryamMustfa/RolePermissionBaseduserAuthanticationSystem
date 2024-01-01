<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the permissions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $loginUser = auth()->user();
        $permissions = Permission::paginate(5); 
        return view('permission.permission', compact('permissions','loginUser'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Permission.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'permissionName' => 'required|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->input('permissionName'),
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully!');
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('Permission.edit', compact('permission'));
    }

    /**
     * Update the specified permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'permissionName' => 'required|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update([
            'name' => $request->input('permissionName'),
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully!');
    }
}
