@extends('layouts.dashboard')

@section('content')
<div class="col-md-4"></div>
    <div class="col-md-6">

        <div class=" col-md-8" id="add">
            <div class="card">
                <center><br><br>
                    <div class="card-header col-md-8"> <strong>Upgrade Staff Role &nbsp{{$staff->username}}</strong></div>
                </center><br><br>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $staff->id) }}">
                            @csrf
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-left">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{$staff->first_name }}" placeholder="{{$staff->first_name}}" readonly>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-left">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $staff->last_name }}" placeholder="{{$staff->last_name}}" readonly>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-left">{{ __('Username') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $staff->username }}" placeholder="{{$staff->username}}" readonly>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="userRole" class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>

                            <div class="col-md-6">
                                <select id="userRole" name="userRole" class="form-control @error('userRole') is_invalid @enderror" required autofocus>
                                  <option value="">{{$staff->userRole}}</option>
                                  <option value="supervisor">Supervisor</option>
                                  <option value="user">User</option>
                                </select>

                                    @error('userRole')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row"></div>
                            <div class="col-md-12">
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4"></div>
                                        <div class="col-md-4 offset-md-3">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Upgrade Staff') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div class="col-md-2"></div>

@endsection
