<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use App\Models\UserNotification;
use Exception;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        return view('home.notification', [
            'title' => __('titles.list', ['name' => 'notification']),
            'notifications' => Auth::user()->notifications()
                                            ->with(['userNotifications' => function ($userNotifications) {
                                                $userNotifications->where('user_id', Auth::id());
                                            }])
                                            ->orderBy('is_read', 'DESC')->get()
        ]);
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(StoreNotificationRequest $request)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(Notification $notification)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(Notification $notification)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateNotificationRequest $request)
    {
        UserNotification::markMessagesAsRead();

        return redirect()->route('notifications.list')->with('success', __('messages.update', ['name' => 'notifications']));
    }

    public function destroy(Notification $notification)
    {
        throw new Exception('The feature is not implemented!');
    }
}
