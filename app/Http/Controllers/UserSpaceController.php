<?php

namespace App\Http\Controllers;

use App\Models\Space;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSpaceController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookings()->where('status', '!=', 'ended')->with('space')->get();

        $user = auth()->user();
        $workspaces = $user->activeWorkspaces()->get();

        return view('spaces.index', compact('bookings', 'workspaces'));
    }


    public function show(Space $space)
    {
        $user = auth()->user();
        if (!$space->users()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You do not have access to this workspace!.');
        }

        $activeBooking = $space->bookings()
            // ->where('user_id', $space->owner->user_id)
            ->where('status', 'confirmed')
            ->whereDate('date_to_activate', '>=', Carbon::now()) 
            ->first();

        if (!$activeBooking) {
            return redirect()->route('my.space.index')->with('error', 'This workspace booking is no longer active.');
        }

        $owner = $space->owner->user;
        return view('spaces.show', compact('space', 'owner'));
    }

    public function addUserToWorkspace(Request $request, $workspaceId)
    {
        $workspace = Space::findOrFail($workspaceId);

        if (!$workspace->users()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You do not have access to this workspace.');
        }

        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $newUser = User::where('email', $validated['email'])->first();

        if ($workspace->users()->where('user_id', $newUser->id)->exists()) {
            return back()->with('error', 'User is already a member of this workspace.');
        }

        $workspace->users()->attach($newUser->id);

        return back()->with('success', 'User added to the workspace successfully.');
    }

    public function removeUserFromWorkspace(Request $request, $workspaceId)
    {
        $workspace = Space::findOrFail($workspaceId);

        // Check if the current user has access to the workspace
        if (!$workspace->users()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You do not have access to this workspace.');
        }

        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $userToRemove = User::where('email', $validated['email'])->first();

        // Check if the user is actually associated with the workspace
        if (!$workspace->users()->where('user_id', $userToRemove->id)->exists()) {
            return back()->with('error', 'User is not a member of this workspace.');
        }

        // Detach the user from the workspace
        $workspace->users()->detach($userToRemove->id);

        return back()->with('success', 'User removed from the workspace successfully.');
    }
}
