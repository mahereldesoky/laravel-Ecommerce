@extends('layouts.admin')


@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h3> Add Category
                    <a href="{{ url ('admin/category') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/category')}}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="row">

                        <div class=" col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                            @error('name') <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control">
                            @error('slug') <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control"  rows="3"></textarea>
                            @error('Description') <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('Image') <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" col-md-6 mb-3">
                            <label>Status</label> <br>
                            <input type="checkbox" name="status">
                        </div>

                        <div class=" col-md-12 mb-3">
                            <h4>SEO Tags</h4>
                        </div>   

                        <div class=" col-md-6 mb-3">
                            <label>Meta_Title</label>
                            <input type="text" name="meta_title" class="form-control">
                            @error('Meta_Title') <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" col-md-12 mb-3">
                            <label>Meta_Keyword</label>
                            <textarea name="meta_keyword" class="form-control"  rows="3"></textarea>
                            @error('meta_keyword') <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" col-md-12 mb-3">
                            <label>Meta_description</label>
                            <textarea name="meta_description" class="form-control"  rows="3"></textarea>
                            @error('meta_description') <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" col-md-6 mb-3">
                            <button class="btn btn-primary " type="submit">Save</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection