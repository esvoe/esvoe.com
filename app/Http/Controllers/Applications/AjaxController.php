<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 07.09.2017
 * Time: 16:33
 */

namespace App\Http\Controllers\Applications;


use App\Models\Application;
use App\Models\ApplicationUser;
use App\ExchangeRate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        Log::useDailyFiles(storage_path().'/logs/applications.log');
    }

    public function rateApplication() {

        $id = $this->request->get('id');
        $rate = (int) $this->request->get('value');
        if ( $rate < 1 || $rate > 5) {
            return response()->json(array(
                'status' => '500',
                'message'=>'application.errors.parameters_damaged'
            ));
        }

        $application = Application::where('id', $id)
            ->where('is_active', true)
            ->first();

        if ( ! $application ) {
            return response()->json(array(
                'status' => '500',
                'message'=>'application.errors.application_not_found'
            ));
        }

        $user = Auth::user();

        $applicationUser = ApplicationUser::where('user_id', $user->id)
            ->where('app_id', $application->id)
            ->where('banned', false)
            ->where('authorized', true)
            ->first();

        if ( ! $applicationUser ) {
            return response()->json(array(
                'status' => '500',
                'message'=>'application.errors.user_link_not_found'
            ));
        }

        $applicationUser->rating = $rate;
        $applicationUser->update();

        // update rating
        $application->updateRating();
        $application->update();

        return response()->json(array(
            'status' => '200',
            'rating'=> $application->rating_packed
        ));
    }

    public function ajaxAppPaymentPrepare($gamename)
    {
        // todo: check values. If has errors -> generate error response
        $app = Application::where('name', $gamename)->first();

        $this->timeline = Auth::user()->timeline;
        $userWallet = $this->timeline->wallet()->first();

        // todo: ask pay.esvoe.com !
        // todo: auth_key, url, callback_url,

        $exchange_rate = 1;

        $inPrice = $this->request->get('price'); // in BCN always! (N * 100)

        $payload = [];

        // ETK
        $rate = ExchangeRate::where('from', 'BCN')->where('to','ETK')->latest()->value('rate');
        if (is_numeric($rate)) {
            $price = ceil(($inPrice / 1000) * $rate * 1000);
            $payload['ETK'] = [
                'name' => 'ETK',
                'price' => $price,
                'price_text' => number_format(($price / 1000), 3),
                'balance' => $userWallet->token,
                'allow' => $userWallet->token >= $price,
            ];
        }

        // EUR
        $rate = ExchangeRate::where('from', 'BCN')->where('to','EUR')->latest()->value('rate');
        if (is_numeric($rate)) {
            $price = ceil(($inPrice/1000) * $rate * 100);
            $payload['EUR'] = [
                'name' => 'EUR',
                'price' => $price,
                'price_text' => number_format(($price / 100), 2),
                'balance'=>$userWallet->euro,
                'allow' => $userWallet->euro >= $price,
            ];
        }

        // USD
        $rate = ExchangeRate::where('from', 'BCN')->where('to','USD')->latest()->value('rate');
        if (is_numeric($rate)) {
            $price = ceil(($inPrice/1000) * $rate * 100);
            $payload['USD'] = [
                'name' => 'USD',
                'price' => $price,
                'price_text' => number_format(($price / 100), 2),
                'balance' => $userWallet->dollar,
                'allow' => $userWallet->dollar >= $price,
            ];
        }

        // UAH
        $rate = ExchangeRate::where('from', 'BCN')->where('to','UAH')->latest()->value('rate');
        if (is_numeric($rate)) {
            $price = ceil(($inPrice/1000) * $rate * 100);
            $payload['UAH'] = [
                'name' => 'UAH',
                'price' => $price,
                'price_text' => number_format(($price / 100), 2),
                'balance' => $userWallet->grivna,
                'allow' => $userWallet->grivna >= $price,
            ];
        }

        return response()->json(['status' => '200', 'data' => $payload]);
    }

    public function ajaxAppPaymentSubmit($gamename)
    {
        $app = Application::where('name', $gamename)->first();
        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletSecret = $userWallet->sign;

        // todo: check exists. if no, generate error.

        // incoming values get
        $inPrice = (int)($this->request->get('price')); // in (BNC * 100)
        $inCurrency = (string)($this->request->get('currency')); // in !BNC (User Selected Currency)
        $inCurrency = strtoupper($inCurrency);
        $inOrderNr = (string)time();
        $inAttributes = (string) ($this->request->get('attributes', ''));

        $respObject = $this->payApiRequestPayment($inOrderNr, $userWallet->pay_id, $app->pay_id, $inPrice, $inCurrency, 'BCN', 'withdrawal', $userWalletSecret, $inAttributes);

        // show result to user

        if (!$respObject) {
            return response()->json([
                'status' => '500',
                'error_code' => '2002',
                'error_message' => 'pay_service_no_response',
            ]);
        }

        if ($respObject->response === true) {
            $rVerification = $respObject->verification;
            $rOrderNr = $respObject->order_nr;
            $rTransactionId = $respObject->transaction_id; // todo: encode this value for safe transfer (str_rot13) < merge crypt function

            // encrypt transaction id
            $transaction_hash = bin2hex($this->encryptString($rTransactionId,md5('salted_'.$userWalletSecret.'_salted')));

            if ($rVerification === 'none') {
                // todo: return response (with completion info) <<<
                return response()->json([
                    'status' => '200',
                    'transaction_state' => 'complete',
                    'transaction_id' => $rTransactionId,
                    'transaction_hash' => $transaction_hash,
                ]);
            }
            else {
                // todo: return info with ask to confirm
                return response()->json([
                    'status' => '200',
                    'transaction_state' => 'verification',
                    'transaction_id' => $rTransactionId,
                    'transaction_hash' => $transaction_hash,
                ]);
            }

        }
        else {
            return response()->json([
                'status' => '500',
                'error_code' => '2005',
                'error_message' => $respObject->message,
            ]);
        }

    }

    public function ajaxAppPaymentConfirm($gamename)
    {

        $app = Application::where('name', $gamename)->first();
        $user = Auth::user();
        $timeline = $user->timeline;
        $userWallet = $timeline->wallet()->first();
        $userWalletSecret = $userWallet->sign;

        $payment_hash = (string)($this->request->get('payment_hash'));
        $payment_code = (string)($this->request->get('payment_code'));

        $payment_id = $this->encryptString(hex2bin($payment_hash),md5('salted_'.$userWalletSecret.'_salted'));


        $result = $this->payApiPaymentConfirm($payment_id, $payment_code, $userWalletSecret);

        if (!$result) {
            return response()->json([
                'status' => '500',
                'error_code' => '2022',
                'error_message' => 'pay_server_no_response',
            ]);
        }
        if ($result->response) {
            return response()->json([
                'status' => '200',
                'transaction_state' => 'complete',
                'transaction_hash' => $payment_hash,
                'result_raw' => $result
            ]);
        }
        else {
            return response()->json([
                'status' => '500',
                'error_code' => '2023',
                'error_message' => $result->message,
                'response_raw' => $result
            ]);
        }


    }

    public function ajaxAppPermissionsRequest($gamename)
    {

        // todo: implement
        $payload = [

        ];

        return response()->json(['status' => '200', 'data' => $payload]);
    }

    public function ajaxAppPermissionsSubmit($gamename)
    {
        // todo: implement
        $payload = [

        ];

        return response()->json(['status' => '200', 'data' => $payload]);
    }

    private function payApiRequestPayment($order_nr, $from_pay_id, $to_pay_id, $amount, $from_currency, $to_currency, $type, $from_secret, $attributes) {
        // currency = {}
        // type = {transfer|withdrawal}

        /*
      [order_nr] => 1503476041
    [from_pay_id] => 2
    [to_pay_id] => 10
    [amount] => 100
    [from_currency] => EUR
    [to_currency] => BCN
    [type] => withdrawal
    [hash] => 2cf49e8fc3d4c79b1569ac730a16c2d8
     */

        $payload = [
            'order_nr' => (string)$order_nr,
            'from_pay_id' => (int) $from_pay_id,
            'to_pay_id' => (int) $to_pay_id,
            'amount' => (int)$amount,
            'from_currency' => (string) $from_currency,
            'to_currency' => (string) $to_currency,
            'type' => (string) $type,
            'attributes' => (string)($attributes), // fixme: is it empty?
            'lang' => Config::get('app.locale'),
            'hash' => md5((string)$order_nr.'|'.$from_pay_id.'|'.$to_pay_id.'|'.$amount.'|'.$from_currency.'|'.$to_currency.'|'.$from_secret)
        ];

        $client = new \GuzzleHttp\Client([
            'http_errors'=>false,
            'allow_redirects' => false,
            'timeout' => 60*2,
            'headers' => [
                'User-Agent'    => 'esvoe.client.api/1.0',
                'Accept'        => 'application/json',
                'Referer'       => 'https://sand.esvoe.com'
            ],
            'json' => $payload
        ]);
        $response = null;
        $hasError = false;
        try {
            $response = $client->request('POST', 'https://pay.esvoe.com/wallet/transfer');
        } catch( \GuzzleHttp\Exception\ClientException $e ){
            $hasError = true;
        }

        $result = null;

        $resultData = $response->getBody()->getContents();

        \Log::debug("pay", array('data'=>$resultData));

        try {
            $result = \GuzzleHttp\json_decode($resultData);
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage(), $exception->getTrace());
        }

        //return (string)$res->getBody();
        return $result;
    }

    private function payApiPaymentConfirm($verification_id, $verification_code, $user_secret) {
        $payload = [
            'transaction_id' => (string)$verification_id,
            'confirm' => (string)$verification_code,
            'lang' => Config::get('app.locale'),
            'hash' => md5($verification_id.'|'.$verification_code.'|'.$user_secret),
        ];

        $client = new \GuzzleHttp\Client([
            'http_errors'=>false,
            'allow_redirects' => false,
            'timeout' => 60*2,
            'headers' => [
                'User-Agent'    => 'esvoe.client.api/1.0',
                'Accept'        => 'application/json',
                'Referer'       => 'https://sand.esvoe.com'
            ],
            'json' => $payload
        ]);
        $response = null;
        $hasError = false;
        try {
            $response = $client->request('POST', 'https://pay.esvoe.com/wallet/transfer');
        } catch( \GuzzleHttp\Exception\ClientException $e ){
            $hasError = true;

        }

        $result = null;

        $response_content = $response->getBody()->getContents();

        Log::info("PAY_API_CONFIRM", ['content'=>(string)$response_content]);

        try {
            $result = \GuzzleHttp\json_decode($response_content); // this method create stdClass instead of assoc array.
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage(), $exception->getTrace());
        }

        //return (string)$res->getBody();
        return $result;
    }

    // Helper methods
    private function encryptString($source, $key = "crypt_key")
    {
        $c = strlen($a = $source);
        $d = strlen($b = $key);
        ($c < $d) ? ($a ^= $b ^= $a ^= $b) : $b = str_pad($b, $c, $b, 1);
        return $a ^ $b;
    }

    private function callPayApi($path, $payload, $timeout = 60, $method = 'POST') {

        if (strpos($path, '/') !== 0) {
            $path = '/'.$path;
        }
        $api_url = 'https://pay.esvoe.com'.$path;
        $client = new \GuzzleHttp\Client([
            'http_errors'=>false,
            'allow_redirects' => false,
            'timeout' => $timeout, // 60 seconds
            'headers' => [
                'User-Agent'    => 'esvoe.client.api/1.0',
                'Accept'        => 'application/json',
                'Referer'       => $this->request->root()
            ],
            'json' => $payload
        ]);

        try {
            $response = $client->request($method, $api_url);
        } catch( \GuzzleHttp\Exception\ClientException $exception ){
            \Log::error($exception->getMessage(), $exception->getTrace());
            return (object) [
                'status' => false,
                'message' => $exception->getMessage(),
            ];
        }

        try {
            $result = \GuzzleHttp\json_decode($response->getBody()->getContents()); // this method create stdClass instead of assoc array.
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage(), $exception->getTrace());
            return (object) [
                'status' => false,
                'message' => $exception->getMessage(),
            ];
        }

        /*
        if ( ! $result->response) {
            return (object) [
                'status' => false,
                'message' => $result->message,
            ];
        }
        */

        Log::info("PayApi.Call", array('url'=>$api_url, 'request'=>$payload, 'status'=> true, 'response'=>$result));

        return (object) [
            'status' => true,
            'response' => $result,
        ];
    }
}