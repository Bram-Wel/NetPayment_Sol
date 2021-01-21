<?php

namespace App\Http\Livewire\Tables;

use App\Models\Message;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class MessagesSent extends LivewireDatatable
{
    public $model = Message::class;

    public function columns()
    {
        return [
            NumberColumn::name('id'),
            Column::name('username'),
            Column::name('phone'),
            Column::name('email'),
            Column::name('message'),
            Column::name('type'),
            Column::callback(['created_at'], function ($date) {
                return $date->diffForHumans();
            })
        ];
    }
}
