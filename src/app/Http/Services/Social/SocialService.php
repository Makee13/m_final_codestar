<?php

namespace App\Http\Services\Social;

use Exception;
use App\Models\User;
use App\Models\SocialAccount;
use Illuminate\Support\Carbon;

class SocialService
{
    /**
     * Update user depend on social account
     *
     * @param SocialAccount $socialAccount
     * @return User
     */
    private function updateUser($socialAccount, $socialUser) {
        $user = $socialAccount->user;
    
        $user->name = $socialUser->name;
        $user->email = $socialUser->email;
        $user->save();

        $socialAccount->token = $socialUser->token;
        $socialAccount->refresh_token = $socialUser->refreshToken;
        $socialAccount->save();

        return $user;
    }

    /**
     * Update or create user for each social media type
     *
     * @param [User] $user
     * @param [string] $social
     * @return boolean
     */
    public function updateOrCreate($socialUser)
    {
        try {
            $socialAccount = SocialAccount::where('id', $socialUser->id)->first();
            if($socialAccount) {
                $user = $this->updateUser($socialAccount, $socialUser);
                return $user;
            }

            $email = $socialUser->email;
            $user = User::where('email', $email)->first();
            if(!$user) {
                $user = User::create([
                    'name' => $socialUser->name, 
                    'email' => $socialUser->email,   
                    'phone' => '',
                    'email_verified_at' => Carbon::now(),
                ]);
            }

            SocialAccount::create([
                'id' => $socialUser->id,
                'token' => $socialUser->token,
                'refresh_token' => $socialUser->refreshToken,
                'user_id' => $user->id
            ]);

            return $user;
        } catch(Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
