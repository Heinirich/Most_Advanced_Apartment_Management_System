<?php

namespace App\Admin\Controllers;

use App\Models\Announcement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AnnouncementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Announcements';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Announcement());
        $grid->model()->latest();
        $grid->column('id', __('#'));
        $grid->column('body', __('Body'));
        $grid->column('status', __('Status'))->switch();
        $grid->created_at('Created at')->display(function ($created) {return date('Y-m-d ', strtotime($created));});
        $grid->column('updated_at', __('Updated at'))->display(function ($updated) {return date('Y-m-d ', strtotime($updated));});

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
        $show = new Show(Announcement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('body', __('Body'));
        $show->field('status', __('Status'));
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
        $form = new Form(new Announcement());

        $form->textarea('body', __('Body'))->rules('required');;
        $form->switch('status', __('Status'))->default(1);

        return $form;
    }
}
