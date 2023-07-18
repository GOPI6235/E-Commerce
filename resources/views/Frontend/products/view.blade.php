@extends('layouts.front')


@section('title', $products->name)

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/add-rating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rate this {{ $products->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                @if ($user_rating)
                                    @for ($i = 1; $i <= $user_rating->stars_rated; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                    @for ($j = $user_rating->stars_rated+1; $j <= 5;$j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating" id="rating{{ $j }}">
                                        <label for="rating{{ $j }}" class="fa fa-star"></label>   
                                    @endfor

                                    
                                @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('category') }}">
                    Collections
                </a> / 
                <a href="{{ 'category/' . $products->category->slug }}">
                    {{ $products->category->name }}
                </a>/
                <a href="{{ url('category/' . $products->category->slug . '/' . $products->slug) }}">
                    {{ $products->name }}
                </a>
            </h6>
        </div>
    </div>

    <div class="container">
        <div class=" product_data">
            <div class="">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/upload/products/' . $products->image) }}" class="w-100"
                            alt="product image here">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $products->name }}
                            @if ($products->trending == '1')
                                <label style="font-size: 16px"
                                    class="float-end badge bg-danger trending_tag">Trending</label>
                            @endif
                        </h2>

                        <hr>
                        <label class="me-3">Original Price: <s>Rs {{ $products->original_price }}</s></label>
                        <label class="fw-bold">Selling Price: Rs {{ $products->selling_price }}</label>
                        {{-- Ratings --}}
                        @php $ratenum = number_format($rating_value) @endphp
                        <div class="reatings">
                            @for ($i = 1; $i <= $ratenum; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for ($j = $ratenum + 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>
                                @if ($ratings->count() > 0)
                                    {{ $ratings->count() }} Ratings
                                @else
                                    No Ratings
                                @endif
                            </span>
                        </div>
                        
                        <p class="mt-3">
                            {!! $products->small_description !!}
                        </p>
                        @if ($products->qty > 0)
                            <label class="badge bg-success">In Stock</label>
                        @else
                            <label class="badge bg-danger">Out Of Stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3" style="width: 130px">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" value="1"
                                        class="form-control qty-input text-center">
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <br />
                                @if ($products->qty > 0)
                                    <button type="button" class="btn btn-primary me-3 float-start addToCartbtn">Add To
                                        Cart
                                        <i class="bi bi-cart4"></i></button>
                                @endif
                                <button type="button" class="btn btn-success me-3 float-start">Add To Wishlist <i
                                        class="bi bi-heart-fill"></i></button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    
                    <h3>Description</h3>
                    <p class="mt-3">
                        {!! $products->description !!}
                    </p>
                </div>
                <hr>
                <div class="col-md-12">
                    <button type="button" class="btn btn-link" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Ratings <i class="fa fa-star"></i>
                    </button>
                </div>
                
            </div>
        </div>

    @endsection
