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

class RegionController extends Controller
{
    public function index()
    {
        return view('region.index');
    }
    public function viewRegion(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
        ->where('supervisor', $user)->orWhere('id', $user)
        ->where('users_company_id', $auth->users_company_id)
        ->get()
        ->pluck('id');
        $query = DB::table('region')->where('region_company_id', $auth->users_company_id);
        $query->join('users', 'users.id', '=', 'region.reg_user_id');
        $ar = json_decode($request->array);
        $region = (!isset($request->region) && empty($request->region)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->region;
        $created_by = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($region)) {
            $query->where('region.region_id', '=', $region);
        }
        if (!empty($created_by)) {
            $query->where('region.reg_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('region.reg_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('region.reg_created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('region.reg_created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('region.reg_name', 'like', '%' . $search . '%');
        //         $query->orWhere('region.reg_remarks', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('region.reg_created_at');
        $pagination_number = (empty($ar)) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('region.reg_user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('region.reg_user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')->where('user_id', Auth::user()->id)->select('user_id')
        ->where('company_company_id', $auth->users_company_id)
        ->get();
        $all_created_by = DB::table('users')->whereIn('id', DB::table('region')->pluck('reg_user_id')->all())
        ->where('users_company_id', $auth->users_company_id)
        ->get();
        $all_region = DB::table('region')->whereIn('region_id', DB::table('region')->pluck('region_id')->all())
        ->where('region_company_id', $auth->users_company_id)
        ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_region';
        $pge_title = 'Region List';
        $srch_fltr = [];
        array_push($srch_fltr, $created_by, $from_date, $to_date);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = (isset($request->str)) ? $request->str : '';
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
            } else if ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } else if ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('region.viewRegion', compact(
                'datas',
                'count_row',
                'pge_title',
                'type',
                'region',
                'all_region',
                'created_by',
                'all_created_by',
                'from_date',
                'to_date',
                'reminder'
            ));
        }
    }
    public function store(Request $request)
    {
        // dd(1);
        $auth = Auth::user();
        $this->validate($request, [
            'region' => 'required',
        ]);
        $add_region = new Region;
        $add_region->reg_user_id = Auth::user()->id;
        $add_region->reg_name = $request->input('region');
        $add_region->reg_remarks = $request->input('reg_remarks');
        $add_region->reg_created_at = Carbon::now('Asia/Karachi');
        $add_region->reg_updated_at = Carbon::now('Asia/Karachi');
        $add_region->region_company_id= $auth->users_company_id;
        $add_region->ip_address = $this->get_ip();
        $add_region->os_name = $this->get_os();
        $add_region->browser = $this->get_browsers();
        $add_region->device = $this->get_device();
        $add_region->save();
        return redirect('/viewRegion')->with('success', 'Successfully Created');
    }
    public function edit(Request $request)
    {
        $get_region = Region::find($request->id);
        return view('region.editRegion', compact('get_region'));
    }
    public function update(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'region' => 'required',
        ]);
        $update_region = Region::find($request->id);
        $update_region->reg_user_id = Auth::user()->id;
        $update_region->reg_name = $request->region;
        $update_region->reg_remarks = $request->reg_remarks;
        $update_region->reg_updated_at = Carbon::now('Asia/Karachi');
        $update_region->region_company_id = $auth->users_company_id;
        $update_region->ip_address = $this->get_ip();
        $update_region->os_name = $this->get_os();
        $update_region->browser = $this->get_browsers();
        $update_region->device = $this->get_device();
        $update_region->save();
        return redirect('/viewRegion')->with('success', 'Successfully Updated');
    }
    public function delete(Request $request)
    {
        $auth = Auth::user();
        $area = Area::where('area_region_id', $request->id)
        ->where('area_company_id', $auth->users_company_id)
        ->count();
        $sector = Sector::where('sec_region_id', $request->id)
        ->where('sector_company_id', $auth->users_company_id)
        ->count();
        $company = Company::where('com_region_id', $request->id)
        ->where('company_company_id', $auth->users_company_id)
        ->count();
        if ($area == 0 && $sector == 0 && $company == 0) {
            $del_region = Region::find($request->id);
            $del_region->delete();
            return redirect('/viewRegion')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/viewRegion')->with('error', 'This Region is using on another Table');
        }
    }
    //    public function update_region(Request $request){
    //        $update_region = Region::find($request->region_id);
    //        $update_region->reg_name = $request->region_name;
    //        $update_region->reg_remarks = $request->region_remarks;
    //$update_region->ip_address = $this->get_ip();
    //$update_region->os_name = $this->get_os();
    //$update_region->browser = $this->get_browsers();
    //$update_region->device = $this->get_device();
    //        $update_region->save();
    //
    //        $get_region = DB::table('region')
    //            ->join('users', 'users.id', '=', 'region.reg_user_id')->get();
    //        foreach ($get_region as $region){
    //            echo '<tr>
    //                      <td>'.$region->reg_name.'</td>
    //                      <td>'.$region->reg_remarks.'</td>
    //                      <td>'.$region->name.'</td>
    //                      <td>'.date('d-M-Y', strtotime($region->reg_created_at)).'</td>
    //                      <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#region_'.$region->region_id.'"> Edit </button></td>
    //                      <td><a href=/deleteRegion?id='.$region->region_id.' onclick="return confirm(\'Are you to Delete this data?\');" class="btn btn-danger btn-sm">Delete</a></td>
    //                  </tr>';
    //        }
    //    }
}
