<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index(): Response
    {
        $users = User::all();
        return Inertia::render('Profile/List', ['users' => $users]);
    }

    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function show(User $user)
    {
        $userFind = User::find($user);

        if (!$userFind) {
            abort(404);
        }

        return Inertia::render('Profile/Edit', ['user' => $userFind]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        // Update common fields
        $user->fill([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Update role if provided
        if (isset($validatedData['role'])) {
            $user->role = $validatedData['role'];
        }

        // Check and reset email verification if the email is changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
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
