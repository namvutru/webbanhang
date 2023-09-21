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
        $grid->column('price', __('Price'));
        $grid->column('type', __('Type'));
        $grid->column('description', __('Description'));
        $grid->column('review', __('Review'));
        $grid->column('shop_category_custom_id', __('Danh mục'))->display(function ($shop_category_custom_id) {
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

        $form->text('name', __('Name'));
        $form->text('price', __('Price'));
        $form->number('type', __('Type'))->default(1);
        $form->hasMany('shop_image_product', 'Hình ảnh', function (Form\NestedForm $form) {
            $form->text('shop_image_product.title', 'Tiêu đề ảnh');
            $form->image('image', 'Hình ảnh')->uniqueName()->removable();
            $form->select('type', 'Loại')->options($this->typeimage)->rules('required');
        });
        $listcateCus= (new ShopCategoryCustom())->listCateCustom();
        $form->select('shop_category_custom_id','Danh mục sản phẩm con')->options($listcateCus);
        $form->ckeditor('description', __('Description'));
        $form->ckeditor('review', __('Review'));

        return $form;
    }
}
