<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index(Request $request)
    {

        $query = Space::with('category');

        // Filter by search term (name or category name)
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filter by availability
        if ($request->has('availability') && $request->input('availability') !== 'all') {
            $availability = $request->input('availability');
            if ($availability == 'available') {
                $query->where('is_available', 1);
            } elseif ($availability == 'non-available') {
                $query->where('is_available', 0);
            }
        }


        $spaces = $query->latest()->paginate(10);
        return view('admin.spaces.index', compact('spaces'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.spaces.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image',
            'price_per_day' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        Space::create($validated);
        return redirect()->route('spaces.index')->with('success', 'Space created successfully.');
    }

    public function show(Space $space)
    {

        return view('admin.spaces.show', compact('space'));
    }

    public function edit(Space $space)
    {
        $categories = Category::latest()->get();
        return view('admin.spaces.edit', compact('space', 'categories'));
    }

    public function update(Request $request, Space $space)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'price_per_day' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        $space->update($validated);
        return redirect()->route('spaces.index')->with('success', 'Space updated successfully.');
    }

    public function destroy(Space $space)
    {
        $space->delete();
        return redirect()->route('spaces.index')->with('success', 'Space deleted successfully.');
    }
}
