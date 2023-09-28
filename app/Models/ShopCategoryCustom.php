<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCategoryCustom extends Model
{
    use HasFactory;
    protected $table='shop_category_custom';
    public $timestamps=false;

    public function shop_category()
    {
        return $this->belongsTo(ShopCategory::class,'shop_category_id');
    }

    public function listCateCustom(){
        $list   = [];
        $result = $this->select('title', 'id')
            ->get()
            ->toArray();
        foreach ($result as $value) {
            $list[$value['id']] = $value['title'];
        }
        return $list;
    }
}
