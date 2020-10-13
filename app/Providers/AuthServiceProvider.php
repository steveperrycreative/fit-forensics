<?php

namespace App\Providers;

use App\Models\File;
use App\Models\Investigation;
use App\Models\Team;
use App\Policies\FilePolicy;
use App\Policies\InvestigationPolicy;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        File::class => FilePolicy::class,
        Investigation::class => InvestigationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
