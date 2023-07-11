<?php

namespace App\Providers;

use App\Interfaces\HewanInterface;
use App\Interfaces\JenisInterface;
use App\Interfaces\ProfileInterface;
use App\Interfaces\UpdateInterface;
use App\Repositories\HewanRepository;
use App\Repositories\JenisRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\UpdateHargaRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(JenisInterface::class, JenisRepository::class);
        $this->app->bind(ProfileInterface::class, ProfileRepository::class);
        $this->app->bind(UpdateInterface::class, UpdateHargaRepository::class);
        $this->app->bind(HewanInterface::class, HewanRepository::class);
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
