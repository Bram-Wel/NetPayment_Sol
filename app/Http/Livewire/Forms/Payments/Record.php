<?php

namespace App\Http\Livewire\Forms\Payments;

use App\Models\Payment;
use Livewire\Component;

class Record extends Component
{

    public $receipt, $phone, $amount, $checked;

    public function mount()
    {

    }

    public function record()
    {
        $payment = new Payment();

        $payment->phone = $this->phone;
        $payment->receipt = $this->receipt;
        $payment->amount = $this->amount;
        $payment->checked = 0;
        $payment->save();

        $this->reset();

        session()->flash('message', 'Payment recorded successfully!');
        $this->redirect(route('payment'));
    }

    public function render()
    {
        return view('livewire.forms.payments.record');
    }
}
