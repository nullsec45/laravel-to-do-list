<?php

namespace App\Providers;

use App\Services\UserServices;
use App\Services\Impl\UserServicesImpl;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons=[
        UserServices::class => UserServicesImpl::class
    ];
    
    public function provides():array{
        return [UserServices::class];
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
