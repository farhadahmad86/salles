<?php

namespace App\Exports;

use Facade\FlareClient\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExcelFileExport implements FromView,ShouldAutoSize
{

    use Exportable;
    public $cusData;
    public $search;
    public $type;
    public $prnt_page_dir;
    public $pge_title;
    public $cusCount_row;
    public function __construct($data = "", $srch_fltr = "", $type = "", $prnt_page_dir = "", $pge_title = "", $count_row = "" )
    {
        $this->cusData = $data;
        // $this->search = implode(",",$srch_fltr);
        $this->type = $type;
        $this->prnt_page_dir = $prnt_page_dir;
        $this->pge_title = $pge_title;
        $this->cusCount_row = $count_row;
        // die('Debugging - $this->cusData: ' . var_export(  $this->search, true));
    }

    public function view() : View
    {
        $datas = $this->cusData;
        $type = $this->type;
        $count_row = $this->cusCount_row;
        $pge_title =  $this->pge_title ;

        return view($this->prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
    }
}
