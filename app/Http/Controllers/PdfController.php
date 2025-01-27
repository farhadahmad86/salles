<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Schedule;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PdfController extends Controller
{
    public function pdf(Request $request, $array = null, $str = null){
        $datas = Schedule::all();
//        $ar = json_decode($request->array);
//        $fromDate = (!isset($request->from) && empty($request->from)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->from;
//        $toDate = (!isset($request->to) && empty($request->to)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->to;
//        $createdBy = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->created_by;
//        $visitType = (!isset($request->visit_type) && empty($request->visit_type)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->visit_type;
//        $companies = (!isset($request->companies) && empty($request->companies)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->companies;
        $prnt_page_dir = 'print.pages.pdf_test';
        $pge_title = 'PDF Test List';
//        $srch_fltr = [];
//        array_push($srch_fltr, $companies, $createdBy, $visitType, $fromDate, $toDate);

//        $pagination_number = (empty($ar)) ? 30 : 100000000;

        if (isset($request->array) && !empty($request->array)) {

            $type = (isset($request->str)) ? $request->str : '';

            $footer = view('print._partials.pdf_footer')->render();
//            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
            $header = view('print._partials.pdf_header', compact('pge_title'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];

            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'type', 'pge_title'));
            $pdf->setOptions($options);


            if( $type === 'pdf') {
                return $pdf->stream($pge_title.'_x.pdf');
            }
            else if( $type === 'download_pdf') {
                return $pdf->download($pge_title.'_x.pdf');
            }
            else if( $type === 'download_excel') {
//                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title), $pge_title.'_x.xlsx');
                return Excel::download(new ExcelFileCusExport($datas, $type, $prnt_page_dir, $pge_title), $pge_title.'_x.xlsx');
            }

        }
        else {
//            return view('pending_cash_transfer_list', compact('datas', 'route', 'title', 'search_by_user'));
            return view('pdf.pdf', compact('datas'));
        }

    }




//    public function pending_cash_transfer_list(Request $request, $array = null, $str = null)
//    {
//        $user = Auth::user();
//        $route = "pending_cash_transfer_list";
//        $title = 'Pending Cash Transfer List';
//
//
//        $ar = json_decode($request->array);
//        $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->search;
//        $search_by_user = (isset($request->search_by_user) && !empty($request->search_by_user)) ? $request->search_by_user : '';
//        $prnt_page_dir = 'print.pending_cash_transfer_list.pending_cash_transfer_list';
//        $pge_title = 'Pending Cash Transfer List';
//        $srch_fltr = [];
//        array_push($srch_fltr, $search);
//
//        $pagination_number = (empty($ar)) ? 30 : 100000000;
//
//
//
//        $query = DB::table('financials_cash_transfer')
//            ->join('financials_users as sendBy', 'sendBy.user_id', '=', 'financials_cash_transfer.ct_send_by')
//            ->join('financials_users as receiveBy', 'receiveBy.user_id', '=', 'financials_cash_transfer.ct_receive_by');
//////                ->where('emp_role_id', config('global_variables.teller_account_id'))
/////
/////
//        if (!empty($search)) {
//            $query->where(function ($query) use ($search) {
//                $query->orWhere('ct_remarks', 'like', '%' . $search . '%')
//                    ->orWhere('ct_send_datetime', 'like', '%' . $search . '%')
//                    ->orWhere('ct_amount', 'like', '%' . $search . '%')
//                    ->orWhere('user_name', 'like', '%' . $search . '%')
//                    ->orWhere('user_designation', 'like', '%' . $search . '%')
//                    ->orWhere('user_name', 'like', '%' . $search . '%')
//                    ->orWhere('user_username', 'like', '%' . $search . '%');
//            });
//        }
//
//        if (!empty($search_by_user)) {
//            $query->where('ct_send_by', $search_by_user);
//        }
//
//
//        $datas = $query->where('ct_status', 'PENDING')
//            ->select('financials_cash_transfer.*', 'sendBy.user_name as SndByUsrName',  'sendBy.user_id as SndById',     'receiveBy.user_name as RcdByUsrName', 'receiveBy.user_id as RcdById')
////            ->where('ct_send_by', $user->user_id)
//            ->orderBy('ct_id', config('global_variables.query_sorting'))
//            ->paginate($pagination_number);
//
//
//
//        if (isset($request->array) && !empty($request->array)) {
//
//            $type = (isset($request->str)) ? $request->str : '';
//
//            $footer = view('print._partials.pdf_footer')->render();
//            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
//            $options = [
//                'footer-html' => $footer,
//                'header-html' => $header,
//            ];
//
//            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'type', 'pge_title'));
//            $pdf->setOptions($options);
//
//
//            if( $type === 'pdf') {
//                return $pdf->stream($pge_title.'_x.pdf');
//            }
//            else if( $type === 'download_pdf') {
//                return $pdf->download($pge_title.'_x.pdf');
//            }
//            else if( $type === 'download_excel') {
//                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title), $pge_title.'_x.xlsx');
//            }
//
//        }
//        else {
//            return view('pending_cash_transfer_list', compact('datas', 'route', 'title', 'search_by_user'));
//        }
//
//    }




}
