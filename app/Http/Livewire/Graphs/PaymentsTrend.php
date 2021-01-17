<?php

namespace App\Http\Livewire\Graphs;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PaymentsTrend extends Component
{
    public $thisYear, $thisWeek, $thisMonth, $lastYear, $secondLastYear, $thirdLastYear, $fourthLastYear, $fifthLastYear,
        $one, $two, $three, $four, $five, $six;

    public function mount()
    {
        $this->thisYear = DB::connection('mysql2')->table('payments')->whereYear('created_at', '=', now()->year)->sum('amount');
        $this->thisMonth = DB::connection('mysql2')->table('payments')->whereMonth('created_at', '=', now()->month)->sum('amount');
        $this->thisWeek = DB::connection('mysql2')->table('payments')->whereBetween('created_at', [Carbon::now()->startOfWeek('1'), Carbon::now()->endOfWeek('7')])->sum('amount');
        $this->lastYear = DB::connection('mysql2')->table('payments')->whereYear('created_at', '=', now()->year - 1)->sum('amount');
        $this->secondLastYear = DB::connection('mysql2')->table('payments')->whereYear('created_at', '=', now()->year - 2)->sum('amount');
        $this->thirdLastYear = DB::connection('mysql2')->table('payments')->whereYear('created_at', '=', now()->year - 3)->sum('amount');
        $this->fourthLastYear = DB::connection('mysql2')->table('payments')->whereYear('created_at', '=', now()->year - 4)->sum('amount');
        $this->fifthLastYear = DB::connection('mysql2')->table('payments')->whereYear('created_at', '=', now()->year - 5)->sum('amount');

        $this->one = now()->year;
        $this->two = now()->year - 1;
        $this->three = now()->year - 2;
        $this->four = now()->year - 3;
        $this->five = now()->year - 4;
        $this->six = now()->year - 5;
    }

    public function render()
    {
        return view('livewire.graphs.payments-trend');
    }
}
