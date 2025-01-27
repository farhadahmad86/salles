<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Category;
use App\Models\OrderPurposal;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\SaleInvoice;
use App\Models\Unit;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProductPriceController extends Controller
{
    public function productPrice(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->get()
            ->pluck('id');
        $query = DB::table('product_price')->where('product_price_company_id', $auth->users_company_id);
        $query->join('product', 'product.id', '=', 'product_price.product_price_product_id');
        $query->join('users', 'users.id', '=', 'product_price.product_price_user_id');
        //        $query->join('unit', 'unit.unit_id', '=', 'product_price.product_price_unit');
        $query->select('product_price.*', 'users.name', 'product.*');
        $ar = json_decode($request->array);
        $product = !isset($request->product) && empty($request->product) ? (!empty($ar) && isset($ar[0]) ? $ar[0]->{'value'} : '') : $request->product;
        $unit = !isset($request->unit) && empty($request->unit) ? (!empty($ar) && isset($ar[1]) ? $ar[1]->{'value'} : '') : $request->unit;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) && isset($ar[2]) ? $ar[2]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) && isset($ar[3]) ? $ar[3]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) && isset($ar[4]) ? $ar[4]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($product)) {
            $query->where('product_price.product_price_product_id', '=', $product);
        }
        if (!empty($unit)) {
            $query->where('product_price.product_price_unit', '=', $unit);
        }
        if (!empty($created_by)) {
            $query->where('product_price.product_price_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('product_price.product_price_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('product_price.product_price_created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('product.product_name', 'like', '%' . $search . '%');
        //         $query->orWhere('product_price.product_price_sale', 'like', '%' . $search . '%');
        //         $query->orWhere('product_price.product_price_unit', 'like', '%' . $search . '%');
        //         $query->orWhere('product_price.product_price_purchase', 'like', '%' . $search . '%');
        //         $query->orWhere('product_price.product_price_created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('product_price.product_price_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('product_price_user_id', $userID);
        }
        if (Auth::user()->role == 'Supervisor') {
            $query->where('product_price_user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->where('company_company_id', $auth->users_company_id)
            ->select('user_id')
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('product_price')->pluck('product_price_user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $all_unit = DB::table('unit')
            ->whereIn('unit_id', DB::table('product_price')->pluck('product_price_unit')->all())
            ->where('unit_company_id', $auth->users_company_id)
            ->get();
        $all_product = DB::table('product')
            ->where('product_company_id', $auth->users_company_id)
            ->whereIn('id', DB::table('product')->pluck('id')->all())
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_productPrice';
        $pge_title = 'Product Price List';
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
            return view('productPrice.productPrice', compact('datas', 'count_row', 'pge_title', 'type', 'product', 'all_product', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder', 'unit', 'all_unit'));
        }
    }

    public function productPriceCreate()
    {
        $auth = Auth::user();
        $unit = DB::table('unit')
            ->where('unit_company_id', $auth->users_company_id)
            ->get();
        $product = Product::where('user_id', Auth::user()->id)
            ->where('product_company_id', $auth->users_company_id)
            ->get();
        return view('productPrice.productPriceCreate', compact('product', 'unit'));
    }

    public function productPriceStore(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'productName' => 'required',
            //            'unit' => 'required',
            'purchase' => 'required',
            'sale' => 'required',
        ]);
        $storeProductPrice = new ProductPrice();
        $storeProductPrice->product_price_user_id = Auth::user()->id;
        //        $storeProductPrice->product_price_unit = $request->input('unit');
        //        $storeProductPrice->cat_id = $request->input('category');
        $storeProductPrice->product_price_product_id = $request->input('productName');
        $storeProductPrice->product_price_company_id = $auth->users_company_id;
        //        $storeProductPrice->description = $request->input('description');
        $storeProductPrice->product_price_purchase = $request->input('purchase');
        //        $storeProductPrice->product_price_status = $request->input('prod_price_status');
        $storeProductPrice->product_price_sale = $request->input('sale');
        $storeProductPrice->product_price_created_at = Carbon::now('Asia/Karachi');
        $storeProductPrice->product_price_updated_at = Carbon::now('Asia/Karachi');
        $storeProductPrice->ip_address = $this->get_ip();
        $storeProductPrice->os_name = $this->get_os();
        $storeProductPrice->browser = $this->get_browsers();
        $storeProductPrice->device = $this->get_device();
        $storeProductPrice->save();
        return redirect('/productPrice')->with('success', 'Successfully Inserted');
    }

    public function productPriceEdit(Request $request)
    {
        $auth = Auth::user();
        $edit = ProductPrice::where('product_price_company_id', $auth->users_company_id)->find($request->id);
        //        $unit = Unit::all();
        $product = DB::table('product')
            ->where('product_company_id', $auth->users_company_id)
            ->get();
        return view('productPrice.productPriceEdit', compact('edit', 'product'));
    }

    public function productPriceUpdate(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            //            'category' => 'required',
            'productName' => 'required',
            //            'unit' => 'required',
            'purchase' => 'required',
            'sale' => 'required',
            //            'description' => 'required'
        ]);
        $storeProductPrice = ProductPrice::find($request->id);
        //        $storeProductPrice->product_price_unit = $request->input('unit');
        //        $storeProductPrice->cat_id = $request->input('category');
        $storeProductPrice->product_price_product_id = $request->input('productName');
        $storeProductPrice->product_price_company_id = $auth->users_company_id;
        //        $storeProductPrice->description = $request->input('description');
        //        $storeProductPrice->cat_id = json_e1ncode($request->input('category'));
        $storeProductPrice->product_price_purchase = $request->input('purchase');
        //        $storeProductPrice->product_price_status = $request->input('prod_status');
        $storeProductPrice->product_price_sale = $request->input('sale');
        $storeProductPrice->product_price_updated_at = Carbon::now('Asia/Karachi');
        $storeProductPrice->ip_address = $this->get_ip();
        $storeProductPrice->os_name = $this->get_os();
        $storeProductPrice->browser = $this->get_browsers();
        $storeProductPrice->device = $this->get_device();
        $storeProductPrice->save();
        return redirect('/productPrice')->with('success', 'Successfully Updated');
    }

    public function productPriceDelete(Request $request)
    {
        $auth = Auth::user();
        //        $sale_invoice = SaleInvoice::where('product_id', $request->id)->count();
        //        $order_purposal = OrderPurposal::where('order_purposal_product_id', $request->id)->count();
        $product = Product::where('id', $request->id)
        ->where('product_company_id', $auth->users_company_id)
        ->count();
        if ($product == 0) {
            $del = ProductPrice::find($request->id);
            $del->delete();
            return redirect('/productPrice')->with('success', 'Successfully Deleted');
        }
        return redirect('/productPrice')->with('error', 'This Product is using on another Table');
    }
}
