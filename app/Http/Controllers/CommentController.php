<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $comment = new Comment();
            $comment->message = $data['message'];
            $comment->post_id = $data['post_id'];
            $comment->user_id = Auth::user()->id;
            $comment->save();
            return redirect()->back()->with('success', 'Pesan anda terkirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pesan anda gagal dikirim!!');
        }
    }

    public function update(Request $request, $comment)
    {
        try {
            $comment = Comment::findOrFail($comment);
            $validated = $request->validate([
                'message' => 'required',
            ]);
            $comment->update($validated);
            return redirect()->back()->with('success', 'Pesan anda berhasil di perbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pesan anda gagal di perbarui!');
        }
    }

    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus komentar anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus komentar anda.');
        }
    }
}
