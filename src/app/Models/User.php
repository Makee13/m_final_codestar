<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\Message;
use App\Models\WishsList;
use App\Models\UserCoupon;
use App\Models\Notification;
use App\Models\SocialAccount;
use App\Models\UserNotification;
use App\Models\WishsListProduct;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword 
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'phone', 
        'address', 
        'email_verified_at',
        'password_level_2',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ADMIN_ROLE = 'admin';
    const USER_ROLE = 'user';

    const BLOCK_STATUS = '1';
    const NOT_BLOCK_STATUS = '0';

    public function checkInValidAddress() {
        return in_array(null, [$this->province, $this->district, $this->commune]);
    }

    public function socialAccounts() {
        return $this->hasMany(SocialAccount::class, 'user_id', 'id');
    }

    public function cart() {
        return $this->hasOne(Cart::class);
    }

    public function orders() {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function coupons() {
        return $this->belongsToMany(UserCoupon::class, 'user_coupon', 'coupon_id', 'user_id');
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    public function wishsList() {
        return $this->hasOne(WishsList::class, 'user_id', 'id');
    }

    public function notifications() {
        return $this->belongsToMany(Notification::class, 'user_notification', 'user_id', 'notification_id');
    }

    public function userNotifications() {
        return $this->hasMany(UserNotification::class, 'user_id', 'id');
    }

    public function getBlockedUser($email) {
        return self::where('email', $email)->where('is_block', self::BLOCK_STATUS)->first();
    }
}
