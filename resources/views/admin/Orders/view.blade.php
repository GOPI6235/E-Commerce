@extends('layouts.admin')


@section('title')
    My Orders
@endsection

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="text-white">Order view
                            <a href="{{ url('orders') }}" class="btn btn-warning float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body order-details">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Shipping Details</h4>
                                <hr>
                                <label for="">First Name</label>
                                <div class="col-md-9 border p-2">{{ $orders->fname }}</div>
                                <label for="">Last Name</label>
                                <div class="col-md-9 border p-2">{{ $orders->lname }}</div>
                                <label for="">Email</label>
                                <div class="col-md-9 border p-2">{{ $orders->email }}</div>
                                <label for="">Contact No.</label>
                                <div class="col-md-9 border p-2">{{ $orders->phone }}</div>
                                <label for="">Shipping Address</label>
                                <div class="col-md-9 border p-2">
                                    {{ $orders->address1 }},<br>
                                    {{ $orders->address2 }},<br>
                                    {{ $orders->city }},<br>
                                    {{ $orders->state }},
                                    {{ $orders->country }}.
                                </div>
                                <label for="">Zip code</label>
                                <div class="border p-2">{{ $orders->pincode }}</div>
                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderitems as $item)
                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>
                                                    <img src="{{ asset('assets/upload/products/' . $item->products->image) }}"
                                                        width="40px" alt="image here">
                                                </td>
                                                <td class="float-end">{{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2">Grand Total: <span class="float-end"> {{ $orders->total_price }}</span></h4>

                                <div class="mt-5 px-2">
                                    <label for=""><h4>Order Status</h4></label>
                                    <form action="{{ url('update-order/'.$orders->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-select" name="order_status">
                                            {{-- <option {{ $orders->status == '0' ? 'selected' : '' }} value="o">Pending
                                            </option> --}}
                                            <option {{ $orders->status == '1' ? 'selected' : '' }} value="1">Completed
                                            </option>
                                        </select>
                                            {{-- <button type="submit" class="btn btn-primary float-end mt-3">Update</button> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
