<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets\Box;

class HomeController extends Controller
{
    public function index(Content $content)
    {
    
        return $content
            ->title('Dashboard')
            ->description('Welcome to the admin Dashboard')
            ->row(function (Row $row) {
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Tenants', 'users', 'blue', '/admin/tenants', count(Bam_Tenants("all")),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Rooms', 'user', 'black', '/admin/rooms', count(Bam_Tenants("all")),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Balance', 'dollar', 'orange', '/admin/mpesa-transactions', Bam_Transactions("lastbalance"),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Past 24Hours', 'dollar', 'navy', '/admin/mpesa-transactions', Bam_Transactions("lastdaily"),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Total Complains', 'users', 'purple', '/admin/complains', count(Bam_Complains("all")),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Open Complains', 'users', 'red', '/admin/complains', count(Bam_Complains("open")),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('On Process Complains', 'users', 'yellow', '/admin/complains', count(Bam_Complains("onprocess")),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Open Complains', 'users', 'green', '/admin/complains', count(Bam_Complains("solved")),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Maintenance', 'scissors', 'green', '/admin/maintenances', 'Ksh.'.Bam_Maintenance("sum"),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Staff', 'user', 'purple', '/admin/auth/users', count(Bam_Admin('staff')),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Total Collection', 'euro', 'black', '/admin/rent-collections',"Ksh.".Bam_RentCollections('sum'),$column);  
                });
                $row->column(3, function (Column $column) {
                    $this->displayInfoBox('Last 7 days Collection', 'euro', 'navy', '/admin/rent-collections',"Ksh.".Bam_RentCollections('week'),$column);  
                });
                $row->column(12, function (Column $column) {
                    
                    $headers = ['Name','Number','Transaction Code','Amount','Time'];
                    $trans_data = array();
                    foreach(Bam_Transactions('latest') as $trans){
                        $trans_data[] = array('name'=>$trans->FirstName.' '.$trans->MiddleName,'number'=>$trans->MSISDN,'number'=>$trans->TransID,'amount'=>$trans->TransAmount,'time'=> date('d - m - Y  (h:i)',strtotime($trans->TransTime)));
                    }
                    $rows = $trans_data;
                    $table = new Table($headers, $rows);
                    $box = new Box('Latetst 10 Transactions', $table->render());
                    $box->removable();
                    $box->style('info');
                    $box->solid();
                    $column->append($box);
                });
            });
    }
    
    public function displayInfoBox($title,$logo,$color,$url,$data=0,$column){
        $infoBox =  new InfoBox($title,$logo,$color,$url,$data);
        return $column->append($infoBox->render());
    }
}
