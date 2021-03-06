<?php

namespace App\Console\Commands;

use AfricasTalking\SDK\AfricasTalking;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Query;

class CheckScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check scheduler and remind user if less than 5 hours left.';

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
     * @throws ConfigException
     */
    public function handle()
    {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT')
        ]);

        $client = new Client($config);

        $query = (new Query('/system/scheduler/print'));
        $response = $client->query($query)->read();
        foreach ($response as $res) {
            $date = ucwords($res['start-date']);
            $time = $res['start-time'];

            $end = $date . " " . $time;
            $endTime = date('h:i A', strtotime($time));

            $end = Carbon::createFromFormat('M/d/Y H:i:s', $end);
            $hours = Carbon::now()->diffInHours($end);

            if ($hours <= 5) {
                $count = User::where('username', ltrim($res['name'], 'deactivate-'))->count();
                if ($count == 0) {
                    $phone = User::where('username', ucfirst(ltrim($res['name'], 'deactivate-')))->value('phone');
                } else {
                    $phone = User::where('username', ltrim($res['name'], 'deactivate-'))->value('phone');
                }
                $username = "thetechglitch"; // use 'sandbox' for development in the test environment
                $apiKey = '0355a696e0f0dca94141e9f88dddd738cdcfc98725445473b0e182b7a15fc526'; // use your sandbox app API key for development in the test environment
                $AT = new AfricasTalking($username, $apiKey);

                $sms = $AT->sms();

                $password = User::where('phone', $phone)->value('password');
                $username = ltrim($res['name'], 'deactivate-');

                $sms->send([
                    'to' => '+254' . ltrim($phone, '0'),
                    'message' => "Your internet subscription expires today at $endTime."
                ]);

                $message = new Message();
                $message->username = ltrim($res['name'], 'deactivate-');
                $message->phone = $phone;
                $message->message = "Your internet subscription expires today at $endTime. You can now change your username, password and phone number you use to pay with in the profile menu.";
                $message->type = 'sms';
                $message->save();
            }
        }
    }
}
