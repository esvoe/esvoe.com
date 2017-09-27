<?php
namespace App\Http\Controllers;

use App\User;
use App\Setting;
use App\Timeline;
use App\Transaction;
use App\Wallet;
use App\Repositories\WalletRepository;
use App\Http\Requests;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Teepluss\Theme\Facades\Theme;
use Response;

class TransactionController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;    
    }
    
    public function getAllTransaction($username)
    {
        $timeline = Timeline::where('username', $username)->first();   
        
        $balance = $timeline->wallet;
        $query = Transaction::where('client_from', $timeline->id)
            ->orwhere('client_to', $timeline->id);
        
        $theme = Theme::uses(Setting::get('current_theme', 'default'))->layout('default');        
        $trending_tags = trendingTags();
                
        return $theme->scope('wallet/transaction', 
            compact('timeline', 'trending_tags', 'balance', 'query'))->render();
        
    }    
}
