<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'deadline',
    'status',
    'description',
    'user_id',
    'client_id',
    'project_id'
  ];

  protected $with = ['user', 'project.client'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function project()
  {
    return $this->belongsTo(Project::class);
  }
}
