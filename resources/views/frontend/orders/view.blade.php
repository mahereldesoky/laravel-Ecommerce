@extends('layouts.app')

@section('title','My Order details')

@section('content')

<div class="py-5 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4>
                        <i class="fa fa-shopping-cart text-dark"></i> My order details
                        <a href="{{url('invoice/'.$orders->id. '/generate')}}"  class="btn btn-sm btn-primary float-end mx-1">Print Invoice</a>
                        <a href="/orders" class="btn btn-sm btn-danger float-end">back</a>
                    </h4>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>order details</h5>
                            <hr>
                            <h4>Order id: {{$orders->id}}</h4>
                            <h4>Tracking Number: {{$orders->tracking_no}}</h4>
                            <h4>Order Created Date: {{$orders->created_at->format('d-m-Y h:i A')}}</h4>
                            <h4>Payment Mode: {{$orders->payment_mode}}</h4>
                            <h4 class="border p-2 text-success">
                                Order Status Message: <span class="text-uppercase">{{$orders->status_message}}</span>

                            </h4>
                        </div>
                        <div class="col-md-6">
                            <h5>User details</h5>
                            <hr>
                            <h4>Fullname: {{$orders->fullname}} </h4>
                            <h4>Email: {{$orders->email}}</h4>
                            <h4>Phone: {{$orders->phone}} </h4>
                            <h4>Adress: {{$orders->adress}}</h4>
                            <h4>Pincode: {{$orders->pincode}} </h4>
                        </div>
                    </div>
                    <hr>
                    <h5>Odrer Items</h5>
                    <hr>
                    <div class=" table-responsive">
                        <table class="table table-bordred table-striped">
                            <thead>
                                <tr>
                                    <th>Item Id</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>

                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($orders->orderItems as $orderItem )
                                    <tr>
                                        <td width="10%">{{$orderItem->id}}</td>
                                        <td width="10%">
                                            @if ($orderItem->product->productImages)
                                            <img src="{{asset($orderItem->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="">
                                            @else
                                            <img src=""style="width: 50px; height: 50px" alt="">
                                            @endif
                                        </td>
                                        <td>
                                            {{$orderItem->product->name}}
                                            
                                            @if($orderItem->productColors)
                                                @if ($orderItem->productColors->color)
                                                <span>- Color: {{$cartItem->productColors->color->name}}</span>                                            
                                                @endif
                                            @endif
                                        </td>
                                        <td width="10%">${{$orderItem->price}}</td>
                                        <td width="10%">{{$orderItem->quantity}}</td>
                                        <td width="10%" class="fw-bold">${{$orderItem->quantity * $orderItem->price }}</td>

                                        @php
                                            $totalPrice += $orderItem->quantity * $orderItem->price ;
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="fw-bold">Total Amount</td>
                                    <td colspan="1" class="fw-bold">${{$totalPrice}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
