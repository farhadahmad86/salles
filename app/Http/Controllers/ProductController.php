<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Category;
use App\Models\Company;
use App\Models\OrderPurposal;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\ProductPrice;
use App\Models\SaleInvoice;
use App\Models\Status;
use App\Models\Unit;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->get()
            ->pluck('id');
        $query = DB::table('product')->where('product_company_id', $auth->users_company_id);
        $query->join('users', 'users.id', '=', 'product.user_id');
        $query->join('unit', 'unit.unit_id', '=', 'product.product_unit');
        $query->join('product_group', 'product_group.product_group_id', '=', 'product.pro_group_id');
        $query->join('category', 'category.cat_id', '=', 'product.cat_id');
        $query->select('product.*', 'users.name', 'product_group.product_group_name', 'category.cat_category', 'unit.*');
        $ar = json_decode($request->array);
        $product_group = !isset($request->product_group) && empty($request->product_group) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->product_group;
        $product_category = !isset($request->product_category) && empty($request->product_category) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->product_category;
        $product = !isset($request->product) && empty($request->product) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->product;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->to_date;
        $unit = !isset($request->unit) && empty($request->unit) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->unit;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($product_group)) {
            $query->where('product.pro_group_id', '=', $product_group);
        }
        if (!empty($product_category)) {
            $query->where('product.cat_id', '=', $product_category);
        }
        if (!empty($product)) {
            $query->where('product.id', '=', $product);
        }
        if (!empty($unit)) {
            $query->where('unit.unit_id', '=', $unit);
        }
        if (!empty($created_by)) {
            $query->where('product.user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('product.created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('product.created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('category.cat_category', 'like', '%' . $search . '%');
        //         $query->orWhere('product.product_name', 'like', '%' . $search . '%');
        //         $query->orWhere('product.description', 'like', '%' . $search . '%');
        //         $query->orWhere('product.created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('status.sta_status', 'like', '%' . $search . '%');
        //         $query->orWhere('unit.unit_name', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('product.created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('product.user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('product.user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('product')->pluck('user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $all_product_category = DB::table('category')
            ->whereIn('cat_id', DB::table('product')->pluck('cat_id')->all())
            ->where('category_company_id', $auth->users_company_id)
            ->get();
        $all_product = DB::table('product')
            ->whereIn('id', DB::table('product')->pluck('id')->all())
            ->where('product_company_id', $auth->users_company_id)
            ->get();
        $all_unit = DB::table('unit')
            ->whereIn('unit_id', DB::table('unit')->pluck('unit_id')->all())
            ->where('unit_company_id', $auth->users_company_id)
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_product';
        $pge_title = 'Product List';
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
            return view('product.index', compact('datas', 'count_row', 'pge_title', 'type', 'product_category', 'all_product_category', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder', 'product', 'all_product', 'all_unit', 'unit'));
        }
    }

    public function create()
    {
        $auth = Auth::user();
        $categories = Category::where('category_company_id', $auth->users_company_id)->get();
        // $status = Status::all();
        $unit = Unit::where('unit_company_id', $auth->users_company_id)->get();
        $pro_group = ProductGroup::where('product_group_company_id', $auth->users_company_id)->get();
        return view('product.createPro', compact('categories', 'unit', 'pro_group'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'pro_group' => 'required',
            'category' => 'required',
            'productName' => 'required',
            'unit' => 'required',
            //            'purchase' => 'required',
            //            'sale' => 'required',
            'description' => 'required',
        ]);
        $storeProduct = new Product();
        $storeProduct->user_id = Auth::user()->id;
        $storeProduct->pro_group_id = $request->input('pro_group');
        $storeProduct->cat_id = $request->input('category');
        $storeProduct->product_unit = $request->input('unit');
        $storeProduct->product_company_id = $auth->users_company_id;
        $storeProduct->product_name = $request->input('productName');
        $storeProduct->description = $request->input('description');
        $storeProduct->created_at = Carbon::now('Asia/Karachi');
        $storeProduct->updated_at = Carbon::now('Asia/Karachi');
        $storeProduct->ip_address = $this->get_ip();
        $storeProduct->os_name = $this->get_os();
        $storeProduct->browser = $this->get_browsers();
        $storeProduct->device = $this->get_device();
        $storeProduct->save();
        //            $storeProduct->purchase = $request->input('purchase');
        //            $storeProduct->product_status = $request->input('prod_status');
        //            $storeProduct->sale = $request->input('sale');
        return redirect('/product');
    }

    public function edit(Request $request)
    {
        $auth = Auth::user();
        $edit = Product::find($request->id);
        $categories = Category::where('category_company_id', $auth->users_company_id)->get();
        $unit = Unit::where('unit_company_id', $auth->users_company_id)->get();
        // $status = Status::where('users_company_id', $auth->users_company_id)->get();
        $pro_group = ProductGroup::where('product_group_company_id', $auth->users_company_id)->get();
        return view('product.editPro', compact('edit', 'categories', 'unit', 'pro_group'));
    }

    public function update(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'category' => 'required',
            'productName' => 'required',
            'unit' => 'required',
            //            'purchase' => 'required',
            //            'sale' => 'required',
            'description' => 'required',
        ]);
        $storeProduct = Product::find($request->id);
        $storeProduct->cat_id = $request->input('category');
        $storeProduct->product_unit = $request->input('unit');
        $storeProduct->product_status = $request->input('prod_status');
        $storeProduct->product_name = $request->input('productName');
        $storeProduct->product_company_id = $auth->users_company_id;
        $storeProduct->description = $request->input('description');
        $storeProduct->updated_at = Carbon::now('Asia/Karachi');
        $storeProduct->ip_address = $this->get_ip();
        $storeProduct->os_name = $this->get_os();
        $storeProduct->browser = $this->get_browsers();
        $storeProduct->device = $this->get_device();
        $storeProduct->save();
        //        $storeProduct->cat_id = json_encode($request->input('category'));
        //        $storeProduct->purchase = $request->input('purchase');
        //        $storeProduct->sale = $request->input('sale');
        return redirect('/product');
    }

    public function delete(Request $request)
    {
        $auth = Auth::user();
        $sale_invoice = SaleInvoice::where('product_id', $request->id)
            ->where('sale_invoice_company_id', $auth->users_company_id)
            ->count();
        $order_purposal = OrderPurposal::where('order_purposal_product_id', $request->id)
            ->where('order_purposal_company_id', $auth->users_company_id)
            ->count();
        //        $product_price = ProductPrice::where('product_price_product_id', $request->id)->count();
        if ($sale_invoice == 0 && $order_purposal == 0) {
            $del_product = Product::find($request->id);
            $del_product->delete();
            $del_product_price = ProductPrice::where('product_price_product_id', $request->id)->delete();
            return redirect('/product')->with('success', 'Successfully Deleted');
        }
        return redirect('/product')->with('error', 'This Product is using on another Table');
    }

    public function changeStatus(Request $request)
    {
        $auth = Auth::user();
        // dd($request->all());

        $user = Product::where('product_company_id', $auth->users_company_id)->find($request->user_id);
        $user->product_status = $request->status;
        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
