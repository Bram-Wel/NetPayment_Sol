<?php

namespace App\Http\Livewire\Packages\Hotspot;

use App\Models\Package;
use Livewire\Component;

class Add extends Component
{

    public $time, $devices, $speed, $price, $name;

    protected $rules = [
        'name' => 'required|string|unique:packages,name',
        'price' => 'required|integer',
        'speed' => 'required|string',
        'devices' => 'required|integer',
        'time' => 'required|string'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $package = new Package();
        $package->name = $this->name;
        $package->time = $this->time;
        $package->speed = $this->speed;
        $package->devices = $this->devices;
        $package->price = $this->price;

        $package->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Added']);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.packages.hotspot.add');
    }
}
