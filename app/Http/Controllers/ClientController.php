<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

  public function index()
  {
    $clients = Client::paginate(20);

    return view('clients.index', compact('clients'));
  }


  public function create()
  {
    return view('clients.create');
  }


  public function store(StoreClientRequest $request)
  {
    $data = $request->validated();

    Client::create($data);

    return redirect()->route('clients.index')
      ->with('message', 'client created successfully');
  }


  public function show(Client $client)
  {
    //
  }


  public function edit(Client $client)
  {
    return view('clients.edit', compact('client'));
  }


  public function update(UpdateClientRequest $request, Client $client)
  {
    $data = $request->validated();

    $client->update($data);

    return redirect()->route('clients.index')
      ->with('message', 'client updated successfully');
  }


  public function destroy(Client $client)
  {
    if(($client->loadCount(['projects' => function ($query) {
      $query->whereIn('status', ['open', 'in progress', 'pending', 'waiting client']);
    }]) != 0)) {
      return redirect()->route('clients.index')
        ->with('message', 'This client cannot be deleted because he has projects or tasks assigned to him!');
    }

    $client->delete();

    return redirect()->route('clients.index')
      ->with('message', 'client deleted successfully');
  }
}
