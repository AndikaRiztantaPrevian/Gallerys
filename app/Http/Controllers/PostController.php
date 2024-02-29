<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $name_image = $data->gambar->store('gambar', 'public');
            Post::create([
                'user_id' => Auth::user()->id,
                'album_id' => $data->album_id,
                'image' => $name_image,
                'title' => $data->title,
                'description' => $data->description
            ]);
            return response()->json(['success', 'message' => 'Berhasil mengupload postingan anda!'], 201);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Gagal mengupload postingan anda!'], 500);
        }
    }

    public function update(UpdateRequest $request, Post $post)
    {
        try {
            $post = Post::findOrFail($post);
            $data = $request->validated();
            $oldImage = $post->image;
            if ($data['image']) {
                Storage::disk('public')->delete($oldImage);
                $name_image = $data['image']->store('gambar', 'public');
                $data['image'] = $name_image;
            }
            $post->update($data);
            return response()->json(['success', 'message' => 'Berhasil mengupdate postingan anda!'], 201);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Gagal mengupdate postingan anda!'], 500);
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post = Post::findOrFail($post);
            $oldImage = $post->image;
            Storage::disk('public')->delete($oldImage);
            $post->delete();
            return response()->json(['success', 'message' => 'Berhasil menghapus postingan anda!'], 202);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Gagal menghapus postingan anda!'], 500);
        }
    }

    protected function getData() {
        $post = Post::inRandomOrder()->paginate();
        return response()->json(['post' => $post]);
    }
}
