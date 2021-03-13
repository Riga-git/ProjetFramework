<?php

namespace App\Policies;

use App\Http\Resources\UserWithGrade;
use App\Models\Department;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Collection;

class DepartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Department  $department
     * @return mixed
     */
    public function view(User $user, Department $department)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user, Grade $params)
    {
        return $user->grade_id === $params->id && $params->can_manage_departments === 1;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Department  $department
     * @return mixed
     */
    public function update(User $user, Department $department, Grade $params)
    {
        return $user->grade_id === $params->id && $params->can_manage_departments === 1;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Department  $department
     * @return mixed
     */
    public function delete(User $user, Department $department, Grade $params)
    {
        return $user->grade_id === $params->id && $params->can_manage_departments === 1;
    }
}
