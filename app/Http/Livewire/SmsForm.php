<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SmsForm extends Component
{

    public $users, $message;

    protected $rules = [
      'user' => 'required',
      'message' => 'required|min:20'
    ];

    public function render()
    {
        return view('livewire.sms-form');
    }
}
