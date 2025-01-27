<?php
namespace App\Http\Controllers;
use App\Exports\ExcelFileCusExport;
use App\Models\CompProfile;
use App\Models\Funnel;
use App\Models\Remarks;
use App\Models\Reminder;
use App\Models\Schedule;
use App\Models\VisitType;
use Barryvdh\Snappy\Facades\SnappyPdf;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use App\Models\Company;
use PDF;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleController extends Controller
{
    public function index()
    {
        //        DB::enableQueryLog();
        //        DB::getQueryLog();
        $auth = Auth::user();
        if (Auth::user()->role == 'Admin') {
            $company = DB::table('company')
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $visit_type = VisitType::where('visit_type_company_id', $auth->users_company_id)->get();
            return view('schedule.index', compact('company', 'visit_type'));
        } elseif (Auth::user()->role == 'Supervisor') {
            $get_supervisor = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('id', Auth::user()->id)
                ->orwhere('supervisor', Auth::user()->id)
                ->pluck('supervisor');
            $company = DB::table('company')
                ->whereIn('user_id', $get_supervisor)
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $visit_type = VisitType::whereIn('visit_type_user_id', $get_supervisor)
                ->where('visit_type_company_id', $auth->users_company_id)
                ->get();
            return view('schedule.index', compact('company', 'visit_type'));
        } elseif (Auth::user()->role == 'Sale Person') {
            $get_supervisor = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('id', Auth::user()->id)
                ->orwhere('supervisor', Auth::user()->id)
                ->pluck('supervisor');
            $company = DB::table('company')
                ->where('user_id', Auth::user()->id)
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $visit_type = VisitType::whereIn('visit_type_user_id', $get_supervisor)
                ->where('visit_type_company_id', $auth->users_company_id)
                ->get();
            return view('schedule.index', compact('company', 'visit_type'));
        } elseif (Auth::user()->role == 'Tele Caller') {
            $get_supervisor = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('id', session('id'))
                ->orwhere('supervisor', session('id'))
                ->pluck('supervisor');
            $company = DB::table('company')
                ->where('user_id', session('id'))
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $visit_type = VisitType::where('visit_type_user_id', session('id'))
                ->where('visit_type_company_id', $auth->users_company_id)
                ->get();
            return view('schedule.index', compact('company', 'visit_type'));
        }
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $this->validate($request, [
            'date' => 'required',
            'comp_id' => 'required',
        ]);
        $schedule_info = new Schedule();
        if ($auth->role == 'Tele Caller') {
            // dd(1);
            $schedule_info->user_id = session('id');
        } else {
            $schedule_info->user_id = Auth::user()->id;
        }
        $schedule_info->company_id = $request->input('comp_id');
        $schedule_info->sch_remarks = $request->input('sch_remarks');
        $schedule_info->date = $request->input('date');
        $schedule_info->type_of_visit = $request->input('typeofvisit');
        if (
            ($status = DB::table('schedule')
                ->where('company_id', '=', $request->input('comp_id'))
                ->where('user_id', '=', Auth::user()->id)
                ->count()) == 0
        ) {
            $schedule_info->schedule_status = 'new';
        } else {
            $schedule_info->schedule_status = 'reSchedule';
        }
        //        $updateComp = [
        //            'sch_id' => Auth::user()->id
        //        ];
        //        DB::table('company')->where('id', $request->input('comp_id'))->update($updateComp);
        $schedule_info->schedule_company_id = $auth->users_company_id;
        $schedule_info->created_at = Carbon::now('Asia/Karachi');
        $schedule_info->updated_at = Carbon::now('Asia/Karachi');
        $schedule_info->ip_address = $this->get_ip();
        $schedule_info->os_name = $this->get_os();
        $schedule_info->browser = $this->get_browsers();
        $schedule_info->device = $this->get_device();
        $schedule_info->save();
        return redirect('schedule_show')->with('success', 'Schedule Added');
    }
    public function show(Request $request, $array = null, $str = null)
    {
        // dd(1);
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->get()
            ->pluck('id');
        $query = DB::table('schedule')->where('schedule_company_id', $auth->users_company_id);
        $query->join('company', 'company.id', '=', 'schedule.company_id');
        $query->join('users', 'users.id', '=', 'schedule.user_id');
        $query->leftJoin('visit_type', 'visit_type.visit_type_id', '=', 'schedule.type_of_visit');
        $query->select('company.id as compId', 'schedule.id as schId', 'schedule.created_at as schedule_created_at', 'schedule.date as date', 'schedule.user_id as sch_user_id', 'users.*', 'company.*', 'schedule.*', 'schedule.date as schedule_date', 'visit_type.visit_type_name');
        $ar = json_decode($request->array);
        if ($auth->role == 'Tele Caller') {
            $query->where('schedule.user_id', session('id'));
        }
        $companies = $request->companies ?? ($ar[0]->{'value'} ?? '');
        $created_by = $request->created_by ?? ($ar[1]->{'value'} ?? '');
        $status = $request->status ?? ($ar[2]->{'value'} ?? '');
        $from_date = $request->from_date ?? ($ar[3]->{'value'} ?? '');
        $to_date = $request->to_date ?? ($ar[4]->{'value'} ?? '');
        $visit_type = $request->visit_type ?? ($ar[4]->{'value'} ?? '');
        // $visit_type = !isset($request->visit_type) && empty($request->visit_type) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->visit_type;
        // $search = !isset($request->search) && empty($request->search) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('schedule.created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('schedule.created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('schedule.company_id', '=', $companies);
        }
        if (!empty($visit_type)) {
            $query->where('schedule.type_of_visit', '=', $visit_type);
        }
        if (!empty($created_by)) {
            $query->where('schedule.user_id', '=', $created_by);
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('company_name', 'like', '%' . $search . '%');
        //         $query->orWhere('schedule.date', 'like', '%' . $search . '%');
        //         $query->orWhere('visit_type_name', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //         $query->orWhere('sch_remarks', 'like', '%' . $search . '%');
        //         $query->orWhere('schedule.created_at', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('schedule.created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('schedule.user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('schedule.user_id', '=', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('schedule')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $all_companies = DB::table('company')
            ->whereIn('id', DB::table('schedule')->pluck('company_id')->all())
            ->where('company_company_id', $auth->users_company_id);
            if ($auth->role == 'Tele Caller') {
                $all_companies->where('company.user_id', session('id'));
            }
            $all_companies = $all_companies->get();

        $all_visit_types = DB::table('visit_type')
            ->whereIn('visit_type_id', DB::table('schedule')->pluck('type_of_visit')->all())
            ->where('visit_type_company_id', $auth->users_company_id);
            if ($auth->role == 'Tele Caller') {
                $all_visit_types->where('visit_type.visit_type_user_id', session('id'));
            }
            $all_visit_types = $all_visit_types->get();

        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('schedule')->pluck('user_id')->all())
            ->where('users_company_id', $auth->users_company_id);
            if ($auth->role == 'Tele Caller') {
                $all_created_by->where('id', session('id'));
            }
            $all_created_by = $all_created_by->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_schedule';
        $pge_title = 'Schedule List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $visit_type, $from_date, $to_date);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = isset($request->str) ? $request->str : '';
            // dd($type);
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = PDF::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                // $pdf->setPaper('A4', 'Landscape');
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                // $pdf->setPaper('A4', 'Landscape');
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('schedule.viewSch', compact('datas', 'count_row', 'pge_title', 'type', 'companies', 'created_by', 'visit_type', 'from_date', 'to_date', 'reminder', 'all_companies', 'all_visit_types', 'all_created_by'));
        }
    }
    public function edit(Request $request)
    {
        $auth = Auth::user();
        $schedule = Schedule::find($request->id);
        $comp_info = Company::where('company_company_id', $auth->users_company_id)->get();
        $visit_type = VisitType::where('visit_type_company_id', $auth->users_company_id)->get();
        return view('schedule.editSch', compact('schedule', 'comp_info', 'visit_type'));
    }
    public function update(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'date' => 'required',
            'comp_id' => 'required',
            'typeofvisit' => 'required',
        ]);
        $schedule = Schedule::find($request->id);
        $schedule->date = $request->input('date');
        $schedule->company_id = $request->input('comp_id');
        $schedule->sch_remarks = $request->input('sch_remarks');
        $schedule->type_of_visit = $request->input('typeofvisit');
        $schedule->schedule_company_id = $auth->users_company_id;
        $schedule->updated_at = Carbon::now('Asia/Karachi');
        $schedule->updated_at = Carbon::now('Asia/Karachi');
        $schedule->ip_address = $this->get_ip();
        $schedule->os_name = $this->get_os();
        $schedule->browser = $this->get_browsers();
        $schedule->device = $this->get_device();
        $schedule->save();
        return redirect('schedule_show')->with('success', 'Successfully Updated');
    }
    public function delete(Request $request)
    {
        $auth = Auth::user();
        $remarks = Remarks::where('remarks_schedule_id', $request->id)
            ->where('remarks_company_id', $auth->users_company_id)
            ->count();
        $reminder = Reminder::where('reminder_schedule_id', $request->id)
            ->where('reminder_company_id', $auth->users_company_id)
            ->count();
        if ($remarks == 0 && $reminder == 0) {
            $Schedule = Schedule::find($request->id);
            $Schedule->delete();
            return redirect('/schedule_show')->with('success', 'This field deleted');
        }
        return redirect('/schedule_show')->with('error', 'This Schedule is using on another Table');
    }

    //    public function notification(){
    //        $today = date('d-m-Y', strtotime(Carbon::now()));
    //        $sch_count_reminder = DB::table('schedule')
    //            ->where('schedule.user_id', '=', Auth::user()->id)
    //            ->where('sch_reminder', $today)
    //            ->count();
    //        $funnel_count_reminder = DB::table('funnel')
    //            ->where('funnel.user_id', '=', Auth::user()->id)
    //            ->where('funnel_reminder', $today)
    //            ->count();
    //        $purposal_count_reminder = DB::table('invoice')
    //            ->where('invoice.user_id', '=', Auth::user()->id)
    //            ->where('invoice_reminder', $today)
    //            ->count();
    //        $order_count_reminder = DB::table('order')
    //            ->where('order.user_id', '=', Auth::user()->id)
    //            ->where('order_reminder', $today)
    //            ->count();
    //        $add_reminders = $sch_count_reminder+$funnel_count_reminder+$purposal_count_reminder+$order_count_reminder;
    //        $sch_reminder = DB::table('schedule')
    //            ->join('company', 'company.id', '=', 'schedule.company_id')
    //            ->select('company.user_id')
    //            ->where('schedule.user_id', '=', Auth::user()->id)
    //            ->where('sch_reminder', $today)
    //            ->get();
    //        if (count($sch_reminder) == 0){
    //            $sch_reminder = 0;
    //        }
    //        $funnel_reminder = DB::table('funnel')
    //            ->join('company', 'company.id', '=', 'funnel.company_id')
    //            ->select('company.user_id')
    //            ->where('funnel.user_id', '=', Auth::user()->id)
    //            ->where('funnel_reminder', $today)
    //            ->get();
    //        if (count($funnel_reminder) == 0){
    //            $funnel_reminder = 0;
    //        }
    //        $invoice_reminder = DB::table('invoice')
    //            ->join('company', 'company.id', '=', 'invoice.company_id')
    //            ->select('company.user_id')
    //            ->where('invoice.user_id', '=', Auth::user()->id)
    //            ->where('invoice_reminder', $today)
    //            ->get();
    //        if (count($invoice_reminder) == 0){
    //            $invoice_reminder = 0;
    //        }
    //        $order_reminder = DB::table('order')
    //            ->join('company', 'company.id', '=', 'order.company_id')
    //            ->select('company.user_id')
    //            ->where('order.user_id', '=', Auth::user()->id)
    //            ->where('order_reminder', $today)
    //            ->get();
    //        if (count($order_reminder) == 0){
    //            $order_reminder = 0;
    //        }
    //        return response()->json(compact('add_reminders', 'sch_reminder', 'funnel_reminder', 'invoice_reminder', 'order_reminder'));
    //    }
}
