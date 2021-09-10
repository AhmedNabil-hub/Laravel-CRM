@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('clients.create') }}">
                Create client
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Clients list</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('message'))
                <div class="alert alert-danger" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="d-flex justify-content-end">
              <form action="{{ route('clients.index') }}" method="GET">
                  <div class="form-group row">
                      <label for="status" class="col-form-label">Status:</label>
                      <div class="col-sm-8">
                          <select class="form-control" name="status" id="status" onchange="this.form.submit()">
                              <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                              @foreach(App\Models\Client::STATUS as $status)
                                  <option
                                      value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
              </form>
          </div>

            <table class="table table-responsive-sm table-striped">
                <thead>
                <tr>
                    <th>Company</th>
                    <th>VAT</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->company_name }}</td>
                        <td>{{ $client->company_vat }}</td>
                        <td>{{ $client->company_address }}</td>
                        <td>{{ $client->status }}</td>
                        <td>
                            <a class="btn btn-xs btn-info" href="{{ route('clients.edit', $client) }}">
                                Edit
                            </a>
                            {{-- @can('delete')

                            @endcan --}}
                            <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                              @csrf
                              @method('DELETE')
                              <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                          </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $clients->withQueryString()->links() }}
        </div>
    </div>

@endsection
