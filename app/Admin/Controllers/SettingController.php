<?php

namespace App\Admin\Controllers;

use App\Models\Setting;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SettingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Setting';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Setting());
        $grid->column('id', __('Id'))->hide();
        $grid->column('sms_module', __('Sms module'))->switch();
        $grid->column('bambanet_sms_api_key', __('Bambanet Api Key'))->editable()->help('Edit directly from here.');;
        $grid->column('bambanet_sms_api_secret', __('Bambanet Api Secret'))->editable()->help('Edit directly from here.');;
        $grid->column('license_key', __('License key'));
        $grid->column('currency_sign', __('Currency Sign'))->editable()->help('Edit directly from here.');
        $grid->column('created_at', __('Created at'))->hide();
        $grid->column('updated_at', __('Updated at'))->hide();

        $grid->disablePagination();
        $grid->disableCreateButton();
        $grid->disableExport();
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
        $show = new Show(Setting::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sms_module', __('Sms module'))->using([
            1 => "Enabled",
            0=> "Disabled"
        ]);
        $show->field('bambanet_sms_api_key', __('Bambanet sms api key'));
        $show->field('bambanet_sms_api_secret', __('Bambanet sms api secret'));
        $show->field('license_key', __('License key'));
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
        $form = new Form(new Setting());

        $form->switch('sms_module', __('Enable/Disable Sms module'));
        $form->text('bambanet_sms_api_key', __('Bambanet Sms Api Key'));
        $form->text('bambanet_sms_api_secret', __('Bambanet Sms Api secret'));
        $form->text('license_key', __('License key'));
        $form->text('currency_sign', __('Currency Sign'));

        $form->setWidth(10, 2);
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });
        return $form;
    }
}
