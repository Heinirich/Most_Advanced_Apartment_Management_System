<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;

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
                    $this->displayInfoBox('Complains', 'users', 'purple', '/admin/complains', count(Bam_Complains("all")),$column);  
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
            });
    }
    
    public function displayInfoBox($title,$logo,$color,$url,$data=0,$column){
        $infoBox =  new InfoBox($title,$logo,$color,$url,$data);
        return $column->append($infoBox->render());
    }
}
