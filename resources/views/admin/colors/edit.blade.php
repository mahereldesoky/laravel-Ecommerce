@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        @if (session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3> Edit Color
                    <a href="{{ url ('admin/colors') }}" class="btn btn-danger btn-sm text-white float-end">
                    Back
                    </a>
                </h3>
            </div>
            <div class="card-body" style="overflow-x: scroll">
                <form action="{{url('admin/colors/'.$color->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Color Name</label>
                        <input type="text" value="{{$color->name}}" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Color Code</label>
                        <input type="text" value="{{$color->code}}" name="code" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" {{$color->status ? 'checked':''}} name="status"> Checked=Hidden,Notchecked=visible
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>   
</div>   


@endsection