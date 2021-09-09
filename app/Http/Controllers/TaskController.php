<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{

  public function index()
  {
    $tasks = Task::paginate(20);

    return view('tasks.index', compact('tasks'));
  }


  public function create()
  {
    $users = User::all();
    $clients = Client::all();
    $projects = Project::all();

    return view('tasks.create', compact('users', 'clients', 'projects'));
  }


  public function store(StoreTaskRequest $request)
  {
    $data = $request->validated();

    Task::create($data);

    return redirect()->route('tasks.index')
      ->with('message', 'task created successfully');
  }


  public function show(Task $task)
  {
    return view('tasks.show', compact('task'));
  }


  public function edit(Task $task)
  {
    $users = User::all();
    $clients = Client::all();
    $projects = Project::all();

    return view('tasks.edit', compact('task', 'users', 'clients', 'projects'));
  }


  public function update(UpdateTaskRequest $request, Task $task)
  {
    $data = $request->validated();

    $task->update($data);

    return redirect()->route('tasks.index')
      ->with('message', 'task updated successfully');
  }


  public function destroy(Task $task)
  {
    $task->loadCount('user');
    $task->loadCount('project');

    if(($task->user_count != 0)
      || ($task->project_count != 0)) {
      return redirect()->route('tasks.index')
        ->with('message', 'This task cannot be deleted because it is assigned to projects or users!');
    }

    $task->delete();

    return redirect()->route('tasks.index')
      ->with('message', 'task deleted successfully');
  }
}
