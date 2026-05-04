<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminNotificationController extends Controller
{
    public function read($id)
    {
        $notification = DB::table('notifications')->where('id', $id)->first();

        if (!$notification) {
            return redirect()->route('admin.dashboard');
        }

        DB::table('notifications')
            ->where('id', $id)
            ->update([
                'read_at' => now(),
            ]);

        $data = json_decode($notification->data, true);

        return redirect($data['url'] ?? route('admin.dashboard'));
    }
}