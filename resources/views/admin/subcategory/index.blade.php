@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h3>Sub-Categories <a class="btn btn-warning float-right" href="{{ url('add-subcategory') }}"><h6>Add SubCategory</h6></a></h3>
        
    </div>
    <div class="card-body">
        <table class="table">
            <thead class=" text-primary">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        <a href="{{ url('edit-subcategory/'.$item->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('delete-subcategory/'.$item->id) }}" class="btn btn-danger">Delete</a>

                    </td>

                </tr>                      
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection