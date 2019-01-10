<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\DegreeDetail;
use App\Policies\DegreePolicy;
use App\Workload;
use App\Policies\WorkloadPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        DegreeDetail::class => DegreePolicy::class,
        Workload::class => WorkloadPolicy::class,

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
