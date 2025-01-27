<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\MainUnit;
use App\Models\Unit;
use App\Models\Product;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UnitController extends Controller
{
    public function uom(Request $request)
    {
        $auth = Auth::user();
        $query = DB::table('unit')->where('unit_company_id', $auth->users_company_id);
        $query->join('users', 'users.id', '=', 'unit.unit_user_id');
        $query->join('main_unit', 'main_unit.main_unit_id', '=', 'unit.unit_main_unit_id');
        $ar = json_decode($request->array);
        $main_unit = !isset($request->main_unit) && empty($request->main_unit) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->main_unit;
        $unit = !isset($request->unit) && empty($request->unit) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->unit;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($main_unit)) {
            $query->where('unit.unit_main_unit_id', '=', $main_unit);
        }
        if (!empty($unit)) {
            $query->where('unit.unit_id', '=', $unit);
        }
        if (!empty($created_by)) {
            $query->where('unit.unit_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('unit.unit_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('unit.unit_created_at', '<=', date($to_date));
        }
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('main_unit.main_unit_name', 'like', '%' . $search . '%');
                $query->orWhere('unit.unit_name', 'like', '%' . $search . '%');
                // $query->orWhere('unit.unit_scale_size', 'like', '%' . $search . '%');
                $query->orWhere('unit.unit_remarks', 'like', '%' . $search . '%');
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('unit.unit_created_at', 'like', '%' . $search . '%');
            });
        }
        $query->orderByDesc('unit.unit_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('region')->pluck('reg_user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $all_unit = DB::table('unit')
            ->whereIn('unit_id', DB::table('unit')->pluck('unit_id')->all())
            ->where('unit_company_id', $auth->users_company_id)
            ->get();
        $all_main_unit = DB::table('main_unit')
            ->whereIn('main_unit_id', DB::table('unit')->pluck('unit_main_unit_id')->all())
            ->where('main_unit_company_id', $auth->users_company_id)
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_uom';
        $pge_title = 'Unit List';
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
            return view('unit.uom', compact('datas', 'count_row', 'pge_title', 'type', 'main_unit', 'all_main_unit', 'unit', 'all_unit', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder'));
        }
    }

    public function uomCreate()
    {
        $auth = Auth::user();
        $main_unit = DB::table('main_unit')
            ->where('main_unit_company_id', $auth->users_company_id)
            ->get();
        return view('unit.uomCreate', compact('main_unit'));
    }

    public function uomStore(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'main_unit' => 'required',
            'unit_name' => 'required',
        ]);
        $data = new Unit();
        $data->unit_user_id = Auth::user()->id;
        $data->unit_main_unit_id = $request->input('main_unit');
        $data->unit_name = $request->input('unit_name');
        $data->unit_company_id = $auth->users_company_id;
        // $data->unit_scale_size = $request->input('unit_scale_size');
        $data->unit_remarks = $request->input('unit_remarks');
        $data->unit_created_at = Carbon::now('Asia/Karachi');
        $data->unit_updated_at = Carbon::now('Asia/Karachi');
        $data->ip_address = $this->get_ip();
        $data->os_name = $this->get_os();
        $data->browser = $this->get_browsers();
        $data->device = $this->get_device();
        $data->save();
        return redirect('/uom')->with('success', 'Successfully Inserted');
    }

    public function uomEdit(Request $request)
    {
        $auth = Auth::user();
        $main_unit = DB::table('main_unit')
            ->where('main_unit_company_id', $auth->users_company_id)
            ->get();
        $data = DB::table('unit')
            ->where('unit_company_id', $auth->users_company_id)
            ->where('unit_id', $request->id)
            ->first();
        return view('unit.uomEdit', compact('main_unit', 'data'));
    }

    public function uomUpdate(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'main_unit' => 'required',
            'unit_name' => 'required',
        ]);
        $data = Unit::find($request->id);
        $data->unit_user_id = Auth::user()->id;
        $data->unit_main_unit_id = $request->input('main_unit');
        $data->unit_name = $request->input('unit_name');
        $data->unit_company_id = $auth->users_company_id;
        // $data->unit_scale_size = $request->input('unit_scale_size');
        $data->unit_remarks = $request->input('unit_remarks');
        $data->unit_created_at = Carbon::now('Asia/Karachi');
        $data->unit_updated_at = Carbon::now('Asia/Karachi');
        $data->ip_address = $this->get_ip();
        $data->os_name = $this->get_os();
        $data->browser = $this->get_browsers();
        $data->device = $this->get_device();
        $data->save();
        return redirect('/uom')->with('success', 'Successfully Updated');
    }

    public function uomDelete(Request $request)
    {
        $auth = Auth::user();
        $product = Product::where('product_unit', $request->id)
        ->where('product_company_id', $auth->users_company_id)
        ->count();
        if ($product == 0) {
            $delete = Unit::find($request->id);
            $delete->delete();
            return redirect('/uom')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/uom')->with('error', 'This Main Unit is using on another Table');
        }
    }
}
