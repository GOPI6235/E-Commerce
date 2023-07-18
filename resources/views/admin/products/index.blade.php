@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4>Products<a class="btn btn-sm btn-warning float-right" href="{{ url('add-product') }}"><h6>Add product</h6></a></h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class=" text-primary">
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Selling Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->selling_price}}</td>
                        <td>
                            <img src="{{ asset('assets/upload/products/'.$item->image) }}" class="category-image" alt="image here">
                        </td>
                        <td>
                            <a href="{{ url('edit-product/'.$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ url('delete-product/'.$item->id) }}" class="btn btn-danger btn-sm">Delete</a>

                        </td>

                    </tr>                      
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection