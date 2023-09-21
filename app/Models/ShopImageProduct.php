<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopImageProduct extends Model
{
    use HasFactory;
    protected $table='shop_image_product';
    public $timestamps=false;
    protected $fillable = ['id','title' ,'image', 'shop_product_id', 'status'];
    public function shop_product()
    {
        return $this->belongsTo(ShopProduct::class,'shop_product_id');
    }
}
