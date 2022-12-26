<?php

namespace App\Admin\Controllers;

use App\Models\Maintenance;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MaintenanceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Maintenance Costs';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Maintenance());
        $grid->model()->latest();
        $grid->column('id', __('Id'))->hide();
        $grid->column('maintenance_title', __('Maintenance Title'));
        $grid->column('date', __('Date'));
        $grid->column('maintenance_amount', __('Amount'));
        $grid->column('details', __('Details'))->hide();
        $grid->column('created_at', __('Created at'))->hide();
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
        $show = new Show(Maintenance::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('maintenance_title', __('Maintenance title'));
        $show->field('maintenance_amount', __('Maintenance amount'));
        $show->field('details', __('Details'));
        $show->field('date', __('Date'));
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
        $form = new Form(new Maintenance());

        $form->text('maintenance_title', __('Maintenance Title'))->required();
        $form->number('maintenance_amount', __('Amount'))->required();
        $form->textarea('details', __('Details'))->required();
        $form->date('date', __('Date'))->default(date('Y-m-d'))->required();

        return $form;
    }
}
