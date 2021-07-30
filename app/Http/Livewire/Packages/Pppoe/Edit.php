<?php

namespace App\Http\Livewire\Packages\Pppoe;

use App\Models\PppoePackages;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $packageId, $name, $speed, $time, $price;

    public function mount()
    {
        $result = DB::table('pppoe_packages')
            ->where('id', '=', $this->packageId)
            ->get();

        foreach ($result as $res) {
            $this->name = $res->name;
            $this->price = $res->price;
            $this->time = $res->time;
            $this->speed = $res->speed;
        }
    }

    protected $rules = [
        'name' => 'required|string',
        'speed' => 'required|string',
        'time' => 'required|string',
        'price' => 'required|integer'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit()
    {
        $this->validate();

        $package = PppoePackages::find($this->packageId);

        $package->time = $this->time;
        $package->speed = $this->speed;
        $package->price = $this->price;

        $package->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Edited successfully']);
        $this->redirect(route('packages'));
        $this->reset();

    }

    public function render()
    {
        return view('livewire.packages.pppoe.edit');
    }
}
