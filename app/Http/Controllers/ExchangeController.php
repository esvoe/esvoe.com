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

class ExchangeController extends AppBaseController
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
//        Log::useDailyFiles(storage_path().'/logs/info.log');
//        Log::info($request->input('rates'));

        foreach ($request->input('rates', []) as $rate){
            $rate = \App\ExchangeRate::create([
                'from'  => $rate['from_currency'],
                'to'    => $rate['to_currency'],
                'rate'  => $rate['rate'],
            ]);
        }

        return response()->json(['ok']);
    }     

}    

