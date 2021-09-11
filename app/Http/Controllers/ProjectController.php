<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{

  public function __construct()
  {
    $this->authorizeResource(Project::class, 'project');
  }

  public function index()
  {
    $projects = Project::filterStatus(request('status'))->paginate(20);

    return view('projects.index', compact('projects'));
  }


  public function create()
  {
    $users = User::all();
    $clients = Client::all();

    return view('projects.create', compact('users', 'clients'));
  }


  public function store(StoreProjectRequest $request)
  {
    $data = $request->validated();

    Project::create($data);

    return redirect()->route('projects.index')
      ->with('message', 'project created successfully');
  }


  public function show(Project $project)
  {
    return view('projects.show', compact('project'));
  }


  public function edit(Project $project)
  {
    $users = User::all();
    $clients = Client::all();

    return view('projects.edit', compact('project', 'users', 'clients'));
  }


  public function update(UpdateProjectRequest $request, Project $project)
  {
    $data = $request->validated();

    $project->update($data);

    return redirect()->route('projects.index')
      ->with('message', 'project updated successfully');
  }


  public function destroy(Project $project)
  {
    $project->loadCount('user');
    $project->loadCount(['tasks' => function ($query) {
      $query->whereIn('status', ['open', 'in progress']);
    }]);
    $project->loadCount('client');

    if(($project->user_count != 0)
      || ($project->tasks_count != 0)
      || ($project->client_count != 0)) {
      return redirect()->route('projects.index')
        ->with('message', 'This project cannot be deleted because it is assigned to clients or users or has running tasks!');
    }

    $project->delete();

    return redirect()->route('projects.index')
      ->with('message', 'project deleted successfully');
  }
}
