<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Signature;

class SignatureController extends Controller
{
    public function index()
    {
        
        $signatures =  Signature::all();
        return inertia::render('Guestbook/signatures', [
            'signatures'=> $signatures

        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'name'    => 'required|string|max:50',
            'message' => 'required|string|max:280',
        ]);

        // Create new signature
        $signature = Signature::create([
            'name'    => $validated['name'],
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route('signatures.index')
            ->with('message', 'Thank you '.$validated['name'].' for signing the guestbook!');
    }
}
