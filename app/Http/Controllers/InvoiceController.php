<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\BusinessProfile;
use App\Models\Category;
use App\Models\Funnel;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderPurposal;
use App\Models\ProductPrice;
use App\Models\Remarks;
use App\Models\Reminder;
use App\Models\SaleInvoice;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use http\Env\Response;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index(){
        $business_profile = BusinessProfile::first();
        $comp = DB::table('company')
            ->where('company.user_id', Auth::user()->id)
            ->get();
        $prod = DB::table('product')
            ->join('product_price', 'product_price_product_id', '=', 'product.id')
            ->join('unit', 'unit.unit_id', '=', 'product.product_unit')
            ->join('status', 'sta_id', '=', 'product.product_status')
            ->where('status.sta_status', '=', 'Active')
            ->get();
        $category = Category::all();
        return view('invoice.index', compact('comp', 'prod', 'category', 'business_profile'));
    }
    public function store(Request $request){
        $this->validate($request, [
            'comp_id' => 'required',
            'date' => 'required',
        ]);
        $invoice_no = Invoice::latest()->pluck('invoice_no')->first();
        $invoice_no += 1;
        $inv = new Invoice();
        $inv->invoice_no = $invoice_no;
        $inv->user_id = Auth::user()->id;
        $inv->company_id = $request->input('comp_id');
        $inv->date = $request->input('date');
        $inv->grand_total = $request->input('grand_total');
        $inv->created_at = Carbon::now('Asia/Karachi');
        $inv->updated_at = Carbon::now('Asia/Karachi');
        $inv->ip_address = $this->get_ip();
        $inv->os_name = $this->get_os();
        $inv->browser = $this->get_browsers();
        $inv->device = $this->get_device();
        $inv->save();

        $invoice_id = Invoice::select('id')->orderBy('id','desc')->first();
        $input = $request->all();
        for ($i = 0; $i <= count($input['qty']); $i++) {
            if (empty($input['qty'][$i]) || !is_numeric($input['qty'][$i])) continue;
            $sale_invoice = new SaleInvoice();
            $sale_invoice->user_id = Auth::user()->id;
            $sale_invoice->inv_id = $invoice_id->id;
            $sale_invoice->payment_type = $input['payment_type'][$i];
            $sale_invoice->date = $input['sale_invoice_date'][$i];
            $sale_invoice->product_id = $input['prod_id'][$i];
            $sale_invoice->sale = $input['sale'][$i];
            $sale_invoice->qty = $input['qty'][$i];
            $sale_invoice->total_amount = $input['amount'][$i];
            $sale_invoice->category_id = $input['category'][$i];
            $sale_invoice->created_at = Carbon::now('Asia/Karachi');
            $sale_invoice->updated_at = Carbon::now('Asia/Karachi');
            $sale_invoice->ip_address = $this->get_ip();
            $sale_invoice->os_name = $this->get_os();
            $sale_invoice->browser = $this->get_browsers();
            $sale_invoice->device = $this->get_device();
            $sale_invoice->save();
        }
        return redirect('/allInvoices')->with('success','Saved Successfully');
    }
    public function delete(Request $request){
//        $sale_invoice = SaleInvoice::where('inv_id', $request->id)->count();
        $order = Order::where('invoice_id', $request->id)->count();
        $remarks = Remarks::where('remarks_purposal_id', $request->id)->count();
        $reminder = Reminder::where('reminder_purposal_id', $request->id)->count();

//        if ($sale_invoice == 0 && $order == 0 && $remarks == 0 && $reminder == 0){
        if ($order == 0 && $remarks == 0 && $reminder == 0){
            $del_invoice = Invoice::find($request->id);
            $del_invoice->delete();
            $del_sale_invoice = SaleInvoice::where('inv_id', $request->id)->delete();
//            $del_sale_invoice->delete();
            return redirect('/allInvoices')->with('success', 'Successfully Deleted');
        }else{
            return redirect('/allInvoices')->with('error', 'This Invoice is using on another Table');
        }
    }
    public function allInvoices(Request $request, $array = null, $str = null){
        $user=Auth::user()->id;
        $userID = DB::table('users')->where('supervisor', $user)->orWhere('id',$user)->get()->pluck('id');
        $query = DB::table('invoice');
        $query->join('users', 'users.id', '=', 'invoice.user_id');
        $query->join('company', 'company.id', '=', 'invoice.company_id');
        $query->select('invoice.*', 'users.*', 'company.*', 'invoice.user_id as invoice_user_id', 'invoice.id as invoice_id', 'invoice.user_id as inv_user_id');
        $ar = json_decode($request->array);
        $companies = (!isset($request->companies) && empty($request->companies)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->to_date;
        $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($from_date)){
            $query->whereDate('invoice.created_at', '>=', date($from_date));
        }
        if (!empty($to_date)){
            $query->whereDate('invoice.created_at', '<=', date($to_date));
        }
        if (!empty($companies)){
            $query->where('invoice.company_id', '=', $companies);
        }
        if (!empty($created_by)){
            $query->where('invoice.user_id', '=', $created_by);
        }
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('company_name', 'like', '%' . $search . '%');
                $query->orWhere('invoice.date', 'like', '%' . $search . '%');
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('invoice.created_at', 'like', '%' . $search . '%');
            });
        }
        $query->orderByDesc('invoice.created_at');
        $pagination_number = (empty($ar) ? 30 : 100000000);
        if (Auth::user()->role == 'Supervisor'){
            $query->whereIn('invoice.user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person'){
            $query->where('invoice.user_id', '=', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('invoice')->where('user_id', Auth::user()->id)->select('user_id')->get();
        $all_companies = DB::table('company')
            ->whereIn('id', DB::table('invoice')->pluck('company_id')->all())
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('invoice')->pluck('user_id')->all())
            ->get();
        $count_row = count($datas);
//            PRINT
        $prnt_page_dir = 'print.pages.p_invoice';
        $pge_title = 'Invoice List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date, $search);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = (isset($request->str)) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if( $type === 'pdf') {
                return $pdf->stream($pge_title.'_x.pdf');
            }
            else if( $type === 'download_pdf') {
                return $pdf->download($pge_title.'_x.pdf');
            }
            else if( $type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title.'_x.xlsx');
            }
        }
        else {
            return view('invoice.allInvoices', compact('datas', 'count_row', 'pge_title', 'type', 'companies', 'created_by',
                'from_date', 'to_date', 'search', 'reminder', 'all_companies', 'all_created_by'));
        }
    }

    //    view order invoices
    public function view_invoice(Request $request){
        $dummy_data = '';
        $get_invoices = DB::table('sale_invoice')
            ->join('product', 'product.id', '=', 'sale_invoice.product_id')
            ->join('category', 'category.cat_id', '=', 'sale_invoice.category_id')
            ->join('invoice', 'invoice.id', '=', 'sale_invoice.inv_id')
            ->where('sale_invoice.inv_id', '=', $request->invoice_id)->get();
        $count_row = count($get_invoices);
        if (count($get_invoices) >  0){
            foreach ($get_invoices as $key => $invoices){
                $table_row[] = '<tr><td>'.($key+1).'</td><td>'.$invoices->cat_category.'</td><td>'.$invoices->product_name.'</td><td>'.$invoices->qty.'</td><td>'.$invoices->sale.'</td><td>'.$invoices->total_amount.'</td></tr>';
            }
            $grand_total = '<tr><td colspan="4"></td><td><b class="float-right">Grand Total: </b></td><td><b>'.number_format($invoices->grand_total,2).'</b></td></tr>';
            $company_name = DB::table('invoice')
                ->join('company', 'company.id', '=', 'invoice.company_id')
                ->where('invoice.id', '=', $request->invoice_id)->pluck('company_name')->first();
            $invoice_date = DB::table('invoice')
                ->where('invoice.id', '=', $request->invoice_id)->pluck('date')->first();
        }else{
            $dummy_data = 'No Data Found';
        }
        $categories_id = SaleInvoice::select('category_id')->where('inv_id', $request->invoice_id)->get();
        $categories = Category::select('cat_id', 'cat_category')->whereIn('cat_id', $categories_id)->get();
        $my_category = '<option selected value="0">All</option>';
        foreach ($categories as $category) {
            $my_category .= '<option value="'.$category->cat_id.'">'.$category->cat_category.'</option>';
        }
        $products_id = SaleInvoice::select('product_id')->where('inv_id', $request->invoice_id)->get();
        $products = Product::select('id', 'product_name')->whereIn('id', $products_id)->get();
        $my_product = '<option selected value="0">All</option>';
        foreach ($products as $product) {
            $my_product .= '<option value="'.$product->id.'">'.$product->product_name.'</option>';
        }
        return response()->json(compact('count_row','table_row', 'grand_total', 'company_name', 'invoice_date', 'dummy_data', 'my_category', 'my_product'));
    }

