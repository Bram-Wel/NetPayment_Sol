<?php

namespace App\Http\Livewire\Packages\Pppoe;

use App\Models\PppoePackages;
use Livewire\Component;

class Add extends Component
{
    public $name, $price, $time, $speed;

    protected $rules = [
        'name' => 'required|string|unique:pppoe_packages,name',
        'price' => 'integer|required',
        'time' => 'required|string',
        'speed' => 'required|integer'
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        $package = new PppoePackages();

        $package->name = $this->name;
        $package->time = $this->time;
        $package->speed = $this->speed;
        $package->price = $this->price;

        $package->save();
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success', 'message' => 'Added']);
    }

    public function render()
    {
        return view('livewire.packages.pppoe.add');
    }
}
