@extends('layouts.admin')

@section('title','My Orders Details')

@section('content')


<div class="row">
    <div class="col-md-12 ">

        @if(session('message'))
            <div class="alert alert-success mb-3">{{session('message')}}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3> My Orders
                </h3>
            </div>
            <div class="card-body">

                    <h4>
                        <i class="fa fa-shopping-cart text-dark"></i> My order details
                        <a href="{{url('/admin/orders')}}" class="btn btn-sm btn-danger float-end mx-1">back</a>
                        <a href="{{url('/admin/invoice/'.$orders->id. '/generate')}}" class="btn btn-sm btn-primary float-end mx-1">Download Invoice</a>
                        <a href="{{url('/admin/invoice/'.$orders->id)}}" target="_blank" class="btn btn-sm btn-warning float-end mx-1">View Invoice</a>
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
                                    <th>Taxs</th>
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
                                        <td width="15%" class="fw-bold">${{$tax = $orderItem->quantity * $orderItem->price * 14/100 }}</td>
                                        <td width="15%" class="fw-bold">${{$orderItem->quantity * $orderItem->price + $tax }}</td>

                                        @php
                                            $totalPrice += $orderItem->quantity * $orderItem->price ;
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="fw-bold">Total Amount</td>
                                    <td colspan="1" class="total-heading">${{$totalPrice + $tax}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                
            </div>
        </div>

        <div class="card border mt-3">
            <div class="card-body">
                <h4>Order Process (order status update)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{url('admin/orders/'.$orders->id)}}" method="post">
                            @csrf
                            @method('PUT')

                            <label >Update Order Status</label>
                            <div class="input-group">
                                <select name="order_status" class="form-select">
                                    <option value="">Select odere Status</option>
                                    <option value="in progress" {{Request::get('status') == 'in progress' ? 'selected' : '' }} >In progress</option>
                                    <option value="compeleted" {{Request::get('status') == 'compeleted' ? 'selected' : '' }} >Compeleted</option>
                                    <option value="pending" {{Request::get('status') == 'pending' ? 'selected' : '' }} >Pending</option>
                                    <option value="canceled "{{Request::get('status') == 'canceled' ? 'selected' : '' }} >Canceled</option>
                                    <option value="out-for-delievry" {{Request::get('status') == 'out-for-delievry' ? 'selected' : '' }} >Out for delievry</option>
                                </select>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>

                        
                        </form>
                    </div>
                    <div class="col-md-7">
                        <br>
                        <h4 class="mt-3"> Current Odrer Status 
                            <span class="text-uppercase">{{$orders->status_message}}</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
