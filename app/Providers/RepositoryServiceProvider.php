<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\Interfaces\SettingRepositoryInterface;
use App\Repository\SettingRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
    }
}
