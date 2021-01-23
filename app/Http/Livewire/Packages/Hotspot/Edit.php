<?php

namespace App\Http\Livewire\Packages\Hotspot;

use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $name, $speed, $price, $time, $devices, $packageId;

    public function mount()
    {
        $response = DB::table('packages')
            ->where('id', '=', $this->packageId)
            ->get();

        foreach ($response as $res) {
            $this->time = $res->time;
            $this->devices = $res->devices;
            $this->speed = $res->speed;
            $this->price = $res->price;
            $this->name = $res->name;
        }
    }

    protected $rules = [
        'name' => 'required|string',
        'price' => 'required|integer',
        'speed' => 'required|string',
        'time' => 'required|string',
        'devices' => 'required|integer'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function edit()
    {
        $this->validate();

        $package = Package::find($this->packageId);

        $package->time = $this->time;
        $package->speed = $this->speed;
        $package->devices = $this->devices;
        $package->price = $this->price;

        $package->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Edited Successfully']);
    }


    public function render()
    {
        return view('livewire.packages.hotspot.edit');
    }
}
