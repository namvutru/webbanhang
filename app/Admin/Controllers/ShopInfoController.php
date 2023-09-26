<?php

namespace App\Admin\Controllers;

use App\Models\ShopInfo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopInfoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ShopInfo';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopInfo());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('logo', __('Logo'))->image();
        $grid->column('description', __('Description'));
        $grid->column('slogan', __('Slogan'));
        $grid->column('slogan2', __('Slogan2'));
        $grid->column('phone', __('Phone'));
        $grid->column('linkzalo', __('Link zalo'));
        $grid->column('linkfacebook', __('Link FaceBook'));
        $grid->column('footer', __('Thông tin cuối trang'));


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
        $show = new Show(ShopInfo::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('logo', __('Logo'));
        $show->field('description', __('Description'));
        $show->field('slogan', __('Slogan'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ShopInfo());

        $form->text('name', __('Name'));
        $form->image('logo', __('Logo'));
        $form->textarea('description', __('Description'));
        $form->text('slogan', __('Slogan'));
        $form->text('slogan2', __('Slogan2'));
        $form->text('phone', __('Phone'));
        $form->text('linkzalo', __('Link zalo'));
        $form->text('linkfacebook', __('Link facebook'));
        $form->ckeditor('footer', __('Thông tin cuối trang'));


        return $form;
    }
}
