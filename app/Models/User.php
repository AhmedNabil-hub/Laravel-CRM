<?php

namespace App\Models;

use App\Models\Task;
use App\Models\Project;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;


  protected $fillable = [
    'fname',
    'lname',
    'email',
    'password'
  ];


  protected $hidden = [
    'password',
    'remember_token',
  ];


  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function tasks()
  {
    return $this->hasMany(Task::class);
  }

  public function projects()
  {
    return $this->hasMany(Project::class);
  }
}
