<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class LiveController extends Controller
{

    // GENERATE MSISDN
    public function makeMSISDN($phonetomsisdn)
    {
        $twochars = substr($phonetomsisdn, 0, 2);
        $threechars = substr($phonetomsisdn, 0, 3);

        if ($twochars === "07") {
            $simu = substr($phonetomsisdn, 1);
            $countrycode = "254";
            $returnedmsisdn = $countrycode . $simu;
        }
        if ($twochars === "01") {
            $simu = substr($phonetomsisdn, 1);
            $countrycode = "254";
            $returnedmsisdn = $countrycode . $simu;
        }
        if ($twochars === "+2") {
            $returnedmsisdn = substr($phonetomsisdn, 1);
        }

        if ($threechars === "254") {
            $returnedmsisdn = $phonetomsisdn;
        }

        return $returnedmsisdn;
    }
    // END GENERATE MSISDN


    public function lipaNaMpesaPassword()
    {
        //timestamp
        $timestamp = Carbon::rawParse('now')->format('YmdHms');
        $businessShortCode = env('MPESA_STK_SHORTCODE');
        $passKey = env('MPESA_PASSKEY');
        $mpesaPassword = base64_encode($businessShortCode . $passKey . $timestamp);

        return $mpesaPassword;
    }


     public function getAccessToken()
    {
        $url = env('MPESA_ENV') == 0
            ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';


        $credentials = base64_encode(env('MPESA_CONSUMER_KEY') . ":" . env('MPESA_CONSUMER_SECRET'));

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic " . $credentials, "Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        $curl_response = curl_exec($curl);
        $access_token = json_decode($curl_response);

        curl_close($curl);

        return $access_token->access_token;
    }


    // REGISTER URLS

    public function registerURLS()
    {
        $url = env('MPESA_ENV') == 0
            ? 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl'
            : 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        $oldbody = array(
            'ShortCode' => env('MPESA_STK_SHORTCODE'),
            'ResponseType' => "Completed",
            'ValidationURL' => env('MPESA_TEST_URL') . "/api/validate/return/accept",
            'ConfirmationURL' => env('MPESA_TEST_URL') . "/api/confirm/store/action"
        );

        $body = json_encode($oldbody);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->getAccessToken(),
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response   = curl_exec($ch);
        curl_close($ch);

        Log::info('Start RegisterURLs');
        Log::info($response);
        Log::info('End RegisterURLs');

        return $response;
    }


    // STKPUSH
    public function stkpush(Request $request)
    {
        $phone = $request->fromphone;
        $amount = $request->amounttodeposit;

        $msisdn = $this->makeMSISDN($phone);

        $curl_post_data =
            [
                'BusinessShortCode' => env('MPESA_STK_SHORTCODE'),
                'Password' => $this->lipaNaMpesaPassword(),
                'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' =>  $msisdn,
                'PartyB' => env('MPESA_STK_SHORTCODE'),
                'PhoneNumber' =>  $msisdn,
                'CallBackURL' => env('MPESA_TEST_URL') . "/api/results/stk",
                'AccountReference' => "Test Stk",
                'TransactionDesc' => "Testing STK",
                'PassKey' => env('MPESA_PASSKEY')
            ];

        $data_string = json_encode($curl_post_data);

        $url = env('MPESA_ENV') == 0
            ? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
            : 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->getAccessToken(),
            'Content-Type: application/json'
        ]);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response);

        return redirect()->back()
            ->with('success', "Check phone for STK popup on number " . $phone . ".Complete the PIN and Refesh the system");
    }






    // b2c
    public function b2c(Request $request)
    {

        $widthdrawingAmount =  $request->amounttowithraw;
        $remarks =  $request->remarks;
        $occasion =  $request->occasion;
        $msisdn = $request->tophone;

        //$charges = getTxCharges($widthdrawingAmount);

            $oldbody =
                [
                    'InitiatorName' => env('MPESA_B2C_INITIATOR'),
                    'SecurityCredential' => base64_encode(env('MPESA_B2C_PASSWORD')),
                    'CommandID' => 'SalaryPayment',
                    'Amount' => $widthdrawingAmount,
                    'PartyA' =>  env('MPESA_B2C_SHORTCODE'),
                    'PartyB' => $msisdn,
                    'Remarks' => $remarks,
                    'QueueTimeOutURL' => env('MPESA_TEST_URL') . '/api/b2c/timeout',
                    'ResultURL' => env('MPESA_TEST_URL') . '/api/beetoosea/results',
                    'Occasion' => $occasion,
                ];

            $body = json_encode($oldbody);

            $url = env('MPESA_ENV') == 0
                ? 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest'
                : 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $this->getAccessToken(),
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);

            curl_close($ch);

            return $response;
    }

    public function b2cResult(Request $request)
    {
        Log::info('START B2C Result');
        Log::info($request->all());
        Log::info('END B2C Result');

        return [
            'ResultCode' => 0,
            'ResultDesc' => 'Accept Service'
        ];
    }

    public function b2cTimeout(Request $request)
    {
        Log::info('START B2C TimeOut');
        Log::info($request->all());
        Log::info('END B2C TimeOut');

        return [
            'ResultCode' => 2,
            'ResultDesc' => 'Reject Service'
        ];
    }




    

    
}
