<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    public function read($notif)
    {

        auth()->user()->notifications->where('id', $notif)->first()->markAsRead();
        return redirect('home');
    }
}
