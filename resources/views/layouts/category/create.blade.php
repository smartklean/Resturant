@extends('layouts.dashboard')

@section('content')
<div class="col-md-4"></div>
    <div class="col-md-6">

        <div class=" col-md-8" id="add">
            <div class="card">
                <center><br><br>
                    <div class="card-header col-md-8"> <strong>Add New Product Category</strong></div>
                </center><br><br>
                <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}"  enctype="multipart/form-data">
                            @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="col-md-2 col-form-label text-md-left">{{ __('Logo') }}</label>
                            <div class="col-md-6">
        
                                <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" name="logo" >
                                @error('logo')
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
                                                {{ __('Add Category') }}
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
