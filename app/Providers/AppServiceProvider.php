<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        $client = Role::where('name' , 'client')->first();
        view()->share([
            'client'=>$client
        ]);

        $role = Role::where('name' , 'moderator')->first();
        view()->share([
            'role' => $role
        ]);

        
    }
}
