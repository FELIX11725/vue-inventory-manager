<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\PostCategory;

class PostCategoryController extends Controller
{
    public function index()
    {
        $postcategories =  PostCategory::all();
        return inertia::render('Posts/Categories', [
            'postcategories'=> $postcategories
        ]
    );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100|unique:post_categories,name',
        ]);

        // Create new post category
         PostCategory::create([
            'name'        => $validated['name'],
        ]);

        return redirect()
            ->route('postscategories.index')
            ->with('message', 'Post Category '.$validated['name'].' created successfully!');
    }
}
