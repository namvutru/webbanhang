<?php

namespace App\Admin\Controllers;

use App\Models\ShopCategory;
use App\Models\ShopCategoryCustom;
use App\Models\ShopProducts;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopCategoryCustomController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ShopCategoryCustom';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopCategoryCustom());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('slug', __('Slug'));
        $grid->column('description', __('Description'));
        $grid->status('status', __('Status'))->switch();
        $grid->column('sort', __('Sort'));
        $grid->shop_category_id('Shop product')->display(function ($shop_category_id) {
            $shopcategory = ShopCategory::find($shop_category_id);
            return $shopcategory->title;
        });;

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ShopCategoryCustom::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('status', __('Status'));
        $show->field('sort', __('Sort'));
        $show->field('shop_category_id', __('Shop category id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ShopCategoryCustom());

        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));
        $form->textarea('description', __('Description'));
        $form->switch('status', __('Status'))->default(1);
        $form->number('sort', __('Sort'))->default(0);
        $shopcategory=(new ShopCategory())->listCate();
        $form->select('shop_category_id')->options($shopcategory);

        return $form;
    }
}
