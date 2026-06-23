<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseLocation extends Model
{
    protected $fillable = [
        'zone', 'rack', 'shelf', 'code', 'is_active',
    ];
}
