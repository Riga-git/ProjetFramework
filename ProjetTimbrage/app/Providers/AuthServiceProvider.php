<?php

namespace App\Providers;

use App\Models\Assignment;
use App\Models\Clocking;
use App\Models\Department;
use App\Models\Grade;
use App\Models\Project;
use App\Models\User;
use App\Policies\AssignmentPolicy;
use App\Policies\ClockingPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\GradePolicy;
use App\Policies\ProjectPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Assignment::class => AssignmentPolicy::class,
        Clocking::class => ClockingPolicy::class,
        Department::class => DepartmentPolicy::class,
        Grade::class => GradePolicy::class,
        Project::class => ProjectPolicy::class,
        User::class => UserPolicy::class,
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
