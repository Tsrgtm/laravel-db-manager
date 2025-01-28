<?php

namespace Tsrgtm\DbManager;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Tsrgtm\DbManager\Livewire\DbManager; // Update the namespace

class DbManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load the Livewire component
        Livewire::component('db-manager', DbManager::class);
        
        // Load the views from the specified directory
        $this->loadViewsFrom(__DIR__ . '/../views', 'db-manager');
    }

    public function register()
    {
        // Register any application services if needed
    }
}
