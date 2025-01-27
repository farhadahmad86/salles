<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Company;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\VisitType;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class VisitTypeController extends Controller
{
    public function visitTypeCreate()
    {
        return view('visitType.visitTypeCreate');
    }
    public function visitTypeView(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('id', $user)
            ->orWhere('supervisor', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->get()
            ->pluck('id');
        $query = DB::table('visit_type')->where('visit_type_company_id', $auth->users_company_id);
        $query->join('users', 'users.id', '=', 'visit_type.visit_type_user_id');
        $query->select('visit_type.*', 'users.name');
        $ar = json_decode($request->array);
        $visit_type = !isset($request->visit_type) && empty($request->visit_type) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->visit_type;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($visit_type)) {
            $query->where('visit_type.visit_type_id', '=', $visit_type);
        }
        if (!empty($created_by)) {
            $query->where('visit_type.visit_type_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('visit_type.visit_type_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('visit_type.visit_type_created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('visit_type.visit_type_created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('visit_type.visit_type_name', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('visit_type.visit_type_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('visit_type_user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('visit_type_user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->where('company_company_id', $auth->users_company_id)
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('region')->pluck('reg_user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            // ->where('id', $user)
            ->get();
        $all_visit_type = DB::table('visit_type')
            ->whereIn('visit_type_id', DB::table('visit_type')->pluck('visit_type_id')->all())
            ->where('visit_type_company_id', $auth->users_company_id)
            // ->where('visit_type_user_id', $user)
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_visitType';
        $pge_title = 'Visit Type List';
        $srch_fltr = [];
        array_push($srch_fltr, $created_by, $from_date, $to_date);
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
            return view('visitType.visitTypeView', compact('datas', 'count_row', 'pge_title', 'type', 'visit_type', 'all_visit_type', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder'));
        }
    }
    public function visitTypeStore(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'visitType' => 'required',
        ]);
        $add_visit_type = new VisitType();
        $add_visit_type->visit_type_user_id = Auth::user()->id;
        $add_visit_type->visit_type_name = $request->input('visitType');
        $add_visit_type->visit_type_company_id = $auth->users_company_id;
        $add_visit_type->visit_type_created_at = Carbon::now('Asia/Karachi');
        $add_visit_type->visit_type_updated_at = Carbon::now('Asia/Karachi');
        $add_visit_type->ip_address = $this->get_ip();
        $add_visit_type->os_name = $this->get_os();
        $add_visit_type->browser = $this->get_browsers();
        $add_visit_type->device = $this->get_device();
        $add_visit_type->save();
        return redirect('/visitTypeView')->with('success', 'Successfully Inserted');
    }
    public function visitTypeEdit(Request $request)
    {
        $auth = Auth::user();
        $get_visit_type = VisitType::find($request->id);
        return view('visitType.visitTypeEdit', compact('get_visit_type'));
    }
    public function visitTypeUpdate(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'visitType' => 'required',
        ]);
        $add_visit_type = VisitType::find($request->id);
        $add_visit_type->visit_type_user_id = Auth::user()->id;
        $add_visit_type->visit_type_name = $request->input('visitType');
        $add_visit_type->visit_type_company_id = $auth->users_company_id;
        $add_visit_type->visit_type_updated_at = Carbon::now('Asia/Karachi');
        $add_visit_type->ip_address = $this->get_ip();
        $add_visit_type->os_name = $this->get_os();
        $add_visit_type->browser = $this->get_browsers();
        $add_visit_type->device = $this->get_device();
        $add_visit_type->save();
        return redirect('/visitTypeView')->with('success', 'Successfully Updated');
    }
    public function visitTypeDelete(Request $request)
    {
        $auth = Auth::user();
        $schedule = Schedule::where('type_of_visit', $request->id)
            ->where('schedule_company_id', $auth->users_company_id)
            ->count();
        if ($schedule == 0) {
            $company = VisitType::find($request->id);
            $company->delete();
            return redirect('/visitTypeView')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/visitTypeView')->with('error', 'This Visit Type is using on another Table');
        }
    }
}
