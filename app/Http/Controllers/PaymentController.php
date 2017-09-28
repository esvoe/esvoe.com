<?php
namespace App\Http\Controllers;

use App\User;
use App\Setting;
use App\Timeline;
use App\Wallet;
use App\Repositories\WalletRepository;
use App\Http\Requests;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Teepluss\Theme\Facades\Theme;
use Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends AppBaseController
{
    /** @var WalletRepository */
    private $walletRepository;
    
    private $timeline;

    public function __construct(WalletRepository $walletRepo, Request $request)
    {
        $this->request = $request;
        $this->walletRepository = $walletRepo;        
    }

    public function index(Request $request)
    {
        if (!$request->isMethod('post')) {
            return back()->withInput();
        }

        $inputs = $request->all();

        $payment = \App\Payment::create([
            'amount'        => $request->input('amount'),
            'currency'      => $request->input('real-money-currency'),
            'description'   => '',
            'payment_method'=> $request->input('real-money-ps'),
            'timeline_id'   => Auth::user()->timeline_id,
        ]);

        $sign = 'kjncs53kjfver834ybd';
        $params = [
            'pay_id'    => Auth::user()->wallet->pay_id,
            'amount'    => (int) floor($payment->amount*100),
            'currency'  => $payment->currency,
            'pay_system'=> $payment->payment_method,
            'lang'      => 'en',
        ];
        $params['hash'] = md5("{$params['pay_id']}|{$params['amount']}|{$params['currency']}|{$params['pay_system']}|{$sign}");

//        Log::useDailyFiles(storage_path().'/logs/info.log');
//        Log::info(dd($params));
        
        return view('payment.redirect_to_paysystem')->with(['url'=>'https://pay.esvoe.com/payment/create','params'=>$params]);
    }

    public function result(Request $request)
    {
        if ($request->input('pay_id') == null)
            die('pay_id not faund.');

        $wallet = \App\Wallet::where('pay_id', (int) $request->input('pay_id'))->firstOrFail();

        return redirect("/{$wallet->timeline->username}/wallet");
    }

    public function resultGet(Request $request)
    {
        if ($request->input('pay_id') == null)
            die('pay_id not faund.');

        $wallet = \App\Wallet::where('pay_id', (int) $request->input('pay_id'))->firstOrFail();

        return redirect("/{$wallet->timeline->username}/wallet");
    }

    public function transferToAnotherUserById(Request $request)
    {
        Log::useDailyFiles(storage_path().'/logs/payment.log');
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('ajax');

        $toUser = \App\Timeline::where('username', $request->input('to_user_id'));
        if (!$toUser){
            return response()->json(['status' => '201', 'message' => 'User not found']);
        }

        $headers = ['Referer' => $request->url()];
        $client = new \GuzzleHttp\Client(['headers' => $headers]);

        $data = [
            'order_nr' => time(),
            'from_pay_id' => Auth::user()->wallet->pay_id,
            'to_pay_id' => Auth::user()->wallet->pay_id,
            'amount' => intval($request->input('sum')*100),
            'from_currency' => $request->input('currency'),
            'to_currency' => $request->input('currency'),
            'type' => 'transfer',
        ];
        $sign = Auth::user()->wallet->sign;
        $data['hash'] = md5("{$data['order_nr']}|{$data['from_pay_id']}|{$data['to_pay_id']}|{$data['amount']}|{$data['from_currency']}|{$data['to_currency']}|{$sign}");

        $response = $client->request('POST', 'https://pay.esvoe.com/wallet/transfer', ['json' => $data]);

        $responseBody = json_decode($response->getBody(), true);

        Log::info($data);
        Log::info("{$data['order_nr']}|{$data['from_pay_id']}|{$data['to_pay_id']}|{$data['amount']}|{$data['from_currency']}|{$data['to_currency']}|{Auth::user()->wallet->sign}");
        Log::info($responseBody);

        if($responseBody['response'] != true)
            return response()->json(['status' => '201', 'message' => 'Error: 412']);

        if($responseBody['verification'] == 'email')
            return response()->json(['status' => '210', 'transaction_id'=>$responseBody['transaction_id']]);

//        $transactionsHtml = $theme->scope('wallet/currency-transactions', ['transactions'=>$responseBody['operations']])->render();

        return response()->json(['status' => '200']);

    }

    public function confirmTransferToAnotherUserById(Request $request)
    {
        Log::useDailyFiles(storage_path().'/logs/payment.log');

        $headers = ['Referer' => $request->url()];
        $client = new \GuzzleHttp\Client(['headers' => $headers]);

        $data = [
            'transaction_id' => $request->input('transaction_id'),
            'confirm' => $request->input('confirm'),
        ];
        $sign = Auth::user()->wallet->sign;
        $data['hash'] = md5("{$data['transaction_id']}|{$data['confirm']}|{$sign}");

        $response = $client->request('POST', 'https://pay.esvoe.com/wallet/transfer', ['json' => $data]);

        $responseBody = json_decode($response->getBody(), true);

        Log::info($data);
        Log::info($responseBody);

        if($responseBody['response'] != true)
            return response()->json(['status' => '201', 'message' => 'Error: response not true']);

        if($responseBody['status'] != '1')
            return response()->json(['status' => '201', 'message' => 'Error: status = 0']);

        return response()->json(['status' => '200', 'message'=>'Перевод успешно завершен']);
    }

    public function fillingFields()
    {
        $users = \App\User::all();

        foreach ($users as $user) {
           if ($user->esvoe_id == null) {
               $user->esvoe_id = 'eid' . implode(explode('.', microtime(TRUE)));
               usleep(200000);
               $user->save();
           }
        }

        foreach ($users as $user) {
            if ($user->wallet_id == null && $user->timeline->wallet !== null) {
                $user->wallet_id = $user->timeline->wallet->id;
                $user->save();
            }
        }

        foreach (\App\Wallet::all() as $wallet) {
            if ($wallet->user_id == null && $wallet->timeline->user != null) {
                $wallet->user_id = $wallet->timeline->user->id;
                $wallet->save();
            }
        }

        return response('ok');
    }

}    

