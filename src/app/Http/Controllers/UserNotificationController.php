<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserNotificationRequest;
use App\Http\Requests\UpdateUserNofificationRequest;
use App\Http\Requests\UpdateUserNotificationRequest;
use App\Models\UserNofification;
use App\Models\UserNotification;
use Exception;

class UserNotificationController extends Controller
{
    public function index()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function create()
    {
        throw new Exception('The feature is not implemented!');
    }

    public function store(StoreUserNotificationRequest $request)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function show(UserNotification $userNotification)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function edit(UserNotification $userNotification)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function update(UpdateUserNotificationRequest $request, UserNotification $userNotification)
    {
        throw new Exception('The feature is not implemented!');
    }

    public function destroy(UserNotification $userNotification)
    {
        throw new Exception('The feature is not implemented!');
    }
}
