<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    use HasFactory;
     protected $table='shop_category';

     public $timestamps=false;
     public function listCate(){
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
