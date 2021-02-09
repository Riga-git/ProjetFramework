<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

    protected $fillable = [
      'user_id',
      'name'
    ];

    public function userIn(){
      return $this->hasMany(User::class, 'department_id');
    }

    public function leader(){
      return $this->belongsTo(User::class, 'id');
    }


}
