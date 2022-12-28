<?php

namespace App\Admin\Controllers;

use App\Models\Room;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RoomController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Room';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Room());
        $grid->model()->latest();
        $grid->quickSearch(function ($model, $query) {
            $model->where('name', 'like',"%{$query}%")->orWhere('room_slug', 'like', "%{$query}%");
        });
        $grid->column('#', __('History'))->display(function(){
            return '<a target="_blank" href="'.route('admin.payhistoryroom',$this->id).'" class="btn btn-success fa fa-eye"></a>';
        });
        $grid->column('id', __('Id'));  
        $grid->column('name', __('Name'));
        $grid->column('tenat', __('Current Tenant'))->display(function(){
            return Bam_CurrentTenant($this->id);
        });
        $grid->column('room_slug', __('Room Identifier Number(RIN)'));
        $grid->column('price', __('Price'));
        $grid->column('image', __('Image'))->image(config('filesystem.admin.url'),50,50);
        //$grid->column('details', __('Details'));
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
        $show = new Show(Room::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('price', __('Price'));
        $show->field('image', __('Image'));
        $show->field('details', __('Details'));
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

        $form = new Form(new Room());

        $roomTable = 'rooms';
        $connection = config('admin.database.connection');
        $form->text('name', __('Name'))
            ->creationRules(['required', "unique:{$connection}.{$roomTable}"])
            ->updateRules(['required', "unique:{$connection}.{$roomTable},username,{{id}}"]);
        $form->text('room_slug', __('Slug'))->value(strtoupper(Bam_GenerateKey(5,5)))
            ->creationRules(['required', "unique:{$connection}.{$roomTable}"]);
        $form->number('price', __('Price'));
        $form->image('image', __('Image'))->default('images/default.png');
        $form->textarea('details', __('Details'));
        $form->switch('status', __('Status'))->default('1');
        
        return $form;
    }
}
