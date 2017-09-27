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
use Illuminate\Support\Facades\Log;
use Teepluss\Theme\Facades\Theme;
use Response;
use GuzzleHttp\Client;

class WalletController extends Controller
{
    /** @var WalletRepository */
    private $walletRepository;
    
    private $timeline;


    public function __construct(WalletRepository $walletRepo, Request $request)
    {
        $this->request = $request;
        $this->walletRepository = $walletRepo;        
    }

    public function walletCreate($type, $id)
    {
        if (empty(config('app.pay_ip'))) return $this->fail([
            'Environment variable PAY_IP not defined. Can not check request from pay-server.'
        ]);

        if (config('app.pay_ip') != $this->request->ip()) return $this->fail([
            'Got result creating wallet from wrong ip: ' . $this->request->ip() . '. Must be: ' . config('app.pay_ip')
        ]);

        $input = $this->request->all();
        $input['type'] = $type;
        $input['id'] = $id;

        if (empty($input['response']) || !$input['response']) return $this->fail([
                'Creating wallet on pay-server unsuccessful!',
                'Pay-server message: ' . (empty($input['message']) ? '' : $input['message']),
                json_encode($input)
            ]);
        if ($type != 'user') return $this->fail(['In async response of pay-server defined type != user.', json_encode($input)]);
        if (empty($input['pay_id'])) return $this->fail(['No pay_id in async response of pay-server.', json_encode($input)]);
        if (empty($input['sign'])) return $this->fail(['No sign in async response of pay-server.', json_encode($input)]);

        $user = User::find($id);
        if (!$user) return $this->fail(['Got wrong (or not existing) ' . $type . ' id from pay-server: ' . $id, json_encode($input)]);

        $wallet = Wallet::firstOrCreate(['timeline_id' => $user->timeline_id]);
        $wallet->pay_id = $input['pay_id'];
        $wallet->sign = $input['sign'];
        $wallet->token_code = $input['ETK_token'];
        $wallet->save();

        Log::info('Registered wallet on pay-server for ' . $type . ' id: ' . $id);

        return response()->json(null, 200);
    }

    private function fail(array $messages = []) {
        if (!empty($messages)) foreach ($messages as $message) Log::alert($message);
        return response()->json(null, 200);
    }

    public function walletUpdate($type, $id)
    {
        if (empty(config('app.pay_ip'))) return $this->fail([
            'Environment variable PAY_IP not defined. Can not check request from pay-server.'
        ]);

        if (config('app.pay_ip') != $this->request->ip()) return $this->fail([
            'Got request for update wallet from wrong ip: ' . $this->request->ip() . '. Must be: ' . config('app.pay_ip')
        ]);

        $input = $this->request->all();
        $input['type'] = $type;
        $input['id'] = $id;

        if ($type != 'user') return $this->fail(['In async response of pay-server defined type != user.', json_encode($input)]);
        if (empty($input['pay_id'])) return $this->fail(['No pay_id for wallet update from pay-server.', json_encode($input)]);
        if (empty($input['hash'])) return $this->fail(['No hash for wallet update from pay-server.', json_encode($input)]);
        $emptySum = ((!isset($input['wallet_EUR']) || !is_numeric($input['wallet_EUR'])) ? 'EUR ' : '')
            . ((!isset($input['wallet_USD']) || !is_numeric($input['wallet_USD'])) ? 'USD ' : '')
            . ((!isset($input['wallet_UAH']) || !is_numeric($input['wallet_UAH'])) ? 'UAH ' : '')
            . ((!isset($input['wallet_ETK']) || !is_numeric($input['wallet_ETK'])) ? 'ETK ' : '');
        if ($emptySum) return $this->fail(['No ' . $emptySum . 'sum amount for wallet update from pay-server.', json_encode($input)]);

        $user = User::find($id);
        if (!$user) return $this->fail(['Got wrong (or not existing) ' . $type . ' id from pay-server: ' . $id, json_encode($input)]);

        $wallet = Wallet::where('timeline_id', $user->timeline_id)->first();
        if (!$wallet) return $this->fail(['Wallet not exist for ' . $type . ' = ' . $id . ' for wallet update from pay-server.', json_encode($input)]);

        if ($input['pay_id'] != $wallet->pay_id) return $this->fail(['Incorrect pay_id for ' . $type . ' = ' . $id . ' for wallet update from pay-server.', json_encode($input)]);

        $strForHash = implode('|', [$wallet->pay_id, $input['wallet_EUR'], $input['wallet_USD'], $input['wallet_UAH'], $input['wallet_ETK'], $wallet->sign]);
        if ($input['hash'] != md5($strForHash)) return $this->fail(['Wrong hash for wallet update from pay-server.', json_encode($input)]);

        $wallet->euro = (int)$input['wallet_EUR'];
        $wallet->dollar = (int)$input['wallet_USD'];
        $wallet->grivna = (int)$input['wallet_UAH'];
        $wallet->token = (int)$input['wallet_ETK'];
        $wallet->save();

        Log::info('Updated wallet from pay-server for ' . $type . ' id: ' . $id);

        return response()->json(null, 200);
    }

