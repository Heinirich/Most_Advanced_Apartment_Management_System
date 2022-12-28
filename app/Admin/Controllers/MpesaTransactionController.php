<?php

namespace App\Admin\Controllers;

use App\Models\MpesaTransaction;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MpesaTransactionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Mpesa Transactions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MpesaTransaction());
        $grid->model()->latest('id');
        $grid->quickSearch(function ($model, $query) {
            $model->where('Firstname', 'like',"%{$query}%")->orWhere('Lastname', 'like', "%{$query}%")->orWhere('TransID', 'like', "%{$query}%")->orWhere('BillRefNumber', 'like', "%{$query}%");
        });

        // $grid->column('id', __('Id'));
        // $grid->column('FirstName', __('FirstName'));
        // $grid->column('MiddleName', __('MiddleName'));
        // $grid->column('LastName', __('LastName'));
        // $grid->column('TransactionType', __('TransactionType'));
        // $grid->column('TransID', __('TransID'));
        // $grid->column('TransTime', __('TransTime'));
        // $grid->column('BusinessShortCode', __('BusinessShortCode'));
        // $grid->column('BillRefNumber', __('BillRefNumber'));
        // $grid->column('InvoiceNumber', __('InvoiceNumber'));
        // $grid->column('ThirdPartyTransID', __('ThirdPartyTransID'));
        // $grid->column('MSISDN', __('MSISDN'));
        // $grid->column('TransAmount', __('TransAmount'));
        // $grid->column('Confirmed', __('Confirmed'));
        // $grid->column('OrgAccountBalance', __('OrgAccountBalance'));
        // $grid->column('deleted_at', __('Deleted at'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->id('id')->sortable();
        $grid->FirstName('First Name')->sortable();
        $grid->MiddleName('Middle Name');
        $grid->LastName('Last Name');
        $grid->TransactionType('Type')->sortable();
        $grid->TransID('TransID')->sortable()->label();
        $grid->TransTime('Date')->display(function ($d) {
            return  date('d - m - Y  (h:i)',strtotime($d));
        });   
        $grid->BusinessShortCode('Paybill')->sortable();
        $grid->BillRefNumber('Account')->sortable();
        $grid->MSISDN('Number')->sortable();
        $grid->TransAmount('Amount')->sortable()->label();
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
        $show = new Show(MpesaTransaction::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('FirstName', __('FirstName'));
        $show->field('MiddleName', __('MiddleName'));
        $show->field('LastName', __('LastName'));
        $show->field('TransactionType', __('TransactionType'));
        $show->field('TransID', __('TransID'));
        $show->field('TransTime', __('TransTime'));
        $show->field('BusinessShortCode', __('BusinessShortCode'));
        $show->field('BillRefNumber', __('BillRefNumber'));
        $show->field('InvoiceNumber', __('InvoiceNumber'));
        $show->field('ThirdPartyTransID', __('ThirdPartyTransID'));
        $show->field('MSISDN', __('MSISDN'));
        $show->field('TransAmount', __('TransAmount'));
        $show->field('Confirmed', __('Confirmed'));
        $show->field('OrgAccountBalance', __('OrgAccountBalance'));
        $show->field('deleted_at', __('Deleted at'));
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
        $form = new Form(new MpesaTransaction());

        $form->text('FirstName', __('FirstName'));
        $form->text('MiddleName', __('MiddleName'));
        $form->text('LastName', __('LastName'));
        $form->text('TransactionType', __('TransactionType'));
        $form->text('TransID', __('TransID'));
        $form->text('TransTime', __('TransTime'));
        $form->text('BusinessShortCode', __('BusinessShortCode'));
        $form->text('BillRefNumber', __('BillRefNumber'));
        $form->text('InvoiceNumber', __('InvoiceNumber'));
        $form->text('ThirdPartyTransID', __('ThirdPartyTransID'));
        $form->text('MSISDN', __('MSISDN'));
        $form->decimal('TransAmount', __('TransAmount'));
        $form->text('Confirmed', __('Confirmed'));
        $form->decimal('OrgAccountBalance', __('OrgAccountBalance'));
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });
        return $form;
    }
}
