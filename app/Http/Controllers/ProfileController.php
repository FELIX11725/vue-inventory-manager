<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
       
        return inertia::render('Profile/settings');
    }


public function update(Request $request)
{
     //dd($request->all());
    $user =Auth::user();
     $request->validate([
        'avatar_path'   => 'image|max:2048',
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|max:255',
        'password' => 'nullable|string|min:8',
    ]);

    if($request->hasFile('avatar_path')) {
        // Delete old avatar_path if it exists
        if($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
            Storage::disk('public')->delete($user->avatar_path);
        }
        // Store new avatar_path with user's name
        $avatarPath = $request->file('avatar_path')->store('avatars/' . $user->name, 'public');
    } else {
        $avatarPath = $user->avatar_path;
    }

    // Update user's avatar_path path
    $user->update([
        'avatar_path' => $avatarPath,
    ]);
    
    return redirect()
        ->route('users.users')
        ->with('message', 'user updated successfully.');
}
}


