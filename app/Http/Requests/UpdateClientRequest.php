<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
      'name' => 'required|string|min:3',
      'email' => 'required|email|unique:clients,email',
      'phone_number' => 'required|alpha_num|unique:clients,phone_number,'.$this->route('client').',id',
      'company_name' => 'required|string|unique:clients,company_name,'.$this->route('client').',id',
      'company_address' => 'required|string',
      'company_city' => 'required|string',
      'company_zip' => 'required|numeric',
      'company_vat' => 'required|numeric|unique:clients,company_vat,'.$this->route('client').',id'
    ];
  }
}
