<?php

namespace App\Admin\Controllers;

use App\Models\ShopAddress;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopAddressController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ShopAddress';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopAddress());

        $grid->column('id', __('Id'));
        $grid->column('address', __('Address'));
        $grid->status('status', __('Status'))->switch();

        $grid->column('linkmap', __('Linkmap'));
        $grid->column('phone', __('Phone'));

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
        $show = new Show(ShopAddress::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('address', __('Address'));
        $show->field('linkmap', __('Linkmap'));
        $show->field('phone', __('Phone'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ShopAddress());

        $form->text('address', __('Address'));
        $form->switch('status',__('Status'));
        $form->text('linkmap', __('Linkmap'));
        $form->text('phone', __('Phone'));

        return $form;
    }
}
