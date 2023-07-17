<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Http\Livewire\Frontend\Checkout\Checkoutshow;


class PayPalController extends Controller
{


     /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('paypal-transaction');
    }


    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction()
    {
        $provider = new PayPalClient;
        $amount = new Checkoutshow;
        $total = $amount->totalProductAmount();
        $data = $total;

        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "$data"
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('message', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('message', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                $carts = Cart::where('user_id',auth()->user()->id)->get();
                if(isset($carts)){
                    Cart::where('user_id',auth()->user()->id)->delete();
                    }
                return  redirect()
                ->route('createTransaction')
                ->with('message', $response['message'] ?? 'Transaction Competelte.' );                


            } else {
                return redirect()
                    ->route('createTransaction')
                    ->with('message', $response['message'] ?? 'Something went wrong.');
            }

    }





    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('message', $response['message'] ?? 'You have canceled the transaction.');
    }



}
