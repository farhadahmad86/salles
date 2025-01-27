<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Remarks;
use App\Models\Schedule;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RemarksController extends Controller
{
    public function sch_remarks(Request $request)
    {
        $auth = Auth::user();
        $add_remarks = new Remarks();
        $add_remarks->remarks_user_id = Auth::user()->id;
        $add_remarks->remarks_schedule_id = $request->input('remarks_row_id');
        $add_remarks->remarks_for_id = $request->input('remarks_for_id');
        $add_remarks->remarks_company_id = $auth->users_company_id;
        $add_remarks->remarks_date = $request->input('remarks_date');
        $add_remarks->remarks_detail = $request->input('remarks_detail');
        $add_remarks->remarks_created_at = Carbon::now('Asia/Karachi');
        $add_remarks->remarks_updated_at = Carbon::now('Asia/Karachi');
        $add_remarks->ip_address = $this->get_ip();
        $add_remarks->os_name = $this->get_os();
        $add_remarks->browser = $this->get_browsers();
        $add_remarks->device = $this->get_device();
        $add_remarks->save();
        return redirect('/schedule_show')->with('success', 'Remarks Added');
    }
    public function scheduleRemarks(Request $request, $array = null, $str = null)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->get()
            ->pluck('id');
        $query = DB::table('remarks')->where('remarks_company_id', $auth->users_company_id);
        $query->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id');
        $query->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id');
        $query->join('schedule', 'schedule.id', '=', 'remarks.remarks_schedule_id');
        $query->join('company', 'company.id', '=', 'schedule.company_id');
        $query->join('visit_type', 'visit_type_id', '=', 'schedule.type_of_visit');
        $query->select('users_user_id.name as user_id_name', 'users_remarks_for.name as remarks_for', 'remarks.remarks_detail', 'remarks.remarks_date', 'remarks.remarks_created_at', 'schedule.sch_remarks', 'company.id', 'company.company_name', 'visit_type.visit_type_id', 'visit_type.visit_type_name', 'users_remarks_for.id as users_remarks_for_id', 'users_remarks_for.name as users_remarks_for_name');
        //        $query->where('reminder.reminder_for_id', '=', Auth::user()->id);
        $ar = json_decode($request->array);
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $visit_type = !isset($request->visit_type) && empty($request->visit_type) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->visit_type;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('remarks.remarks_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('remarks.remarks_created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('company.id', '=', $companies);
        }
        if (!empty($visit_type)) {
            $query->where('visit_type.visit_type_id', '=', $visit_type);
        }
        if (!empty($created_by)) {
            $query->where('remarks.remarks_user_id', '=', $created_by);
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('company_name', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_date', 'like', '%' . $search . '%');
        //         $query->orWhere('visit_type_name', 'like', '%' . $search . '%');
        //         $query->orWhere('users_remarks_for.name', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_detail', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_created_at', 'like', '%' . $search . '%');
        //     });
        // }else{
        $query->whereIn(
            'remarks.remarks_user_id',
            DB::table('users')
                ->where('role', '=', 'Tele Caller')
                ->orWhere('id', '=', Auth::user()->id)
                ->pluck('id'),
        );
        // }
        $query->orderByDesc('remarks_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $tele_caller = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', 'Tele Caller')
            ->pluck('id');
        $sch_remarks = DB::table('remarks')
            ->where('remarks_company_id', $auth->users_company_id)
            ->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id')
            ->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id')
            ->join('schedule', 'schedule.id', '=', 'remarks.remarks_schedule_id')
            ->join('company', 'company.id', '=', 'schedule.company_id')
            ->join('visit_type', 'visit_type_id', '=', 'schedule.type_of_visit')
            ->select('users_user_id.name as user_id_name', 'users_remarks_for.name as remarks_for', 'remarks.remarks_detail', 'remarks.remarks_date', 'remarks.remarks_created_at', 'schedule.sch_remarks', 'company.id', 'company.company_name', 'visit_type.visit_type_id', 'visit_type.visit_type_name')
            ->whereIn('remarks.remarks_user_id', $tele_caller)
            ->get();
        $all_created_by = DB::table('remarks')
            ->where('remarks_company_id', $auth->users_company_id)
            ->join('users', 'id', '=', 'remarks.remarks_user_id')
            ->select('users.id', 'users.name')
            ->where('users.role', '=', 'Tele Caller')
            ->orWhere('remarks.remarks_for_id', Auth::user()->id)
            ->groupBy('remarks.remarks_user_id')
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_schedule_remarks';
        $pge_title = 'Schedule Remarks List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $visit_type, $from_date, $to_date);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = isset($request->str) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = PDF::loadView($prnt_page_dir, compact('datas', 'count_row', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('scheduleRemarks.scheduleRemarks', compact('datas', 'count_row', 'pge_title', 'type', 'created_by', 'from_date', 'to_date', 'sch_remarks', 'all_created_by', 'companies', 'visit_type'));
        }
    }
    //    public function remarks_schedule_advance_search (Request $request, $array = null, $str = null){
    //        $user = Auth::user()->id;
    //        $table_row = '';
    //        $query = DB::table('remarks');
    //        $query->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id');
    //        $query->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id');
    //        $query->join('schedule', 'schedule.id', '=', 'remarks.remarks_schedule_id');
    //        $query->join('company', 'company.id', '=', 'schedule.company_id');
    //        $query->join('visit_type', 'visit_type_id', '=', 'schedule.type_of_visit');
    //        $query->select('users_user_id.name as user_id_name', 'users_remarks_for.name as remarks_for', 'remarks.remarks_detail',
    //                'remarks.remarks_date', 'remarks.remarks_created_at', 'schedule.sch_remarks', 'company.id', 'company.company_name',
    //            'visit_type.visit_type_id', 'visit_type.visit_type_name', 'users_reminder_for.id as users_reminder_for_id',
    //            'users_reminder_for.name as users_reminder_for_name');
    ////        $query->where('reminder.reminder_for_id', '=', Auth::user()->id);
    //
    //        $ar = json_decode($request->array);
    //        $companies = (!isset($request->companies) && empty($request->companies)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->companies;
    //        $created_by = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->created_by;
    //        $visit_type = (!isset($request->visit_type) && empty($request->visit_type)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->visit_type;
    //        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->from_date;
    //        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->to_date;
    //
    //        if (!empty($from_date)){
    //            $query->whereDate('remarks.remarks_created_at', '>=', date($from_date));
    //        }
    //        if (!empty($to_date)){
    //            $query->whereDate('remarks.remarks_created_at', '<=', date($to_date));
    //        }
    //        if (!empty($companies)){
    //            $query->where('company.id', '=', $companies);
    //        }
    //        if (!empty($visit_type)){
    //            $query->where('visit_type.visit_type_id', '=', $visit_type);
    //        }
    //        if (!empty($created_by)){
    //            $query->where('remarks.remarks_user_id', '=', $created_by);
    //        }else{
    //            $query->whereIn('remarks.remarks_user_id', DB::table('users')
    //                ->where('role', '=', 'Tele Caller')
    //                ->orWhere('id', '=', Auth::user()->id)->pluck('id')
    //            );
    //        }
    //        $datas = $query->get();
    //        $count_row = count($datas);
    //        if ($count_row >  0){
    //            foreach ($datas as $key => $schedule){
    //                $table_row .= '<tr><td>'.($key+1).'</td><td>'.$schedule->remarks_created_at.'</td><td>'.date('d-M-Y', strtotime($schedule->remarks_date)).'</td>
    //                                <td>'.$schedule->company_name.'</td><td>'.$schedule->visit_type_name.'</td><td>'.$schedule->remarks_detail.'</td><td>'.$schedule->user_id_name.'</td>
    //                                </tr>';
    //            }
    //        }
    ////            PRINT
    //        $prnt_page_dir = 'print.pages.p_schedule_remarks';
    //        $pge_title = 'Schedule Remarks List';
    //        $srch_fltr = [];
    //        array_push($srch_fltr, $companies, $created_by, $visit_type, $from_date, $to_date);
    //
    //        if (isset($request->array) && !empty($request->array)) {
    //            $type = (isset($request->str)) ? $request->str : '';
    //            $footer = view('print._partials.pdf_footer')->render();
    //            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
    //            $options = [
    //                'footer-html' => $footer,
    //                'header-html' => $header,
    //            ];
    //            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'type', 'pge_title'));
    //            $pdf->setOptions($options);
    //            if( $type === 'pdf') {
    //                return $pdf->stream($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_pdf') {
    //                return $pdf->download($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_excel') {
    //                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title), $pge_title.'_x.xlsx');
    //            }
    //        }
    //        else {
    //            return response(compact('count_row', 'table_row'));
    //        }
    //    }
    public function funnel_remarks(Request $request)
    {
        $auth = Auth::user();
        $add_remarks = new Remarks();
        $add_remarks->remarks_user_id = Auth::user()->id;
        $add_remarks->remarks_funnel_id = $request->input('remarks_row_id');
        $add_remarks->remarks_for_id = $request->input('remarks_for_id');
        $add_remarks->remarks_date = $request->input('remarks_date');
        $add_remarks->remarks_detail = $request->input('remarks_detail');
        $add_remarks->remarks_company_id = $auth->users_company_id;
        $add_remarks->remarks_created_at = Carbon::now('Asia/Karachi');
        $add_remarks->remarks_updated_at = Carbon::now('Asia/Karachi');
        $add_remarks->ip_address = $this->get_ip();
        $add_remarks->os_name = $this->get_os();
        $add_remarks->browser = $this->get_browsers();
        $add_remarks->device = $this->get_device();
        $add_remarks->save();
        return redirect('/funnel')->with('success', 'Remarks Added');
    }
    public function funnelRemarks(Request $request, $array = null, $str = null)
    {
        $auth = Auth::user();
        $query = DB::table('remarks')->where('remarks_company_id', $auth->users_company_id);
        $query->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id');
        $query->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id');
        $query->join('funnel', 'funnel.id', '=', 'remarks.remarks_funnel_id');
        $query->join('company', 'company.id', '=', 'funnel.company_id');
        $query->join('status', 'sta_id', '=', 'funnel.status_id');
        $query->select('users_user_id.name as user_id_name', 'remarks.remarks_detail', 'users_remarks_for.name as remarks_for', 'remarks.remarks_date', 'remarks.remarks_created_at', 'funnel.mrc', 'funnel.otc', 'company.id', 'company.company_name', 'status.sta_id', 'status.sta_status', 'users_remarks_for.id as users_remarks_for_id', 'users_remarks_for.name as users_remarks_for_name');
        //        $query->where('remarks.remarks_for_id', '=', Auth::user()->id);
        $ar = json_decode($request->array);
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $status = !isset($request->status) && empty($request->status) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->status;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('remarks.remarks_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('remarks.remarks_created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('company.id', '=', $companies);
        }
        if (!empty($status)) {
            $query->where('status.sta_id', '=', $status);
        }
        if (!empty($created_by)) {
            $query->where('remarks.remarks_user_id', '=', $created_by);
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('company_name', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_date', 'like', '%' . $search . '%');
        //         $query->orWhere('status.sta_status', 'like', '%' . $search . '%');
        //         $query->orWhere('users_remarks_for.name', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_detail', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_created_at', 'like', '%' . $search . '%');
        //     });
        // }else{
        $query->whereIn(
            'remarks.remarks_user_id',
            DB::table('users')
                ->where('role', '=', 'Tele Caller')
                ->orWhere('id', '=', Auth::user()->id)
                ->pluck('id'),
        );
        // }
        $query->orderByDesc('remarks_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $tele_caller = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', 'Tele Caller')
            ->pluck('id');
        $funnel_remarks = DB::table('remarks')
            ->where('remarks_company_id', $auth->users_company_id)
            ->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id')
            ->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id')
            ->join('funnel', 'funnel.id', '=', 'remarks.remarks_funnel_id')
            ->join('company', 'company.id', '=', 'funnel.company_id')
            ->join('status', 'sta_id', '=', 'funnel.status_id')
            ->select('users_user_id.name as user_id_name', 'remarks.remarks_detail', 'users_remarks_for.name as remarks_for', 'remarks.remarks_date', 'remarks.remarks_created_at', 'funnel.mrc', 'funnel.otc', 'company.id', 'company.company_name', 'status.sta_id', 'status.sta_status')
            ->whereIn('remarks.remarks_user_id', $tele_caller)
            ->get();
        $all_created_by = DB::table('remarks')
            ->where('remarks_company_id', $auth->users_company_id)
            ->join('users', 'id', '=', 'remarks.remarks_user_id')
            ->select('users.id', 'users.name')
            ->where('remarks_company_id', $auth->users_company_id)
            ->where('users.role', '=', 'Tele Caller')
            ->orWhere('remarks.remarks_for_id', Auth::user()->id)
            ->groupBy('remarks.remarks_user_id')
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_funnel_remarks';
        $pge_title = 'Funnel Remarks List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $status, $from_date, $to_date);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = isset($request->str) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = PDF::loadView($prnt_page_dir, compact('datas', 'count_row', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('funnelRemarks.funnelRemarks', compact('datas', 'count_row', 'pge_title', 'type', 'created_by', 'from_date', 'to_date', 'funnel_remarks', 'all_created_by', 'companies', 'status'));
        }
    }
    //    public function remarks_funnel_advance_search (Request $request, $array = null, $str = null){
    //        $user = Auth::user()->id;
    //        $table_row = '';
    //        $query = DB::table('remarks');
    //        $query->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id');
    //        $query->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id');
    //        $query->join('funnel', 'funnel.id', '=', 'remarks.remarks_funnel_id');
    //        $query->join('company', 'company.id', '=', 'funnel.company_id');
    //        $query->join('status', 'sta_id', '=', 'funnel.status_id');
    //        $query->select('users_user_id.name as user_id_name', 'remarks.remarks_detail', 'users_remarks_for.name as remarks_for',
    //                'remarks.remarks_date', 'remarks.remarks_created_at', 'funnel.mrc', 'funnel.otc', 'company.id', 'company.company_name',
    //            'status.sta_id', 'status.sta_status', 'users_remarks_for.id as users_remarks_for_id',
    //            'users_remarks_for.name as users_remarks_for_name');
    ////        $query->where('remarks.remarks_for_id', '=', Auth::user()->id);
    //
    //        $ar = json_decode($request->array);
    //        $companies = (!isset($request->companies) && empty($request->companies)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->companies;
    //        $created_by = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->created_by;
    //        $status = (!isset($request->status) && empty($request->status)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->status;
    //        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->from_date;
    //        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->to_date;
    //
    //        if (!empty($from_date)){
    //            $query->whereDate('remarks.remarks_created_at', '>=', date($from_date));
    //        }
    //        if (!empty($to_date)){
    //            $query->whereDate('remarks.remarks_created_at', '<=', date($to_date));
    //        }
    //        if (!empty($companies)){
    //            $query->where('company.id', '=', $companies);
    //        }
    //        if (!empty($status)){
    //            $query->where('visit_type.visit_type_id', '=', $status);
    //        }
    //        if (!empty($created_by)){
    //            $query->where('remarks.remarks_user_id', '=', $created_by);
    //        }else{
    //            $query->whereIn('remarks.remarks_user_id', DB::table('users')
    //                ->where('role', '=', 'Tele Caller')
    //                ->orWhere('id', '=', Auth::user()->id)->pluck('id')
    //            );
    //        }
    ////        if (Auth::user()->role == 'Supervisor'){
    ////            $userID = DB::table('users')->where('supervisor', $user)->orWhere('id',$user)->get()->pluck('id');
    ////            $query->whereIn('schedule.user_id', $userID);
    ////        }elseif (Auth::user()->role == 'Sale Person'){
    ////            $query->where('schedule.user_id', '=', $user);
    ////        }
    //        $datas = $query->get();
    //        $count_row = count($datas);
    //        if ($count_row >  0){
    //            foreach ($datas as $key => $schedule){
    //                $table_row .= '<tr><td>'.($key+1).'</td><td>'.$schedule->remarks_created_at.'</td><td>'.date('d-M-Y', strtotime($schedule->remarks_date)).'</td>
    //                                <td>'.$schedule->company_name.'</td><td>'.$schedule->remarks_detail.'</td><td>'.$schedule->otc.'</td><td>'.$schedule->mrc.'</td>
    //                                <td>'.$schedule->sta_status.'</td><td>'.$schedule->remarks_for.'</td><td>'.$schedule->user_id_name.'</td>
    //                                </tr>';
    //            }
    //        }
    //        //            PRINT
    //        $prnt_page_dir = 'print.pages.p_funnel_remarks';
    //        $pge_title = 'Funnel Remarks List';
    //        $srch_fltr = [];
    //        array_push($srch_fltr, $companies, $created_by, $status, $from_date, $to_date);
    //
    //        if (isset($request->array) && !empty($request->array)) {
    //            $type = (isset($request->str)) ? $request->str : '';
    //            $footer = view('print._partials.pdf_footer')->render();
    //            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
    //            $options = [
    //                'footer-html' => $footer,
    //                'header-html' => $header,
    //            ];
    //            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'type', 'pge_title'));
    //            $pdf->setOptions($options);
    //            if( $type === 'pdf') {
    //                return $pdf->stream($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_pdf') {
    //                return $pdf->download($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_excel') {
    //                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title), $pge_title.'_x.xlsx');
    //            }
    //        }
    //        else {
    //            return response(compact('count_row', 'table_row'));
    //        }
    //    }
    public function purposal_remarks(Request $request)
    {
        $auth = Auth::user();
        $add_remarks = new Remarks();
        $add_remarks->remarks_user_id = Auth::user()->id;
        $add_remarks->remarks_purposal_id = $request->input('remarks_row_id');
        $add_remarks->remarks_for_id = $request->input('remarks_for_id');
        $add_remarks->remarks_company_id = $auth->users_company_id;
        $add_remarks->remarks_date = $request->input('remarks_date');
        $add_remarks->remarks_detail = $request->input('remarks_detail');
        $add_remarks->remarks_created_at = Carbon::now('Asia/Karachi');
        $add_remarks->remarks_updated_at = Carbon::now('Asia/Karachi');
        $add_remarks->ip_address = $this->get_ip();
        $add_remarks->os_name = $this->get_os();
        $add_remarks->browser = $this->get_browsers();
        $add_remarks->device = $this->get_device();
        $add_remarks->save();
        return redirect('/quotations')->with('success', 'Remarks Added');
    }
    public function purposalRemarks(Request $request, $array = null, $str = null)
    {
        $auth = Auth::user();
        $query = DB::table('remarks')->where('remarks_company_id', $auth->users_company_id);
        $query->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id');
        $query->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id');
        $query->join('invoice', 'invoice.id', '=', 'remarks.remarks_purposal_id');
        $query->join('company', 'company.id', '=', 'invoice.company_id');
        $query->select('users_user_id.name as user_id_name', 'remarks.remarks_detail', 'remarks.remarks_date', 'remarks.remarks_created_at', 'invoice.grand_total', 'users_remarks_for.name as remarks_for', 'company.id', 'company.company_name', 'users_remarks_for.id as users_remarks_for_id', 'users_remarks_for.name as users_remarks_for_name');
        //        $query->where('remarks.remarks_for_id', '=', Auth::user()->id);
        $ar = json_decode($request->array);
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('remarks.remarks_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('remarks.remarks_created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('company.id', '=', $companies);
        }
        if (!empty($created_by)) {
            $query->where('remarks.remarks_user_id', '=', $created_by);
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('company_name', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_date', 'like', '%' . $search . '%');
        //         $query->orWhere('users_remarks_for.name', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_detail', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_created_at', 'like', '%' . $search . '%');
        //     });
        // }else{
        $query->whereIn(
            'remarks.remarks_user_id',
            DB::table('users')
                ->where('role', '=', 'Tele Caller')
                ->orWhere('id', '=', Auth::user()->id)
                ->pluck('id'),
        );
        // }
        $query->orderByDesc('remarks_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $tele_caller = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', 'Tele Caller')
            ->pluck('id');
        $purposal_remarks = DB::table('remarks')
            ->where('remarks_company_id', $auth->users_company_id)
            ->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id')
            ->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id')
            ->join('invoice', 'invoice.id', '=', 'remarks.remarks_purposal_id')
            ->join('company', 'company.id', '=', 'invoice.company_id')
            ->select('users_user_id.name as user_id_name', 'remarks.remarks_detail', 'remarks.remarks_date', 'remarks.remarks_created_at', 'invoice.grand_total', 'users_remarks_for.name as remarks_for', 'company.id', 'company.company_name')
            ->whereIn('remarks.remarks_user_id', $tele_caller)
            ->get();
        $all_created_by = DB::table('remarks')
            ->where('remarks_company_id', $auth->users_company_id)
            ->join('users', 'id', '=', 'remarks.remarks_user_id')
            ->select('users.id', 'users.name')
            ->where('users.role', '=', 'Tele Caller')
            ->orWhere('remarks.remarks_for_id', Auth::user()->id)
            ->groupBy('remarks.remarks_user_id')
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_invoice_remarks';
        $pge_title = 'Invoice Remarks List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = isset($request->str) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = PDF::loadView($prnt_page_dir, compact('datas', 'count_row', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('purposalRemarks.purposalRemarks', compact('datas', 'count_row', 'pge_title', 'type', 'created_by', 'from_date', 'to_date', 'purposal_remarks', 'all_created_by', 'companies'));
        }
    }
    //    public function remarks_quotation_advance_search (Request $request, $array = null, $str = null){
    //        $user = Auth::user()->id;
    //        $table_row = '';
    //        $query = DB::table('remarks');
    //        $query->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id');
    //        $query->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id');
    //        $query->join('invoice', 'invoice.id', '=', 'remarks.remarks_purposal_id');
    //        $query->join('company', 'company.id', '=', 'invoice.company_id');
    //        $query->select('users_user_id.name as user_id_name', 'remarks.remarks_detail', 'remarks.remarks_date', 'remarks.remarks_created_at',
    //            'invoice.grand_total','users_remarks_for.name as remarks_for', 'company.id', 'company.company_name', 'users_remarks_for.id as users_remarks_for_id',
    //            'users_remarks_for.name as users_remarks_for_name');
    ////        $query->where('remarks.remarks_for_id', '=', Auth::user()->id);
    //
    //        $ar = json_decode($request->array);
    //        $companies = (!isset($request->companies) && empty($request->companies)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->companies;
    //        $created_by = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->created_by;
    //        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->from_date;
    //        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->to_date;
    //
    //        if (!empty($from_date)){
    //            $query->whereDate('remarks.remarks_created_at', '>=', date($from_date));
    //        }
    //        if (!empty($to_date)){
    //            $query->whereDate('remarks.remarks_created_at', '<=', date($to_date));
    //        }
    //        if (!empty($companies)){
    //            $query->where('company.id', '=', $companies);
    //        }
    //        if (!empty($created_by)){
    //            $query->where('remarks.remarks_user_id', '=', $created_by);
    //        }else{
    //            $query->whereIn('remarks.remarks_user_id', DB::table('users')
    //                ->where('role', '=', 'Tele Caller')
    //                ->orWhere('id', '=', Auth::user()->id)->pluck('id')
    //            );
    //        }
    ////        if (Auth::user()->role == 'Supervisor'){
    ////            $userID = DB::table('users')->where('supervisor', $user)->orWhere('id',$user)->get()->pluck('id');
    ////            $query->whereIn('schedule.user_id', $userID);
    ////        }elseif (Auth::user()->role == 'Sale Person'){
    ////            $query->where('schedule.user_id', '=', $user);
    ////        }
    //        $datas = $query->get();
    //        $count_row = count($datas);
    //        if ($count_row >  0){
    //            foreach ($datas as $key => $schedule){
    //                $table_row .= '<tr><td>'.($key+1).'</td><td>'.$schedule->remarks_created_at.'</td><td>'.date('d-M-Y', strtotime($schedule->remarks_date)).'</td>
    //                                <td>'.$schedule->company_name.'</td><td>'.$schedule->remarks_detail.'</td><td>'.$schedule->grand_total.'</td>
    //                                <td>'.$schedule->remarks_for.'</td><td>'.$schedule->user_id_name.'</td>
    //                                </tr>';
    //            }
    //        }
    //        //            PRINT
    //        $prnt_page_dir = 'print.pages.p_invoice_remarks';
    //        $pge_title = 'Invoice Remarks List';
    //        $srch_fltr = [];
    //        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date);
    //
    //
    //        if (isset($request->array) && !empty($request->array)) {
    //            $type = (isset($request->str)) ? $request->str : '';
    //            $footer = view('print._partials.pdf_footer')->render();
    //            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
    //            $options = [
    //                'footer-html' => $footer,
    //                'header-html' => $header,
    //            ];
    //            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'type', 'pge_title'));
    //            $pdf->setOptions($options);
    //            if( $type === 'pdf') {
    //                return $pdf->stream($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_pdf') {
    //                return $pdf->download($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_excel') {
    //                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title), $pge_title.'_x.xlsx');
    //            }
    //        }
    //        else {
    //            return response(compact('count_row', 'table_row'));
    //        }
    //    }
    public function order_remarks(Request $request)
    {
        $auth = Auth::user();
        $add_remarks = new Remarks();
        $add_remarks->remarks_user_id = Auth::user()->id;
        $add_remarks->remarks_order_id = $request->input('remarks_row_id');
        $add_remarks->remarks_company_id = $auth->users_company_id;
        $add_remarks->remarks_for_id = $request->input('remarks_for_id');
        $add_remarks->remarks_date = $request->input('remarks_date');
        $add_remarks->remarks_detail = $request->input('remarks_detail');
        $add_remarks->remarks_created_at = Carbon::now('Asia/Karachi');
        $add_remarks->remarks_updated_at = Carbon::now('Asia/Karachi');
        $add_remarks->ip_address = $this->get_ip();
        $add_remarks->os_name = $this->get_os();
        $add_remarks->browser = $this->get_browsers();
        $add_remarks->device = $this->get_device();
        $add_remarks->save();
        return redirect('/order')->with('success', 'Remarks Added');
    }
    public function orderRemarks(Request $request, $array = null, $str = null)
    {
        $auth = Auth::user();
        $query = DB::table('remarks')->where('remarks_company_id', $auth->users_company_id);
        $query->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id');
        $query->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id');
        $query->join('order', 'order.id', '=', 'remarks.remarks_order_id');
        $query->join('company', 'company.id', '=', 'order.company_id');
        $query->select('users_user_id.name as user_id_name', 'remarks.remarks_detail', 'remarks.remarks_date', 'remarks.remarks_created_at', 'order.grand_total', 'users_remarks_for.name as remarks_for', 'company.id', 'company.company_name', 'users_remarks_for.id as users_remarks_for_id', 'users_remarks_for.name as users_remarks_for_name');
        //        $query->where('remarks.remarks_for_id', '=', Auth::user()->id);
        $ar = json_decode($request->array);
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('remarks.remarks_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('remarks.remarks_created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('company.id', '=', $companies);
        }
        if (!empty($created_by)) {
            $query->where('remarks.remarks_user_id', '=', $created_by);
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('company_name', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_date', 'like', '%' . $search . '%');
        //         $query->orWhere('users_remarks_for.name', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_detail', 'like', '%' . $search . '%');
        //         $query->orWhere('remarks_created_at', 'like', '%' . $search . '%');
        //     });
        // }else{
        $query->whereIn(
            'remarks.remarks_user_id',
            DB::table('users')
                ->where('role', '=', 'Tele Caller')
                ->orWhere('id', '=', Auth::user()->id)
                ->pluck('id'),
        );
        // }
        $query->orderByDesc('remarks_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $tele_caller = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', 'Tele Caller')
            ->pluck('id');
        $order_remarks = DB::table('remarks')
            ->where('remarks_company_id', $auth->users_company_id)
            ->join('users as users_user_id', 'users_user_id.id', '=', 'remarks.remarks_user_id')
            ->join('users as users_remarks_for', 'users_remarks_for.id', '=', 'remarks.remarks_for_id')
            ->join('order', 'order.id', '=', 'remarks.remarks_order_id')
            ->join('company', 'company.id', '=', 'order.company_id')
            ->select('users_user_id.name as user_id_name', 'remarks.remarks_detail', 'remarks.remarks_date', 'remarks.remarks_created_at', 'order.grand_total', 'users_remarks_for.name as remarks_for', 'company.id', 'company.company_name')
            ->whereIn('remarks.remarks_user_id', $tele_caller)
            ->get();
        $all_created_by = DB::table('remarks')
            ->where('remarks_company_id', $auth->users_company_id)
            ->join('users', 'id', '=', 'remarks.remarks_user_id')
            ->select('users.id', 'users.name')
            ->where('users.role', '=', 'Tele Caller')
            ->orWhere('remarks.remarks_for_id', Auth::user()->id)
            ->groupBy('remarks.remarks_user_id')
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_order_remarks';
        $pge_title = 'Order Remarks List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = isset($request->str) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = PDF::loadView($prnt_page_dir, compact('datas', 'count_row', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('orderRemarks.orderRemarks', compact('datas', 'count_row', 'pge_title', 'type', 'created_by', 'from_date', 'to_date', 'order_remarks', 'all_created_by', 'companies'));
        }
    }
    //    public function remarks_order_advance_search (Request $request, $array = null, $str = null){
    //        $user = Auth::user()->id;
    //        $table_row = '';
    //
    //        $ar = json_decode($request->array);
    //        $companies = (!isset($request->companies) && empty($request->companies)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->companies;
    //        $created_by = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->created_by;
    //        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->from_date;
    //        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->to_date;
    //
    //        if (!empty($from_date)){
    //            $query->whereDate('remarks.remarks_created_at', '>=', date($from_date));
    //        }
    //        if (!empty($to_date)){
    //            $query->whereDate('remarks.remarks_created_at', '<=', date($to_date));
    //        }
    //        if (!empty($companies)){
    //            $query->where('company.id', '=', $companies);
    //        }
    //        if (!empty($created_by)){
    //            $query->where('remarks.remarks_user_id', '=', $created_by);
    //        }else{
    //            $query->whereIn('remarks.remarks_user_id', DB::table('users')
    //                ->where('role', '=', 'Tele Caller')
    //                ->orWhere('id', '=', Auth::user()->id)->pluck('id')
    //            );
    //        }
    ////        if (Auth::user()->role == 'Supervisor'){
    ////            $userID = DB::table('users')->where('supervisor', $user)->orWhere('id',$user)->get()->pluck('id');
    ////            $query->whereIn('schedule.user_id', $userID);
    ////        }elseif (Auth::user()->role == 'Sale Person'){
    ////            $query->where('schedule.user_id', '=', $user);
    ////        }
    //        $datas = $query->get();
    //        $count_row = count($datas);
    //        if ($count_row >  0){
    //            foreach ($datas as $key => $schedule){
    //                $table_row .= '<tr><td>'.($key+1).'</td><td>'.$schedule->remarks_created_at.'</td><td>'.date('d-M-Y', strtotime($schedule->remarks_date)).'</td>
    //                                <td>'.$schedule->company_name.'</td><td>'.$schedule->remarks_detail.'</td><td>'.$schedule->grand_total.'</td>
    //                                <td>'.$schedule->remarks_for.'</td><td>'.$schedule->user_id_name.'</td>
    //                                </tr>';
    //            }
    //        }
    //        //            PRINT
    //        $prnt_page_dir = 'print.pages.p_order_remarks';
    //        $pge_title = 'Order Remarks List';
    //        $srch_fltr = [];
    //        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date);
    //
    //        if (isset($request->array) && !empty($request->array)) {
    //            $type = (isset($request->str)) ? $request->str : '';
    //            $footer = view('print._partials.pdf_footer')->render();
    //            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
    //            $options = [
    //                'footer-html' => $footer,
    //                'header-html' => $header,
    //            ];
    //            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'type', 'pge_title'));
    //            $pdf->setOptions($options);
    //            if( $type === 'pdf') {
    //                return $pdf->stream($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_pdf') {
    //                return $pdf->download($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_excel') {
    //                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title), $pge_title.'_x.xlsx');
    //            }
    //        }
    //        else {
    //            return response(compact('count_row', 'table_row'));
    //        }
    //    }
    public function all_remarks()
    {

        $auth = Auth::user();
        return view('tele_caller_reports.all_remarks',compact('auth'));
    }
    public function fetching_remarks(Request $request)
    {
        $auth = Auth::user();
        $get_supervisor = DB::table('users')
            ->where('role', '=', $request->role)
            ->pluck('id');
        if ($request->user_table == 'schedule') {
            $user_id = $request->user_id;
            $query = DB::table('remarks');
            $query->join('users', 'users.id', '=', 'remarks.remarks_for_id');
            $query->join('schedule', 'schedule.id', '=', 'remarks.remarks_schedule_id');
            $query->join('company', 'company.id', '=', 'schedule.company_id');
            $query->join('visit_type', 'visit_type.visit_type_id', '=', 'schedule.type_of_visit');
            $query->select('schedule.date as date', 'users.name as name', 'company.company_name as company_name', 'visit_type.visit_type_name as visit_type_name', 'remarks.remarks_date as remarks_date', 'remarks.remarks_detail as remarks_detail', 'remarks.remarks_created_at as remarks_created_at');
            $query->whereDate('remarks.remarks_created_at', '>=', date($request->from_date));
            $query->whereDate('remarks.remarks_created_at', '<=', date($request->to_date));
            if (isset($user_id)) {
                $query->where('remarks.remarks_for_id', '=', $user_id);
            }
            $query->whereIn('remarks.remarks_for_id', $get_supervisor);
            $data = $query->get();
            $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Visit Type</th>
                        <th>Remarks Date</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            ';
            foreach ($data as $key => $schedule_data) {
                $table_data[] =
                    '
                     <tbody>
                        <tr>
                            <td>' .
                    ($key + 1) .
                    '</td><td>' .
                    $schedule_data->date .
                    '</td><td>' .
                    $schedule_data->name .
                    '</td><td>' .
                    $schedule_data->company_name .
                    '</td>
                            <td>' .
                    $schedule_data->visit_type_name .
                    '</td><td>' .
                    $schedule_data->remarks_date .
                    '</td><td>' .
                    $schedule_data->remarks_detail .
                    '</td>
                            <td>' .
                    date('d-M-Y', strtotime($schedule_data->remarks_created_at)) .
                    '</td>
                        </tr>
                    </tbody>
                ';
            }
        } elseif ($request->user_table == 'funnel') {
            $user_id = $request->user_id;
            $query = DB::table('remarks');
            $query->join('users', 'users.id', '=', 'remarks.remarks_for_id');
            $query->join('funnel', 'funnel.id', '=', 'remarks.remarks_funnel_id');
            $query->join('company', 'company.id', '=', 'funnel.company_id');
            $query->join('category', 'category.cat_id', '=', 'funnel.category_id');
            $query->join('status', 'status.sta_id', '=', 'funnel.status_id');
            $query->select('funnel.date as date', 'users.name as name', 'company.company_name as company_name', 'category.cat_category as cat_category', 'funnel.mrc as mrc', 'funnel.otc as otc', 'status.sta_status as sta_status', 'remarks.remarks_date as remarks_date', 'remarks.remarks_detail as remarks_detail', 'remarks.remarks_created_at');
            $query->whereDate('remarks.remarks_created_at', '>=', date($request->from_date));
            $query->wheredate('remarks.remarks_created_at', '<=', date($request->to_date));
            if (isset($user_id)) {
                $query->where('remarks.remarks_for_id', '=', $user_id);
            }
            $query->whereIn('remarks.remarks_for_id', $get_supervisor);
            $data = $query->get();
            $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Category</th>
                        <th>MRC</th>
                        <th>OTC</th>
                        <th>Status</th>
                        <th>Remarks Date</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            ';
            foreach ($data as $key => $funnel_data) {
                $table_data[] =
                    '
                     <tbody>
                        <tr>
                            <td>' .
                    ($key + 1) .
                    '</td><td>' .
                    $funnel_data->date .
                    '</td><td>' .
                    $funnel_data->name .
                    '</td><td>' .
                    $funnel_data->company_name .
                    '</td>
                            <td>' .
                    $funnel_data->cat_category .
                    '</td><td>' .
                    $funnel_data->mrc .
                    '</td><td>' .
                    $funnel_data->otc .
                    '</td><td>' .
                    $funnel_data->sta_status .
                    '</td>
                            <td>' .
                    $funnel_data->remarks_date .
                    '</td><td>' .
                    $funnel_data->remarks_detail .
                    '</td><td>' .
                    date('d-M-Y', strtotime($funnel_data->remarks_created_at)) .
                    '</td>
                        </tr>
                    </tbody>
                ';
            }
        } elseif ($request->user_table == 'invoice') {
            $user_id = $request->user_id;
            $query = DB::table('remarks');
            $query->join('users', 'users.id', '=', 'remarks.remarks_for_id');
            $query->join('invoice', 'invoice.id', '=', 'remarks.remarks_purposal_id');
            $query->join('company', 'company.id', '=', 'invoice.company_id');
            $query->select('invoice.date as date', 'users.name as name', 'company.company_name as company_name', 'invoice.grand_total as grand_total', 'remarks.remarks_date as remarks_date', 'remarks.remarks_detail as remarks_detail', 'remarks.remarks_created_at as remarks_created_at');
            $query->whereDate('remarks.remarks_created_at', '>=', date($request->from_date));
            $query->wheredate('remarks.remarks_created_at', '<=', date($request->to_date));
            if (isset($user_id)) {
                $query->where('remarks.remarks_for_id', '=', $user_id);
            }
            $query->whereIn('remarks.remarks_for_id', $get_supervisor);
            $data = $query->get();
            $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Grand Total</th>
                        <th>Remarks Date</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            ';
            foreach ($data as $key => $invoice_data) {
                $table_data[] =
                    '
                     <tbody>
                        <tr>
                            <td>' .
                    ($key + 1) .
                    '</td><td>' .
                    $invoice_data->date .
                    '</td><td>' .
                    $invoice_data->name .
                    '</td><td>' .
                    $invoice_data->company_name .
                    '</td>
                            <td>' .
                    $invoice_data->grand_total .
                    '</td><td>' .
                    $invoice_data->remarks_date .
                    '</td><td>' .
                    $invoice_data->remarks_detail .
                    '</td>
                            <td>' .
                    date('d-M-Y', strtotime($invoice_data->remarks_created_at)) .
                    '</td>
                        </tr>
                    </tbody>
                ';
            }
        } elseif ($request->user_table == 'order') {
            $user_id = $request->user_id;
            $query = DB::table('remarks');
            $query->join('users', 'users.id', '=', 'remarks.remarks_for_id');
            $query->join('order', 'order.id', '=', 'remarks.remarks_order_id');
            $query->join('company', 'company.id', '=', 'order.company_id');
            $query->select('order.sale_date as sale_date', 'users.name as name', 'company.company_name as company_name', 'order.grand_total as grand_total', 'remarks.remarks_date as remarks_date', 'remarks.remarks_detail as remarks_detail', 'remarks.remarks_created_at as remarks_created_at');
            $query->whereDate('order.created_at', '>=', date($request->from_date));
            $query->wheredate('order.created_at', '<=', date($request->to_date));
            if (isset($user_id)) {
                $query->where('remarks.remarks_for_id', '=', $user_id);
            }
            $query->whereIn('remarks.remarks_for_id', $get_supervisor);
            $data = $query->get();
            $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Grand Total</th>
                        <th>Remarks Date</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            ';
            foreach ($data as $key => $order_data) {
                $table_data[] =
                    '
                     <tbody>
                        <tr>
                            <td>' .
                    ($key + 1) .
                    '</td><td>' .
                    $order_data->sale_date .
                    '</td><td>' .
                    $order_data->name .
                    '</td><td>' .
                    $order_data->company_name .
                    '</td>
                            <td>' .
                    $order_data->grand_total .
                    '</td><td>' .
                    $order_data->remarks_date .
                    '</td><td>' .
                    $order_data->remarks_detail .
                    '</td>
                            <td>' .
                    date('d-M-Y', strtotime($order_data->remarks_created_at)) .
                    '</td>
                        </tr>
                    </tbody>
                ';
            }
        }
        return response()->json(compact('table_data'));
    }
}
