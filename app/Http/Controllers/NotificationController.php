<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function update(Request $request, Notification $notification)
    {
        try {
            $notif = Notification::findOrFail($notification);
            $notif->read = 1;
            $notif->save();
            return response()->json(['success', 'message' => 'Anda menandai notifikasi ini sudah dibaca.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error', 'message' => 'Anda gagal menandai notifikasi ini sudah dibaca.'], 500);

        }
    }
}
