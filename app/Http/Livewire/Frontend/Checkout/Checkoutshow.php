<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Http\Controllers\PayPalController;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Str;

class Checkoutshow extends Component
{
    public $carts, $totalProductAmount = 0 ;

    public $fullname,$email,$phone,$pincode,$adress,$payment_mode = NULL, $payment_id = NULL;

    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder',
    ];

    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|min:10|max:11',
            'pincode' => 'required|string',
            'adress' => 'required|string|max:500',

        ];

    }

    public function placeOrder()
    {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'Work'.Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'adress' => $this->adress,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id
        ]);

        foreach($this->carts as $cartItem){
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
            
            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price
            ]);

            if($cartItem->product_color_id != NULL){
                $cartItem->productColors()->where('id', $cartItem->product_color_id)
                ->decrement('quantity',$cartItem->quantity);
            }else{
                $cartItem->product()->where('id', $cartItem->product_id)
                ->decrement('quantity',$cartItem->quantity);
            }
        }

        return $order;

    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0 ;
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        foreach($this->carts as $cartItem){
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }

        return $this->totalProductAmount ;
    }



        
    public function codOrder()
    {

        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder){

            Cart::where('user_id',auth()->user()->id)->delete();

            session()->flash('message', 'Your order has been placed successfully');
            $this->dispatchBrowserEvent('message', ['text' => 'Order Placed successfully',
            'type' => 'success','status' => 200]);
            return redirect()->to('thank-you');
        }else {
            $this->dispatchBrowserEvent('message', ['text' => 'Something went wrong',
            'type' => 'error','status' => 500]);
        }
    }

    public function paidOnlineOrder()
    {

        $this->payment_id = NULL;
        $this->payment_mode = 'Paid online order';
        $codOrder = $this->placeOrder();
        if($codOrder){
            
            return redirect()->route('processTransaction');
            if(isset($response['status']) && $response['status'] == 'COMPLETED'){
            session()->flash('message', 'Your order has been placed successfully');
            $this->dispatchBrowserEvent('message', ['text' => 'Order Placed successfully',
            'type' => 'success','status' => 201]);

        }
        }else {
            $this->dispatchBrowserEvent('message', ['text' => 'Something went wrong',
            'type' => 'error','status' => 422]);
        }
    }




    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkoutshow',[
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
