<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'token',
        'refresh_token',
        'user_id',
    ];

    const ACTIVE_SOCIALS = ['facebook'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
