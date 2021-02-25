<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'user_id',
    'project_id',
    'date',
    'duration'
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function project(){
    return $this->belongsTo(Project::class);
  }
}
