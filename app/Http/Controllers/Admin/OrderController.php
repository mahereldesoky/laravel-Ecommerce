<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $todayDate = Carbon::now();
        // $orders = Order::all();

        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != NULL, function ($q) use($request) {

        return  $q->whereDate('created_at', $request->date);
        },function ($q) use($todayDate){

        return $q->whereDate('created_at', $todayDate);
        })
        ->when($request->status != NULL, function ($q) use($request) {
        return $q->where('status_message', $request->status);
        })
        ->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $order_id)
    {
        $orders = Order::where('id',$order_id)->first();
        if($orders){
            return view('admin.orders.view', compact('orders'));
        }else {
            return redirect('admin/orders')->with('message', 'Order not found');
        }
    }



    public function updateOrderStatus(int $order_id, Request $request)
    {
        $orders = Order::where('id',$order_id)->first();
        if($orders){
            $orders->update([
                'status_message' => $request->order_status
            ]);
            return redirect('admin/orders/'.$order_id)->with('message', 'Order Status Updated');
        }else {
            return redirect('admin/orders/'.$order_id)->with('message', 'Order not found');
        }
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
        return $pdf->download('invoice'.$orders->id.'-'.$todayDate.'.pdf');
    }

}
