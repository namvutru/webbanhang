<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('shop-categories', ShopCategoryController::class);
    $router->resource('shop-category-customs', ShopCategoryCustomController::class);

    $router->resource('cms_category', CmsCategoryController::class);
    $router->resource('cms_content', CmsContentController::class);
    $router->resource('cms_news', CmsNewsController::class);
    $router->resource('cms_page', CmsPageController::class);
    $router->resource('shop-products', ShopProductController::class);
    $router->resource('shop-image-products', ShopImageProductController::class);
    $router->resource('shop-banners', ShopBannerController::class);
    $router->resource('shop-videos', ShopVideoController::class);
    $router->resource('shop-infos', ShopInfoController::class);



});
