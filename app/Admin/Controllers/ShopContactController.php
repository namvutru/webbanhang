<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopContact;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ShopContactController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Thông tin đơn hàng');
            // $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Chỉnh sửa');
            // $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Tạo mới');
            // $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(ShopContact::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('Họ và tên')->sortable();

            $grid->phone('Số điện thoại')->sortable();
            $grid->address('Địa chỉ')->sortable();

            $grid->nameproduct('Tên sản phẩm');
            $grid->imageproduct('Ảnh sản phẩm')->image();
            $grid->numberproduct('Số lượng');

            $grid->created_at('Ngày tạo')->sortable();
            $grid->disableExport();
            $grid->disableCreateButton();
            $grid->disableRowSelector();

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(ShopContact::class, function (Form $form) {

            $form->text('name', 'Tên nhà cung cấp');
            $form->image('image', 'Hình ảnh')->uniqueName()->move('brand')->removable();
            $form->switch('status', 'Trạng thái');
            $form->number('sort', 'Sắp xếp');
            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
        });
    }

    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('');
            $content->description('');
            $content->body(Admin::show(ShopContact::findOrFail($id), function (Show $show) {
                $show->id('ID');
            }));
        });
    }
}
