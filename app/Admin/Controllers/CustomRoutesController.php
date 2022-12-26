<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;
use App\Models\Room;

class CustomRoutesController extends Controller
{    
    /**
     * payhistoryroom
     *
     * @param  mixed $content
     * @param  mixed $request
     * @param  mixed $room_slug
     * @return void
     */
    public function payhistoryroom(Content $content,Request $request,$room_id){
        $data = Room::findOrFail($room_id);
        $description = 'Room Payment History for '.$data->name;
        return $content
            ->title($data->name)
            ->withSuccess('Payment History','All Payment History for '.$data->name)
            ->body(new Box($description, view('admin.payments.room')));
        // return ;
        
    }
}