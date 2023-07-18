@extends('layouts.front')


@section('title')
    Checkout
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

    <div class="container mt-3">
        <form action="{{ url('place-order') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Basic Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" value="{{ Auth::user()->name }}" name="fname"
                                        class="form-control firstname" placeholder="Enter First Name">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-5">
                                    <label for="">Last Name</label>
                                    <input type="text" name="lname" value="{{ Auth::user()->lname }}"
                                        class="form-control lname" placeholder="Enter Last Name">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control email" placeholder="Enter Email">
                                    <span id="email_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                        class="form-control phone" placeholder="Enter Phone Number">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 1</label>
                                    <input type="text" name="address1" value="{{ Auth::user()->address1 }}"
                                        class="form-control address1" placeholder="Enter Address 1">
                                    <span id="address1_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 2</label>
                                    <input type="text" name="address2" value="{{ Auth::user()->address2 }}"
                                        class="form-control address2" placeholder="Enter Address 2">
                                    <span id="address2_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" name="city" value="{{ Auth::user()->city }}"
                                        class="form-control city" placeholder="Enter City">
                                    <span id="city_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">State</label>
                                    <input type="text" name="state" value="{{ Auth::user()->state }}"
                                        class="form-control state" placeholder="Enter State">
                                    <span id="state_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" name="country" value="{{ Auth::user()->country }}"
                                        class="form-control country" placeholder="Enter Country">
                                    <span id="country_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Pin Code</label>
                                    <input type="text" name="pincode" value="{{ Auth::user()->pincode }}"
                                        class="form-control pincode" placeholder="Enter Pin Code">
                                    <span id="pincode_error" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order detail</h4>
                        </div>
                        @if ($cartitems->count() > 0)
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach ($cartitems as $item)
                                            <tr>
                                                @php $total += ($item->products->selling_price * $item->prod_qty) @endphp
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->prod_qty }}</td>
                                                <td>{{ $item->products->selling_price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <h6 class="px-2">Grand Total <span class="float-end">Rs {{ $total }}</span></h6>
                            <hr>
                            <input type="hidden" name="payment_mode" value="COD">
                            <button type="submit" class="btn btn-success w-100 ">Place Order</button>
                            <div class="card card-default">
                                <div class="card-header">
                                    Laravel - Razorpay Payment Gateway Integration
                                </div>
                                <div class="card-body text-center">
                                    <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                                        @csrf 
                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                data-key="{{ env('RAZORPAY_KEY') }}"
                                                data-amount="10000"
                                                data-buttontext="Pay 100 INR"
                                                data-name="GeekyAnts official"
                                                data-description="Razorpay payment"
                                                data-image="/images/logo-icon.png"
                                                data-prefill.name="ABC"
                                                data-prefill.email="abc@gmail.com"
                                                data-theme.color="#ff7529">
                                        </script>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="cart-body text-center">
                                <h3>No Products In Cart</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection 
