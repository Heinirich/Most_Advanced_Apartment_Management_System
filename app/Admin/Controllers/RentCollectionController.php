<?php

namespace App\Admin\Controllers;

use App\Models\RentCollection;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RentCollectionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Rent Collections';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RentCollection());
        $grid->model()->latest('id');
        $grid->column('id', __('Id'));
        $grid->column('room.name', __('Room '));
        $grid->column('amount_paid', __('Amount paid'))->label('info');
        $grid->column('bill_date', __('Bill date'))->sortable();
        $grid->column('bill_month', __('Bill month'));    
        $grid->column('bill_year', __('Bill year'));
        $grid->column('bill_status', __('Bill status'))->switch();
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
        $show = new Show(RentCollection::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('room_id', __('Room id'));
        $show->field('amount_paid', __('Amount paid'));
        $show->field('bill_date', __('Bill date'));
        $show->field('bill_month', __('Bill month'));
        $show->field('bill_year', __('Bill year'));
        $show->field('bill_status', __('Bill status'));
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
        $form = new Form(new RentCollection());

        $form->select('room_id', __('Room'))->options(Bam_Rooms('plucked'));
        $form->number('amount_paid', __('Amount paid'));
        $form->date('bill_date', __('Bill Paid Date'))->default(date('d-m-Y'));
        $form->select('bill_month', __('Bill month'))->options(Bam_Months())->default(date("m"));
        $form->select('bill_year', __('Bill year'))->options(Bam_Years())->default(date("Y"));
        $form->select('bill_status', __('Bill status'))->options([
            0 => 'Due',
            1 => 'Paid'
        ]);

        return $form;
    }
}
