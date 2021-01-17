<?php

namespace App\Http\Livewire\Tables;

use App\Models\Payment;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class PaymentsTable extends LivewireDatatable
{
    public $model = Payment::class;

    public function columns()
    {
        return [
            NumberColumn::name('id'),
            Column::name('phone'),
            Column::name('receipt_number')->label('Receipt'),
            Column::name('amount'),
            Column::name('type'),
            Column::callback(['created_at'], function ($date) {
                return date('d, M Y h:i:s A', strtotime($date));
            }),
            BooleanColumn::name('checked')
        ];
    }
}
