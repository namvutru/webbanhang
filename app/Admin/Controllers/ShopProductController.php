<?php

namespace App\Admin\Controllers;

use App\Models\ShopCategoryCustom;
use App\Models\ShopProduct;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ShopProduct';

    public $typeimage= ['1' => 'Ảnh sản phẩm theo màu', '2' => 'Ảnh mô tả sản phẩm', '3' => 'Ảnh khác'];

    public $typeproduct= ['1' => 'Xe điện', '2' => 'Ác quy', '3' => 'Phụ tùng'];

    public $hot= ['0' => 'Mặc định', '1' => 'Mới', '2' => 'Hot'];
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopProduct());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('imagemain', __('ImageMain'))->image();
        $grid->column('price', __('Price'));
        $grid->column('color', __('Color'));
        $grid->column('type', __('Type'))->display(function ($type) {
            if($type == 1) return 'Xe điện';
            else if($type ==2) return 'Ác quy';
            else return 'Phụ tùng';
    });
        $grid->column('hot', __('Hot'))->display(function ($type) {
            if($type == 0) return 'Mặc định';
            else if($type ==1) return 'Mới';
            else return 'Hot';
        });
        $grid->column('status', __('Status'))->switch();
        $grid->column('description', __('Description'))->expand(function () {
            $html = '<br><span>';
            $html.=$this->description;
            return $html . "</span><br>";

        }, 'View description');

        $grid->column('review', __('Review'))
            ->expand(function () {
            $html = '<br><span>';
            $html.=$this->review;
            return $html . "</span><br>";
        }, 'View Review');
        $grid->column('shop_category_custom_id', __('Category Custom'))->display(function ($shop_category_custom_id) {
            $shopcustomcategory = ShopCategoryCustom::find($shop_category_custom_id);
            return $shopcustomcategory->title;
        });

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
        $show = new Show(ShopProduct::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('price', __('Price'));
        $show->field('type', __('Type'));
        $show->field('description', __('Description'));
        $show->field('review', __('Review'));
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
        $form = new Form(new ShopProduct());

        $form->tab('Thông tin sản phẩm', function ($form) {

            $form->text('name', __('Name'));
            $form->text('slug', __('Slug'));
            $form->text('price', __('Price'));
            $form->text('color', __('Color'));
            $form->select('type', __('Type'))->options($this->typeproduct);
            $form->select('hot', __('Hot'))->options($this->hot);
            $form->image('imagemain',__('Image Main'))->removable();
            $form->switch('status',__('Status'))->default(1);
            $listcateCus= (new ShopCategoryCustom())->listCateCustom();
            $form->select('shop_category_custom_id','Category Custom')->options($listcateCus);
            $form->ckeditor('description', __('Description'));
            $form->ckeditor('review', __('Review'));
        }) ->tab('Hình ảnh phụ', function ($form) {
            $form->hasMany('shop_image_product', 'Hình ảnh', function (Form\NestedForm $form) {
                $form->text('title', 'Title Image');
                $form->image('image', 'Image')->uniqueName()->removable();
                $form->select('type', 'Type Image')->options($this->typeimage)->rules('required');
                $form->textarea('description', __('Description'));
            });
        });



        return $form;
    }
}
