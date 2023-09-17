<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function addNotification()
    {
        $header = 'noti';
        return view('notification.AddNotification', compact('header'));
    }

    public function notificationSave(Request $request)
    {
        $notificationsave = Notification::create([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->desc
        ]);

        $data['success'] = "success";
        echo json_encode($data);
    }
}
