<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Http\Middleware\AdminMiddleware;
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

class SectorController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $get_all_region = Region::where('reg_user_id', Auth::user()->id)
            ->where('region_company_id', $auth->users_company_id)
            ->get();
        return view('sector.index', compact('get_all_region'));
    }
    public function viewSector(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')->where('supervisor', $user)->orWhere('id', $user)
        ->where('users_company_id', $auth->users_company_id)
        ->get()
        ->pluck('id');
        $query = DB::table('sector')->where('sector_company_id', $auth->users_company_id);
        $query->join('region', 'region.region_id', '=', 'sector.sec_region_id');
        $query->join('area', 'area.area_id', '=', 'sector.sec_area_id');
        $query->join('users', 'users.id', '=', 'sector.sec_user_id');
        $ar = json_decode($request->array);
        $region = !isset($request->region) && empty($request->region) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->region;
        $area = !isset($request->area) && empty($request->area) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->area;
        $sector = !isset($request->sector) && empty($request->sector) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->sector;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[6]->{'value'} : '') : $request->search;
        if (!empty($region)) {
            $query->where('sector.sec_region_id', '=', $region);
        }
        if (!empty($area)) {
            $query->where('sector.sec_area_id', '=', $area);
        }
        if (!empty($sector)) {
            $query->where('sector.sector_id', '=', $sector);
        }
        if (!empty($created_by)) {
            $query->where('sector.sec_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('sector.sec_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('sector.sec_created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('region.reg_name', 'like', '%' . $search . '%');
        //         $query->orWhere('area.area_name', 'like', '%' . $search . '%');
        //         $query->orWhere('sector.sec_created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('sector.sec_name', 'like', '%' . $search . '%');
        //         $query->orWhere('sector.sec_remarks', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('sector.sec_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('sec_user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('sec_user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('sector')->pluck('sec_user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $all_region = DB::table('region')
            ->whereIn('region_id', DB::table('sector')->pluck('sec_region_id')->all())
            ->where('region_company_id', $auth->users_company_id)
            ->get();
        $all_area = DB::table('area')
            ->whereIn('area_id', DB::table('sector')->pluck('sec_area_id')->all())
            ->where('area_company_id', $auth->users_company_id)
            ->get();
        $all_sector = DB::table('sector')
            ->whereIn('sector_id', DB::table('sector')->pluck('sector_id')->all())
            ->where('sector_company_id', $auth->users_company_id)
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_sector';
        $pge_title = 'Sector List';
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
            return view('sector.viewSector', compact('datas', 'count_row', 'pge_title', 'type', 'region', 'all_region', 'area', 'all_area', 'sector', 'all_sector', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder'));
        }
    }
    public function store(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'region' => 'required',
            'area' => 'required',
            'sector' => 'required',
        ]);
        $add_sec = new Sector();
        $add_sec->sec_user_id = Auth::user()->id;
        $add_sec->sec_region_id = $request->input('region');
        $add_sec->sec_area_id = $request->input('area');
        $add_sec->sec_name = $request->input('sector');
        $add_sec->sec_remarks = $request->input('sec_remarks');
        $add_sec->sec_created_at = Carbon::now('Asia/Karachi');
        $add_sec->sector_company_id = $auth->users_company_id;
        $add_sec->sec_updated_at = Carbon::now('Asia/Karachi');
        $add_sec->ip_address = $this->get_ip();
        $add_sec->os_name = $this->get_os();
        $add_sec->browser = $this->get_browsers();
        $add_sec->device = $this->get_device();
        $add_sec->save();
        return redirect('/viewSector')->with('success', 'Successfully Created');
    }
    public function edit(Request $request)
    {
        $auth = Auth::user();
        $get_all_region = Region::where('reg_user_id', Auth::user()->id)
        ->where('region_company_id', $auth->users_company_id)->get();
        $get_edit_sector = DB::table('sector')
            ->where('sector_id', '=', $request->id)
            ->where('sector_company_id', $auth->users_company_id)
            ->first();
        $get_all_area = DB::table('area')
            ->where('area.area_region_id', '=', $get_edit_sector->sec_region_id)
            ->where('area_company_id', $auth->users_company_id)
            ->get();
        return view('sector.editSector', compact('get_all_region', 'get_all_area', 'get_edit_sector'));
    }
    public function update(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'region' => 'required',
            'area' => 'required',
            'sector' => 'required',
        ]);
        $add_sec = Sector::find($request->id);
        $add_sec->sec_user_id = Auth::user()->id;
        $add_sec->sec_region_id = $request->input('region');
        $add_sec->sec_area_id = $request->input('area');
        $add_sec->sec_name = $request->input('sector');
        $add_sec->sec_remarks = $request->input('sec_remarks');
        $add_sec->sec_updated_at = Carbon::now('Asia/Karachi');
        $add_sec->sector_company_id = $auth->users_company_id;
        $add_sec->ip_address = $this->get_ip();
        $add_sec->os_name = $this->get_os();
        $add_sec->browser = $this->get_browsers();
        $add_sec->device = $this->get_device();
        $add_sec->save();
        return redirect('/viewSector')->with('success', 'Successfully Updated');
    }
    public function delete(Request $request)
    {
        $company = Company::where('com_sector_id', $request->id)->count();
        if ($company == 0) {
            $delete_sector = Sector::find($request->id);
            $delete_sector->delete();
            return redirect('/viewSector')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/viewSector')->with('error', 'This Sector is using on another Table');
        }
    }
}
