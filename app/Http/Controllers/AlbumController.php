<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required'
            ]);
            $album = new Album();
            $album->name = $data['name'];
            $album->user_id = Auth::user()->id;
            $album->save();
            return response()->json(['success', 'message' => 'Anda berhasil menambahkan Album.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Anda gagal menambahkan Album.'], 500);
        }
    }

    public function update(Request $request, Album $album)
    {
        try {
            $albumData = Album::findOrFail($album);
            $albumData->name = $request->name;
            $albumData->save();
            return response()->json(['success', 'message' => 'Anda berhasil mengupdate Album ini.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Anda gagal mengupdate Album ini.'], 500);
        }
    }

    public function destroy(Album $album)
    {
        try {
            $albumData = Album::findOrFail($album);
            $albumData->delete();
            return response()->json(['success', 'message' => 'Anda telah menghapus Album'], 500);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Anda gagal menghapus Album'], 500);
        }
    }
}
