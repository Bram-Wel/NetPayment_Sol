<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TotalAmountDaily extends Component
{
    public $totalAmount;

    public function mount()
    {
        $this->totalAmount = DB::table('payments')
            ->whereDay('created_at', date('d'))
            ->sum('amount');
    }

    public function render()
    {
        return view('livewire.total-amount-daily');
    }
}
