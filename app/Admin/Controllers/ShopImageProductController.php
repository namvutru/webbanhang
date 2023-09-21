<?php

namespace App\Admin\Controllers;

use App\Models\ShopImageProduct;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopImageProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ShopImageProduct';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopImageProduct());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('status', __('Status'));
        $grid->column('type', __('Type'));
        $grid->column('image', __('Image'));
        $grid->column('shop_product_id', __('Shop product id'));

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
        $show = new Show(ShopImageProduct::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('status', __('Status'));
        $show->field('type', __('Type'));
        $show->field('image', __('Image'));
        $show->field('shop_product_id', __('Shop product id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ShopImageProduct());

        $form->text('title', __('Title'));
        $form->text('description', __('Description'));
        $form->number('status', __('Status'))->default(1);
        $form->number('type', __('Type'))->default(1);
        $form->image('image', __('Image'));
        $form->number('shop_product_id', __('Shop product id'));

        return $form;
    }
}
