<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
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
        'cur_password' => 'required|current_password',
        'new_password' => 'required|min:8|confirmed',
        'new_password_confirmation' => 'required'
      ];
    }
}
