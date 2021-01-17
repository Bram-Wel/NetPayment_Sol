<?php

namespace App\Http\Livewire\Tables;

use App\Models\Payment;
use App\Models\User;
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
            Column::callback(['phone'], function ($phone) {
                return User::where('phone', $phone)->value('username');
            })->label('Name'),
            Column::name('phone'),
            Column::name('receipt_number')->label('Receipt'),
            Column::name('amount'),
            Column::callback(['created_at'], function ($date) {
                return date('d, M Y h:i:s A', strtotime($date));
            })->label('payment time'),
            BooleanColumn::name('checked')
        ];
    }
}
