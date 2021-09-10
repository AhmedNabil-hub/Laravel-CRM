@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('users.create') }}">
                Create user
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Users list</div>

        <div class="card-body">
          @if (session('errors'))
            <div class="alert alert-danger" role="alert">
                {{ session('errors') }}
            </div>
          @endif

          @if (session('message'))
            <div class="alert alert-danger" role="alert">
                {{ session('message') }}
            </div>
          @endif

          <div class="d-flex justify-content-end">
            <form action="{{ route('users.index') }}" method="GET">
                <div class="form-group row">
                    <label for="status" class="col-form-label">Status:</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="status" id="status" onchange="this.form.submit()">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                            @foreach(App\Models\User::STATUS as $status)
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
                    <th>ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    {{-- @if ($withDeleted)
                        <th>Deleted at</th>
                    @endif --}}
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->fname }}</td>
                        <td>{{ $user->lname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->status }}</td>
                        {{-- @if ($withDeleted)
                            <td>{{ $user->deleted_at ?? 'Not deleted' }}</td>
                        @endif --}}
                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('users.edit', $user) }}">
                                Edit
                            </a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $users->withQueryString()->links() }}
        </div>
    </div>

@endsection
