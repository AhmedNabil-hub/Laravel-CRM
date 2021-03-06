@extends('layouts.app')

@section('content')
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header">Contact information</div>

            <div class="card-body">
                <div class="form-group">
                    <label class="required" for="contact_name">Name</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
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
                    <label for="phone_number">Phone number</label>
                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                    @if($errors->has('phone_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone_number') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                      @foreach(App\Models\Client::STATUS as $status)
                          <option
                              value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                      @endforeach
                  </select>
                  @if($errors->has('status'))
                      <div class="invalid-feedback">
                          {{ $errors->first('status') }}
                      </div>
                  @endif
                  <span class="help-block"> </span>
              </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Company information</div>
            <div class="card-body">
                <div class="form-group">
                    <label class="required" for="company_name">Company name</label>
                    <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" required>
                    @if($errors->has('company_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_name') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="company_vat">Company vat</label>
                    <input class="form-control {{ $errors->has('company_vat') ? 'is-invalid' : '' }}" type="text" name="company_vat" id="company_vat" value="{{ old('company_vat') }}" required>
                    @if($errors->has('company_vat'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_vat') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="company_address">Company address</label>
                    <input class="form-control {{ $errors->has('company_address') ? 'is-invalid' : '' }}" type="text" name="company_address" id="company_address" value="{{ old('company_address') }}" required>
                    @if($errors->has('company_address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_address') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="company_city">Company city</label>
                    <input class="form-control {{ $errors->has('company_city') ? 'is-invalid' : '' }}" type="text" name="company_city" id="company_city" value="{{ old('company_city') }}" required>
                    @if($errors->has('company_city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_city') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="company_zip">Company zip</label>
                    <input class="form-control {{ $errors->has('company_zip') ? 'is-invalid' : '' }}" type="text" name="company_zip" id="company_zip" value="{{ old('company_zip') }}" required>
                    @if($errors->has('company_zip'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_zip') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary" type="submit">
                    Save
                </button>
            </div>
        </div>
    </form>

@endsection
