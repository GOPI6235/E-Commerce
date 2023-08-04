@extends('layouts.front')


@section('title')
    My Cart
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a>/
                <a href="{{ url('cart') }}">
                    Cart
                </a>
            </h6>
        </div>
    </div>


    <div class="container my-5">
        <div class="card shadow cartitems">
            @if ($cartItems->count() > 0)
            <div class="card-body">
                @php $total = 0;@endphp
                @foreach ($cartItems as $item)
                    <div class="row product_data">
                        <div class="col-md-2 mt-2 text-center">
                            @if ($item->product)
                                @if ($item->product)
                                <h6>{{ $item->product->category->name }}</h6>
                                @else
                                    <h6>Category Not Found</h6>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-2 mt-2 text-center">
                            <a href="{{ url('product/'.$item->products->slug) }}">
                                <img src="{{ asset('assets/upload/products/' . $item->product->image) }}" height="70px" width="70px" alt="image here">
                            </a>
                        </div>
                        <div class="col-md-2 mt-4 text-center">
                            <h6>{{ $item->products->name }}</h6>
                        </div>
                        <div class="col-md-2 mt-4 ">
                            <h6> Rs {{ $item->products->selling_price }}</h6>
                        </div>
                        <div class="col-md-2 ">
                            <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                            @if ($item->products->qty >= $item->prod_qty)
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3" style="width: 120px">
                                    <button class="input-group-text decrement-btn changeQuantity">-</button>
                                    <input type="text" name="quantity" class="form-control qty-input text-center"
                                        value="{{ $item->prod_qty }}">
                                    <button class="input-group-text increment-btn changeQuantity">+</button>
                                </div>
                                @php $total += $item->products->selling_price * $item->prod_qty ; @endphp
                            @else
                               <h6 class="mt-3 btn btn-outline-danger">Out Of Stock</h6>    
                            @endif
                        </div>
                        <div class="col-md-2">
                            <button class="btn mt-2 delete-cart-item"><i class="bi bi-trash3"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card-footer">
                <h6>Totel Price = {{ $total }}
                    <a href="{{ url('checkout') }}" class="btn btn-outline-success float-end">proceed to checkout</a
                        href="{{ url('checkout') }}">
                </h6>
            </div>
            @else
                <div class="card-body text-center">
                    <h2>Your <i class="bi bi-cart4"></i> Cart Is Empty!</h2>
                    <a href="{{ url('category') }}" class="btn btn-outline-primary float-end">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>
@endsection
