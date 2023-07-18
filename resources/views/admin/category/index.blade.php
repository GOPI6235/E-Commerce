@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h3>Categories <a class="btn btn-warning float-right" href="{{ url('add-category') }}"><h6>Add Category</h6></a></h3>
            
        </div>
        <div class="card-body">
            <table class="table">
                <thead class=" text-primary">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <img src="{{ asset('assets/upload/category/'.$item->image) }}" class="category-image" alt="image here">
                        </td>
                        <td>
                            <a href="{{ url('edit-category/'.$item->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ url('delete-category/'.$item->id) }}" class="btn btn-danger">Delete</a>

                        </td>

                    </tr>                      
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection