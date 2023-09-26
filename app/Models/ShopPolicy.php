<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopPolicy extends Model
{
    use HasFactory;
    protected $table='shop_policy';
    public $timestamps=false;
}
