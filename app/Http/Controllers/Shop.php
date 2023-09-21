<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use App\Models\ShopCategoryCustom;
use Illuminate\Http\Request;

class Shop extends Controller
{
    //
    public function home(){

        $shop_categorys = ShopCategory::orderBy('id','desc')->get();
        $shop_category_custom =  ShopCategoryCustom::all();
        return view('namvutru',
            array(
                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom
            )
        );

    }
}
