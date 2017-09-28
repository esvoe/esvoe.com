<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Wallet;
use Illuminate\Support\Facades\Log;

class WalletRegisteredUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        $wallet = Wallet::firstOrCreate(['timeline_id' => $user->timeline_id]);
        if (empty($user->wallet_id) || empty($wallet->user_id)){
            //        $user->wallet()->save($wallet);
            $user->wallet_id = $wallet->id; //TODO переделать нужно не забыть
            $user->save();
            $wallet->user_id = $user->id;
            $wallet->save();
        }
        if (!(empty($wallet->pay_id) || empty($wallet->sign))) return null;
        if (empty(config('app.pay_url'))) {
            Log::alert('Environment variable APP_PAY not defined. Request for register wallet impossible.');
            return null;
        }
        $url = config('app.pay_url') . '/wallet/create';
        $opts = [
            'http' => [
                'method'  => 'POST',
                'header'  => [
                    'Content-type: application/json',
                    'Referer: ' . config('app.url')
                ],
                'content' => json_encode([
                    'user_name'     => $user->username,
                    'user_nickname' => $user->name,
                    'user_id'       => $user->id,
                    'user_email'    => $user->email,
                    'type'          => 'user'
                ])
            ]
        ];
        Log::info('Request for creating wallet', [$url, $opts]);
        $context = stream_context_create($opts);
        try {
            $response = file_get_contents($url, false, $context);

            if ($response === false) {
                Log::alert('Request for creating wallet unsuccessful. Error request to pay-server.');
            } else {
                $response = utf8_encode($response);
                $res = json_decode($response);
                if (empty($res->response) || !$res->response) {
                    Log::alert('Request for creating wallet unsuccessful.');
                    if (!empty($response) && empty($res)) Log::alert('Pay-server response: ' . $response);
                    if (!empty($res->message)) {
                        Log::alert('Pay-server Message: ' . $res->message);
                    } else {
                        Log::alert('No message from pay-server');
                    }
                } else {
                    Log::info('Success response for request to create wallet for user id: ' . $user->id);
                }
            }
        } catch (\Exception $e) {
            Log::alert('Error request to pay-server:' . $e->getMessage());
        }
    }

    public function subscribe($events) {
        $events->listen(
            'Illuminate\Auth\Events\Registered',
            'App\Listeners\WalletRegisteredUser@handle'
        );
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\WalletRegisteredUser@handle'
        );
    }
}
