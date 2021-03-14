<?php

namespace App\Traits;

use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

trait AuthTrait{

  /**
   * Get the grade_id for the authenticated user
   *
   * @return int grade_id
   */
  protected function userGrade(){
    return Grade::find(Auth::user()->grade_id);
  }

  /**
   * Get the right to manage departments for the authenticated user
   *
   * @return int can_manage_departments
   */
  protected function authForDepartments(){
    return Grade::find(Auth::user()->grade_id)->can_manage_departments;
  }

  /**
   * Get the right to manage projects for the authenticated user
   *
   * @return int can_manage_projects
   */
  protected function authForProjects(){
    return Grade::find(Auth::user()->grade_id)->can_manage_projects;
  }

}
