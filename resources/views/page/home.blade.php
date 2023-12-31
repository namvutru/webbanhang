@extends('namvutru')

@section('content')




    <section id="mainSlide" class="">


        <div id="myCarousel" class="carousel slide lazy">
            <div class="carousel-inner" role="listbox" aria-label="carousel">

                @foreach($banner_trangchu as $key => $ban_trachu)
                    @if($key == 0)
                        <div class="item active" style="padding: 0 !important;">
                            <a href="{{$ban_trachu->link}}" title="{{$ban_trachu->title}}">
                                <img class="img-full" width="1540" height="407"
                                     src="{{env('APP_URL') . '/documents/website/'.$ban_trachu->image}}"
                                     alt=" {{$ban_trachu->title}}" >
                                {{--                                 data-lazy-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-xe-may-50cc-khuyen-mai-gia-tot-PC-scaled.jpg">--}}
                                {{--                            <noscript><img class="img-full" width="1540" height="407"--}}
                                {{--                                           src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-xe-may-50cc-khuyen-mai-gia-tot-PC-scaled.jpg"--}}
                                {{--                                           alt=" Banner 0"></noscript>--}}
                            </a>
                        </div>

                    @else
                        <div class="item" style="padding: 0 !important;">
                            <a href="{{$ban_trachu->link}}" title="{{$ban_trachu->title}}">
                                <img class="img-full" width="1540" height="407"

                                     src="{{env('APP_URL') . '/documents/website/'.$ban_trachu->image}}"
                                     alt=" {{$ban_trachu->title}}">
                                {{--                                 data-lazy-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-xe-may-50cc-khuyen-mai-gia-tot-PC-scaled.jpg">--}}
                                {{--                            <noscript><img class="img-full" width="1540" height="407"--}}
                                {{--                                           src="https://xedienvietthanh.com/wp-content/uploads/2020/04/xe-dien-xe-may-50cc-khuyen-mai-gia-tot-PC-scaled.jpg"--}}
                                {{--                                           alt=" Banner 0"></noscript>--}}
                            </a>
                        </div>

                    @endif



                @endforeach




            </div>
            <!-- Left and right controls -->
            <a class="left mycarousel-control transition" href="#myCarousel" role="button" data-slide="prev">
                <i class="fa fa-angle-left transition" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right mycarousel-control transition" href="#myCarousel" role="button" data-slide="next">
                <i class="fa fa-angle-right transition" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    @include('page.includes.narbar')


    <div class="container">
        <ul id="result_pr_pc" class="slider-items-products">
            <li class="">
                <!-- loop product -->

                @foreach($list_products as $key => $product)
                    <div class="col-xs-12 col-lg-4 col-md-4 display-pt10 item">
                        <div class="col-item">
                            <div class="item-inner">
                                <div class="product-wrapper transition">
                                    <a href="{{route('thong-tin-san-pham',$product->slug)}}"
                                       title="{{$product->name}}">
                                        <img width="367" height="248" alt="{{$product->name}}"
                                             src="{{env('APP_URL') . '/documents/website/'.$product->imagemain}}"
                                             class="notlazy transition">
                                    </a>
                                    @if($product->hot ==0)
                                        <span class="icon ico-default ">Mặc định</span>
                                    @elseif($product->hot ==1)
                                        <span class="icon ico-moi ">Mới</span>
                                    @else
                                        <span class="icon ico-hot ">Hot</span>
                                    @endif

                                    </div>
                                <div class="item-info">
                                    <h5 class="item-title text-uppercase"><a
                                            href="{{route('thong-tin-san-pham',$product->slug)}}"
                                            title="X{{$product->name}}">{{$product->name}}</a></h5>
                                    <div class="item-price">
                                        <span class="old-price"><span class="price">{{$product->old_price}}</span></span>
                                        <span class="regular-price"><span class="price">{{$product->price}}</span></span>
                                    </div>
                                </div>
                                <div class="item-detail">
                                    <!-- case: choose gift on product -->
                                    <div class="item-offers">
                                        - Quà tặng trị giá tới 500K <br/> - Áp dụng giao hàng toàn quốc <br/>
                                    </div>

                                    <!-- case: choose gift on parent taxonomy -->

                                    <div class="item-link">
                                        <button data-name="{{$product->name}}"


                                                data-image="{{env('APP_URL') . '/documents/website/'.$product->imagemain}}"
                                                data-price="{{$product->price}}"
                                                data-imagedb="{{$product->imagemain}}"
                                                class="btn btn-success bk-btn-paynow-list" id="openModalButton" type="button"
                                                style="width: 122px; height: 25px; margin-top: -3px; font-size: 11px">MUA
                                            NGAY
                                        </button>
                                        <button data-name="{{$product->name}}"
                                                data-image="{{env('APP_URL') . '/documents/website/'.$product->imagemain}}"
                                                data-price="{{$product->price}}"
                                                class="btn bk-btn-installment-list" id="openModalButton" type="button"
                                                style="width: 122px; height: 25px; margin-top: 5px; font-size: 11px; margin-left: 0px">
                                            MUA
                                            TRẢ GÓP
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

                <!-- loop product -->


            </li>



            </li>

        </ul>
        <div class="text-center alm-btn-wrap">
            <button id="loadmore_pc" class="alm-load-more-btn more btn-show-more-2018">Tải thêm sản phẩm <i
                    class="fa fa-angle-double-down" aria-hidden="true"></i></button>
        </div>
        <div class="clearfix"></div>

    </div>



    <div class="offer-banner-section hidden-xs">
        <div class="container">
            <div class="+row">
                <div class="col-xs-12 col-lg-8 col-sm-8 no-padding banner900x600 relative">
                    <a href="{{$banner_lon->linkbanner}}" title="{{$banner_lon->title}}">
                        <img width=320 height=400 alt="banner" class="lazyload"
                             src="{{env('APP_URL') . '/documents/website/'.$banner_lon->image}}"
                             data-src="{{env('APP_URL') . '/documents/website/'.$banner_lon->image}}"
                             style="width:100%"/>
                    </a>

                    <style>

                        .wrdatcoc{ padding: 15px 5%; background: rgba(0, 0, 0, 0.4); position: absolute; bottom: 0; left: 0; width: 100%; z-index: 99 }
                        .wrdatcoc .form-datcoc input{ max-width: 400px; margin-right: 5px; }
                        .wrdatcoc .form-datcoc{  }

                    </style>

                    <div class="wrdatcoc">
                        <form method="post" class="form-datcoc d-flex justify-content-center">
                            <input class="form-control" name="dcsdt" type="text"
                                   placeholder="NHẬP SỐ ĐIỆN THOẠI (Đặt cọc chỉ cần 1 triệu đồng) " required="true">
                            <button name="btn-datcoc" type="submit" class="link-buy btn btn-success bold text-left">Đặt
                                Trước
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4 col-sm-4 no-padding sb-fb-2qc">
                    <ul class="list-unstyled">

                        @foreach($banner_nho as $key => $ban_nho)

                            <li><a href="{{$ban_nho->linkbanner}}"
                                   title="banner nho"><img width=323 height=85 alt="{{$ban_nho->title}}"
                                                           src="{{env('APP_URL') . '/documents/website/'.$ban_nho->image}}">
{{--                                                           data-lazy-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/diem-manh-xe-dien-viet-thanh-1.png"/>--}}
                                    <noscript><img width=323 height=85 alt="{{$ban_nho->title}}"
                                                   src="{{env('APP_URL') . '/documents/website/'.$ban_nho->image}}"/>
                                    </noscript>
                                </a></li>
                        @endforeach


                        <!-- <li><a href="https://xedienvietthanh.com/tin-tuc/mua-tra-gop-xe-may-dien-lai-suat-thap-den-0/" title="banner nho"><img width="100%" alt="banner nho" class="lazyload" src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif" data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/diem-manh-xe-dien-viet-thanh-1.png" /></a></li> -->

                        <!-- <li><a href="https://xedienvietthanh.com/xe-may-dien/" title="banner nho"><img width="100%" alt="banner nho" class="lazyload" src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif" data-src="https://xedienvietthanh.com/wp-content/uploads/2020/04/Xe-dien-viet-thanh-Cac-mau-xe-dien-chinh-hang.jpg" /></a></li> -->

                        <!--<li>
                           <div class="full">
                              <a target="_blank" rel="nofollow" href="https://www.facebook.com/tapdoanxedien"><img class="lazyload w100" src="https://xedienvietthanh.com/wp-content/themes/auto/blank.gif" data-src="https://xedienvietthanh.com/wp-content/themes/auto/images/bg_fb.jpg"></a>
                          </div>
                          </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="section-news">
{{--        <div class="table-news-menu container hidden-xs hidden-sm">--}}
{{--            <table class="table-news" width="100%">--}}
{{--                <tr>--}}
{{--                    <td><a href="https://xedienvietthanh.com/loi-khuyen-chuyen-gia/" title="Lời khuyên chuyên gia"--}}
{{--                           class="bold">Lời khuyên chuyên gia</a></td>--}}
{{--                    <td><a href="https://xedienvietthanh.com/loi-khuyen-chuyen-gia/thu-xe-cu-doi-xe-moi/"--}}
{{--                           title="Thu xe cũ đổi xe mới" class="bold">Thu xe cũ đổi xe mới</a></td>--}}
{{--                    <td><a href="https://xedienvietthanh.com/tu-van-mien-phi-247/" title="Tư vấn miễn phí 24/7"--}}
{{--                           class="bold">Tư vấn miễn phí 24/7</a></td>--}}
{{--                    <td><a href="https://xedienvietthanh.com/doi-xe-trong-vong-72h/" title="Đổi xe trong vòng 72H"--}}
{{--                           class="bold">Đổi xe trong vòng 72H</a></td>--}}
{{--                    <td><a href="https://xedienvietthanh.com/chinh-sach-bao-hanh/" title="Chính sách bảo hành" class="bold">Chính--}}
{{--                            sách bảo hành</a></td>--}}
{{--                </tr>--}}
{{--            </table>--}}
{{--        </div>--}}
        <div class="box_news_home">
            <div class="container">
                <div class="col-xs-12 col-lg-6 col-md-6 no-padding">
                    <div class="col-ext col-ext-left">
                        <div class="heading_box">
                            <a href="{{route('danh-sach-bai-viet')}}" title="Bài viết"><span
                                    class="title2 led">Bài viết hữu ích</span></a>
                        </div>
                        <ul class="lst_item_ext">
                            <li class="large_item tintucnoibat transition over-hidden">
                                <a href="{{route('bai-viet',$cms_content_first->slug)}}"
                                   title="{{$cms_content_first->title}}">
                                    <img src="{{env('APP_URL') . '/documents/website/'.$cms_content_first->image}}"
                                         data-src="{{env('APP_URL') . '/documents/website/'.$cms_content_first->image}}"
                                         class="lazyload lazy lazyload img-full transition wp-post-image"
                                         alt="{{$cms_content_first->title}}" loading="lazy"/>
                                    <p class="cl_white transition">{{$cms_content_first->title}}</p>
                                </a>
                            </li>
                            @foreach($cms_content as $key => $content)
                                <li>
                                    <a class="photo"
                                       href="{{route('bai-viet',$content->slug)}}"
                                       title="{{$content->title}}">
                                        <img src="{{env('APP_URL') . '/documents/website/'.$content->image}}"
                                             data-src="{{env('APP_URL') . '/documents/website/'.$content->image}}"
                                             class="lazyload lazy lazyload transition wp-post-image"
                                             alt="{{$content->title}}"
                                             loading="lazy"/> </a>
                                    <div class="r">
                                        <h4 class="title"><a
                                                href="{{route('bai-viet',$content->slug)}}"
                                                title="{{$content->title}}">
                                                {{$content->title}}</a></h4>
                                        <div class="reg_date">{{$content->updated_at}}</div>
                                    </div>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-6 col-md-6 no-padding">
                    <div class="col-ext col-ext-right">
                        <div class="heading_box"><a href="{{route('danh-sach-videos')}}" title="Video Clips"><span
                                    class="title2">Video Clips</span></a></div>
                        <ul class="lst_item_ext">

                            <li class="large_item video_top">
                                <!--  <iframe id="video_top" width="100%" data-src="https://www.youtube.com/embed/ZCQzp5hqwbE" frameborder="0" allowfullscreen></iframe> -->
                                <iframe id="video_top" width="100%" src="https://www.youtube.com/embed/{{$shop_video_top->link}}"
{{--                                        srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=https://www.youtube.com/embed/ZCQzp5hqwbE?autoplay=1><img src=https://img.youtube.com/vi/ZCQzp5hqwbE/hqdefault.jpg alt='Video Quat boss'><span>▶</span></a>"--}}
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                        title="{{$shop_video_top->title}}"
                                ></iframe>
                                <p class="title_video cl_white transition">{{$shop_video_top->title}}</p>
                            </li>
                            @foreach($shop_videos as $key => $video)
                                <li onclick="modal_video(this,'28499', 'n1Akkr1GBKM')" data-toggle="modal"
                                    data-target="#modalVideo">
                                    <img data-src="https://img.youtube.com/vi/{{$video->link}}/0.jpg"
                                         src="https://www.youtube.com/embed/{{$video->link}}"
                                         class="photo lazy lazyload" width="130" width="80" alt="lazy-photo">
                                    <div class="r">
                                        <h4 class="title">{{$video->title}}</h4>
                                        <div class="reg_date">{{$video->updated_at}}</div>
                                    </div>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                </div>

                <div id='bk-modal'></div>
            </div>
        </div>
    </section>


    <!-- main-content -->
    <style>
        .overhiden {
            overflow: hidden
        }
    </style>


    <section class="acquy_phutung_2019">

        <div class="container">
            <div class="row">
                <div class="col-xs-12 ">
                    <div class="head-title font30 text-uppercase h2"><a href="{{route('danh-muc-san-pham','ac-quy')}}">ắc quy
                            chính hãng</a>
                    </div>
                    <div class="owl-carousel overhiden" id="owl-acquy-2019">
                        <!-- loop product -->
                        @foreach($list_products_l2 as $key => $product_l2)

                            <div class="display-pt10 item-special">
                                <div class="col-item">
                                    <div class="item-inner">
                                        <div class="product-wrapper">
                                            <a href="{{route('thong-tin-san-pham',$product_l2->slug)}}" title="{{$product_l2->name}}">
                                                <img src="{{env('APP_URL').'/documents/website/'.$product_l2->imagemain}}" data-src="{{env('APP_URL').'/documents/website/'.$product_l2->imagemain}}" class="lazyload img-full transition lazy lazyload wp-post-image" alt="" loading="lazy" /></a>
                                        </div>
                                        <div class="item-info">
                                            <h5 class="item-title text-uppercase"><a href="{{route('thong-tin-san-pham',$product_l2->slug)}}" title="{{$product_l2->name}}">{{$product_l2->name}}</a></h5>
                                            <div class="item-price">
                                                <span class="old-price"><span class="price">{{$product_l2->old_price}}</span></span>
                                                <span class="regular-price"><span class="price">{{$product_l2->price}}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                        <!-- loop product -->
                        <!-- loop product -->

                        <!-- loop product -->
                    </div>
                </div>
                <div class="col-xs-12 ">
                    <div class="head-title font30 text-uppercase h2"><a
                            href="{{route('danh-muc-san-pham','phu-tung')}}">phụ tùng chính hãng</a>
                    </div>
                    <div class="owl-carousel overhiden" id="owl-phutung-2019">
                        <!-- loop product -->
                        @foreach($list_products_l3 as $key => $product_l3)
                            <div class="display-pt10 item-special">
                                <div class="col-item">
                                    <div class="item-inner">
                                        <div class="product-wrapper">
                                            <a href="{{route('thong-tin-san-pham',$product_l3->slug)}}" title="{{$product_l3->name}}">
                                                <img src="{{env('APP_URL').'/documents/website/'.$product_l3->imagemain}}" data-src="{{env('APP_URL').'/documents/website/'.$product_l3->imagemain}}" class="lazyload img-full transition lazy lazyload wp-post-image" alt="" loading="lazy" /></a>
                                        </div>
                                        <div class="item-info">
                                            <h5 class="item-title text-uppercase"><a href="{{route('thong-tin-san-pham',$product_l3->slug)}}" title="{{$product_l3->name}}">{{$product_l3->name}}</a></h5>
                                            <div class="item-price">
                                                <span class="old-price"><span class="price">{{$product_l3->old_price}}</span></span>
                                                <span class="regular-price"><span class="price">{{$product_l3->price}}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        <!-- loop product -->

                        <!-- loop product -->
                    </div>
                </div>
            </div>
        </div>

    </section>



    <div class="modal fade  font16" id="quick-buy" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="ss-form" action="{{route('dat-hang')}}" class="form-quickbuy">
                    @csrf
                    <div class="modal-header">
                        <h4 class="row text-center title_form text-uppercase" id ="dialog_name"></h4>
                    </div>
                    <div class="modal-body">
                        <table class="table bold">
                            <thead class="thead-inverse">
                            <tr>
                                <th class="hidden-xs hidden-sm">Hình ảnh</th>
                                <th class="hidden-xs hidden-sm">Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Hủy</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="hidden-xs hidden-sm">
                                    <img id="dialog_image"
                                        src=""
                                         data-src=""
                                         class="lazyload thumb-prod wp-post-image" alt=""/></td>
                                <td class="hidden-xs hidden-sm" id="qb_name"></td>
                                <td id="qb_don_gia"></td>
                                <td>
                                    <input id="qb_quantity" type="number" step="1" min="1" max="" name="po_quantity"
                                           value="1" size="4" pattern="[0-9]*" inputmode="numeric">
                                    <input id="don_gia" type="hidden" value="">
                                </td>
                                <td><span class="del" data-dismiss="modal">Hủy</span></td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="infopromotion">
                                        <ul>
                                            {{--                                        <li><i class="fa fa-gift"></i> Mũ bảo hiểm đạt chuẩn trị giá 250.000đ</li>--}}
                                            {{--                                        <li><i class="fa fa-gift"></i> Áp dụng giao hàng toàn quốc</li>--}}
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="">Tổng tiền: <span class="cl_red"><span id="tongtien"></span> VNĐ</span></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="wd100 khach-hang">
                            <h4 class="row text-center title_form bold text-uppercase">Chọn phương thức thanh toán</h4>
                            <div class="space20"></div>
                            <p>Quý khách vui lòng chọn một hình thức thanh toán trong số các hình thức bên dưới phù hợp
                                nhất.</p>

                            <table width="100%" cellpadding="0" cellspacing="0" class="conTable">
                                <tbody>
                                <tr>
                                    <td width="20">
                                        <input type="radio" id="pay_bank" name="paytype" value="3"
                                               onclick="change_paytype(3)"></td>
                                    <td valign="top">
                                        <label for="pay_bank"><strong class="payTitle">Chuyển khoản ngân hàng</strong>
                                        </label>
                                        <br>
                                        <div class="bankInfo" style="padding-top: 5px;display: none; ">
                                            {!! $shop_info->bankinfo !!}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20">
                                        <input type="radio" id="pay_cod" name="paytype" value="1"
                                               onclick="change_paytype(1)"></td>
                                    <td valign="top">
                                        <label for="pay_cod"><strong class="payTitle">Trả tiền mặt trực tiếp ngay khi nhận
                                                hàng</strong>
                                        </label>
                                        <div class="compInfo" style="margin-top: 25px; display: none;">
                                            <p>Nhân viên của chúng tôi sẽ thu tiền khi giao nhận hàng hóa.</p>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>


                            <h4 class="row text-center title_form text-uppercase">Nhập thông tin đơn hàng</h4>
                            <div class="space20"></div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Họ tên</label>
                                <div class="col-sm-10">
                                    <input type="text" name="hoten" value="" class="ss-q-short form-control"
                                           id="entry_1918389590" dir="auto" aria-label="Họ tên  " title="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact-email" class="col-sm-2 control-label">Số điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="text" name="sdt" value="" class="ss-q-short form-control"
                                           id="entry_1974945640" dir="auto" aria-label="Điện thoại  Phải là một dãy số."
                                           aria-required="true" required="" step="1"
                                           title="Nhập đúng số điện thoại của bạn">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contact-email" class="col-sm-2 control-label">Địa chỉ</label>
                                <div class="col-sm-10">
                                    <input type="text" name="diachi" value="" class="ss-q-short form-control"
                                           id="entry_638975727" dir="auto" aria-label="Địa chỉ  " title="">
                                </div>
                            </div>
                            {{--                        <div class="form-group none">--}}
                            {{--                            <label for="contact-email" class="col-sm-2 control-label">Email</label>--}}
                            {{--                            <div class="col-sm-10">--}}
                            {{--                                <input type="text" name="email" value="" class="ss-q-short form-control"--}}
                            {{--                                       id="entry_589038675" dir="auto" aria-label="Email  Phải chứa @" pattern=".*@.*"--}}
                            {{--                                       title="Ph&#7843;i ch&#7913;a @">--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            {{--                        <div class="form-group none">--}}
                            {{--                            <label for="contact-email" class="col-sm-2 control-label">Yêu cầu</label>--}}
                            {{--                            <div class="col-sm-10">--}}
                            {{--                                <textarea name="yeucau" rows="2" cols="0" class="ss-q-long form-control"--}}
                            {{--                                          id="entry_1997209857" dir="auto" aria-label="Nội dung yêu cầu  "></textarea>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            <div class="none">
                                <input type="text" name="tensanpham" value=""
                                       class="ss-q-short form-control" id="tensanpham" dir="auto"
                                       aria-label="Tên sản phẩm  " title="">
                                <input type="text" name="dongia" value="" class="ss-q-short form-control"
                                       id="entry_1558387368" dir="auto" aria-label="Đơn giá hiện tại  " title="">
                                <input type="text" name="anhsanpham" value="" class="ss-q-short form-control"
                                       id="anhsanpham" dir="auto" aria-label="Đơn giá hiện tại  " title="">
                                {{--                            <input type="text" name="soluong" value="" class="ss-q-short form-control"--}}
                                {{--                                   id="entry_1568021111" dir="auto" aria-label="Số lượng đặt mua  " title="">--}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer wd100">
                        <!-- <a class="btn btn-default" data-dismiss="modal">Close</a> -->
                        <input type="submit" class="btn btn-primary" name="submit" id="dialog_submit" value="Đặt hàng">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Bắt sự kiện click trên nút "Mở Modal", mở modal

        var buttons = document.querySelectorAll(".bk-btn-paynow-list");
        buttons.forEach(function(button) {
            button.addEventListener("click", function() {



                var productName = button.getAttribute("data-name");
                var productImage = button.getAttribute("data-image");
                var productPrice = button.getAttribute("data-price");


                var productImageDB = button.getAttribute("data-imagedb");




                document.getElementById("qb_don_gia").textContent = productPrice;
                document.getElementById("don_gia").value = productPrice;

                document.getElementById("dialog_name").textContent = productName;
                document.getElementById("qb_name").textContent = productName;
                document.getElementById("dialog_image").src = productImage;



                document.getElementById("tensanpham").value = productName;
                document.getElementById("anhsanpham").value = productImageDB;



                $('#quick-buy').modal('show');
        });
        });
    </script>

    <script>


        // Bắt sự kiện click trên nút "Mở Modal", mở modal

        var buttons = document.querySelectorAll(".bk-btn-installment-list");
        buttons.forEach(function(button) {
            button.addEventListener("click", function() {



                var productName = button.getAttribute("data-name");
                var productImage = button.getAttribute("data-image");
                var productPrice = button.getAttribute("data-price");


                var productImageDB = button.getAttribute("data-imagedb");




                document.getElementById("qb_don_gia").textContent = productPrice;
                document.getElementById("don_gia").value = productPrice;

                document.getElementById("dialog_name").textContent = productName;
                document.getElementById("qb_name").textContent = productName;
                document.getElementById("dialog_image").src = productImage;



                document.getElementById("tensanpham").value = productName;
                document.getElementById("anhsanpham").value = productImageDB;



                $('#quick-buy').modal('show');
            });
        });
    </script>

    <script type="text/javascript">
        const quantityInput = document.getElementById("qb_quantity");
        quantityInput.addEventListener("change", function() {


            qualty = $('#qb_quantity').val();



            chuoi = $('#don_gia').val();



            pattern = /\d+/g;

            matches = chuoi.match(pattern);

            soGhepLai = "";

            for (var i = 0; i < matches.length; i++) {
                soGhepLai += matches[i];
            }


            soNguyen = parseInt(soGhepLai, 10);

            price = soNguyen;

            tongtien = qualty * price ;

            $('#tongtien, #qb_thanh_tien').html(formatNumber(tongtien));
        });
    </script>

@endsection
