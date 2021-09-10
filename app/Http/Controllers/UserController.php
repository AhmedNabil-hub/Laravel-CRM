<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;

class UserController extends Controller
{

  public function index()
  {
    $users = User::filterStatus(request('status'))->paginate(20);

    return view('users.index', compact('users'));
  }


  public function create()
  {
    return view('users.create');
  }


  public function store(StoreUserRequest $request)
  {
    $data = $request->validated();

    $data['password'] = Hash::make($data['password']);

    User::create($data);

    return redirect()->route('users.index')
      ->with('message', 'user created successfully');
  }


  public function show(User $user)
  {
    return view('users.show', compact('user'));
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

  public function updatePassword(UpdateUserPasswordRequest $request)
  {
    $data = $request->validated();

    User::findOrFail(auth()->id())->update(['password' => Hash::make($data['new_password'])]);

    $user = User::findOrFail(auth()->id());

    return redirect()->route('users.show', compact('user'))
      ->with('message', 'user password updated successfully');
  }


  public function destroy(User $user)
  {
    $user->loadCount(['projects' => function ($query) {
      $query->whereIn('status', ['open', 'in progress', 'pending', 'waiting client']);
    }]);

    $user->loadCount(['tasks' => function ($query) {
      $query->whereIn('status', ['open', 'in progress']);
    }]);

    if (($user->projects_count != 0)
      || ($user->tasks_count != 0)
      || ($user->id === auth()->id())
    ) {
      return redirect()->route('users.index')
        ->with('message', 'This user cannot be deleted because he has projects or tasks assigned to him!');
    }

    $user->delete();

    return redirect()->route('users.index')
      ->with('message', 'user deleted successfully');
  }
}
