@extends('layouts.front')


@section('title')
    Welcome To AddToCart
@endsection

@section('content')
    @include('layouts.inc.slider')

    <div class="py-5">
        <div class="container">
            <div class="row top-selling-owl">
                <h2>Top Sellings</h2>
                <div class="owl-carousel owl-theme">
                    @foreach ($mostSellingProducts as $product)
                        <div class="item mb-3 mt-3">
                                <div class="card shadow">
                                    <a href="{{ url('product/'.$product->slug) }}">
                                        <img src="{{ asset('assets/upload/products/' . $product->image) }}" class="card-img-top img-fluid"
                                            alt="product image">
                                    </a>
                                    <div class="card-body">
                                        <h5>{{ $product->name }}</h5>

                                        <span class="float-start">&#8377 {{ $product->selling_price }}</span>
                                        <span class="float-end">&#8377 <s>{{ $product->original_price }}</s></span>
                                    </div>
                                    <button class="btn btn-warning quick-view-btn center" data-product-id="{{ $product->id }}"><i class="fa fa-eye"></i></button>
                                </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Quick View content will be loaded here -->
                @include('quick_view')
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="container">
            <div class="row">
                <h2>Most Selling Categories</h2>
                <div class="owl-carousel owl-theme">
                    @foreach ($mostSellingCategories as $category)
                        <div class="item mt-3">
                            <a href="{{ url('view-category/' . $category->slug) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/upload/category/' . $category->image) }}"
                                        class="card-img-top img-fluid" alt="category image">
                                    <div class="card-body">
                                        <h5>{{ $category->name }}</h5>
                                        <p>
                                            {{ $category->description }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })

        $(document).ready(function() {
            $('.quick-view-btn').on('click', function() {
                var productId = $(this).data('product-id');

                $.ajax({
                    method: "GET",
                    url: "/product-quick-view/" + productId, // Adjust the URL to your route
                    success: function(response) {
                        $('#quickViewModal .modal-content').html(response);
                        $('#quickViewModal').modal('show');
                    }
                });
            });
        });
    </script>
    
@endsection


