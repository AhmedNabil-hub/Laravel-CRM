@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Create user</div>

        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="form-group">
                    <label class="required" for="fname">First Name</label>
                    <input class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}" type="text" name="fname" id="fname" value="{{ old('fname') }}" required>
                    @if($errors->has('fname'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fname') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="lname">Last Name</label>
                    <input class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}" type="text" name="lname" id="lname" value="{{ old('lname') }}" required>
                    @if($errors->has('lname'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lname') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="email">Email</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="password">Password</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" value="{{ old('password') }}" required>
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="password_confirmation">Password Confirmation</label>
                    <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" required>
                    @if($errors->has('password_confirmation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role"
                          id="role" required>
                      @foreach(App\Models\User::ROLE as $role)
                          <option value="{{ $role }}">
                            {{ ucfirst($role) }}
                          </option>
                      @endforeach
                  </select>
                  @if($errors->has('role'))
                      <div class="invalid-feedback">
                          {{ $errors->first('role') }}
                      </div>
                  @endif
                  <span class="help-block"> </span>
              </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
