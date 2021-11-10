@extends('layouts.dashboard')

@section('content')
<div class="col-md-4"></div>
    <div class="col-md-6">

        <div class=" col-md-8" id="add">
            <div class="card">
                <center><br><br>
                    <div class="card-header col-md-8"> <strong> Re-stock Product {{$product->name}}</strong></div>
                </center><br><br>
                <div class="card-body">
                    <form method="POST" action="{{ route('refill.store', $product->id) }}">
                            @csrf
                        <div class="form-group row">
                            <label for="product_id" class="col-md-3 col-form-label text-md-left">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <select id="product_id" name="product_id" class="form-control @error('name') is_invalid @enderror"  autofocus>
                                  <option value="{{$product->id}}">{{$product->name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="old_stock" class="col-md-3 col-form-label text-md-left">{{ __('Old_stock') }}</label>
                            <div class="col-md-6">
                                <input id="old_stock" type="text" class="form-control{{ $errors->has('old_stock') ? ' is-invalid' : '' }}" name="old_stock" value="{{$product->quantity }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantity" class="col-md-3 col-form-label text-md-left">{{ __('Quantity') }}</label>
                            <div class="col-md-6">
                                <input id="quantity" type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" value="{{ old('quantity') }}" onchange="calculate()"  placeholder="Quantity to be added">

                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_stock" class="col-md-3 col-form-label text-md-left">{{ __('Total Stock') }}</label>
                            <div class="col-md-6">
                                <input id="total_stock" type="text" class="form-control{{ $errors->has('total_stock') ? ' is-invalid' : '' }}" name="total_stock" value="" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-3 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select id="category" name="category" class="form-control @error('category') is_invalid @enderror"  autofocus onchange="calculate()">
                                  <option value="{{$product->category_id}}">{{$product->category->name}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row"></div>
                            <div class="col-md-12">
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4"></div>
                                        <div class="col-md-4 offset-md-3">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Refill Product') }}
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

@section('extra-script')
    <script type="text/javascript">

        function calculate()
        {
            var old = parseInt(document.getElementById("old_stock").value);
            var qty = parseInt(document.getElementById("quantity").value);
            $('#total_stock').val(old + qty);
        }
    </script>

@endsection
