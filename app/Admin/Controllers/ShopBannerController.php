<?php

namespace App\Admin\Controllers;

use App\Models\ShopBanner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopBannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ShopBanner';

    public $typeproduct= ['1' => 'Banner trang chủ', '2' => 'Banner lớn', '3' => 'Banner nhỏ'];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopBanner());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('image', __('Image'))->image();
        $grid->column('typebanner', __('Typebanner'))->display(function ($typebanner){
            if($typebanner == 1){
                return 'Banner trang chủ';
            }else if($typebanner == 2){
                return 'Banner lớn';
            }else{
                return 'Banner nhỏ';
            }

        });
        $grid->column('sort', __('Sort'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(ShopBanner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('image', __('Image'));
        $show->field('typebanner', __('Typebanner'));
        $show->field('sort', __('Sort'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ShopBanner());

        $form->text('title', __('Title'));
        $form->image('image', __('Image'))->removable();
        $form->select('typebanner', __('Typebanner'))->options($this->typeproduct);
        $form->number('sort', __('Sort'))->default(0);

        return $form;
    }
}
