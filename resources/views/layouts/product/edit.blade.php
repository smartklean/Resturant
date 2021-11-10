@extends('layouts.dashboard')

@section('content')
<div class="col-md-4"></div>
    <div class="col-md-6">

        <div class=" col-md-8" id="add">
            <div class="card">
                <center><br><br>
                    <div class="card-header col-md-8"> <strong> Edit Product {{$product->name}}</strong></div>
                </center><br><br>
                <div class="card-body">
                    <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-left">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$product->name }}" placeholder="{{$product->name}}" >

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantity" class="col-md-3 col-form-label text-md-left">{{ __('Quantity') }}</label>
                            <div class="col-md-6">
                                <input id="quantity" type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" value="{{$product->quantity }}" placeholder="product quantity i.e 200">

                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="selling_price" class="col-md-3 col-form-label text-md-left">{{ __('Selling Price') }}</label>
                            <div class="col-md-6">
                                <input id="selling_price" type="text" class="form-control{{ $errors->has('selling_price') ? ' is-invalid' : '' }}" name="selling_price" value="{{ $product->selling_price }}" placeholder="selling price">

                                @if ($errors->has('selling_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('selling_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-3 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select id="category" name="category" class="form-control @error('category') is_invalid @enderror"  autofocus>
                                  <option value="{{$product->category_id}}">{{$product->category->name}}</option>
                                   @foreach($categories as $category)
                                    	<option value="{{ $category->id }}">
                                              {{ $category->name }}
                                        </option>
                                     @endforeach
                                </select>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="low_stock" class="col-md-3 col-form-label text-md-left">{{ __('Product Low-stock') }}</label>
                            <div class="col-md-6">
                                <input id="low_stock" type="text" class="form-control{{ $errors->has('low_stock') ? ' is-invalid' : '' }}" name="low_stock" value="{{$product->low_stock }}" placeholder="alert me when product quantity left is i.e 200">

                                @if ($errors->has('low_stock'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('low_stock') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="logo" class="col-md-3 col-form-label text-md-left">{{ __('Logo') }}</label>
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
                                            {{ __('Update Product') }}
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
