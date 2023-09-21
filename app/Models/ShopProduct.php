<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProduct extends Model
{
    use HasFactory;
    protected $table='shop_product';
    public function shop_image_product()
    {
        return $this->hasMany(ShopImageProduct::class,'shop_product_id');
    }
}
