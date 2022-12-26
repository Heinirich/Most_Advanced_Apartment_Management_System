<?php

namespace App\Admin\Controllers;

use App\Models\SmsCommunication;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SmsCommunicationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Sms Communication';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SmsCommunication());

        $grid->column('id', __('Id'));
        $grid->column('sms_body', __('Body'));
        $grid->column('sms_status', __('Status'));
        $grid->column('is_single', __('Is single'))->hidden();
        $grid->column('receiver_id', __('Receiver'));
        $grid->created_at('Created at')->display(function ($created) {return date('Y-m-d ', strtotime($created));});
        $grid->column('updated_at', __('Updated at'))->hide();

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
        $show = new Show(SmsCommunication::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sms_body', __('Sms body'));
        $show->field('sms_status', __('Sms status'));
        $show->field('is_single', __('Is single'));
        $show->field('receiver_id', __('Receiver id'));
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
        $form = new Form(new SmsCommunication());

        $form->textarea('sms_body', __('Sms body'));
        $form->hidden('sms_status', __('Sms status'))->value(0);
        $form->text('is_single', __('Is single'));
        $form->number('receiver_id', __('Receiver id'));

        return $form;
    }
}
