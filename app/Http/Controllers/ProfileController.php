<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }
    public function edit()
{
    return view('profile.edit');
}

public function update(Request $request)
{
    $user = Auth::user();
    
    // Validate and update user information
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'nullable|string|max:20',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'bio' => 'nullable|string',
        'sector' => 'nullable|string',
        'association_name' => 'nullable|string',
    ]);
    
    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $validatedData['profile_picture'] = $path;
    }

    $user->update($validatedData);

    return redirect()->route('profile.show')->with('success', 'Profil mis à jour avec succès.');
}
}
