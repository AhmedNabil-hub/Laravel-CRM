<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{

  public function index()
  {
    $users = User::paginate(20);

    return view('users.index', compact('users'));
  }


  public function create()
  {
    return view('users.create');
  }


  public function store(StoreUserRequest $request)
  {
    $data = $request->validated();

    User::create($data);

    return redirect()->route('users.index')
      ->with('message', 'user created successfully');
  }


  public function show(User $user)
  {
    //
  }


  public function edit(User $user)
  {
    return view('users.edit', compact('user'));
  }


  public function update(UpdateUserRequest $request, User $user)
  {
    $data = $request->validated();

    $user->update($data);

    return redirect()->route('users.index')
      ->with('message', 'user updated successfully');
  }


  public function destroy(User $user)
  {
    if (($user->loadCount(['projects' => function ($query) {
        $query->whereIn('status', ['open', 'in progress', 'pending', 'waiting client']);
      }]) != 0)
      || ($user->loadCount(['tasks' => function ($query) {
        $query->whereIn('status', ['open', 'in progress']);
      }]) != 0)
    ) {
      return redirect()->route('users.index')
        ->with('message', 'This user cannot be deleted because he has projects or tasks assigned to him!');
    }

    $user->delete();

    return redirect()->route('users.index')
      ->with('message', 'user deleted successfully');
  }
}