    public function getBalance($username)
    {
        $timeline = Timeline::where('username', $username)->first();
        $balance = $timeline->wallet()->first();

        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');
        $trending_tags = trendingTags();
        
        return $theme->scope('wallet/index', compact('timeline', 'trending_tags', 'balance'))->render();
    }

    public function sell($username)
    {
        $timeline = Timeline::where('username', $username)->first();        
        $balance = $timeline->wallet;
        
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');        
        $trending_tags = trendingTags();
                
        return $theme->scope('wallet/sell', compact('timeline', 'trending_tags', 'balance'))->render();
    } 
    
    public function buy($username)
    {
        $timeline = Timeline::where('username', $username)->first();        
        $balance = $timeline->wallet;
        
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');        
        $trending_tags = trendingTags();
        
        return $theme->scope('wallet/buy', compact('timeline', 'trending_tags', 'balance'))->render();
    }
    
    public function refill($username)
    {
        $timeline = Timeline::where('username', $username)->first();        
        $balance = $timeline->wallet;
        
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');        
        $trending_tags = trendingTags();
        
        return $theme->scope('wallet/refill', compact('timeline', 'trending_tags', 'balance'))->render();
    }    
    
    public function refillToMail($username)
    {
        $timeline = Timeline::where('username', $username)->first();        
        $balance = $timeline->wallet;
        
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');        
        $trending_tags = trendingTags();
        
        return $theme->scope('wallet/mailing', compact('timeline', 'trending_tags', 'balance'))->render();
    }  
    
    public function withdrawal($username)
    {
        $timeline = Timeline::where('username', $username)->first();        
        $balance = $timeline->wallet;
        
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');        
        $trending_tags = trendingTags();
        
        return $theme->scope('wallet/withdrawal', compact('timeline', 'trending_tags', 'balance'))->render();
    }

    public function currencyTransactions(Request $request)
    {
//        Log::useDailyFiles(storage_path().'/logs/wallet.log');
//        Log::info($request->all());
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('ajax');

        $headers = ['Referer' => $request->url()];
        $client = new Client(['headers' => $headers]);

        $response = $client->request('POST', 'https://pay.esvoe.com/wallet/history', [
            'json' => [
                'pay_id'    => Auth::user()->wallet->pay_id,
                'currency'  => $request->input('currency'),
                'from_date' => date("d.m.Y", strtotime($request->input('from_data'))),
                'to_date'   => date("d.m.Y", strtotime($request->input('to_data'))),
                'num'       => 10,
                'page'      => $request->input('num_page'),
            ]
        ]);

        $responseBody = json_decode($response->getBody(), true);

        if($responseBody['response'] != true || !isset($responseBody['operations']))
            return response()->json(['status' => '201', 'message' => 'Error: 412']);

        $transactionsHtml = $theme->scope('wallet/currency-transactions', ['transactions'=>$responseBody['operations']])->render();

        $page = (($responseBody['num_page'] > $request->input('num_page')) ? $request->input('num_page') + 1 : '0');

        return response()->json(['status' => '200', 'next_page' => $page, 'data' => $transactionsHtml]);
    }
}

