<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubscribeMovie extends Component
{

    public $package, $freq, $message = "Subscribe", $timestamp, $shortcode, $consumerKey, $consumerSecret, $phone, $openModal, $amount;

    public function mount()
    {
        $this->openModal = false;
        $this->message = "Subscribe";

        $this->timestamp = date('YmdHis', time());
        $this->shortcode = '7587637';
        $this->consumerKey = 'UEZoZdWPgGlcnKR9cS0rZ3lnrsntsaft';
        $this->consumerSecret = 'acIzhXbEd3O2qubW';
        $this->phone = '254' . ltrim(Auth::user()->phone, 0);

    }

    public function buy()
    {
        $this->message = "Subscribing...";
        $this->openModal = true;

        if ($this->package == 1 && $this->freq == 'daily') {
            $this->amount = 20;
        } elseif ($this->package == 2 && $this->freq == 'daily') {
            $this->amount = 120;
        } elseif ($this->package == 3 && $this->freq == 'daily') {
            $this->amount = 450;
        }

        $this->customerMpesaSTKPush($this->shortcode, $this->timestamp, $this->phone);

        $this->message = "Buy Now";
    }

    public function customerMpesaSTKPush($shortcode, $timestamp, $phone)
    {
        $url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $shortcode,
            'Password' => $this->lipaNaMpesaPassword($shortcode, $timestamp),
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerBuyGoodsOnline',
            'Amount' => $this->amount,
            'PartyA' => $this->phone, // replace this with your phone number
            'PartyB' => 5623109,
            'PhoneNumber' => $this->phone, // replace this with your phone number
            'CallBackURL' => 'https://51.178.186.9/api/payment.php',
            'AccountReference' => "The Tech Glitch",
            'TransactionDesc' => "Pay for The Tech Glitch Internet"
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_exec($curl);
    }

    public function generateAccessToken()
    {
        $credentials = base64_encode($this->consumerKey . ":" . $this->consumerSecret);
        $url = "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic " . $credentials));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token = json_decode($curl_response);
        return $access_token->access_token;
    }

    public function lipaNaMpesaPassword($shortcode, $timestamp): string
    {
        $passkey = "3baf38758ec6d941a51cca5806e4d38ce10478d3b0b268deeda1104c728dcba2";
        return base64_encode($shortcode . $passkey . $timestamp);
    }

    public function render()
    {
        return view('livewire.subscribe-movie');
    }
}
