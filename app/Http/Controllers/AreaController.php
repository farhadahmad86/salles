<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Area;
use App\Models\Company;
use App\Models\Region;
use App\Models\Sector;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AreaController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $get_all_region = Region::where('reg_user_id', Auth::user()->id)
            ->where('region_company_id', $auth->users_company_id)
            ->get();
        return view('area.index', compact('get_all_region'));
    }
    public function viewArea(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->get()
            ->pluck('id');
        $query = DB::table('area')->where('area_company_id', $auth->users_company_id);
        $query->join('region', 'region_id', '=', 'area.area_region_id');
        $query->join('users', 'id', '=', 'area.area_user_id');
        $ar = json_decode($request->array);
        $region = !isset($request->region) && empty($request->region) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->region;
        $area = !isset($request->area) && empty($request->area) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->area;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($region)) {
            $query->where('area.area_region_id', '=', $region);
        }
        if (!empty($area)) {
            $query->where('area.area_id', '=', $area);
        }
        if (!empty($created_by)) {
            $query->where('area.area_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('area.area_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('area.area_created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('reg_name', 'like', '%' . $search . '%');
        //         $query->orWhere('area.area_created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('area.area_name', 'like', '%' . $search . '%');
        //         $query->orWhere('area.area_remarks', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('area.area_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('area_user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('area_user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->where('company_company_id', $auth->users_company_id)
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('area')->pluck('area_user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $all_region = DB::table('region')
            ->where('region_company_id', $auth->users_company_id)
            ->get();
        $all_area = DB::table('area')
            ->whereIn('area_id', DB::table('area')->pluck('area_id')->all())
            ->where('area_company_id', $auth->users_company_id)
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_area';
        $pge_title = 'Region List';
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
            return view('area.viewArea', compact('datas', 'region', 'all_region', 'count_row', 'pge_title', 'type', 'area', 'all_area', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder'));
        }
    }
    public function store(Request $request)
    {
        $auth = Auth::user();
        // dd(1);
        $this->validate($request, [
            'region' => 'required',
            'area' => 'required',
        ]);
        $add_area = new Area();
        $add_area->area_user_id = Auth::user()->id;
        $add_area->area_region_id = $request->input('region');
        $add_area->area_name = $request->input('area');
        $add_area->area_company_id= $auth->users_company_id;
        $add_area->area_remarks = $request->input('area_remarks');
        $add_area->area_created_at = Carbon::now('Asia/Karachi');
        $add_area->area_updated_at = Carbon::now('Asia/Karachi');
        $add_area->ip_address = $this->get_ip();
        $add_area->os_name = $this->get_os();
        $add_area->browser = $this->get_browsers();
        $add_area->device = $this->get_device();
        $add_area->save();
        return redirect('/viewArea')->with('success', 'Successfully Created');
    }
    public function edit(Request $request)
    {
        $auth = Auth::user();
        $get_all_region = Region::where('reg_user_id', Auth::user()->id)
        ->where('region_company_id', $auth->users_company_id)
        ->get();
        $get_area = Area::find($request->id);
        return view('area.editArea', compact('get_all_region', 'get_area'));
    }
    public function update(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'region' => 'required',
            'area' => 'required',
        ]);
        $add_area = Area::find($request->id);
        $add_area->area_user_id = Auth::user()->id;
        $add_area->area_region_id = $request->input('region');
        $add_area->area_name = $request->input('area');
        $add_area->area_company_id= $auth->users_company_id;
        $add_area->area_remarks = $request->input('area_remarks');
        $add_area->area_updated_at = Carbon::now('Asia/Karachi');
        $add_area->ip_address = $this->get_ip();
        $add_area->os_name = $this->get_os();
        $add_area->browser = $this->get_browsers();
        $add_area->device = $this->get_device();
        $add_area->save();
        return redirect('/viewArea')->with('success', 'Successfully Updated');
    }
    public function delete(Request $request)
    {
        $auth = Auth::user();
        $sector = Sector::where('sec_area_id', $request->id)
        ->where('sector_company_id', $auth->users_company_id)
        ->count();
        $company = Company::where('com_area_id', $request->id)
        ->where('company_company_id', $auth->users_company_id)
        ->count();
        if ($sector == 0 && $company == 0) {
            $delete_area = Area::find($request->id);
            $delete_area->delete();
            return redirect('/viewArea')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/viewArea')->with('error', 'This Area is using on another Table');
        }
    }
}
