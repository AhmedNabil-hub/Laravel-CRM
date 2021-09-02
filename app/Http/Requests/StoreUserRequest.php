<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
      'fname' => 'required|string|min:value',
      'lname' => 'required|string|min:value',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:8',
      'role' => 'required|in:admin,user'
    ];
  }
}
