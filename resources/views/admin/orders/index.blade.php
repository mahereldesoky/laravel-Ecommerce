@extends('layouts.admin')

@section('title','My Orders')

@section('content')


<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h3> My Orders
                </h3>
            </div>
            <div class="card-body">

                <form action="" method="get">
                    <div class="row">

                        <div class="col-md-3">
                            <label >Filter By Date</label>
                            <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d')}}" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label >Filter By Date</label>
                            <select name="status" class="form-select">
                                <option value="">Select All Status</option>
                                <option value="in progress" {{Request::get('status') == 'in progress' ? 'selected' : '' }} >In progress</option>
                                <option value="compeleted" {{Request::get('status') == 'compeleted' ? 'selected' : '' }} >Compeleted</option>
                                <option value="pending" {{Request::get('status') == 'pending' ? 'selected' : '' }} >Pending</option>
                                <option value="canceled "{{Request::get('status') == 'canceled' ? 'selected' : '' }} >Canceled</option>
                                <option value="out-for-delievry" {{Request::get('status') == 'out-for-delievry' ? 'selected' : '' }} >Out for delievry</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <hr>
                    <div class=" table-responsive">
                        <table class="table table-bordred table-striped">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Tracking Number</th>
                                    <th>User Name</th>
                                    <th>Payment Mode</th>
                                    <th>Order Date</th>
                                    <th>Status Message</th>
                                    <th>ACtion</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($orders as $orderItem )
                                <tr>
                                    <td>{{$orderItem->id}}</td>
                                    <td>{{$orderItem->tracking_no}}</td>
                                    <td>{{$orderItem->fullname}}</td>
                                    <td>{{$orderItem->payment_mode}}</td>
                                    <td>{{$orderItem->created_at->format('d-m-Y')}}</td>
                                    <td>{{$orderItem->status_message}}</td>
                                    <td><a href="{{url('admin/orders/'.$orderItem->id)}}" class="btn btn-primary btn-sm" >View</a></td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">No Orders Available</td>
                                </tr>
                                    
                                @endforelse

                            </tbody>
                        </table>
                        {{-- <div>
                            {{$orders->links()}}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
