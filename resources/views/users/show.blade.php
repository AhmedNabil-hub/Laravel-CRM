@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">Contact information</div>

        <div class="card-body">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <span class="font-weight-bold mr-4">First Name</span>
              <p class="mb-0">{{ $user->fname }}</p>
            </div>
            <div class="d-flex align-items-center">
              <span class="font-weight-bold mr-4">Last Name</span>
              <p class="mb-0">{{ $user->lname }}</p>
            </div>
            <div class="d-flex align-items-center">
              <span class="font-weight-bold mr-4">Email</span>
              <p class="mb-0">{{ $user->email }}</p>
            </div>
            <div class="d-flex align-items-center">
              <span class="font-weight-bold mr-4">Status</span>
              <p class="mb-0">{{ $user->status }}</p>
            </div>
          </div>
        </div>
    </div>

    @if ($user->id == auth()->id())
    <div class="card">
        <div class="card-header">Change password</div>

        <div class="card-body">
            <form action="{{ route('users.updatePassword') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="required" for="old_password">Current password</label>
                    <input class="form-control {{ $errors->has('cur_password') ? 'is-invalid' : '' }}" type="password" name="cur_password" id="cur_password" required>
                    @if($errors->has('cur_password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cur_password') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="new_password">New password</label>
                    <input class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}" type="password" name="new_password" id="new_password" required>
                    @if($errors->has('new_password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('new_password') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="new_password_confirmation">Confirm new password</label>
                    <input class="form-control {{ $errors->has('new_password_confirmation') ? 'is-invalid' : '' }}" type="password" name="new_password_confirmation" id="new_password_confirmation" required>
                    @if($errors->has('new_password_confirmation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('new_password_confirmation') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <button class="btn btn-primary" type="submit">
                    Save
                </button>
            </form>
        </div>
    </div>
    @endif

@endsection
