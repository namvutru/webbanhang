<?php

namespace App\Http\Controllers;

use App\Models\CmsContent;
use App\Models\ShopBanner;
use App\Models\ShopCategory;
use App\Models\ShopCategoryCustom;
use App\Models\ShopImageProduct;
use App\Models\ShopInfo;
use App\Models\ShopProduct;
use App\Models\ShopVideo;
use Illuminate\Http\Request;
use DB;

class Shop extends Controller
{
    //
    public function home(){
        $shop_info = ShopInfo::first();

        $baner_trangchu = ShopBanner::where('status',1)->where('typebanner',1)->orderBy('id', 'desc')->orderBy('sort','desc')->get();
        $banner_lon =ShopBanner::where('status',1)->where('typebanner',2)->first();
        $bannber_nho =ShopBanner::where('status',1)->where('typebanner',3)->orderBy('id', 'desc')->orderBy('sort','desc')->get();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::all();
        $list_products_l1= ShopProduct::where('status',1)->where('type',1)->orderBy('id', 'desc')->paginate(20);
        $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->paginate(20);
        $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->paginate(20);

        $cms_content_first = CmsContent::where('status',1)->first();
        $cms_content = CmsContent::where('status',1)->orderby('id', 'desc')->get();

        $shop_videos = ShopVideo::where('status',1)->orderby('id', 'desc')->get();
        $shop_video_top = ShopVideo::where('status',1)->first();

        return view('page.home',
            array(
                'shop_info'=>$shop_info,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,

                'list_products'=> $list_products_l1,
                'list_products_l2'=> $list_products_l2,
                'list_products_l3'=> $list_products_l3,

                'banner_trangchu'=> $baner_trangchu,
                'banner_lon'=>$banner_lon ,
                'banner_nho'=>$bannber_nho ,

                'cms_content' => $cms_content,
                'cms_content_first'=> $cms_content_first,

                'shop_videos'=>$shop_videos,
                'shop_video_top'=>$shop_video_top,

            )
        );

    }

    public function detail($slug){
        $shop_info = ShopInfo::first();
        $shop_categorys = ShopCategory::orderBy('id','desc')->get();
        $shop_category_custom =  ShopCategoryCustom::all();

        $product = ShopProduct::where('status',1)->where('slug',$slug)->first();
        $shop_image_product = ShopImageProduct::where('status',1)->where('shop_product_id',$product->id)->get();
        return view('page.detail.detail',
            array(
                'shop_info'=>$shop_info,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,

                'product'=>$product,
                'shop_image_product'=>$shop_image_product,

                )
        );
    }

    public function category($slug){
        $shop_info = ShopInfo::first();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::all();

        $category = ShopCategory::where('slug',$slug)->first();

        $list_product = DB::table('shop_product')->join('shop_category_custom', 'shop_product.shop_category_custom_id', '=', 'shop_category_custom.id')->where('shop_category_custom.shop_category_id','=',$category->id)->where('shop_product.status','=',1)->select('shop_product.*')->orderBy('shop_product.id','desc')->get();

        if($category->type == 1){
        return view('page.category.category_product_l1',
            array(
                'shop_info'=>$shop_info,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,

                'category'=>$category,
                'list_product'=>$list_product,
            )
        );
        }else{
            return view('page.category.category_product_l2',
                array(
                    'shop_info'=>$shop_info,

                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,

                    'category'=>$category,
                    'list_product'=>$list_product,
                )
            );
        }


    }


    public function categorycustom($slug){
        $shop_info = ShopInfo::first();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::all();

        $category = ShopCategoryCustom::where('slug',$slug)->first();

        $list_product = ShopProduct::where('status',1)->where('shop_category_custom_id',$category->id)->orderBy('id','desc')->get();

        if($category->type == 1){
            return view('page.category.category_product_l1',
                array(
                    'shop_info'=>$shop_info,

                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,

                    'category'=>$category,
                    'list_product'=>$list_product,
                )
            );
        }else{
            return view('page.category.category_product_l2',
                array(
                    'shop_info'=>$shop_info,

                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,

                    'category'=>$category,
                    'list_product'=>$list_product,
                )
            );
        }


    }



    public function test(){
        return view('index');
    }

}
