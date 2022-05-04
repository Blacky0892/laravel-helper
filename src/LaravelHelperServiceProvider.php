<?php

namespace Blacky0892\LaravelHelper;

use Illuminate\Support\ServiceProvider;

class LaravelHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-helper', \Blacky0892\LaravelHelper\Helper::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        require_once 'ExcelMacro.php';
        require_once 'functions.php';
    }
}