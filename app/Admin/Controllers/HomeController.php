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
                    $this->displayInfoBox('Tenants', 'users', 'green', '/admin/tenants', count(Bam_Tenants("all")),$column);  
                });
            });
    }
    
    public function displayInfoBox($title,$logo,$color,$url,$data=0,$column){
        $infoBox =  new InfoBox($title,$logo,$color,$url,$data);
        return $column->append($infoBox->render());
    }
}
