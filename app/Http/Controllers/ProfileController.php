<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request->all());
        // $request->user()->fill($request->validated());
        $validated = $request->validated();

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // if ($request->hasFile('avatar')) {
        //     if ($request->user()->avatar) {
        //         Storage::disk('public')->delete($request->user()->avatar);
        //     }

        //     $path = $request->file('avatar')->store('img', 'public');
        //     $validated['avatar'] = $path;
        // }

        if ($request->has('avatar')) {
            // If user has an old avatar, delete the old avatar
            if ($request->user()->avatar) {
                Storage::disk('public')->delete($request->user()->avatar);
            }

            // Get the file name from the avatar request ('tmp/example.png')
            $fileName = Str::after($request->avatar, 'tmp/');

            // Move the file from "tmp" to "img" dir
            Storage::disk('public')->move($request->avatar, "img/$fileName");

            // Replace the avatar value with the new path
            $validated['avatar'] = "img/$fileName";
        }

        // $request->user()->save();
        $request->user()->update($validated);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('tmp', 'public');

            return $path;
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
