<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\CompanyPocProfile;
use App\Models\DesignationModel;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DesignationControlller extends Controller
{
    public function create_designation()
    {
        return view('designation.create_designation');
    }
    public function storedesignation(Request $request)
    {
        $auth = Auth::user();
        // dd($request->all());
        $this->validate($request, [
            // 'designation_description' => 'required',
        ]);
        $store_desig = new DesignationModel();
        if ($auth->role == 'Tele Caller') {
            $store_desig->designation_user_id = session('id');
        } else {
            $store_desig->designation_user_id = Auth::user()->id;
        }
        $store_desig->designation_title = $request->designation_title;
        $store_desig->designation_company_id = $auth->users_company_id;
        $store_desig->designation_created_at = Carbon::now('Asia/Karachi');
        $store_desig->designation_updated_at = Carbon::now('Asia/Karachi');
        $store_desig->ip_address = $this->get_ip();
        $store_desig->os_name = $this->get_os();
        $store_desig->browser = $this->get_browsers();
        $store_desig->device = $this->get_device();
        $store_desig->save();
        return redirect('/designation')->with('success', 'Successfully Inserted');
    }
    public function designation(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        // dd($auth);
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->orWhere('id', $user)
            ->get()
            ->pluck('id');
        $query = DB::table('designation');
        $query->where('designation_company_id', '=', $auth->users_company_id);
        $query->join('users', 'users.id', '=', 'designation.designation_user_id');
        if ($auth->role == 'Tele Caller') {
            $query->where('designation.designation_user_id', session('id'));
        }
        $ar = json_decode($request->array);
        $designation = !isset($request->designation) && empty($request->designation) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->designation;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->search;
        if (!empty($designation)) {
            $query->where('designation.designation_id', '=', $designation);
        }
        if (!empty($created_by)) {
            $query->where('designation.designation_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('designation.designation_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('designation.designation_created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('designation.designation_title', 'like', '%' . $search . '%');
        //         $query->orWhere('designation.designation_description', 'like', '%' . $search . '%');
        //         $query->orWhere('designation.designation_created_at', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('designation.designation_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('designation.designation_user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('designation.designation_user_id', '=', $user);
        }
        $datas = $query->paginate($pagination_number);
        // dd($datas);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $all_created_by = DB::table('users')->whereIn('id', DB::table('designation')->pluck('designation_user_id')->all());
        if ($auth->role == 'Tele Caller') {
            $all_created_by->where('id', session('id'));
        }
        $all_created_by = $all_created_by->get();

        $all_designation = DB::table('designation')->whereIn('designation_id', DB::table('designation')->pluck('designation_id')->all());
        if ($auth->role == 'Tele Caller') {
            $all_designation->where('designation.designation_user_id', session('id'));
        }

        $all_designation = $all_designation->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_designation';
        $pge_title = 'Designation List';
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
            return view('designation.designation_list', compact('datas', 'count_row', 'pge_title', 'type', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder', 'designation', 'all_designation'));
        }
    }
    public function edit_designation(Request $request)
    {
        $get_designation = DesignationModel::find($request->id);
        // dd($get_designation);
        return view('designation.edit_designation', compact('get_designation'));
    }
    public function update_designation(Request $request)
    {
        $this->validate($request, [
            // 'designation_description' => 'required',
        ]);
        $auth = Auth::user();
        $user = Auth::user()->id;
        // dd(Auth::user()->id);
        $store_designation = DesignationModel::find($request->id);
        if ($auth->role == 'Tele Caller') {
            $store_designation->designation_user_id = session('id');
        } else {
            $store_designation->designation_user_id = Auth::user()->id;
        }
        $store_designation->designation_title = $request->designation_title;
        $store_designation->designation_company_id = $auth->users_company_id;
        $store_designation->designation_updated_at = Carbon::now('Asia/Karachi');
        $store_designation->ip_address = $this->get_ip();
        $store_designation->os_name = $this->get_os();
        $store_designation->browser = $this->get_browsers();
        $store_designation->device = $this->get_device();
        $store_designation->save();
        return redirect('/designation')->with('success', 'Successfully Updated');
    }
    public function deletedesignation(Request $request)
    {
        $auth = Auth::user();
        $poc_id = CompanyPocProfile::where('com_poc_profile_designation', $request->id)
            ->where('com_poc_profile_company_id', $auth->users_company_id)
            ->count();
        // dd($poc_id);
        if ($poc_id == 0) {
            $delete_designations = DesignationModel::find($request->id);
            $delete_designations->delete();
            return redirect('/designation')->with('success', 'Successfully Deleted');
        }
        return redirect('/designation')->with('error', 'This Designation is using on another Table');
    }
}
