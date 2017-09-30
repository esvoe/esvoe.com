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

class AdvertisingController extends AppBaseController
{
    /** @var WalletRepository */
    private $walletRepository;
    
    private $timeline;

    public function __construct(WalletRepository $walletRepo, Request $request)
    {
        $this->request = $request;
        $this->walletRepository = $walletRepo;        
    }

    public function getBanners(Request $request)
    {
        Log::useDailyFiles(storage_path().'/logs/add.log');

        $headers = ['Referer' => $request->url()];
        $client = new \GuzzleHttp\Client(['headers' => $headers]);

        $data = [
            'external_user_id' => Auth::user()->id,
            'wantedBanners' => [
//                [
//                    'count' => 3,
//                    'width' => 336,
//                    'height'=> 280,
//                ],
//                [
//                    'count' => 2,
//                    'width' => 125,
//                    'height'=> 125,
//                ],
//                [
//                    'count' => 2,
//                    'width' => 300,
//                    'height'=> 250,
//                ]
                [
                    'count' => $request->input('count'),
                    'width' => $request->input('width'),
                    'height'=> $request->input('height'),
                ]
            ],
        ];

        $response = $client->request('POST', 'https://add.esvoe.com/api/get_banners', ['json' => $data]);
//        $response = $client->request('POST', 'https://sand.esvoe.com/get-banners-test', ['json' => $data]);

        $responseBody = json_decode($response->getBody(), true);
        Log::info($response->getBody());

        $htmlBlocks = '';
        foreach ($responseBody[0]['codes'] as $code){
            $htmlBlocks .= $code;
        }

        Log::info($responseBody);
//
//        dd($responseBody);
//
//        if($responseBody['response'] != true)
//            return response()->json(['status' => '201', 'message' => 'Error: response not true']);
//
//        if($responseBody['status'] != '1')
//            return response()->json(['status' => '201', 'message' => 'Error: status = 0']);

        return response()->json(['status' => '200', 'htmlBlocks' => $htmlBlocks]);
    }

    public function getBannersTest(Request $request)
    {
        Log::useDailyFiles(storage_path().'/logs/add-test.log');
        Log::info(file_get_contents('php://input'));
        die;
    }

}    

