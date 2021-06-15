<?php

namespace App\Http\Livewire\Tables;

use App\Models\Message;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class MessagesSent extends LivewireDatatable
{
    public $model = Message::class;

    public function columns()
    {
        return [
            NumberColumn::name('id'),
            Column::name('username')->searchable(),
            Column::name('phone')->searchable(),
            Column::name('message')->truncate(50)->searchable(),
            Column::name('type')->searchable(),
            Column::callback(['created_at'], function ($date) {
                return date('d, M Y h:i:s A', strtotime($date));
            })->label('Sent on'),
            Column::delete()->label('Delete')
        ];
    }
}
