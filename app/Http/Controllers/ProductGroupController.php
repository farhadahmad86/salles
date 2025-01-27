<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Category;
use App\Models\ProductGroup;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductGroupController extends Controller
{
    public function productGroup(Request $request)
    {
        $auth = Auth::user();
        $query = DB::table('product_group')->where('product_group_company_id', $auth->users_company_id);
        $query->join('users', 'users.id', '=', 'product_group.product_group_user_id');
        $ar = json_decode($request->array);
        $product_group = !isset($request->product_group) && empty($request->product_group) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->product_group;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($product_group)) {
            $query->where('product_group.product_group_id', '=', $product_group);
        }
        if (!empty($created_by)) {
            $query->where('product_group.product_group_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('product_group.product_group_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('product_group.product_group_created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('product_group.product_group_name', 'like', '%' . $search . '%');
        //         $query->orWhere('product_group.product_group_remarks', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //         $query->orWhere('product_group.product_group_created_at', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('product_group.product_group_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $count_row = count($datas);
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('product_group')->pluck('product_group_user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $all_product_group = DB::table('product_group')
            ->whereIn('product_group_id', DB::table('product_group')->pluck('product_group_id')->all())
            ->where('product_group_company_id', $auth->users_company_id)
            ->get();
        //        dd($all_product_group);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_productGroup';
        $pge_title = 'Product Group List';
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
            $pdf = PDF::loadView($prnt_page_dir, compact('datas', 'count_row', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('productGroup.productGroup', compact('datas', 'count_row', 'pge_title', 'type', 'all_product_group', 'product_group', 'created_by', 'all_created_by', 'from_date', 'to_date'));
        }
    }

    public function productGroupCreate()
    {
        return view('productGroup.productGroupCreate');
    }

    public function productGroupStore(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'product_group_name' => 'required',
        ]);
        $data = new ProductGroup();
        $data->product_group_user_id = Auth::user()->id;
        $data->product_group_name = $request->input('product_group_name');
        $data->product_group_remarks = $request->input('product_group_remarks');
        $data->product_group_company_id = $auth->users_company_id;
        $data->product_group_created_at = Carbon::now('Asia/Karachi');
        $data->product_group_updated_at = Carbon::now('Asia/Karachi');
        $data->ip_address = $this->get_ip();
        $data->os_name = $this->get_os();
        $data->browser = $this->get_browsers();
        $data->device = $this->get_device();
        $data->save();
        return redirect('/productGroup')->with('success', 'Successfully Inserted');
    }

    public function productGroupEdit(Request $request)
    {
        $auth = Auth::user();
        $product_group = DB::table('product_group')
            ->where('product_group_company_id', $auth->users_company_id)
            ->get();
        $data = DB::table('product_group')
            ->where('product_group_company_id', $auth->users_company_id)
            ->where('product_group_id', $request->id)
            ->first();
        return view('productGroup.productGroupEdit', compact('product_group', 'data'));
    }

    public function productGroupUpdate(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'product_group_name' => 'required',
        ]);
        $data = ProductGroup::find($request->id);
        $data->product_group_user_id = Auth::user()->id;
        $data->product_group_name = $request->input('product_group_name');
        $data->product_group_remarks = $request->input('product_group_remarks');
        $data->product_group_company_id = $auth->users_company_id;
        $data->product_group_created_at = Carbon::now('Asia/Karachi');
        $data->product_group_updated_at = Carbon::now('Asia/Karachi');
        $data->ip_address = $this->get_ip();
        $data->os_name = $this->get_os();
        $data->browser = $this->get_browsers();
        $data->device = $this->get_device();
        $data->save();
        return redirect('/productGroup')->with('success', 'Successfully Updated');
    }

    public function productGroupDelete(Request $request)
    {
        $auth = Auth::user();
        $product = Category::where('cat_product_group_id', $request->id)
        ->where('category_company_id', $auth->users_company_id)
        ->count();
        if ($product == 0) {
            $delete = ProductGroup::find($request->id);
            $delete->delete();
            return redirect('/productGroup')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/productGroup')->with('error', 'This Product Group is using on another Table');
        }
    }
}
