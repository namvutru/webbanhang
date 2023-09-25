<?php

namespace App\Admin\Controllers;

use App\Models\ShopCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ShopCategory';

    public $typecategory= ['1' => 'Danh mục của phương tiện', '2' => 'Danh mục của phụ tùng hoặc ác quy'];
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ShopCategory());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('slug', __('Slug'));
        $grid->column('description', __('Description'));
        $grid->status('status', __('Status'))->switch();
        $grid->column('sort', __('Sort'));
        $grid->column('type', __('Type'))->display(function ($type){
            if($type == 1){
                return 'Danh mục của phương tiện';
            }else {
                return 'Danh mục của phụ tùng hoặc ác quy';
            }
        });


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
        $show = new Show(ShopCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('status', __('Status'));
        $show->field('sort', __('Sort'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ShopCategory());

        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));
        $form->textarea('description', __('Description'));
        $form->select('type',__('Type Category'))->options($this->typecategory);
        $form->switch('status', __('Status'))->default(1);
        $form->number('sort', __('Sort'))->default(null);

        return $form;
    }
}
