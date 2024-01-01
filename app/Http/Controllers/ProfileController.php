<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Update user information
        $data = [
            'name' => $request->input('name'),
            'email'=>$request->input('email'),
        ];
        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        // Handle profile image upload
        if ($request->hasFile('profile_picture')) {
            // Delete the previous profile image if it exists
            if ($user->profile_image) {
                Storage::delete($user->profile_image);
            }

            // Store the new profile image
            $profileImage = $request->file('profile_picture');
            $path = $profileImage->store('profile_images', 'public'); // 'profile_images' is the storage folder; adjust as needed
            $data['profile_image'] = $path;
        }

        $user->update($data);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}

