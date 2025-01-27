<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Category;
use App\Models\CatProductGrp;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\Status;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('id', $user)
            ->orWhere('supervisor', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->get()
            ->pluck('id');
        $query = DB::table('category')
            ->where('category_company_id', $auth->users_company_id)
            ->leftJoin('product_group', 'product_group.product_group_id', '=', 'category.cat_product_group_id');
        $query->join('users', 'id', '=', 'category.cat_user_id');
        $query->select('category.*', 'users.name', 'product_group.*');
        $ar = json_decode($request->array);
        $product_group = !isset($request->product_group) && empty($request->product_group) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->product_group;
        $product_category = !isset($request->product_category) && empty($request->product_category) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->product_category;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($product_group)) {
            $query->where('category.cat_product_group_id', '=', $product_group);
        }
        if (!empty($product_category)) {
            $query->where('category.cat_id', '=', $product_category);
        }
        if (!empty($created_by)) {
            $query->where('category.cat_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('category.created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('category.created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('category.created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('product_group.product_group_name', 'like', '%' . $search . '%');
        //         $query->orWhere('category.cat_category', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('category.created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('cat_user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('cat_user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        $count_row = count($datas);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('region')->pluck('reg_user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $all_product_group = DB::table('product_group')
            ->where('product_group_company_id', $auth->users_company_id)
            ->get();
        $all_product_category = DB::table('category')
            ->whereIn('cat_id', DB::table('category')->pluck('cat_id')->all())
            ->where('category_company_id', $auth->users_company_id)
            ->get();
        $product_group_array = [];
        $cat_product_group_id = [];
        foreach ($datas as $key => $group_id) {
            $product_group_array[] = explode(',', $group_id->cat_product_group_id);
            $cat_product_group_id[$group_id->cat_id] = DB::table('product_group')
                ->whereIn('product_group_id', $product_group_array[$key])
                ->get('product_group_name');
        }

        //            PRINT
        $prnt_page_dir = 'print.pages.p_product_category';
        $pge_title = 'Product Category List';
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
            return view('category.index', compact('datas', 'count_row', 'pge_title', 'type', 'product_category', 'all_product_category', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder', 'cat_product_group_id', 'product_group', 'all_product_group'));
        }
    }

    //    public function index(Request $request){
    //        $user = Auth::user()->id;
    //        $userID = DB::table('users')->where('id', $user)->orWhere('supervisor', $user)->get()->pluck('id');
    //        $query = DB::table('category');
    ////            ->join('product_group', 'product_group.product_group_id', '=', 'category.cat_product_group_id')
    //        $query->leftJoin('cat_product_grp', 'cat_product_grp.product_cat_id', '=', 'category.cat_id');
    //        $query->leftJoin('product_group', 'product_group.product_group_id', '=', 'cat_product_grp.product_grp_id');
    //        $query->join('users', 'id', '=', 'category.cat_user_id');
    //        $query->select('users.name', 'product_group.*', 'cat_product_grp.*', 'category.*');
    ////        dd($query->get());
    //        $product_group_name = DB::table('cat_product_grp')
    //            ->get()
    //            ->pluck('product_cat_id')
    //            ->groupBy('product_cat_id');
    //
    ////        dd($product_group_name);
    //        $group1 = [];
    //        foreach ($product_group_name as $key => $item1){
    ////            dd($key);
    //            $group1[] = DB::table('product_group')->whereIn('product_group_id', $product_group_name[$key])->get('product_group_name')->toArray();
    //        }
    ////        dd($group1);
    ////        dd($product_group_name);
    //
    //
    //
    ////        dd($product_group);
    //
    //
    //        $ar = json_decode($request->array);
    //        $product_group = (!isset($request->product_group) && empty($request->product_group)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->product_group;
    //        $product_category = (!isset($request->product_category) && empty($request->product_category)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->product_category;
    //        $created_by = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->created_by;
    //        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->from_date;
    //        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->to_date;
    //        $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->search;
    //        if (!empty($product_group)){
    //            $query->where('category.cat_product_group_id', '=', $product_group);
    //        }
    //        if (!empty($product_category)){
    //            $query->where('category.cat_id', '=', $product_category);
    //        }
    //        if (!empty($created_by)){
    //            $query->where('category.cat_user_id', '=', $created_by);
    //        }
    //        if (!empty($from_date)){
    //            $query->where('category.created_at', '>=', date($from_date));
    //        }
    //        if (!empty($to_date)){
    //            $query->where('category.created_at', '<=', date($to_date));
    //        }
    //        if (!empty($search)) {
    //            $query->where(function ($query) use ($search) {
    //                $query->orWhere('category.created_at', 'like', '%' . $search . '%');
    //                $query->orWhere('product_group.product_group_name', 'like', '%' . $search . '%');
    //                $query->orWhere('category.cat_category', 'like', '%' . $search . '%');
    //                $query->orWhere('name', 'like', '%' . $search . '%');
    //            });
    //        }
    //        $query->orderByDesc('category.created_at');
    //        $pagination_number = (empty($ar)) ? 30 : 100000000;
    //        if(Auth::user()->role == 'Supervisor'){
    //            $query->whereIn('cat_user_id', $userID);
    //        }
    //        if(Auth::user()->role == 'Sale Person'){
    //            $query->where('cat_user_id', $user);
    //        }
    //        $datas = $query->paginate($pagination_number);
    //        $count_row = count($datas);
    //        $reminder = DB::table('company')->where('user_id', Auth::user()->id)->select('user_id')->get();
    //        $all_created_by = DB::table('users')->whereIn('id', DB::table('region')->pluck('reg_user_id')->all())->get();
    //        $all_product_group = DB::table('product_group')->get();
    //        $all_product_category = DB::table('category')->whereIn('cat_id', DB::table('category')->pluck('cat_id')->all())->get();
    ////        $product_group_array = [];
    ////        $cat_product_group_id = [];
    ////        foreach ($datas as $key => $group_id){
    ////            $product_group_array[] = explode(',', $group_id->cat_product_group_id);
    ////            $cat_product_group_id[$group_id->cat_id] = DB::table('product_group')->whereIn('product_group_id', $product_group_array[$key])->get('product_group_name');
    ////        }
    ////        dd($cat_product_group_id);
    //
    //        $cat_product_grp = DB::table('cat_product_grp')
    //            ->join('category', 'category.cat_id', '=', 'cat_product_grp.product_cat_id')->pluck('product_grp_id');
    ////        dd($cat_product_grp);
    ////            PRINT
    //        $prnt_page_dir = 'print.pages.p_product_category';
    //        $pge_title = 'Product Category List';
    //        $srch_fltr = [];
    //        array_push($srch_fltr, $created_by, $from_date, $to_date, $search);
    //        $type = '';
    //        if (isset($request->array) && !empty($request->array)) {
    //            $type = (isset($request->str)) ? $request->str : '';
    //            $footer = view('print._partials.pdf_footer')->render();
    //            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
    //            $options = [
    //                'footer-html' => $footer,
    //                'header-html' => $header,
    //            ];
    //            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
    //            $pdf->setOptions($options);
    //            if( $type === 'pdf') {
    //                return $pdf->stream($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_pdf') {
    //                return $pdf->download($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_excel') {
    //                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title.'_x.xlsx');
    //            }
    //        }
    //        else {
    //            return view('category.index', compact('datas','count_row', 'pge_title', 'type', 'product_category', 'all_product_category',
    //                'created_by', 'all_created_by', 'from_date', 'to_date', 'search', 'reminder', 'product_group', 'all_product_group'));
    //        }
    //    }

    public function create()
    {
        $auth = Auth::user();
        $product_group = ProductGroup::where('product_group_company_id', $auth->users_company_id)->get();
        return view('category.createCat', compact('product_group'));
    }
    public function store(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'category' => 'required',
            'product_group' => 'required',
        ]);
        $category = explode(',', implode(',', $request->input('category')));
        for ($i = 0; $i < count($category); $i++) {
            $add_cat = new Category();
            $add_cat->cat_product_group_id = $request->product_group;
            $add_cat->category_company_id = $auth->users_company_id;
            $add_cat->cat_category = $category[$i];
            $add_cat->cat_user_id = Auth::user()->id;
            $add_cat->created_at = Carbon::now('Asia/Karachi');
            $add_cat->updated_at = Carbon::now('Asia/Karachi');
            $add_cat->ip_address = $this->get_ip();
            $add_cat->os_name = $this->get_os();
            $add_cat->browser = $this->get_browsers();
            $add_cat->device = $this->get_device();
            $add_cat->save();
        }
        //        $category_last_id = DB::table('category')->orderByDesc('cat_id')->first('cat_id');
        //        for ($i = 0; $i < count($request->product_group); $i++){
        //            $cat_product_grp = new CatProductGrp();
        //            $cat_product_grp->product_cat_id = $category_last_id->cat_id;
        //            $cat_product_grp->product_grp_id = $request->product_group[$i];
        //            $cat_product_grp->save();
        //        }
        return redirect('/category')->with('success', 'Successfully Added');
    }
    public function edit(Request $request)
    {
        $auth = Auth::user();
        $product_group = ProductGroup::where('product_group_company_id', $auth->users_company_id)->get();
        $edit_category = Category::where('category_company_id', $auth->users_company_id)->find($request->id);
        return view('category.editCat', compact('edit_category', 'product_group'));
    }
    public function update(Request $request)
    {
        $auth = Auth::user();
        // dd($request->all());
        $update_cat = Category::find($request->id);
        $update_cat->cat_user_id = Auth::user()->id;
        // $product_group = isset($request->product_group) && is_array($request->product_group) ? $request->product_group : [];
        $update_cat->cat_product_group_id = $request->product_group;
        // $update_cat->cat_product_group_id = implode(',', $request->product_group);
        $update_cat->cat_category = $request->category;
        $update_cat->category_company_id = $auth->users_company_id;
        $update_cat->updated_at = Carbon::now('Asia/Karachi');
        $update_cat->ip_address = $this->get_ip();
        $update_cat->os_name = $this->get_os();
        $update_cat->browser = $this->get_browsers();
        $update_cat->device = $this->get_device();
        $update_cat->save();
        return redirect('/category')->with('success', 'Successfully Updated');
    }
    public function delete(Request $request)
    {
        $auth = Auth::user();
        $product = DB::table('product')
            ->where('product_company_id', $auth->users_company_id)
            ->where('cat_id', $request->id)
            ->count();
        $funnel = DB::table('funnel')
            ->where('funnel_company_id', $auth->users_company_id)
            ->where('category_id', $request->id)
            ->count();
        $sale_invoice = DB::table('sale_invoice')
            ->where('sale_invoice_company_id', $auth->users_company_id)
            ->where('category_id', $request->id)
            ->count();
        $order_purposal = DB::table('order_purposal')
            ->where('order_purposal_company_id', $auth->users_company_id)
            ->where('order_purposal_category_id', $request->id)
            ->count();
        if ($product == 0 && $funnel == 0 && $sale_invoice == 0 && $order_purposal == 0) {
            $delete_cat = Category::find($request->id);
            $delete_cat->delete();
            return redirect('/category')->with('success', 'Successfully Deleted');
        }
        return redirect('/category')->with('error', 'This Category is using on another Table');
    }
}
