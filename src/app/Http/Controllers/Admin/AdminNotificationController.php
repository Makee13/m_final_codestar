<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
{
    public function index()
    {
        return view('admin.notification.list', [
            'title' => __('titles.list', ['name' => 'notifications'])
        ]);
    }

    public function store(StoreNotificationRequest $request)
    {
        $notification = Notification::create([
            'content' => $request->input('content'),
            'title' => $request->input('title'),
            'notice_types' => $request->input('notice_types'),
            'image' => $request->input('thumb'),
            'sender_id' => Auth::id()
        ]);

        UserNotification::addUserNotifications($request->users,
            $notification->id,
            $isSendAll = $request->input('send_all'));

        return back()->with('success', __('messages.succ-add-mess', ['name' => 'notification']));
    }

    public function create()
    {
        return view('admin.notification.add', [
            'title' => __('titles.add', ['name' => 'notification']),
            'users' => User::where('roles', 'user')->get()
        ]);
    }

    public function show(Notification $notification)
    {
        return view('admin.notification.edit', [
            'title' => __('titles.edit', ['name' => 'notifications']),
            'notification' => $notification,
            'users' => User::where('roles', 'user')->get()
        ]);
    }

    public function edit(Notification $notification)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(StoreNotificationRequest $request, Notification $notification)
    {
        if (!$notification) {
            return back()->with('error', __('messages.err-update-mess', ['name' => 'notification']));
        }

        $notification->update([
            'content' => $request->input('content'),
            'notice_types' => $request->input('notice_types'),
            'image' => $request->input('thumb'),
            'sender_id' => Auth::id(),
        ]);

        UserNotification::where('notification_id', $notification->id)->delete();

        UserNotification::addUserNotifications($request->users,
            $notification->id,
            $isSendAll = $request->input('send_all'));

        return back()->with('success', __('messages.succ-update-mess', ['name' => 'notification']));
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return back()->with('success', __('messages.succ-del-mess', ['name' => 'notification']));
    }
}
