<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\WarehouseLocation;
use App\Models\StockMovement;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'weight',
        'quantity',
        'image',
        'category_id',
        'warehouse_location_id',
    ];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function location(){
        return $this->belongsTo(WarehouseLocation::class, 'warehouse_location_id');
    }

    public function stockMovements(){
        return $this->hasMany(StockMovement::class);
    }
}
