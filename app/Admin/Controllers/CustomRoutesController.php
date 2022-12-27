<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;
use App\Models\Room;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Widgets\Table;

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
            ->withSuccess('History','All Payment and Rent Collection History for '.$data->name)
            ->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $headers = ['Amount Paid', 'Bill Date', 'Bill Month', 'Bill Year','Bill Status'];
                    $room_id =  Bam_CurrentRoute('parameters')['room_id'];
                    $data = Bam_RentCollections('byroom',$room_id);
                    $response = array();
                    foreach ($data as $datum) {
                        $response[] = array("Ksh.".$datum->amount_paid,$datum->bill_date,$datum->bill_month,$datum->bill_year,$datum->bill_status==0?'Due':'Paid');
                    }
                    $rows = $response;

                    $table = new Table($headers, $rows);

                    $tab = new Tab();
                    $tab->add('Payment History', view('admin.payments.room'));
                    $tab->add('Collection History', $table->render());
                    $column->append($tab->render());
                });
            })
            ->body(new Box($description, view('admin.payments.room')));
        // return ;
        
    }
}