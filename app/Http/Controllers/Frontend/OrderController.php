<?php

namespace App\Http\Controllers\frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at', 'ASC')->paginate(10);
        return view('frontend.orders.index',compact('orders'));
    }

    public function show($order_id)
    {
        $orders = Order::where('user_id',Auth::user()->id)->where('id',$order_id)->first();
        if($orders){
            return view('frontend.orders.view',compact('orders'));
        }else{

        }
        return  redirect()->back()->with('message','No orders found');
    }

    public function viewInvoice(int $order_id)
    {
        $orders = Order::find($order_id);
        return view('admin.invoice.generate-invoice' , compact('orders'));
    }

    public function generateInvoice(int $order_id)
    {
        $orders = Order::find($order_id);
        $data = ['orders' => $orders];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);

        $todayDate = Carbon::now()->format('Y-m-d');
        return $pdf->stream('invoice'.$orders->id.'-'.$todayDate.'.pdf');
    }
}
