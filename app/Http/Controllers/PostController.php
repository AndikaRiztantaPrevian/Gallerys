<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Album;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::where('user_id', Auth::user()->id)->get();
        $album = Album::where('user_id', Auth::user()->id)->get();

        return view('post.index', compact('post', 'album'));
    }

    public function edit(Post $post)
    {
        $album = Album::where('user_id', Auth::user()->id)->get();
        return view('post.edit', compact('post', 'album'));
    }

    public function show(Post $post)
    {
        $like = Like::where('user_id', Auth::user()->id)->get();
        $likeCount = Like::count();
        return view('post.show', compact('post', 'like', 'likeCount'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $name_image = $data['image']->store('gambar', 'public');
            Post::create([
                'user_id' => Auth::user()->id,
                'album_id' => $data['album_id'],
                'image' => $name_image,
                'title' => $data['title'],
                'description' => $data['description']
            ]);
            return back()->with('success', 'Berhasil mengupload postingan anda!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupload postingan anda!');
        }
    }

    public function update(Request $request, $post)
    {
        try {
            $post = Post::findOrFail($post);

            if ($request->image) {
                $validated = $request->validate([
                    'title' => 'required',
                    'image' => 'required|mimes:png,jpg,jpeg',
                    'description' => 'required',
                    'album_id' => 'required',
                ]);

                Storage::disk('public')->delete($post->image);

                $name_image = $validated['image']->store('gambar', 'public');
                $validated['image'] = $name_image;

                $post->update($validated);

                return back()->with('success', 'Berhasil mengupdate postingan');
            } else {
                $validated = $request->validate([
                    'title' => 'required',
                    'description' => 'required',
                    'album_id' => 'required',
                ]);

                $validated['image'] = $post->image;

                $post->update($validated);

                return back()->with('success', 'Berhasil mengupdate postingan');
            }
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', 'Gagal mengupdate postingan');
        }
    }



    public function destroy($post)
    {
        try {
            $postData = Post::findOrFail($post);
            $oldImage = $postData->image;
            Storage::disk('public')->delete($oldImage);
            $postData->delete();
            return back()->with('success', 'Berhasil menghapus postingan anda!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus postingan anda.');
        }
    }
}
