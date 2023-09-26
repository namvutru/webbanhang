<?php

namespace App\Http\Controllers;

use App\Models\CmsCategory;
use App\Models\CmsContent;
use App\Models\CmsNews;
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
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();



        $list_products_l1= ShopProduct::where('status',1)->where('type',1)->orderBy('id', 'desc')->paginate(20);
        $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->paginate(20);
        $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->paginate(20);

        $cms_content_first = CmsContent::where('status',1)->first();
        $cms_content = CmsContent::where('status',1)->orderby('id', 'desc')->take(5);

        $shop_videos = ShopVideo::where('status',1)->orderby('id', 'desc')->get();
        $shop_video_top = ShopVideo::where('status',1)->first();

        return view('page.home',
            array(
                'shop_info'=>$shop_info,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,
                'cms_category'=>$cms_category,

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

        $shop_categorys  = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $product = ShopProduct::where('status',1)->where('slug',$slug)->first();
        $shop_image_product = ShopImageProduct::where('status',1)->where('shop_product_id',$product->id)->get();


        if($product->type==1){
            return view('page.detail.detail',
                array(
                    'shop_info'=>$shop_info,

                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,
                    'cms_category'=>$cms_category,

                    'product'=>$product,
                    'shop_image_product'=>$shop_image_product,

                )
            );
        }else{
            return view('page.detail.detail_l2',
                array(
                    'shop_info'=>$shop_info,

                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,
                    'cms_category'=>$cms_category,

                    'product'=>$product,
                    'shop_image_product'=>$shop_image_product,

                )
            );
        }



    }

    public function category($slug){
        $shop_info = ShopInfo::first();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $category = ShopCategory::where('slug',$slug)->first();

        $list_product = DB::table('shop_product')->join('shop_category_custom', 'shop_product.shop_category_custom_id', '=', 'shop_category_custom.id')->where('shop_category_custom.shop_category_id','=',$category->id)->where('shop_product.status','=',1)->select('shop_product.*')->orderBy('shop_product.id','desc')->get();

        if($category->type == 1){
        return view('page.category.category_product_l1',
            array(
                'shop_info'=>$shop_info,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,
                'cms_category'=>$cms_category,

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
                    'cms_category'=>$cms_category,

                    'category'=>$category,
                    'list_product'=>$list_product,
                )
            );
        }


    }


    public function categorycustom($slug){
        $shop_info = ShopInfo::first();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $category = ShopCategoryCustom::where('slug',$slug)->first();

        $list_product = ShopProduct::where('status',1)->where('shop_category_custom_id',$category->id)->orderBy('id','desc')->get();

        if($category->type == 1){
            return view('page.category.category_product_l1',
                array(
                    'shop_info'=>$shop_info,

                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,
                    'cms_category'=>$cms_category,

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
                    'cms_category'=>$cms_category,

                    'category'=>$category,
                    'list_product'=>$list_product,
                )
            );
        }


    }



    public function list_news(){

        $shop_info = ShopInfo::first();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $cms_content = CmsContent::where('status',1)->orderBy('updated_at','desc')->paginate(2);


        return view('page.news.list_news',
            array(
                'shop_info'=>$shop_info,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,
                'cms_category'=>$cms_category,

                'cms_content'=>$cms_content,


            )
        );



    }


    public function news($slug){

    }



    public function test(){
        return view('index');
    }



    public function news_detail($name, $id)
    {
        // $news_currently = CmsNews::find($id);
        $blog_currently = CmsContent::find($id);
        // return $id;
        $categorySelf = CmsCategory::where('id', $blog_currently['category_id'])->first();
        $blogs_other = CmsContent::where('id', '!=', $blog_currently['id'])->orderByDesc('id')->get();

        if($blog_currently){
            $title = ($blog_currently) ? $blog_currently->title : 'Không tìm thấy dữ liệu';
            return view($this->theme . '.cms_news_detail',
                array(
                    'title'          => $title,
                    'news_currently' => $blog_currently,
                    'description'    => $this->configs['site_description'],
                    'keyword'        => $this->configs['site_keyword'],
                    'blogs'          => (new CmsNews)->getItemsNews($limit = 4),
                    'categorySelf' => $categorySelf,
                    'blogs_other' => $blogs_other

                )
            );
        } else {
            return view($this->theme . '.notfound',
                array(
                    'title'       => 'Không tìm thấy dữ liệu',
                    'description' => '',
                    'keyword'     => $this->configs['site_keyword'],
                )
            );
        }

    }


}
