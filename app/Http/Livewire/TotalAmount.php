<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TotalAmount extends Component
{
    public $totalAmount;

    public function mount()
    {
        $this->totalAmount = DB::table('payments')
            ->whereMonth('created_at', date('m'))
            ->sum('amount');
    }

    public function render()
    {
        return view('livewire.total-amount');
    }
}
