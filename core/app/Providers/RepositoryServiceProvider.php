<?php

namespace App\Providers;

use App\Contracts\AdminContract;
use App\Contracts\BaseContract;
use App\Contracts\LanguageContract;
use App\Contracts\LanguageDetailsContract;
use App\Contracts\ModuleContract;
use App\Contracts\PermissionContract;
use App\Contracts\RoleContract;
use App\Contracts\UserContract;
use App\Repositories\AdminRepository;
use App\Repositories\BaseRepository;
use App\Repositories\LanguageDetailsRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\ModuleRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        BaseContract::class => BaseRepository::class,
        RoleContract::class => RoleRepository::class,
        ModuleContract::class => ModuleRepository::class,
        PermissionContract::class => PermissionRepository::class,
        UserContract::class => UserRepository::class,
        AdminContract::class => AdminRepository::class,
        LanguageContract::class => LanguageRepository::class,
        LanguageDetailsContract::class => LanguageDetailsRepository::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
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
