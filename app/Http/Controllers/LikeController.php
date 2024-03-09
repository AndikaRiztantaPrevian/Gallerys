<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'post_id' => 'required',
            ]);
            Like::create([
                'post_id' => $validated['post_id'],
                'user_id' => Auth::user()->id,
            ]);  

            return redirect()->back()->with('success', 'Anda menyukai postingan ini.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Anda gagal menyukai postingan ini.');
        }
    }

    public function destroy(Like $like)
    {
        try {
            $like->delete();
            return redirect()->back()->with('success', 'Anda tidak lagi menyukai postingan ini.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Proses gagal silahkan coba beberapa saat lagi.');
        }
    }
}
