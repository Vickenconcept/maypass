<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Events\UserCreated;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    public function showRegistrationForm(Request $request)
    {
        $roles = Role::where('name', '!=', 'super-admin')->get();

        return view('admin.register', compact('roles'));
    }
    public function register(Request $request)
    {

        try {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                // 'role' => 'sometimes',
            ]);
            
            
            $user = User::create($data);

            $role = intval($request->role );

            $user->assignRole($role);
            Mail::to($user->email)->send(new \App\Mail\UserCreatedMail($user->name, $data['password']));

            // event(new UserCreated($user));

        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->back()->withInput()->withErrors(['error' => 'A duplicate entry error occurred. Please try again.']);
            }
        }




        return $request->wantsJson()
            ? Response::api(['data' => $user])
            : to_route('login');
    }

    public function login(CreateUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $request->wantsJson()
                ? Response::api('Invalid Credentials', Response::HTTP_BAD_REQUEST)
                : back()->with('invalidCredential', 'Invalid Credentials');
        }

        return  to_route('home');
    }

    public function logout(Request $request)
    {

        if ($request->wantsJson()) {

            return Response::api('logged out successfully');
        }

        Auth::logout();

        return to_route('login');
    }
}
