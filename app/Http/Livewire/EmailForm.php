<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EmailForm extends Component
{
    public $users, $message;

    protected $rules = [
      'user' => 'required',
      'message' => 'required|min:30'
    ];

    public function render()
    {
        return view('livewire.email-form');
    }
}
