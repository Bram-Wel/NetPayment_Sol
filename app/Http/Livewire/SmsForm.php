<?php

namespace App\Http\Livewire;

use AfricasTalking\SDK\AfricasTalking;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class SmsForm extends Component
{

    public $user, $message;

    protected $rules = [
        'message' => 'required|min:20'
    ];

    public function sendSms()
    {
        if ($this->user == '') {
            $users = User::get();
            foreach ($users as $user) {
                $phone = $user->phone;
                $username = "thetechglitch"; // use 'sandbox' for development in the test environment
                $apiKey = '0355a696e0f0dca94141e9f88dddd738cdcfc98725445473b0e182b7a15fc526'; // use your sandbox app API key for development in the test environment
                $AT = new AfricasTalking($username, $apiKey);

                $sms = $AT->sms();

                $sms->send([
                    'to' => '+254' . ltrim($phone, '0'),
                    'message' => $this->message
                ]);

                $message = new Message();
                $message->username = $this->user;
                $message->phone = $phone;
                $message->message = $this->message;
                $message->type = 'sms';
                $message->save();
            }
        } else {
            $phone = User::where('username', $this->user)->value('phone');
            $username = "thetechglitch"; // use 'sandbox' for development in the test environment
            $apiKey = '0355a696e0f0dca94141e9f88dddd738cdcfc98725445473b0e182b7a15fc526'; // use your sandbox app API key for development in the test environment
            $AT = new AfricasTalking($username, $apiKey);

            $sms = $AT->sms();

            $sms->send([
                'to' => '+254' . ltrim($phone, '0'),
                'message' => $this->message
            ]);

            $message = new Message();
            $message->username = $this->user;
            $message->phone = $phone;
            $message->message = $this->message;
            $message->type = 'sms';
            $message->save();
        }


        $this->reset();
    }

    public function render()
    {
        return view('livewire.sms-form');
    }
}
