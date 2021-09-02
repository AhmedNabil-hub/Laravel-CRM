<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
      'title' => 'required|string|min:3',
      'description' => 'required|string|min:3',
      'deadline' => 'required|date',
      'status' => 'required|in:closed,open,waiting client,in progress,blocked,pending',
      'user_id' => 'required|exists:users,id',
      'client_id' => 'required|exists:clients,id',
      'project_id' => 'required|exists:projects,id',
    ];
  }
}
