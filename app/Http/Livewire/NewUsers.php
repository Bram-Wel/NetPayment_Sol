<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewUsers extends Component
{
    public $newUsers;

    public function mount()
    {
        $this->newUsers = DB::table('users')
            ->whereMonth('created_at', date('m'))
            ->count('id');
    }

    public function render()
    {
        return view('livewire.new-users');
    }
}
