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
            return response()->json(['success', 'message' => 'Pesan anda terkirim!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Pesan anda gagal dikirim!'], 500);
        }
    }

    public function destroy(Comment $comment)
    {
        try {
            $comment = Comment::findOrFail($comment);
            $comment->delete();
            return response()->json(['success', 'message' => 'Berhasil menghapus komentar anda.'], 202);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Gagal menghapus komentar anda.'], 500);
        }
    }
}
