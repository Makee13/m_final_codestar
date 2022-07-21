<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Policies\Admin\AdminOrderPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy','
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Reset link to sent for user
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return request()->getSchemeAndHttpHost().'/password/reset/bymail?token='.$token;
        });

    }
}
