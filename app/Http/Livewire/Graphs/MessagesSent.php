<?php

namespace App\Http\Livewire\Graphs;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MessagesSent extends Component
{
    public $thisYear, $thisWeek, $thisMonth, $lastYear, $secondLastYear, $thirdLastYear, $fourthLastYear, $fifthLastYear,
        $one, $two, $three, $four, $five, $six;

    public function mount()
    {
        $this->thisYear = DB::table('messages')->whereYear('created_at', '=', now()->year)->count();
        $this->thisMonth = DB::table('messages')->whereMonth('created_at', '=', now()->month)->count();
        $this->thisWeek = DB::table('messages')->whereBetween('created_at', [Carbon::now()->startOfWeek('1'), Carbon::now()->endOfWeek('7')])->count();
        $this->lastYear = DB::table('messages')->whereYear('created_at', '=', now()->year - 1)->count();
        $this->secondLastYear = DB::table('messages')->whereYear('created_at', '=', now()->year - 2)->count();
        $this->thirdLastYear = DB::table('messages')->whereYear('created_at', '=', now()->year - 3)->count();
        $this->fourthLastYear = DB::table('messages')->whereYear('created_at', '=', now()->year - 4)->count();
        $this->fifthLastYear = DB::table('messages')->whereYear('created_at', '=', now()->year - 5)->count();

        $this->one = now()->year;
        $this->two = now()->year - 1;
        $this->three = now()->year - 2;
        $this->four = now()->year - 3;
        $this->five = now()->year - 4;
        $this->six = now()->year - 5;
    }


    public function render()
    {
        return view('livewire.graphs.messages-sent');
    }
}
