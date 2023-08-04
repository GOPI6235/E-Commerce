@extends('layouts.front')


@section('title')
    Wishlist
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a>/
                <a href="{{ url('wishlist') }}">
                    Wishlist
                </a>
            </h6>
        </div>
    </div>


    <div class="container my-5">
        <div class="card shadow cartitems">
            <div class="cart-body">
                @if ($wishlist->count() > 0)
                    @foreach ($wishlist as $item)
                        <div class="row product_data">
    
                            <div class="col-md-2 mt-2 text-center">
                                <a href="{{ url('product/'.$item->product->slug) }}">
                                    <img src="{{ asset('assets/upload/products/' . $item->product->image) }}" height="70px" width="70px" alt="image here">
                                </a>
                            </div>
                            <div class="col-md-2 mt-4 text-center">
                                <h6>{{ $item->product->name }}</h6>
                            </div>
                            <div class="col-md-2 mt-4 ">
                                <h6> Rs {{ $item->product->selling_price }}</h6>
                            </div>
                            <div class="col-md-2 mt-4 ">
                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                <input type="hidden" class="qty-input" value="1">

                                @if ($item->product->qty >= $item->prod_qty)

                                    <h6>In Stock</h6>
                                @else
                                   <h6>Out Of Stock</h6>    
                                @endif
                            </div>
                            <div class="col-md-2 mt-2">
                                <button class="btn btn-success mt-2 cart-wishlist">Add To Cart<i class="bi bi-cart4"></i></button>
                            </div>
                            <div class="col-md-2 mt-2">
                                <button class="btn btn-danger mt-2 remove-wishlist"><i class="bi bi-trash3"></i></button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                
                @else
                    <h4>They are no products in your Wishlist</h4>
                @endif
            </div>

        </div>
    </div>
@endsection
