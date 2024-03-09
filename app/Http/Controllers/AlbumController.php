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
            return redirect()->back()->with('success', 'Anda berhasil menambahkan Album.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Anda gagal menambahkan Album.');
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
            $album->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus album.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus album.');
        }
    }
}
