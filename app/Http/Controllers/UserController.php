<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;


class UserController extends Controller
{
    public function index()
    {
        $users = User::when(request('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })->orderBy('id', 'desc')->get();

        return Inertia::render('Users/users', [
            'users' => $users
        ]);
    }
}