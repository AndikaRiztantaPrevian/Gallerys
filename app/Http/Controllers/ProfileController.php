<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function photoStore(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $newPhotoPath = $validated['image']->store('photo', 'public');

        $request->user()->photo_path = $newPhotoPath;
        $request->user()->save();

        return redirect()->route('profile.edit')->with('success', 'Anda berhasil menambahkan foto ke profil Anda.');
    }


    public function photoUpdate(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $oldPhotoPath = $request->user()->photo_path;

        if ($oldPhotoPath && Storage::disk('public')->exists($oldPhotoPath)) {
            Storage::disk('public')->delete($oldPhotoPath);
        }

        $newPhotoPath = $validated['image']->store('photo', 'public');
        $request->user()->photo_path = $newPhotoPath;
        $request->user()->save();

        return redirect()->route('profile.edit')->with('success', 'Anda berhasil memperbarui foto profil Anda.');
    }


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
