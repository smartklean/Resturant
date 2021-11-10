@extends('layouts.dashboard')

@section('content')
<div class="col-md-4"></div>
    <div class="col-md-6">

        <div class=" col-md-8" id="add">
            <div class="card">
                <center><br><br>
                    <div class="card-header col-md-8"> <strong>Reset {{$staff->username}} &nbsp;Password</strong></div>
                </center><br><br>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.reset', $staff->id) }}">
                            @csrf
                        
                        

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        <div class="form-group row"></div>
                                <div class="col-md-12">
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4"></div>
                                            <div class="col-md-4 offset-md-3">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Reset Password') }}
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
