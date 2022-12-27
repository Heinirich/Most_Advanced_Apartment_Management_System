<?php

namespace App\Admin\Controllers;

use App\Models\SmsCommunication;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\MessageBag;



class SingleSmsCommuniationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Single Sms';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SmsCommunication());
        $grid->model()->latest()->where('is_single','specific');

        $grid->column('id', __('Id'));
        //$grid->column('sms_body', __('Sms body'));
        $grid->column('sms_status', __('Sms status'))->display(function($sms_status){
            if($sms_status == 1){
                $sms_status = 'Sent';
            }else{
                $sms_status = 'Pending';
            }
            
            return $sms_status;
        })->label([
            '1'=>'success',
            '0' => 'info'
        ])->sortable();
        $grid->column('receiver_id', __('Receiver'))->display(function($receiver_id){
            return \DB::table('users')
            ->where('id', $receiver_id)
            ->pluck('name')
            ->first();
        });
        $grid->column('sender_id', __('Sender Admin'))->display(function($sender_id){
            return \DB::table('admin_users')
            ->where('id', $sender_id)
            ->pluck('username')
            ->first();
        })->label('success');
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
        $show = new Show(SmsCommunication::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sms_body', __('Sms body'));
        $show->field('sms_status', __('Sms status'));
        $show->field('sender_id', __('Sender id'));
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

        $script = <<<SCRIPT
            $('.sms_body').keyup(updateCount);
            $('#spnCharLeft').css('display', 'none');
            function updateCount() {
                
                var maxLimit = 150;
                var cs = $(this).val().length;
                console.log(cs);
                var lengthCount = this.value.length;              
                if (lengthCount > maxLimit) {
                    this.value = this.value.substring(0, maxLimit);
                    var charactersLeft = maxLimit - lengthCount + 1;  
                    $("#spnCharLeft").text('<span style="color:red;" > *Your sms limit is 150 characters</span>');                 
                }
                else {                   
                    var charactersLeft = maxLimit - lengthCount;                   
                }
                $('#spnCharLeft').css('display', 'block');
                $('#spnCharLeft').text(charactersLeft + ' Characters left');
                
            }
    SCRIPT;
    Admin::script($script);

        $sms_text = '<h4>You are about to send 1 sms to one of  your tenants</h4>';
        $form = new Form(new SmsCommunication());
        $form->html($sms_text);

        $form->select('receiver_id','Tenant')->options(
            \DB::table('users')->get()->pluck('name','id')
        );
        $form->hidden('is_single')->value(1);
        $form->textarea('sms_body', __('Sms body'));
        $form->hidden('sms_status', __('Sms status'))->value(0);
        $sms_limit = '<p id="spnCharLeft"><span style="color:red;" > *Your sms limit is 150 characters</span></p>';
        $form->html($sms_limit);
        $form->hidden('sender_id', __('Sender id'))->value(Admin::user()->id);
        $form->hidden('is_single')->value('specific');
        $form->saved(function (Form $form) {

            $success = new MessageBag([
                'title'   => 'Success',
                'message' => 'The Sms will be sent shortly. Thank you',
            ]);
           
            //return back()->with(compact('success'));
        });
        return $form;
    }
}
