<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PppoePackages extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'pppoe_packages';
}
