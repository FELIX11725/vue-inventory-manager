<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(Request $request)
{
    $users = User::when($request->input('search'), function ($query, $search) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
    })->orderBy('id')->get();

    return Inertia::render('Users/users', [
        'users' => $users
    ]);
}

}