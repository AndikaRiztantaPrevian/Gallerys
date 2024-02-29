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
            $like = new Like();
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();

            $notif = new Notification();
            $notif->post_id = $request->post_id;
            $notif->user_id = Auth::user()->id;
            $notif->message = 'Postingan anda di like oleh,' + Auth::user()->id;
            $notif->save();
            return response()->json(['success', 'message' => 'Anda menglike postingan ini'], 200);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Anda menglike postingan ini'], 500);
        }
    }

    public function destroy(Like $like)
    {
        try {
            $like = Like::findOrFail($like);
            $like->delete();
            return response()->json(['success', 'message' => 'Anda tidak lagi menyukai postingan ini'], 200);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Proses tidak menyukai gagal silahkan coba lagi'], 200);
        }
    }
}
