@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            Edit/Update SubCategory
        </div>
        <div class="card-body">
            <form action="{{ url('update-subcategory/'.$subcategory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="cate_id">
                            <option value="">{{ $subcategory->category->name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label for="">Name</label>
                        <input type="text" value="{{ $subcategory->name }}" class="form-control" name="name">
                    </div>
                    <div class="col-md-6 mb-1">
                        <label for="">Slug</label>
                        <input type="text" value="{{ $subcategory->slug }}" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12 mb-1">
                        <label for="">Description</label>
                        <textarea name="description" rows="3" class="form-control">{{ $subcategory->description }}</textarea>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label for="">Status</label>
                        <input type="checkbox" {{ $subcategory->status =="1" ? 'checked':'' }} name="status">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection