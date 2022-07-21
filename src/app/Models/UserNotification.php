<?php

namespace App\Models;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserNotification extends Model
{
    use HasFactory;

    protected $table = 'user_notification';

    protected $fillable = [
        'user_id',
        'notification_id',
        'is_read',
        'created_at',
        'updated_at',
    ];

    public $incrementing = false;

    protected $primaryKey = ['user_id', 'notification_id'];

    protected function setKeysForSaveQuery($query)
    {
        return $query->where('user_id', $this->getAttribute('user_id'))
                    ->where('notification_id', $this->getAttribute('notification_id'));
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Mark messages as read for login user
     *
     * @return void
     */
    public static function markMessagesAsRead()
    {
        return self::where('user_id', Auth::id())
                    ->where('is_read', 'unread')
                    ->update(['is_read' => 'read']);
    }

    /**
     * Add user notifications, which add all or not
     * 
     * @param [array] $userIds 
     * @param [integer] $noticeId 
     * @param [boolean] $isSendAll 
     */
    public static function addUserNotifications($userIds, $noticeId, $isSendAll)
    {
        $data = [];
        if ($isSendAll || $userIds == null) {
            $userIds = User::where('roles', User::USER_ROLE)->pluck('id')->toArray();
        }

        foreach ($userIds as $key => $userId) {
            array_push($data, [
                'user_id' => $userId,
                'notification_id' => $noticeId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        self::insert($data);
    }
}
