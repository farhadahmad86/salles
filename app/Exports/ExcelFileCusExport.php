<?php

namespace App\Exports;

use App\Models\BusinessProfile;
use App\Models\RegionModel;
use function foo\func;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\FromQuery;
//use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;


class ExcelFileCusExport implements FromView, ShouldAutoSize
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

    // private function getNameFromNumber($num) {
    //     $numeric = ($num - 1) % 26;
    //     $letter = chr(65 + $numeric);
    //     $num2 = intval(($num - 1) / 26);

    //     if ($num2 > 0) {
    //         return $this->getNameFromNumber($num2) . $letter;
    //     } else {
    //         return $letter;
    //     }
    // }

    // public function registerEvents(): array
    // {
    //     // TODO: Implement registerEvents() method.
    //     $styleArray = [
    //         'setTable' => [
    //             'font' => [
    //                 'bold' => true,
    //                 'size' => '12',
    //             ],
    //             'borders' => [
    //                 'allBorders' => [
    //                     'borderStyle' => Border::BORDER_THIN,
    //                     'color' => ['argb','000000']
    //                 ],
    //             ],
    //         ],
    //         'setHed1' => [
    //             'font' => [
    //                 'bold' => true,
    //                 'size' => '14',
    //             ],
    //             'alignment' => [
    //                 'horizontal' => Alignment::HORIZONTAL_LEFT,
    //             ],
    //         ],
    //         'setHed2' => [
    //             'font' => [
    //                 'bold' => true,
    //                 'size' => '14',
    //             ],
    //             'alignment' => [
    //                 'horizontal' => Alignment::HORIZONTAL_RIGHT,
    //             ],
    //         ],
    //         'setHed3' => [
    //             'font' => [
    //                 'bold' => true,
    //                 'size' => '10',
    //             ],
    //             'alignment' => [
    //                 'horizontal' => Alignment::HORIZONTAL_LEFT,
    //             ],
    //         ],
    //         'setHed4' => [
    //             'font' => [
    //                 'bold' => true,
    //                 'size' => '10',
    //             ],
    //             'alignment' => [
    //                 'horizontal' => Alignment::HORIZONTAL_RIGHT,
    //             ],
    //         ],
    //     ];
    //     $lastLetter = '';


    //     return [
    //         BeforeSheet::class => function (BeforeSheet $event) use ($styleArray) {
    //             $event->sheet->getStyle('A1:E1')->applyFromArray($styleArray['setTable']);
    //         },

    //         AfterSheet::class => function (AfterSheet $event) use ($styleArray) {
    //             //                $event->writer->getProperties()->setCreator('Patrick');
    //             $rows = $event->sheet->getDelegate()->toArray();
    //             $breakdown = false;

    //             foreach ($rows as $k => $v) {
    //                 $lastLetter = $this->getNameFromNumber(count($v));

    //                 $event->sheet->getStyle('A'.$k.':'.$lastLetter.$k)->getAlignment()->setWrapText(true);
    //                 $event->sheet->getStyle('A'.($k+1))->getAlignment()->setHorizontal('center');
    //                 $event->sheet->getStyle('A'.($k+1).':'.$lastLetter.($k+1))->getAlignment()->setVertical('center');
    //                 if($k === 0){
    //                     $event->sheet->getStyle('A1:'.$lastLetter.'1')->getAlignment()->setHorizontal('center');
    //                     $event->sheet->getStyle('A1:'.$lastLetter.'1')->applyFromArray([
    //                         'font' => [
    //                             'name' => 'Arial',
    //                             'bold' => true,
    //                             'size' => '12',
    //                             'color' => [
    //                                 'argb' => '000000'
    //                             ],
    //                             'align' => 'center'
    //                         ],
    //                     //                            'fill' => [
    //                     //                                'fillType' => Fill::FILL_SOLID,
    //                             //                                'color' => [
    //                         //                                    'argb' => 'FF37474f'
    //                         //                                ]
    //                         //                            ],
    //                         'borders' => [
    //                             'allBorders' => [
    //                                 'borderStyle' => Border::BORDER_THIN,
    //                                 'color' => ['argb','000000']
    //                             ],
    //                         ],
    //                     ]);
    //                 }
    //                 else if ($k === 1){
    //                     $event->sheet->getStyle('A2:'.$lastLetter.'2')->applyFromArray([
    //                         'font' => [
    //                             'name' => 'Arial',
    //                             'size' => 10,
    //                             'color' => [
    //                                 'argb' => '000000'
    //                             ]
    //                         ],
    //                         //                            'fill' => [
    //                         //                                'fillType' => Fill::FILL_SOLID,
    //                         //                                'color' => [
    //                         //                                    'argb' => 'FF3949ab'
    //                         //                                ]
    //                         //                            ],
    //                         'borders' => [
    //                             'allBorders' => [
    //                                 'borderStyle' => Border::BORDER_THIN,
    //                                 'color' => ['argb','000000']
    //                             ],
    //                         ],
    //                     ]);
    //                 }
    //                 else{
    //                     if(!is_numeric($v[0])){
    //                         $event->sheet->getStyle('A'.($k + 1))->applyFromArray([
    //                             'font' => [
    //                                 'name' => 'Arial',
    //                                 'size' => 10,
    //                             ]
    //                         ]);
    //                     }

    //                     if($v[0] === 'Hover and Click Breakdown'){
    //                         $breakdown = true;
    //                         $event->sheet->getStyle('A'.($k+1).':'.$lastLetter.($k+1))->applyFromArray([
    //                             //                                'fill' => [
    //                             //                                    'fillType' => Fill::FILL_SOLID,
    //                             //                                    'color' => [
    //                             //                                        'argb' => 'FF3949ab'
    //                            //                                    ]
    //                             //                                ],
    //                             'font' => [
    //                                 'color' => [
    //                                     'argb' => 'FFFFFFFF'
    //                                 ]
    //                             ],
    //                             'borders' => [
    //                                 'allBorders' => [
    //                                     'borderStyle' => Border::BORDER_THIN,
    //                                     'color' => ['argb','000000']
    //                                 ],
    //                             ],
    //                         ]);
    //                     }

    //                     if(!$breakdown){
    //                         if(!empty($v[0])){
    //                             $event->sheet->getStyle('A'.($k+1).':'.$lastLetter.($k+1))->applyFromArray([
    //                                 'font' => [
    //                                     'name' => 'Arial',
    //                                     'size' => 10,
    //                                                 ],
    //             //                                    'fill' => [
    //             //                                        'fillType' => Fill::FILL_SOLID,
    //             //                                        'color' => [
    //             //                                            'argb' => 'FFcfd8dc'
    //             //                                        ]
    //             //                                    ],
    //                                 'borders' => [
    //                                     'allBorders' => [
    //                                         'borderStyle' => Border::BORDER_THIN,
    //                                         'color' => ['argb','000000']
    //                                     ],
    //                                 ],
    //                             ]);
    //                         }
    //                     }
    //                     else{
    //                         if($v[1] === 'Component ID'){
    //                             $event->sheet->getStyle('A'.($k+1).':'.$lastLetter.($k+1))->applyFromArray([
    //             //                                    'fill' => [
    //             //                                        'fillType' => Fill::FILL_SOLID,
    //             //                                        'color' => [
    //             //                                            'argb' => 'FFcfd8dc'
    //             //                                        ]
    //             //                                    ],
    //                                 'borders' => [
    //                                     'allBorders' => [
    //                                         'borderStyle' => Border::BORDER_THIN,
    //                                         'color' => ['argb','000000']
    //                                     ],
    //                                 ],
    //                                 'font' => [
    //                                     'bold' => true
    //                                 ]
    //                             ]);
    //                         }

    //                         $event->sheet->getStyle('C'.($k+1))->applyFromArray([
    //                             'font' => [
    //                                 'bold' => true
    //                             ]
    //                         ]);
    //                     }
    //                 }
    //             }

    //             $maxWidth = 30;
    //             foreach ($event->sheet->getParent()->getAllSheets() as $sheet) {
    //                 $sheet->calculateColumnWidths();
    //                 foreach ($sheet->getColumnDimensions() as $colDim) {
    //                     if (!$colDim->getAutoSize()) {
    //                         continue;
    //                     }
    //                     $colWidth = $colDim->getWidth();
    //                     if ($colWidth > $maxWidth) {
    //                         $colDim->setAutoSize(false);
    //                         $colDim->setWidth($maxWidth);
    //                     }
    //                 }
    //             }

    //             //                $event->sheet->getStyle('A1:E1')->applyFromArray($styleArray['setTable']);
    //             $event->sheet->insertNewRowBefore(1,5);
    //             //                $event->sheet->insertNewColumnBefore('A',2);
    //             //                $company_info = Session::get('company_info');                 getting company info in variable with session
    //             $business_profile = BusinessProfile::find(1);

    //             $event->sheet->setCellValue('A1', 'Company Name: '.$business_profile->business_profile_name);
    //             $event->sheet->setCellValue('A2', 'Address: '.$business_profile->business_profile_address);
    //             $event->sheet->setCellValue('A3', "Email: ".$business_profile->business_profile_email);
    //             $event->sheet->setCellValue('A4', 'Search Filter: '.$this->search.' ');

    //             $event->sheet->setCellValue('C1', "".$this->pge_title." ");
    //             $event->sheet->setCellValue('C2', "Mob #: ".$business_profile->business_profile_mobile_no);
    //             $event->sheet->setCellValue('C3', "PTCL #: ".$business_profile->business_profile_ptcl_no);
    //             //                $event->sheet->setCellValue('C4', "WhatsApp #: ");

    //             //                $event->sheet->getRowDimension('1')->setRowHeight(50);
    //             foreach ($rows as $k => $v) {
    //                 $lastLetter = $this->getNameFromNumber(count($v));
    //                 $event->sheet->getDelegate()->mergeCells('A'.($k+1).':B'.($k+1));
    //                 $event->sheet->getDelegate()->mergeCells('C'.($k+1).':'.$lastLetter.($k+1));
    //                 $event->sheet->getColumnDimension('A')->setAutoSize(false);
    //                 $event->sheet->getColumnDimension('C')->setAutoSize(false);
    //                 $event->sheet->getStyle('A'.$k.':'.$lastLetter.$k)->getAlignment()->setWrapText(true);
    //                 $event->sheet->getStyle('A'.$k.':'.$lastLetter.$k)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    //                 if($k === 1) {
    //                     $event->sheet->getStyle('A'.$k.':B'.$k)->applyFromArray($styleArray['setHed1']);
    //                     $event->sheet->getStyle('C'.$k.':'.$lastLetter.$k)->applyFromArray($styleArray['setHed2']);
    //                 }
    //                 $event->sheet->getStyle('A'.($k+1).':B'.($k+1))->applyFromArray($styleArray['setHed3']);
    //                 $event->sheet->getStyle('C'.($k+1).':'.$lastLetter.($k+1))->applyFromArray($styleArray['setHed4']);
    //                 if($k === 4) break;
    //             }
    //             $event->sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
    //             $event->sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);

    //             $event->sheet->getHeaderFooter()
    //                 ->setOddHeader('&C&HPlease treat this document as confidential!');
    //             $event->sheet->getHeaderFooter()
    //                 ->setOddFooter('&L&B 2019 XIMI VOUGE | All rights reserved.'.'&CPage &P of &N'.'&RDesigned & Developed by softagics.com');
    //             //                $event->sheet->getParent()->getProperties()->getTitle()

    //         },
    //     ];
    // }

    public function view(): View
    {
        // Log::info('View method called with data: ' . json_encode($this->cusData));
        $datas = $this->cusData;
        $type = $this->type;
        $count_row = $this->cusCount_row;
        $pge_title =  $this->pge_title ;
        // die('Debugging - $this->cusData: ' . var_export( $pge_title, true));
        return view($this->prnt_page_dir, compact('datas', 'type', 'count_row'));
    }

    // public function headings(): array
    // {
    //     return ['Column 1', 'Column 2', 'Column 3'];
    // }

}
