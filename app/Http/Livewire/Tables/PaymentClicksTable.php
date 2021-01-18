<?php

namespace App\Http\Livewire\Tables;

use App\Models\Ip;
use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class PaymentClicksTable extends LivewireDatatable
{
    public $model = Ip::class;
    public $exportable = true;

    public function columns()
    {
        return [
            NumberColumn::name('id'),
            Column::callback(['phone'], function ($phone) {
                return User::where('phone', 0 . ltrim($phone, '254'))->value('username');
            })->label('Username')->searchable(),
            Column::callback(['phone', 'address'], function ($phone) {
                return 0 . ltrim($phone, '254');
            })->label('Phone'),
            Column::name('address'),
            Column::callback(['created_at'], function ($date) {
                return date('d, M Y h:i:s A', strtotime($date));
            })->label('Clicked on')
        ];
    }
}
