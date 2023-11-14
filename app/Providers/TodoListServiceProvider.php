<?php

namespace App\Providers;

use App\Services\TodoListService;
use Illuminate\Support\ServiceProvider;
use App\Services\Impl\TodoListServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;

class TodoListServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons=[
        TodoListService::class => TodoListServiceImpl::class
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function provides():array{
        return [TodoListService::class];
    }
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
