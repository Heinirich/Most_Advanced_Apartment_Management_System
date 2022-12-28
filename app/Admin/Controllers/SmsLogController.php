<?php

namespace App\Admin\Controllers;

use App\Models\SmsLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SmsLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Sms Logs';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SmsLog());

        $grid->column('id', __('Id'));
        $grid->column('sms', __('Sms'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'))->hide();

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
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
        $show = new Show(SmsLog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sms', __('Sms'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->panel()->tools(function ($tools) {
            $tools->disableDelete();
        });
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SmsLog());

        $form->text('sms', __('Sms'))->readonly();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });
        return $form;
    }
}
