<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(Request $request) //all the information notification  
    {
        $user = $request->user();
        $notifications = $user->unreadNotifications;

        return response()->json($notifications);
    }

    public function indexData(Request $request) // jsut the DAta
    {
        $user = $request->user();
        $notifications = $user->unreadNotifications->take(10);
       // $notifications->markAsRead();
    
        $notificationsData = [];
        foreach ($notifications as $notification) {
            $data = $notification->data;
            $data['id'] = $notification->id;
            $notificationsData[] = $data;
        }
    
        return response()->json($notificationsData);
    }



    public function markAsRead($id) //for the web super admin mark as read notifications
    {
        $notification = Auth::user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        return back();
    }
}
