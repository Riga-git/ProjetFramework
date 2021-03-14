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
   * Get the right to manage department for the authenticated user
   *
   * @return int can_manage_department
   */
  protected function authForDepartment(){
    return Grade::find(Auth::user()->grade_id)->can_manage_departments;
  }
}
