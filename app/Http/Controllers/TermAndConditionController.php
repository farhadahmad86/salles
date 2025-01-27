<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Order;
use App\Models\TandC;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TermAndConditionController extends Controller
{
    public function TandC()
    {
        return view('TandC.TandC');
    }

    public function viewTandC(Request $request)
    {
        $auth = Auth::user();
        $query = DB::table('term_and_condition')->where('term_and_condition_company_id', $auth->users_company_id);
        $ar = json_decode($request->array);
        $tandc = !isset($request->tandc) && empty($request->tandc) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->tandc;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->search;
        if (!empty($tandc)) {
            $query->where('term_and_condition.tandc_id', '=', $tandc);
        }
        if (!empty($created_by)) {
            $query->where('term_and_condition.tandc_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('term_and_condition.tandc_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('term_and_condition.tandc_created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('term_and_condition.tandc_title', 'like', '%' . $search . '%');
        //         $query->orWhere('term_and_condition.tandc_description', 'like', '%' . $search . '%');
        //         $query->orWhere('term_and_condition.tandc_created_at', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('term_and_condition.tandc_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->where('company_company_id', $auth->users_company_id)
            ->select('user_id')
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('term_and_condition')->pluck('tandc_user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $all_tandc = DB::table('term_and_condition')
            ->whereIn('tandc_id', DB::table('term_and_condition')->pluck('tandc_id')->all())
            ->where('term_and_condition_company_id', $auth->users_company_id)
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_tandc';
        $pge_title = 'Terms and Condition List';
        $srch_fltr = [];
        array_push($srch_fltr, $from_date, $to_date);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = isset($request->str) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = PDF::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('TandC.viewTandC', compact('datas', 'count_row', 'pge_title', 'type', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder', 'tandc', 'all_tandc'));
        }
    }
    public function storeTandC(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'tandc_description' => 'required',
        ]);
        $store_tandc = new TandC();
        $store_tandc->tandc_user_id = Auth::user()->id;
        $store_tandc->tandc_title = $request->tandc_title;
        $store_tandc->tandc_description = $request->tandc_description;
        $store_tandc->term_and_condition_company_id = $auth->users_company_id;
        $store_tandc->tandc_created_at = Carbon::now('Asia/Karachi');
        $store_tandc->tandc_updated_at = Carbon::now('Asia/Karachi');
        $store_tandc->ip_address = $this->get_ip();
        $store_tandc->os_name = $this->get_os();
        $store_tandc->browser = $this->get_browsers();
        $store_tandc->device = $this->get_device();
        $store_tandc->save();
        return redirect('/viewTandC')->with('success', 'Successfully Inserted');
    }
    public function edit_tandc(Request $request)
    {
        $auth = Auth::user();
        $get_tandc = TandC::where('term_and_condition_company_id', $auth->users_company_id)->find($request->id);
        return view('TandC.edit_tandc', compact('get_tandc'));
    }
    public function update_tandc(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'tandc_description' => 'required',
        ]);
        $store_tandc = TandC::find($request->id);
        $store_tandc->tandc_user_id = Auth::user()->id;
        $store_tandc->tandc_title = $request->tandc_title;
        $store_tandc->tandc_description = $request->tandc_description;
        $store_tandc->term_and_condition_company_id = $auth->users_company_id;
        $store_tandc->tandc_updated_at = Carbon::now('Asia/Karachi');
        $store_tandc->ip_address = $this->get_ip();
        $store_tandc->os_name = $this->get_os();
        $store_tandc->browser = $this->get_browsers();
        $store_tandc->device = $this->get_device();
        $store_tandc->save();
        return redirect('/viewTandC')->with('success', 'Successfully Updated');
    }
    public function deleteTandC(Request $request)
    {
        $auth = Auth::user();
        $order = DB::table('order')
            ->whereRaw('FIND_IN_SET(' . $request->id . ', tandc_id)')
            ->where('order_company_id', $auth->users_company_id)
            ->count();
        if ($order == 0) {
            $delete_tand = TandC::find($request->id);
            $delete_tand->delete();
            return redirect('/viewTandC')->with('success', 'Successfully Deleted');
        }
        return redirect('/viewTandC')->with('error', 'This Term and Condition is using on another Table');
    }
}
