<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompProfile;
use App\Models\Funnel;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\Status;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CompProfileController extends Controller
{
    public function index(Request $request, $array = null, $str = null)
    {
        $user = Auth::user()->id;
        $userID = DB::table('users')->where('supervisor', $user)->orWhere('id', $user)->get()->pluck('id');
        $query = DB::table('company_profile');
        $query->join('status', 'status.sta_id', '=', 'company_profile.comprofile_status');
        $query->join('company', 'company.id', '=', 'company_profile.comprofile_company_id');
        $query->join('users', 'users.id', '=', 'company_profile.comprofile_user_id');
        //        $query->join('status', 'status.sta_id', '=', 'company_profile.comprofile_status');
        $ar = json_decode($request->array);
        $companies = (!isset($request->companies) && empty($request->companies)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->created_by;
        $status = (!isset($request->status) && empty($request->status)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->status;
        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->from_date;
        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->to_date;
        $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($companies)) {
            $query->where('company_profile.comprofile_company_id', '=', $companies);
        }
        if (!empty($created_by)) {
            $query->where('company_profile.comprofile_user_id', '=', $created_by);
        }
        if (!empty($status)) {
            $query->where('company_profile.comprofile_status', '=', $status);
        }
        if (!empty($from_date)) {
            $query->where('company_profile.comprofile_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('company_profile.comprofile_created_at', '<=', date($to_date));
        }
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('company.company_name', 'like', '%' . $search . '%');
                $query->orWhere('company_profile.comprofile_created_at', 'like', '%' . $search . '%');
                $query->orWhere('company_profile.comprofile_email', 'like', '%' . $search . '%');
                $query->orWhere('company_profile.comprofile_mobile_no', 'like', '%' . $search . '%');
                $query->orWhere('company_profile.comprofile_whatsapp_no', 'like', '%' . $search . '%');
                $query->orWhere('company_profile.comprofile_ptcl', 'like', '%' . $search . '%');
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('company_profile.comprofile_status', 'like', '%' . $search . '%');
                $query->orWhere('company_profile.comprofile_address', 'like', '%' . $search . '%');
            });
        }
        $query->orderByDesc('company_profile.comprofile_created_at');
        $pagination_number = (empty($ar)) ? 30 : 100000000;
        if (Auth::user()->role == "Supervisor") {
            $query->whereIn('company_profile.comprofile_user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('company_profile.comprofile_user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')->where('user_id', Auth::user()->id)->select('user_id')->get();
        $all_companies = DB::table('company')->whereIn('id', DB::table('company_profile')->pluck('comprofile_company_id')->all())->get();
        $all_created_by = DB::table('users')->whereIn('id', DB::table('company_profile')->pluck('comprofile_user_id')->all())->get();
        $all_status = DB::table('status')->whereIn('sta_id', DB::table('company_profile')->pluck('comprofile_status')->all())->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_compProfile';
        $pge_title = 'Company Profile List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $all_status, $from_date, $to_date, $search);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = (isset($request->str)) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } else if ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } else if ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('compProfile.index', compact(
                'datas',
                'count_row',
                'pge_title',
                'type',
                'status',
                'all_status',
                'companies',
                'all_companies',
                'created_by',
                'all_created_by',
                'from_date',
                'to_date',
                'search',
                'reminder'
            ));
        }
    }
    public function create()
    {
        if (Auth::user()->role == "Admin") {
            $comp_name = Company::all();
            $status = Status::all();
            return view('compProfile.createCompProfile', compact('comp_name', 'status'));
        } elseif (Auth::user()->role == "Supervisor") {
            $comp_name = Company::where('user_id', Auth::user()->id)->get();
            $status = Status::all();
            return view('compProfile.createCompProfile', compact('comp_name', 'status'));
        } elseif (Auth::user()->role == "Sale Person") {
            $comp_name = Company::where('user_id', Auth::user()->id)->get();
            $status = Status::all();
            return view('compProfile.createCompProfile', compact('comp_name', 'status'));
        }
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'comp_id' => 'required',
            'mobile' => 'required',
            'whatsapp' => 'required',
            'email' => 'required',
            'status' => 'required',
            'web_address' => 'required'
        ]);

        //        for ($i = 0; $i < count($request->name); $i++){
        //            $store_comPro = new CompProfile();
        //            $store_comPro->comprofile_company_id = $request->input('comp_id');
        //            $store_comPro->comprofile_user_id = Auth::user()->id;
        //            $store_comPro->comprofile_name = $request->input(['name'])[$i];
        //            $store_comPro->comprofile_designation = $request->input(['designation'])[$i];
        //            $store_comPro->comprofile_mobile_no = $request->input(['mobile'])[$i];
        //            $store_comPro->comprofile_whatsapp_no = $request->input(['whatsapp'])[$i];
        //            $store_comPro->comprofile_email = $request->input(['email'])[$i];
        //            $store_comPro->comprofile_status = $request->input(['status'])[$i];
        //        $store_comPro->ip_address = $this->get_ip();
        //        $store_comPro->os_name = $this->get_os();
        //        $store_comPro->browser = $this->get_browsers();
        //        $store_comPro->device = $this->get_device();
        //            $store_comPro->save();
        //        }
        $store_comPro = new CompProfile();
        $store_comPro->comprofile_company_id = $request->input('comp_id');
        $store_comPro->comprofile_user_id = Auth::user()->id;
        $store_comPro->comprofile_ptcl = $request->input('ptcl');
        $store_comPro->comprofile_address = $request->input('address');
        $store_comPro->comprofile_mobile_no = $request->input('mobile');
        $store_comPro->comprofile_whatsapp_no = $request->input('whatsapp');
        $store_comPro->comprofile_email = $request->input('email');
        $store_comPro->comprofile_status = $request->input('status');
        $store_comPro->comprofile_web_address = $request->input('web_address');
        $store_comPro->comprofile_created_at = Carbon::now('Asia/Karachi');
        $store_comPro->comprofile_updated_at = Carbon::now('Asia/Karachi');
        $store_comPro->ip_address = $this->get_ip();
        $store_comPro->os_name = $this->get_os();
        $store_comPro->browser = $this->get_browsers();
        $store_comPro->device = $this->get_device();
        $store_comPro->save();
        return redirect('/CompProfile')->with('success', 'Company Profile Created');
    }
    public function edit(Request $request)
    {
        $edit_id = $request->id;
        $comp_name = Company::all();
        $compPro = CompProfile::find($request->id);
        $status = Status::all();
        return view('compProfile.editCompProfile', compact('comp_name', 'compPro', 'edit_id', 'status'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'comp_id' => 'required',
            'ptcl' => 'required',
            'mobile' => 'required',
            'whatsapp' => 'required',
            'email' => 'required',
            'status' => 'required',
        ]);
        $update_comPro = CompProfile::find($request->id);
        $update_comPro->comprofile_user_id = Auth::user()->id;
        $update_comPro->comprofile_ptcl = $request->input('ptcl');
        $update_comPro->comprofile_mobile_no = $request->input('mobile');
        $update_comPro->comprofile_company_id = $request->input('comp_id');
        $update_comPro->comprofile_whatsapp_no = $request->input('whatsapp');
        $update_comPro->comprofile_email = $request->input('email');
        $update_comPro->comprofile_status = $request->input('status');
        $update_comPro->comprofile_web_address = $request->input('web_address');
        $update_comPro->comprofile_updated_at = Carbon::now('Asia/Karachi');
        $update_comPro->ip_address = $this->get_ip();
        $update_comPro->os_name = $this->get_os();
        $update_comPro->browser = $this->get_browsers();
        $update_comPro->device = $this->get_device();
        $update_comPro->save();
        return redirect('/CompProfile')->with('success', 'Company Profile Updated');
    }
    public function delete(Request $request)
    {
        //        $funnel = Funnel::where('company_id', $request->id)->count();
        //        if ($funnel == 0) {
        $del_company_profile = CompProfile::find($request->id);
        $del_company_profile->delete();
        return redirect('CompProfile')->with('success', 'Successfully Deleted');
        //        } else {
        //            return redirect('CompProfile')->with('error', 'This Company Profile is using on another Table');
        //        }
    }
}
