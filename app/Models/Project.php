<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Filter;

class Project extends Model
{
  use HasFactory, Filter;

  protected $fillable = [
    'title',
    'deadline',
    'status',
    'description',
    'user_id',
    'client_id'
  ];

  const STATUS = [ 'open', 'in progress', 'completed', 'cancelled', 'blocked'];

  // protected $with = ['user', 'client', 'tasks'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function client()
  {
    return $this->belongsTo(Client::class);
  }

  public function tasks()
  {
    return $this->hasMany(Task::class);
  }
}
