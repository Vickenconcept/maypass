<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {

        $roles = Role::where('name', '!=', 'super-admin')->get();
        $permissions = Permission::all();

        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create(['name' => $validated['name']]);

        return redirect()->route('roles.create')->with('success', 'Role created successfully.');
    }

    public function updatePermissions(Request $request, Role $role)
    {
        try {
            $validated = $request->validate([
                'permissions' => 'array',
                'permissions.*' => 'integer|exists:permissions,id',
            ]);

            // Convert permissions to integers
            $validated['permissions'] = array_map('intval', $validated['permissions']);

            // Sync permissions
            $role->syncPermissions($validated['permissions']);

            return redirect()->route('roles.index')->with('success', 'Permissions updated successfully.');
        } catch (\Exception $e) {

            return back()->with('error', 'An error occurred while updating permissions.');
        }
    }
}
