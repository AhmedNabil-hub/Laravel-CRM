<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
  public function authorize()
  {
    if (Auth::user()->role === 'admin') {
      return true;
    }

    return false;
  }


  public function rules()
  {
    return [
      'fname' => 'required|string|min:3',
      'lname' => 'required|string|min:3',
      'email' => 'required|email|unique:users,email,'.$this->route('user')->id.',id',
      'role' => 'required|in:admin,user'
    ];
  }
}
