<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'notice_types',
        'sender_id',
        'receiver_id',
        'content',
        'created_at',
        'updated_at',
    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function userNotifications() {
        return $this->hasMany(UserNotification::class, 'notification_id', 'id');
    }

    public function receivers() {
        return $this->belongsToMany(User::class, 'user_notification', 'user_id', 'notification_id');
    }
}
