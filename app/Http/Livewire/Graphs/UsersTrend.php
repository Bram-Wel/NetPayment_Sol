<?php

namespace App\Http\Livewire\Graphs;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UsersTrend extends Component
{

    public $thisYear, $thisWeek, $thisMonth, $lastYear, $secondLastYear, $thirdLastYear, $fourthLastYear, $fifthLastYear,
        $one, $two, $three, $four, $five, $six;

    public function mount()
    {
        $this->thisYear = DB::table('users')->whereYear('created_at', '=', now()->year)->count('id');
        $this->thisMonth = DB::table('users')->whereMonth('created_at', '=', now()->month)->count('id');
        $this->thisWeek = DB::table('users')->whereBetween('created_at', [Carbon::now()->startOfWeek('1'), Carbon::now()->endOfWeek('7')])->count('id');
        $this->lastYear = DB::table('users')->whereYear('created_at', '=', now()->year - 1)->count('id');
        $this->secondLastYear = DB::table('users')->whereYear('created_at', '=', now()->year - 2)->count('id');
        $this->thirdLastYear = DB::table('users')->whereYear('created_at', '=', now()->year - 3)->count('id');
        $this->fourthLastYear = DB::table('users')->whereYear('created_at', '=', now()->year - 4)->count('id');
        $this->fifthLastYear = DB::table('users')->whereYear('created_at', '=', now()->year - 5)->count('id');

        $this->one = now()->year;
        $this->two = now()->year - 1;
        $this->three = now()->year - 2;
        $this->four = now()->year - 3;
        $this->five = now()->year - 4;
        $this->six = now()->year - 5;
    }


    public function render()
    {
        return view('livewire.graphs.users-trend');
    }
}
