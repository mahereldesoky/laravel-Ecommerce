@extends('layouts.app')

@section('title')
{{$product->meta_title}}
@endsection

@section('keyword')
{{$product->meta_keyword}}
@endsection

@section('description')
{{$product->meta_description}}
@endsection
@section('content')


<div>
    <livewire:frontend.product.view :category="$category" :product="$product">
</div>

@endsection