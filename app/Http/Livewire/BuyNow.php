<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BuyNow extends Component
{
    public $package, $message;

    public function mount() {
        $this->message = "Buy Now";
    }

    public function buy() {
        $this->message = "Buying...";

        if ($this->package == 3) {
            $amount = 1500;
        } elseif ($this->package == 5) {
            $amount = 2200;
        } elseif ($this->package) {
            $amount = 2800;
        }

        $this->message = "Buy Now";

        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success', 'message' => 'Payment initiated successfully!']);
    }

    public function render()
    {
        return view('livewire.buy-now');
    }
}
