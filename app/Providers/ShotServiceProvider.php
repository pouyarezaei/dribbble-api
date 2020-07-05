<?php


namespace App\Providers;


use App\Repositories\ShotRepository\EloquentShotRepository;
use App\Repositories\ShotRepository\ShotRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ShotServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ShotRepositoryInterface::class, EloquentShotRepository::class);
    }
}