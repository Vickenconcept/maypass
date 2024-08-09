<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $superAdminRole = Role::where('name', 'super-admin')->first();
        $superAdminRoleId = $superAdminRole ? $superAdminRole->id : null;
    
        if ($superAdminRoleId) {
            $users = User::whereDoesntHave('roles', function ($query) use ($superAdminRoleId) {
                $query->where('roles.id', $superAdminRoleId);
            })->get();
        } else {
            $users = User::all(); // Fallback if the role does not exist
        }
        
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'super-admin')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:8',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Update user details
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $validated['roles'] = array_map('intval', $validated['roles']);

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Sync roles
        if (isset($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}
