@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3> Edit Category
                    <a class="btn btn-primary btn-sm float-end" href="{{url('admin/category')}}">Back
                    </a>
                </h3>

            </div>

            <div class="card-body">
                <form action="{{url('admin/category/'.$category->id)}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Name" class="form-label">Name</label>
                            <input type="text" value="{{$category->name}}" class="form-control" name="name" placeholder="Enter Name">
                            @error('name')
                            <small class="text-danger">{{($message)}}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Slug" class="form-label">Slug</label>
                            <input type="text" value="{{$category->slug}}" class="form-control" name="slug">
                            @error('slug')
                            <small class="text-danger">{{($message)}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="Description" class="form-label">Description</label>
                            <textarea class="form-control" rows="3" name="description">{{$category->description}}</textarea>
                            @error('description')
                            <small class="text-danger">{{($message)}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Image" class="form-label">Image</label>
                            <img src="{{asset('/uploads/category/'.$category->image)}}" width="60px" height="60px" alt="">
                            <input type="file" class="form-control" name="image">
                            @error('image')
                            <small class="text-danger">{{($message)}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status</label><br>
                            <input type="checkbox" name="status" {{$category->status == '1' ? 'checked':''}}>
                        </div>

                        <div class="col-md-12">
                            <h4>SEO Tags</h4>
                        </div>
                        <br>
                        <div class="col-md-12 mb-3">
                            <label for="Meta Title" class="form-label">Meta Title</label>
                            <input type="text" value="{{$category->meta_title}}" class="form-control" name="meta_title">
                            @error('meta_title')
                            <small class="text-danger">{{($message)}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="Meta Keyword" class="form-label">Meta Keyword</label>
                            <textarea class="form-control" name="meta_keyword" rows="3">{{$category->meta_keyword}}</textarea>
                            @error('meta_keyword')
                            <small class="text-danger">{{($message)}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="Meta Description" class="form-label">Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="3">{{$category->meta_description}}</textarea>
                            @error('meta_description')
                            <small class="text-danger">{{($message)}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <button class="btn btn-primary float-end" type="submit">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection