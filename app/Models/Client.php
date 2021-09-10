<?php

namespace App\Models;

use App\Traits\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, Filter;

    protected $fillable = [
      'name',
      'email',
      'phone_number',
      'company_name',
      'company_address',
      'company_city',
      'company_zip',
      'company_vat',
      'status'
    ];

    const STATUS = ['active', 'inactive'];

    public function projects()
  {
    return $this->hasMany(Project::class);
  }
}
