<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public  function index(Request $request){

        $query = Space::where('is_available', true);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    });
                    
            });
        }

        // if ($request->has('status') && $request->input('status') !== 'all') {
        //     $status = $request->input('status');
        //     $query->where('status', $status);
        // }

        $spaces = $query->latest()->get()->shuffle();
        
        return view('home', compact('spaces'));
    }
}
