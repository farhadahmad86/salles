<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Company;
use App\Models\CompanyPocProfile;
use App\Models\DesignationModel;
use App\Models\Funnel;
use App\Models\Invoice;
use App\Models\Status;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ClientPocProfileController extends Controller
{
    public function ClientPoc(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->get()
            ->pluck('id');
        $query = DB::table('company_poc_profile');
        $query->where('company_poc_profile_company_id', $auth->users_company_id);
        $query->join('company', 'company.id', '=', 'company_poc_profile.com_poc_profile_company_id');
        $query->join('users', 'users.id', '=', 'company_poc_profile.com_poc_profile_user_id');
        $query->join('designation', 'designation.designation_id', '=', 'company_poc_profile.com_poc_profile_designation');
        if ($auth->role == 'Tele Caller') {
            $query->where('company_poc_profile.com_poc_profile_user_id', session('id'));
        }
        //        $query->join('status', 'status.sta_id', '=', 'company_poc_profile.com_poc_profile_status');
        $ar = json_decode($request->array);
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $designation = !isset($request->designation) && empty($request->designation) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->designation;
        $status = !isset($request->status) && empty($request->status) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->status;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($companies)) {
            $query->where('company_poc_profile.com_poc_profile_company_id', '=', $companies);
        }
        if (!empty($created_by)) {
            $query->where('company_poc_profile.com_poc_profile_user_id', '=', $created_by);
        }
        if (!empty($designation)) {
            $query->where('company_poc_profile.com_poc_profile_designation', '=', $designation);
        }
        if ($status != null || $status != '') {
            $query->where('company_poc_profile.com_poc_profile_status', '=', $status);
        }
        if (!empty($from_date)) {
            $query->where('company_poc_profile.com_poc_profile_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('company_poc_profile.com_poc_profile_created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('company.company_name', 'like', '%' . $search . '%');
        //         $query->orWhere('company_poc_profile.com_poc_profile_created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('company_poc_profile.com_poc_profile_email', 'like', '%' . $search . '%');
        //         $query->orWhere('company_poc_profile.com_poc_profile_mobile_no', 'like', '%' . $search . '%');
        //         $query->orWhere('company_poc_profile.com_poc_profile_whatsapp_no', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //         $query->orWhere('company_poc_profile.com_poc_profile_status', 'like', '%' . $search . '%');
        //         $query->orWhere('company_poc_profile.com_poc_profile_address', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('company_poc_profile.com_poc_profile_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('company_poc_profile.com_poc_profile_user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('company_poc_profile.com_poc_profile_user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $all_companies = DB::table('company')
            ->whereIn('id', DB::table('company_poc_profile')->pluck('com_poc_profile_company_id')->all())
            ->where('company_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_companies->where('company.user_id', session('id'));
        }
        $all_companies = $all_companies->get();

        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('company_poc_profile')->pluck('com_poc_profile_user_id')->all())
            ->where('users_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_created_by->where('id', session('id'));
        }
        $all_created_by = $all_created_by->get();
        $all_status = DB::table('status')
            ->whereIn('sta_id', DB::table('company_poc_profile')->pluck('com_poc_profile_status')->all())
            ->where('status_company_id', $auth->users_company_id)
            ->get();
        $all_designation = DB::table('designation')
            ->whereIn('designation_id', DB::table('company_poc_profile')->pluck('com_poc_profile_designation')->all())
            ->where('designation_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_designation->where('designation.designation_user_id', session('id'));
        }
        $all_designation = $all_designation->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_ClientPoc';
        $pge_title = 'Client POC Profile List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $all_status, $all_designation, $from_date, $to_date);
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
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('ClientPoc.ClientPoc', compact('datas', 'all_designation', 'designation', 'count_row', 'pge_title', 'type', 'status', 'all_status', 'companies', 'all_companies', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder'));
        }
    }
    public function createClientPoc()
    {
        $auth = Auth::user();
        if (Auth::user()->role == 'Admin') {
            $comp_name = Company::where('company_company_id', $auth->users_company_id)->get();
            $designation = DesignationModel::where('designation_company_id', $auth->users_company_id)->get();
            return view('ClientPoc.CreatePoc', compact('comp_name', 'designation'));
        } elseif (Auth::user()->role == 'Supervisor') {
            $comp_name = Company::where('user_id', Auth::user()->id)
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $designation = DesignationModel::where('designation_user_id', Auth::user()->id)
                ->where('designation_company_id', $auth->users_company_id)
                ->get();
            return view('ClientPoc.CreatePoc', compact('comp_name', 'designation'));
        } elseif (Auth::user()->role == 'Sale Person') {
            $comp_name = Company::where('user_id', Auth::user()->id)
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $designation = DesignationModel::where('designation_user_id', Auth::user()->id)
                ->where('designation_company_id', $auth->users_company_id)
                ->get();
            return view('ClientPoc.CreatePoc', compact('comp_name', 'designation'));
        } elseif (Auth::user()->role == 'Tele Caller') {
            $comp_name = Company::where('user_id', session('id'))
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $designation = DesignationModel::where('designation_user_id', session('id'))
                ->where('designation_company_id', $auth->users_company_id)
                ->get();
            return view('ClientPoc.CreatePoc', compact('comp_name', 'designation'));
        }
    }
    public function storeClientPoc(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $this->validate($request, [
            'poc_name' => 'required',
            'poc_designation' => 'required',
            'poc_mobile' => 'required',
            'poc_whatsapp' => 'required',
            'poc_email' => 'required',
            // 'poc_status' => 'required',
        ]);
        $store_comPro = new CompanyPocProfile();
        $store_comPro->com_poc_profile_company_id = $request->input('poc_comp_id');
        if ($auth->role == 'Tele Caller') {
            $store_comPro->com_poc_profile_user_id = session('id');
        } else {
            $store_comPro->com_poc_profile_user_id = Auth::user()->id;
        }
        $store_comPro->com_poc_profile_name = $request->input('poc_name');
        $store_comPro->com_poc_profile_designation = $request->input('poc_designation');
        $store_comPro->com_poc_profile_mobile_no = $request->input('poc_mobile');
        $store_comPro->com_poc_profile_whatsapp_no = $request->input('poc_whatsapp');
        $store_comPro->com_poc_profile_email = $request->input('poc_email');
        $store_comPro->com_poc_profile_status = $request->input('poc_status');
        $store_comPro->company_poc_profile_company_id = $auth->users_company_id;
        $store_comPro->com_poc_profile_created_at = Carbon::now('Asia/Karachi');
        $store_comPro->com_poc_profile_updated_at = Carbon::now('Asia/Karachi');
        $store_comPro->ip_address = $this->get_ip();
        $store_comPro->os_name = $this->get_os();
        $store_comPro->browser = $this->get_browsers();
        $store_comPro->device = $this->get_device();
        $store_comPro->save();
        return redirect('ClientPoc')->with('success', 'Client POC Created');
    }
    public function editClientPoc(Request $request)
    {
        $auth = Auth::user();
        $edit_id = $request->id;
        $comp_name = Company::where('company_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $comp_name->where('company.user_id', session('id'));
        }
        $comp_name = $comp_name->get();
        $designation = DesignationModel::where('designation_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $designation->where('designation.designation_user_id', session('id'));
        }
        $designation = $designation->get();

        $comp_poc_profile = CompanyPocProfile::find($request->id);
        // dd($comp_poc_profile,$edit_id,$comp_name);
        return view('ClientPoc.editPoc', compact('comp_name', 'comp_poc_profile', 'edit_id', 'designation'));
    }
    public function updateClientPoc(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'poc_name' => 'required',
            'poc_designation' => 'required',
            'poc_mobile' => 'required',
            'poc_whatsapp' => 'required',
            'poc_email' => 'required',
            // 'poc_status' => 'required',
        ]);
        $update_comPro = CompanyPocProfile::find($request->id);
        $update_comPro->com_poc_profile_name = $request->input('poc_name');
        if ($auth->role == 'Tele Caller') {
            $update_comPro->com_poc_profile_user_id = session('id');
        } else {
            $update_comPro->com_poc_profile_user_id = Auth::user()->id;
        }
        $update_comPro->com_poc_profile_name = $request->input('poc_name');
        $update_comPro->com_poc_profile_designation = $request->input('poc_designation');
        $update_comPro->com_poc_profile_mobile_no = $request->input('poc_mobile');
        $update_comPro->com_poc_profile_company_id = $request->input('poc_comp_id');
        $update_comPro->com_poc_profile_whatsapp_no = $request->input('poc_whatsapp');
        $update_comPro->com_poc_profile_email = $request->input('poc_email');
        $update_comPro->com_poc_profile_status = $request->input('poc_status');
        $update_comPro->company_poc_profile_company_id = $auth->users_company_id;
        $update_comPro->com_poc_profile_updated_at = Carbon::now('Asia/Karachi');
        $update_comPro->ip_address = $this->get_ip();
        $update_comPro->os_name = $this->get_os();
        $update_comPro->browser = $this->get_browsers();
        $update_comPro->device = $this->get_device();
        $update_comPro->save();
        return redirect('ClientPoc')->with('success', 'Client POC Updated');
    }
    public function deleteClientPoc(Request $request)
    {
        $auth = Auth::user();
        $inv = Invoice::where('poc_id', $request->id)
            ->where('invoice_company_id', $auth->users_company_id)
            ->count();
        if ($inv == 0) {
            $del_company_poc_profile = CompanyPocProfile::find($request->id);
            $del_company_poc_profile->delete();
            return redirect('ClientPoc')->with('success', 'Successfully Deleted');
        } else {
            return redirect('ClientPoc')->with('error', 'This Client POC is using on another Table');
        }
    }
    public function changeStatus(Request $request)
    {
        // return $request->all();
        // // dd($request->all());
        $Poc = CompanyPocProfile::find($request->poc_id);
        // dd($company);
        $Poc->com_poc_profile_status = $request->status;
        $Poc->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
