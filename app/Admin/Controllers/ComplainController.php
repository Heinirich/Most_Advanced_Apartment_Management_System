<?php

namespace App\Admin\Controllers;

use App\Models\Complain;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ComplainController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Complain';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Complain());
        $grid->model()->latest();

        $grid->column('id', __('Id'));
        $grid->column('room.name', __('Room'))->help('This is room name.');;
        $grid->column('user.name',__('Tenant'));
        //'user_id', __('User')
        $grid->column('body', __('Body'))->hide();
        $grid->column('solution', __('Solution'))->hide();
        $grid->column('status', __('Status'))->sortable()->using([
            0 => 'Pending',
            1 => 'On Process',
            2 => 'Closed/Completed'
        ])->label([
            0 => 'warning',
            1 => 'info',
            2 => 'success',
        ]);        
        $grid->column('adminuser.username', __('Solved by'))->setAttributes(['style' => 'color:green;text-transform:uppercase']);
        $grid->column('created_at', __('Created at'))->display(function ($d) {
            return  date('d - m - Y ',strtotime($d));
        });   
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
        $show = new Show(Complain::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('room_id', __('Room id'));
        $show->field('user_id', __('User id'));
        $show->field('body', __('Body'));
        $show->field('solution', __('Solution'));
        $show->field('status', __('Status'));
        $show->field('solved_by', __('Solved by'));
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
        $form = new Form(new Complain());

        $form->select('room_id', __('Room '))->options(Bam_Rooms('plucked'));
        $form->select('user_id', __('Tenant'))->options(Bam_Tenants('plucked'));
        $form->textarea('body', __('Body'));
        $form->textarea('solution', __('Solution'));
        $options = [
            0 => 'Pending',
            1 => 'On Process',
            2 => 'Closed/Completed',
        ];
        $form->select('status', __('Status'))->options($options);
        $form->hidden('solved_by', __('Solved by'))->value(Bam_Admin('logged'));

        return $form;
    }
}
