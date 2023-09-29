<?php

namespace App\Http\Controllers;

use App\Models\CmsCategory;
use App\Models\CmsContent;
use App\Models\CmsNews;
use App\Models\ShopAddress;
use App\Models\ShopBanner;
use App\Models\ShopCategory;
use App\Models\ShopCategoryCustom;
use App\Models\ShopContact;
use App\Models\ShopImageProduct;
use App\Models\ShopInfo;
use App\Models\ShopPolicy;
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
        $banner_duoiphai = ShopBanner::where('status',1)->where('typebanner',4)->orderBy('id', 'desc')->orderBy('sort','desc')->first();
        $shop_policy = ShopPolicy::where('status',1)->get();
        $shop_address = ShopAddress::where('status',1)->get();


        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();


        $list_products_l1= ShopProduct::where('status',1)->where('type',1)->orderBy('id', 'desc')->paginate(20);
        $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->take(10)->get();
        $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->take(10)->get();

        $cms_content_first = CmsContent::where('status',1)->orderby('id', 'desc')->first();
        $cms_content = CmsContent::where('status',1)->orderby('id', 'desc')->orderby(DB::raw('RAND()'))->whereNotIn('slug',[$cms_content_first->slug])->take(6)->get();

        $shop_video_top = ShopVideo::where('status',1)->orderby('id', 'desc')->first();
        $shop_videos = ShopVideo::where('status',1)->orderby('id', 'desc')->orderby(DB::raw('RAND()'))->whereNotIn('link',[$shop_video_top->link])->take(6)->get();


        return view('page.home',
            array(
                'shop_info'=>$shop_info,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,
                'cms_category'=>$cms_category,

                'shop_policy'=>$shop_policy,
                'shop_address'=>$shop_address,

                'list_products'=> $list_products_l1,
                'list_products_l2'=> $list_products_l2,
                'list_products_l3'=> $list_products_l3,

                'banner_trangchu'=> $baner_trangchu,
                'banner_lon'=>$banner_lon ,
                'banner_nho'=>$bannber_nho ,
                'banner_duoiphai'=>$banner_duoiphai,

                'cms_content' => $cms_content,
                'cms_content_first'=> $cms_content_first,

                'shop_videos'=>$shop_videos,
                'shop_video_top'=>$shop_video_top,



            )
        );

    }

    public function detail($slug){
        $shop_info = ShopInfo::first();

        $shop_policy = ShopPolicy::where('status',1)->get();
        $shop_address = ShopAddress::where('status',1)->get();

        $banner_duoiphai = ShopBanner::where('status',1)->where('typebanner',4)->orderBy('id', 'desc')->orderBy('sort','desc')->first();

        $shop_categorys  = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $product = ShopProduct::where('status',1)->where('slug',$slug)->first();
        $shop_image_product = ShopImageProduct::where('status',1)->where('shop_product_id',$product->id)->get();



        if($product->type==1){

            $related_product = ShopProduct::where('status',1)->where('type',1)->where('shop_category_custom_id',$product->shop_category_custom_id)->orderby(DB::raw('RAND()'))->whereNotIn('slug',[$product->slug])->take(12)->get();
            $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->take(10)->get();

            $related_news =  CmsContent::where('status',1)->orderby(DB::raw('RAND()'))->take(3)->get();

            return view('page.detail.detail',
                array(
                    'shop_info'=>$shop_info,

                    'shop_policy'=>$shop_policy,
                    'shop_address'=>$shop_address,

                    'banner_duoiphai'=>$banner_duoiphai,

                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,
                    'cms_category'=>$cms_category,

                    'product'=>$product,
                    'shop_image_product'=>$shop_image_product,

                    'related_product'=>$related_product,
                    'list_products_l2'=>$list_products_l2,

                    'related_news'=>$related_news,

                )
            );
        }else{

            $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->take(10)->get();
            $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->take(10)->get();
            return view('page.detail.detail_l2',
                array(
                    'shop_info'=>$shop_info,

                    'shop_policy'=>$shop_policy,
                    'shop_address'=>$shop_address,

                    'banner_duoiphai'=>$banner_duoiphai,


                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,
                    'cms_category'=>$cms_category,

                    'product'=>$product,
                    'shop_image_product'=>$shop_image_product,

                    'list_products_l2'=> $list_products_l2,
                    'list_products_l3'=> $list_products_l3,

                )
            );
        }



    }

    public function category($slug){
        $shop_info = ShopInfo::first();

        $shop_policy = ShopPolicy::where('status',1)->get();
        $shop_address = ShopAddress::where('status',1)->get();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->take(10)->get();
        $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->take(10)->get();

        $category = ShopCategory::where('slug',$slug)->first();

        $list_product = DB::table('shop_product')->join('shop_category_custom', 'shop_product.shop_category_custom_id', '=', 'shop_category_custom.id')->where('shop_category_custom.shop_category_id','=',$category->id)->where('shop_product.status','=',1)->select('shop_product.*')->orderBy('shop_product.id','desc')->get();

        if($category->type == 1){
        return view('page.category.category_product_l1',
            array(
                'shop_info'=>$shop_info,

                'shop_policy'=>$shop_policy,
                'shop_address'=>$shop_address,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,
                'cms_category'=>$cms_category,

                'list_products_l2'=> $list_products_l2,
                'list_products_l3'=> $list_products_l3,

                'category'=>$category,
                'list_product'=>$list_product,
            )
        );
        }else{
            return view('page.category.category_product_l2',
                array(
                    'shop_info'=>$shop_info,

                    'shop_policy'=>$shop_policy,
                    'shop_address'=>$shop_address,

                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,
                    'cms_category'=>$cms_category,

                    'list_products_l2'=> $list_products_l2,
                    'list_products_l3'=> $list_products_l3,

                    'category'=>$category,
                    'list_product'=>$list_product,
                )
            );
        }


    }


    public function categorycustom($slug){
        $shop_info = ShopInfo::first();

        $shop_policy = ShopPolicy::where('status',1)->get();
        $shop_address = ShopAddress::where('status',1)->get();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->take(10)->get();
        $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->take(10)->get();

        $category = ShopCategoryCustom::with('shop_category')->where('slug',$slug)->first();

        $list_product = ShopProduct::where('status',1)->where('shop_category_custom_id',$category->id)->orderBy('id','desc')->get();

        if($category->shop_category->type == 1){
            return view('page.category.category_product_l1',
                array(
                    'shop_info'=>$shop_info,

                    'shop_policy'=>$shop_policy,
                    'shop_address'=>$shop_address,

                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,
                    'cms_category'=>$cms_category,

                    'list_products_l2'=> $list_products_l2,
                    'list_products_l3'=> $list_products_l3,

                    'category'=>$category,
                    'list_product'=>$list_product,
                )
            );
        }else{
            return view('page.category.category_product_l2',
                array(
                    'shop_info'=>$shop_info,

                    'shop_policy'=>$shop_policy,
                    'shop_address'=>$shop_address,

                    'shop_categorys' => $shop_categorys,
                    'shop_category_custom' => $shop_category_custom,
                    'cms_category'=>$cms_category,

                    'list_products_l2'=> $list_products_l2,
                    'list_products_l3'=> $list_products_l3,

                    'category'=>$category,
                    'list_product'=>$list_product,
                )
            );
        }


    }



    public function list_news(){

        $shop_info = ShopInfo::first();

        $shop_policy = ShopPolicy::where('status',1)->get();
        $shop_address = ShopAddress::where('status',1)->get();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->take(10)->get();
        $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->take(10)->get();

        $cms_content = CmsContent::where('status',1)->orderBy('updated_at','desc')->paginate(10);


        return view('page.news.list_news',
            array(
                'shop_info'=>$shop_info,

                'shop_policy'=>$shop_policy,
                'shop_address'=>$shop_address,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,
                'cms_category'=>$cms_category,

                'list_products_l2'=> $list_products_l2,
                'list_products_l3'=> $list_products_l3,

                'cms_content'=>$cms_content,


            )
        );



    }

    public function category_news($slug){
        $shop_info = ShopInfo::first();

        $shop_policy = ShopPolicy::where('status',1)->get();
        $shop_address = ShopAddress::where('status',1)->get();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->take(10)->get();
        $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->take(10)->get();

        $category_news =  CmsCategory::where('uniquekey',$slug)->first();

        $cms_content = CmsContent::where('status',1)->where('category_id',$category_news->id)->orderBy('updated_at','desc')->paginate(10);


        return view('page.news.list_news',
            array(
                'shop_info'=>$shop_info,

                'shop_policy'=>$shop_policy,
                'shop_address'=>$shop_address,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,
                'cms_category'=>$cms_category,

                'list_products_l2'=> $list_products_l2,
                'list_products_l3'=> $list_products_l3,

                'category_news'=>$category_news,

                'cms_content'=>$cms_content,


            )
        );
    }


    public function news($slug){
        $shop_info = ShopInfo::first();

        $shop_policy = ShopPolicy::where('status',1)->get();
        $shop_address = ShopAddress::where('status',1)->get();

        $banner_duoiphai = ShopBanner::where('status',1)->where('typebanner',4)->orderBy('id', 'desc')->orderBy('sort','desc')->first();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->take(10)->get();
        $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->take(10)->get();

        $news = CmsContent::where('status',1)->where('slug',$slug)->first();
        $related_news =  CmsContent::where('category_id',$news->category_id)->where('status',1)->orderby(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->take(5)->get();

        return view('page.news.detail_new',
            array(
                'shop_info'=>$shop_info,

                'shop_policy'=>$shop_policy,
                'shop_address'=>$shop_address,

                'banner_duoiphai'=>$banner_duoiphai,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,
                'cms_category'=>$cms_category,

                'list_products_l2'=> $list_products_l2,
                'list_products_l3'=> $list_products_l3,

                'news'=>$news,
                'related_news'=>$related_news,



            )
        );


    }

    public function policy($slug){
        $shop_info = ShopInfo::first();

        $shop_policy = ShopPolicy::where('status',1)->get();
        $shop_address = ShopAddress::where('status',1)->get();

        $banner_duoiphai = ShopBanner::where('status',1)->where('typebanner',4)->orderBy('id', 'desc')->orderBy('sort','desc')->first();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->take(10)->get();
        $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->take(10)->get();

        $policy = ShopPolicy::where('slug',$slug)->first();

        $related_news =  CmsContent::where('status',1)->orderby(DB::raw('RAND()'))->take(10)->get();

        return view('page.policy.policy',
            array(
                'shop_info'=>$shop_info,

                'shop_policy'=>$shop_policy,
                'shop_address'=>$shop_address,

                'banner_duoiphai'=>$banner_duoiphai,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,
                'cms_category'=>$cms_category,

                'list_products_l2'=> $list_products_l2,
                'list_products_l3'=> $list_products_l3,

                'policy'=>$policy,

                'related_news'=>$related_news,

            )
        );


    }

    public function search(Request $request){

        $shop_info = ShopInfo::first();

        $shop_policy = ShopPolicy::where('status',1)->get();
        $shop_address = ShopAddress::where('status',1)->get();

        $shop_categorys = ShopCategory::where('status',1)->orderBy('id','asc')->get();
        $shop_category_custom =  ShopCategoryCustom::where('status',1)->get();
        $cms_category = CmsCategory::where('status',1)->get();

        $list_products_l2= ShopProduct::where('status',1)->where('type',2)->orderBy('id', 'desc')->take(10)->get();
        $list_products_l3= ShopProduct::where('status',1)->where('type',3)->orderBy('id', 'desc')->take(10)->get();


        $data= $request->all();
        $search = $data['search'];

        $list_product = ShopProduct::where('name','LIKE','%'.$search.'%')->orderBy('updated_at','DESC')->where('status',1)->paginate(12);

        return view('page.search.search',
            array(
                'shop_info'=>$shop_info,

                'shop_policy'=>$shop_policy,
                'shop_address'=>$shop_address,

                'shop_categorys' => $shop_categorys,
                'shop_category_custom' => $shop_category_custom,
                'cms_category'=>$cms_category,

                'list_products_l2'=> $list_products_l2,
                'list_products_l3'=> $list_products_l3,

                'list_product'=>$list_product,

                'search'=> $search,

            )
        );
    }



    public function videos(){

    }

    public function postContact(Request $request)
    {

        //Send email

            $data            = $request->all();
//            $data['content'] = str_replace("\n", "<br>", $data['content']);
            // ShopContact::insert(["name"=> $data["name"], "title"=> $data["title"], "content"=> $data["content"],"email"=> $data["email"],"phone"=> $data["phone"],
            // "created_at" => \Carbon\Carbon::now()  ]);
            // Mail::send('vendor.mail.contact', $data, function ($message) use ($data) {
            //     $message->to($this->configs['site_email'], $this->configs['site_title']);
            //     $message->replyTo($data['email'], $data['name']);
            //     $message->subject($data['title']);
            // });
            $contact = new ShopContact;
            $contact->name = $data["hoten"];
            $contact->phone = $data["sdt"];
            $contact->address = $data["diachi"];
            $contact->nameproduct = $data["tensanpham"];
            $contact->imageproduct = $data["anhsanpham"];
            $contact->numberproduct = $data["po_quantity"];
            $contact->created_at = \Carbon\Carbon::now() ;
            $contact->updated_at = \Carbon\Carbon::now() ;
            $contact->save();



        return redirect()->back()->with('message','gửi thông tin đơn hàng thành công');
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
