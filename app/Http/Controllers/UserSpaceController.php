<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSpaceController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user's bookings
        $bookings = Auth::user()->bookings()->where('status', '!=', 'ended')->with('space')->get();

        // Pass the bookings to the view
        return view('spaces.index', compact('bookings'));
    }

    
    public function show(Space $space)
    {
        return view('spaces.show', compact('space'));
    }
}