//    public function invoice_modal_search(Request $request){
//        $table_row = '';
//        $grand_total = '';
//        $company_name = '';
//        $invoice_date = '';
//        $grand_total_amount = 0;
//        $query = DB::table('sale_invoice');
//            $query->join('product', 'product.id', '=', 'sale_invoice.product_id');
//            $query->join('category', 'category.cat_id', '=', 'sale_invoice.category_id');
//            $query->join('invoice', 'invoice.id', '=', 'sale_invoice.inv_id');
//            if (isset($request->from_date)){
//                $query->whereDate('sale_invoice.date', '>=', date($request->from_date));
//            }
//            if (isset($request->to_date)){
//                $query->whereDate('sale_invoice.date', '<=', date($request->to_date));
//            }
//            if ($request->category != 0){
//                $query->where('sale_invoice.category_id', '=', $request->category);
//            }
//            if ($request->product != 0){
//                $query->where('sale_invoice.product_id', '=', $request->product);
//            }
//            $query->where('sale_invoice.inv_id', '=', $request->invoice_id);
//            $get_invoices = $query->get();
//        $count_row = count($get_invoices);
//        if ($count_row >  0){
//            foreach ($get_invoices as $key => $invoices){
//                $table_row .= '<tr><td>'.($key+1).'</td><td>'.$invoices->cat_category.'</td><td>'.$invoices->product_name.'</td><td>'.$invoices->qty.'</td><td>'.$invoices->sale.'</td><td>'.$invoices->total_amount.'</td></tr>';
//                $grand_total_amount += $invoices->total_amount;
//            }
//            $grand_total = '<tr><td colspan="4"></td><td><b class="float-right">Grand Total: </b></td><td><b>'.$grand_total_amount.'</b></td></tr>';
//            $company_name = DB::table('invoice')
//                ->join('company', 'company.id', '=', 'invoice.company_id')
//                ->where('invoice.id', '=', $request->invoice_id)->pluck('company_name')->first();
//            $invoice_date = DB::table('invoice')
//                ->where('invoice.id', '=', $request->invoice_id)->pluck('date')->first();
//        }
//        return response(compact('count_row','table_row', 'grand_total', 'company_name', 'invoice_date'));
//    }

}
