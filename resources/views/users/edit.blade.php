@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Edit user</div>

        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="required" for="fname">First name</label>
                    <input class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}" type="text" name="fname" id="fname" value="{{ old('fname', $user->fname) }}" required>
                    @if($errors->has('fname'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fname') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="lname">Last name</label>
                    <input class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}" type="text" name="lname" id="lname" value="{{ old('lname', $user->lname) }}" required>
                    @if($errors->has('lname'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lname') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="email">Email</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role"
                          id="role" required>
                      @foreach(App\Models\User::ROLE as $role)
                          <option
                              value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
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
                <label for="status">Status</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
                    @foreach(App\Models\User::STATUS as $status)
                        <option
                            value="{{ $status }}" {{ (old('status') ? old('status') : $user->status ?? '') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
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
