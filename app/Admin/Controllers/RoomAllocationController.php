<?php

namespace App\Admin\Controllers;

use App\Models\RoomAllocation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class RoomAllocationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Room Allocation History';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RoomAllocation());

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('Tenant'));
        $grid->column('room.name', __('Room'));
        $grid->column('allocation_month', __('Allocation month'));
        $grid->column('allocation_date', __('Allocation date'));
        $grid->column('adminuser.name', __('Admin'));
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
        $show = new Show(RoomAllocation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('tenant_id', __('Tenant id'));
        $show->field('room_id', __('Room id'));
        $show->field('allocation_month', __('Allocation month'));
        $show->field('allocation_date', __('Allocation date'));
        $show->field('admin_id', __('Admin id'));
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
        $form = new Form(new RoomAllocation());

        $form->select('tenant_id', __('Tenant '))->options(Bam_Tenants('plucked'));
        $form->select('room_id', __('Room'))->options(Bam_Rooms('plucked'));
        $form->select('allocation_month', __('Allocation month'))->options(Bam_Months())->default(date("m"));
        $form->date('allocation_date', __('Allocation date'))->default(date('d-m-Y'));
        $form->hidden('admin_id', __('Admin id'))->value(Admin::user()->id);

        return $form;
    }
}
