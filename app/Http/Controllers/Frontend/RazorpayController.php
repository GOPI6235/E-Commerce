<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facade\FlareClient\Api;
use Session;
use Redirect;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class RazorpayController extends Controller
{
    public function store(Request $request) {
        $input = $request->all();
        $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payment = Payment::create([
                    'user_id'=>$response[Auth::id()],
                    'r_payment_id' => $response['id'],
                    'method' => $response['method'],
                    'currency' => $response['currency'],
                    'user_email' => $response['email'],
                    'amount' => $response['amount']/100,
                    'json_response' => json_encode((array)$response)
                ]);
            } catch(Exceptio $e) {
                return $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        // Session::put('success',('Payment Successful');
        // return redirect()->back();
    }
}
