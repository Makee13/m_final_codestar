<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Services\Social\SocialService;
use Laravel\Socialite\Two\InvalidStateException;

class SocialAuthController extends Controller
{
    private $socialService;

    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }

    public function verify($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback(Request $request, $social)
    {
        if ($this->isInActiveSocials($social)) {
            try {
                $socialUser = Socialite::driver($social)->user();
            } catch (InvalidStateException $e) {
                $socialUser = Socialite::driver($social)->stateless()->user();
            }

            $user = $this->socialService->updateOrCreate($socialUser);

            if ($user) {
                Auth::login($user);
            }
        }
        return redirect()->route('home');
    }

    private function isInActiveSocials($social)
    {
        return in_array($social, SocialAccount::ACTIVE_SOCIALS);
    }
}
