<?php

namespace App\Console\Commands;

use AfricasTalking\SDK\AfricasTalking;
use App\Models\Message;
use App\Models\MovieSubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckMoviePayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check movie packages payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Africa/Nairobi');
        $result = DB::connection('mysql2')->table('payments')
            ->where('checked', '=', 0)
            ->count('id');

        if ($result > 0) {
            $result = DB::connection('mysql2')->table('payments')
                ->where('checked', '=', 0)
                ->get();

            foreach ($result as $payment) {
                $p = $payment->phone;
                $name = User::where('phone', $p)->value('username');
                $amount = DB::connection('mysql2')->table('payments')
                    ->where('phone', $p)
                    ->where('checked', 0)
                    ->value('amount');

                if ($amount == 20) {
                    $movieSubscription = new MovieSubscription();
                    $movieSubscription->name = Auth::user()->name;
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addDay();
                    $movieSubscription->package = 1;
                    $movieSubscription->expiry = $date;
                    $movieSubscription->save();
                    $rate = 'daily';
                } elseif ($amount == 120) {
                    $movieSubscription = new MovieSubscription();
                    $movieSubscription->name = Auth::user()->name;
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addWeek();
                    $movieSubscription->package = 2;
                    $movieSubscription->expiry = $date;
                    $movieSubscription->save();
                    $rate = 'weekly';
                } elseif ($amount == 450) {
                    $movieSubscription = new MovieSubscription();
                    $movieSubscription->name = Auth::user()->name;
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', now())->addMonth();
                    $movieSubscription->package = 3;
                    $movieSubscription->expiry = $date;
                    $movieSubscription->save();
                    $rate = 'monthly';
                }

                $time = date('h:i a', strtotime($date));
                $date = date('d, M Y', strtotime($date));

                $username = "thetechglitch"; // use 'sandbox' for development in the test environment
                $apiKey = '0355a696e0f0dca94141e9f88dddd738cdcfc98725445473b0e182b7a15fc526'; // use your sandbox app API key for development in the test environment
                $AT = new AfricasTalking($username, $apiKey);

                $sms = $AT->sms();

                $sms->send([
                    'to' => '+254' . ltrim($p, '0'),
                    'message' => "You have successfully subscribed to the $rate movie package, expires on $date at $time."
                ]);

                $message = new Message();
                $message->username = $name;
                $message->phone = $p;
                $message->message = "You have successfully subscribed to the $rate movie package, expires on $date at $time.";
                $message->type = 'sms';
                $message->save();

                DB::connection('mysql2')->table('payments')
                    ->where('phone', '=', $p)
                    ->update(['checked' => 1]);
            }
        }
    }
}
