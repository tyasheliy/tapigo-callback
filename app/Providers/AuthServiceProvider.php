<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Services\AuthService;
use Illuminate\Console\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    public function register(): void {
        $this->app->singleton(AuthService::class, function(){
            return new AuthService;
        });
    }

    public function boot(): void
    {
        //
    }
}
