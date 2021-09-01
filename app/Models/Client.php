<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'email',
      'phone_number',
      'company_name',
      'company_address',
      'company_city',
      'company_zip',
      'company_vat'
    ];

    public function projects()
  {
    return $this->hasMany(Project::class);
  }
}
