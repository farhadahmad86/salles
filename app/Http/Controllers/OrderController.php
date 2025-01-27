<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\BusinessProfile;
use App\Models\Category;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderPurposal;
use App\Models\Product;
use App\Models\Remarks;
use App\Models\Reminder;
use App\Models\SaleInvoice;
use App\Models\TandC;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use function React\Promise\all;

class OrderController extends Controller
{
    public function index(Request $request, $array = null, $str = null)
    {
        $user = Auth::user()->id;
        $auth = Auth::user();
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->orWhere('id', $user)
            ->pluck('id')
            ->all();
        $query = DB::table('order')->where('order_company_id', $auth->users_company_id);
        $query->join('users', 'users.id', '=', 'order.user_id');
        $query->join('company', 'company.id', '=', 'order.company_id');
        $query->select('order.*', 'users.*', 'company.*', 'order.created_at as order_created_at', 'order.user_id as order_user_id', 'order.id as order_id', 'order.user_id as inv_user_id');
        if ($auth->role == 'Tele Caller') {
            $query->where('order.user_id', session('id'));
        }
        $ar = json_decode($request->array);
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('order.created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('order.created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('order.company_id', '=', $companies);
        }
        if (!empty($created_by)) {
            $query->where('order.user_id', '=', $created_by);
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('company_name', 'like', '%' . $search . '%');
        //         $query->orWhere('order.sale_date', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //         $query->orWhere('order.created_at', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('order.created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('order.user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('order.user_id', '=', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('order')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->where('order_company_id', $auth->users_company_id)
            ->get();
        $all_companies = DB::table('company')->where('company_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_companies->where('company.user_id', session('id'));
        } else {
            $all_companies->whereIn('id', Invoice::where('user_id', $user)->pluck('unique_id')->all());
        }
        $all_companies = $all_companies->get();
        $all_created_by = DB::table('users')->where('users_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_created_by->where('id', session('id'));
        } else {
            $all_created_by->whereIn('id', Invoice::where('user_id', $user)->pluck('unique_id')->all());
        }
        $all_created_by = $all_created_by->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_order';
        $pge_title = 'Order List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date);
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
            return view('order.index', compact('datas', 'count_row', 'pge_title', 'type', 'companies', 'created_by', 'from_date', 'to_date', 'reminder', 'all_companies', 'all_created_by'));
        }
    }
    public function create()
    {
        $auth = Auth::user();
        $business_profile = BusinessProfile::where('business_profile_company_id', $auth->users_company_id)->first();
        $comp_name = DB::table('company')->where('company_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $comp_name->where('company.user_id', session('id'));
        } else {
            $comp_name->where('company.user_id', Auth::user()->id);
        }
        $comp_name = $comp_name->get();
        // dd($comp_name);
        $quotations = Invoice::where('invoice_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $quotations->where('user_id', session('id'));
        } else {
            $quotations->where('user_id', Auth::user()->id);
        }
        $quotations = $quotations->groupBy('unique_id');
        $quotations = $quotations->get();
        // dd($quotations);
        $all_tandc = TandC::where('term_and_condition_company_id', $auth->users_company_id)->get();
        $all_product = DB::table('product')
            ->join('product_price', 'product_price_product_id', '=', 'product.id')
            ->join('unit', 'unit.unit_id', '=', 'product.product_unit')
            ->join('status', 'sta_id', '=', 'product.product_status')
            ->where('product_company_id', $auth->users_company_id)
            ->where('status.sta_status', '=', 'Active')
            ->get();
        $category = Category::where('category_company_id', $auth->users_company_id)->get();
        return view('order.createOrder', compact('comp_name', 'quotations', 'all_product', 'all_tandc', 'business_profile', 'category'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $this->validate($request, [
            'date' => 'required',
            'comp_id' => 'required',
            // 'purposal_list' => 'required',
            'qty' => 'required',
            'sale' => 'required',
            'amount' => 'required',
            'prod_id' => 'required',
        ]);
        $order_no = Order::latest()->pluck('order_no')->first();
        $order_no += 1;
        $add_order = new Order();
        $add_order->order_no = $order_no;
        if ($auth->role == 'Tele Caller') {
            $add_order->user_id = session('id');
        } else {
            $add_order->user_id = Auth::user()->id;
        }
        $add_order->invoice_id = $request->input('purposal_list');
        $add_order->company_id = $request->input('comp_id');
        $add_order->sale_date = $request->input('date');
        $add_order->grand_total = $request->input('grand_total');
        $add_order->order_company_id = $auth->users_company_id;
        $add_order->tandc_id = $request->input('tandc');
        $add_order->created_at = Carbon::now('Asia/Karachi');
        $add_order->updated_at = Carbon::now('Asia/Karachi');
        $add_order->ip_address = $this->get_ip();
        $add_order->os_name = $this->get_os();
        $add_order->browser = $this->get_browsers();
        $add_order->device = $this->get_device();
        $add_order->save();

        $order_last_id = Order::select('id')
            ->orderBy('id', 'desc')
            ->where('order_company_id', $auth->users_company_id)
            ->first();
        for ($i = 0; $i < count($request->qty); $i++) {
            $add_order_purposal = new OrderPurposal();
            $add_order_purposal->order_purposal_order_id = $order_last_id->id;
            if ($auth->role == 'Tele Caller') {
                $add_order_purposal->order_purposal_user_id = session('id');
            } else {
                $add_order_purposal->order_purposal_user_id = Auth::user()->id;
            }
            $add_order_purposal->order_purposal_date = $request->input('date');
            $add_order_purposal->order_purposal_company_id = $request->input('date');
            $add_order_purposal->order_purposal_payment_type = $request->input(['payment_type'])[$i];
            $add_order_purposal->order_purposal_product_id = $auth->users_company_id;
            $add_order_purposal->order_purposal_qty = $request->input(['qty'])[$i];
            $add_order_purposal->order_purposal_sale = $request->input(['sale'])[$i];
            $add_order_purposal->order_purposal_category_id = $request->input(['category'])[$i];
            $add_order_purposal->order_purposal_total_amount = $request->input(['amount'])[$i];
            $add_order_purposal->order_purposal_pro_description = $request->input(['prod_description'])[$i];
            $add_order_purposal->order_purposal_created_at = Carbon::now('Asia/Karachi');
            $add_order_purposal->order_purposal_updated_at = Carbon::now('Asia/Karachi');
            $add_order_purposal->ip_address = $this->get_ip();
            $add_order_purposal->os_name = $this->get_os();
            $add_order_purposal->browser = $this->get_browsers();
            $add_order_purposal->device = $this->get_device();
            $add_order_purposal->save();
        }
        return redirect('/order')->with('success', 'Successfully Added');
    }
    public function edit(Request $request)
    {
        $auth = Auth::user();
        $compName = Company::where('company_company_id', $auth->users_company_id)();
        $edit = DB::table('company')
            ->join('order', 'order.company_id', '=', 'company.id')
            ->where('company_company_id', $auth->users_company_id)
            ->where('order.id', '=', $request->id)
            ->first();
        $orderInfo = Order::find($request->id);
        return view('order.editOrder', compact('edit', 'compName', 'orderInfo'));
    }
    public function update(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'date' => 'required',
            'comp_id' => 'required',
            'poc' => 'required',
            'mob' => 'required',
            'email' => 'required',
            'mrc' => 'required',
            'otc' => 'required',
            'status' => 'required',
        ]);
        $storeOrder = Order::find($request->id);
        $storeOrder->sale_date = $request->input('date');
        $storeOrder->company_id = $request->input('comp_id');
        $storeOrder->poc = $request->input('poc');
        $storeOrder->mob = $request->input('mob');
        $storeOrder->email = $request->input('email');
        $storeOrder->mrc = $request->input('mrc');
        $storeOrder->otc = $request->input('otc');
        $storeOrder->order_company_id = $auth->users_company_id;
        $storeOrder->status = $request->input('status');
        $storeOrder->updated_at = Carbon::now('Asia/Karachi');
        $storeOrder->ip_address = $this->get_ip();
        $storeOrder->os_name = $this->get_os();
        $storeOrder->browser = $this->get_browsers();
        $storeOrder->device = $this->get_device();
        $storeOrder->save();

        return redirect('/order')->with('success', 'Successfully Updated');
    }
    public function delete(Request $request)
    {
        $auth = Auth::user();
        //        $order_purposal = OrderPurposal::where('order_purposal_order_id', $request->id)->count();
        $remarks = Remarks::where('remarks_order_id', $request->id)
            ->where('remarks_company_id', $auth->users_company_id)
            ->count();
        $reminder = Reminder::where('reminder_order_id', $request->id)
            ->where('reminder_company_id', $auth->users_company_id)
            ->count();
        //        if ($order_purposal == 0 && $remarks == 0 && $reminder == 0){
        if ($remarks == 0 && $reminder == 0) {
            $del_order = Order::find($request->id);
            $del_order->delete();
            // $del_purposal = OrderPurposal::where('order_purposal_order_id', $request->id)->delete();
            //            $del_purposal->delete();
            return redirect('/order')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/order')->with('error', 'This Order is using on another Table');
        }
    }
    //getting purposals list after click on company id
    public function get_purposal(Request $request)
    {
        //        return $request->company_id;
        $auth = Auth::user();
        $purposal_list = DB::table('invoice')
            ->join('company', 'company.id', '=', 'invoice.company_id')
            ->select('invoice.*', 'company.*', 'company.id as comp_id', 'company.user_id as comp_user_id', 'invoice.version as invoice_id')
            ->where('unique_id', $request->company_id)
            ->where('invoice_company_id', $auth->users_company_id)
            ->get();
        // dd($purposal_list,$request->company_id);
        echo '<option disabled selected hidden>Choose...</option>';
        foreach ($purposal_list as $list) {
            echo '<option value="' . $list->invoice_id . '">' . $list->invoice_id . '</option>';
        }
    }
    //getting all purposal after click on purposal dropdown item
    public function purposal_lists(Request $request)
    {
        $purposal_row_num = 0;
        $purposal_lists = DB::table('sale_invoice')
            ->join('product', 'product.id', '=', 'sale_invoice.product_id')
            ->join('product_price', 'product_price_product_id', '=', 'product.id')
            ->where('inv_id', '=', $request->order_porposal_id)
            ->get();
        foreach ($purposal_lists as $purposal) {
            $return_purposal_lists[] =
                '
                <input type="hidden" value="' .
                $purposal->product_price_purchase .
                '" class="' .
                $purposal_row_num .
                ' p_botm' .
                $purposal_row_num .
                '">
                <input type="hidden" name="prod_id[]" value="' .
                $purposal->product_id .
                '" class="' .
                $purposal_row_num .
                ' p_prod' .
                $purposal_row_num .
                '" form="create_order">
                <input type="hidden" name="payment_type[]" value="' .
                $purposal->payment_type .
                '" class="' .
                $purposal_row_num .
                ' payment_type' .
                $purposal_row_num .
                '" form="create_order">
                <input type="hidden" name="prod_description[]" value="' .
                htmlspecialchars($purposal->description) .
                '" class="' .
                $purposal_row_num .
                ' p_prod_desc' .
                $purposal_row_num .
                '" form="create_order">
                <input type="hidden" name="qty[]" value="' .
                $purposal->qty .
                '" class="' .
                $purposal_row_num .
                ' p_category' .
                $purposal_row_num .
                '" form="create_order">
                <input type="hidden" name="category[]" value="' .
                $purposal->category_id .
                '" class="' .
                $purposal_row_num .
                ' p_qty' .
                $purposal_row_num .
                '" form="create_order">
                <input type="hidden" name="sale[]" value="' .
                $purposal->product_price_sale .
                '" class="' .
                $purposal_row_num .
                ' p_sale' .
                $purposal_row_num .
                '" form="create_order">
                <input type="hidden" name="amount[]" value="' .
                $purposal->total_amount .
                '" class="' .
                $purposal_row_num .
                ' p_amount' .
                $purposal_row_num .
                '" form="create_order">
                <tr><td>' .
                $purposal->product_name .
                '<br>' .
                $purposal->description .
                '</td><td>' .
                $purposal->qty .
                '</td><td>' .
                $purposal->product_price_sale .
                '</td><td>' .
                $purposal->total_amount .
                '</td><td>' .
                $purposal->payment_type .
                '</td>
                <td class="rmv1"><button class="btn btn-primary btn-sm" onclick="edit_order_row(this,' .
                $purposal_row_num .
                ')">Edit</button></td>
                <td class="rmv1"><button class="btn btn-danger btn-sm" onclick="delete_order_row(this,' .
                $purposal_row_num .
                ')">Remove</button></td></tr>';
            $purposal_row_num++;
        }
        $product_id = DB::table('sale_invoice')
            ->join('product', 'product.id', '=', 'sale_invoice.product_id')
            ->where('inv_id', '=', $request->order_porposal_id)
            ->get()
            ->pluck('product_id');
        return response()->json(compact('return_purposal_lists', 'product_id'));
    }
    //    view order invoices
    public function view_order(Request $request)
    {
        $dummy_data = '';
        $table_row = [];
        $count_row = '';
        $grand_total = '';
        $company_name = '';
        $order_date = '';
        $get_order_invoices = DB::table('order_purposal')
            ->join('product', 'product.id', '=', 'order_purposal.order_purposal_product_id')
            ->join('order', 'order.id', '=', 'order_purposal.order_purposal_order_id')
            ->join('category', 'category.cat_id', '=', 'order_purposal.order_purposal_category_id')
            ->where('order_purposal.order_purposal_order_id', '=', $request->order_id)
            ->get();
        if (count($get_order_invoices) > 0) {
            foreach ($get_order_invoices as $invoices) {
                $table_row[] =
                    '<tr><td>' .
                    $invoices->product_name .
                    '<br>' .
                    $invoices->order_purposal_pro_description .
                    '</td><td>' .
                    $invoices->cat_category .
                    '</td>
                <td class="align-right">' .
                    $invoices->order_purposal_qty .
                    '</td><td class="align-right">' .
                    $invoices->order_purposal_sale .
                    '</td>
                <td class="align-right">' .
                    $invoices->order_purposal_total_amount .
                    '</td><tc>' .
                    $invoices->order_purposal_payment_type .
                    '</tc></tr>';
            }
            $count_row = count($get_order_invoices);
            $grand_total = '<tr><td colspan="3"></td><td><b class="float-right">Grand Total: </b></td><td><b>' . number_format($invoices->grand_total, 2) . '</b></td></tr>';
            $company_name = DB::table('order')
                ->join('company', 'company.id', '=', 'order.company_id')
                ->where('order.id', '=', $request->order_id)
                ->pluck('company_name')
                ->first();
            $order_date = DB::table('order')
                ->where('order.id', '=', $request->order_id)
                ->pluck('sale_date')
                ->first();
        } else {
            $dummy_data = 'No Data Found';
        }
        $categories_id = OrderPurposal::select('order_purposal_category_id')
            ->where('order_purposal_order_id', $request->order_id)
            ->get();
        $categories = Category::select('cat_id', 'cat_category')->whereIn('cat_id', $categories_id)->get();
        $my_category = '<option selected value="0">All</option>';
        foreach ($categories as $category) {
            $my_category .= '<option value="' . $category->cat_id . '">' . $category->cat_category . '</option>';
        }
        $products_id = OrderPurposal::select('order_purposal_product_id')
            ->where('order_purposal_order_id', $request->order_id)
            ->get();
        $products = Product::select('id', 'product_name')->whereIn('id', $products_id)->get();
        $my_product = '<option selected value="0">All</option>';
        foreach ($products as $product) {
            $my_product .= '<option value="' . $product->id . '">' . $product->product_name . '</option>';
        }
        $terms = DB::table('order')
            ->join('term_and_condition', 'term_and_condition.tandc_id', '=', 'order.tandc_id')
            ->select('order.tandc_id as order_tandc_id', 'term_and_condition.tandc_id as term_tandc_id', 'order.*', 'term_and_condition.*')
            ->where('order.id', '=', $request->order_id)
            ->first();
        $terms_id = explode(',', $terms->order_tandc_id);
        $getting_terms = DB::table('term_and_condition')
            ->whereIn('tandc_id', $terms_id)
            ->get(['tandc_title', 'tandc_description']);
        return response()->json(compact('table_row', 'dummy_data', 'count_row', 'grand_total', 'company_name', 'order_date', 'getting_terms', 'my_category', 'my_product'));
        //        return response()->json(compact('get_order_invoices', 'dummy_data'));
    }

    //    public function order_modal_search(Request $request){
    //        $table_row = '';
    //        $grand_total = '';
    //        $company_name = '';
    //        $order_date = '';
    //        $grand_total_amount = 0;
    //        $query = DB::table('order_purposal');
    //        $query->join('product', 'product.id', '=', 'order_purposal.order_purposal_product_id');
    //        $query->join('order', 'order.id', '=', 'order_purposal.order_purposal_order_id');
    //        $query->join('category', 'category.cat_id', '=', 'order_purposal.order_purposal_category_id');
    //        if (isset($request->from_date)){
    //            $query->whereDate('order_purposal.order_purposal_date', '>=', date($request->from_date));
    //        }
    //        if (isset($request->to_date)){
    //            $query->whereDate('order_purposal.order_purposal_date', '<=', date($request->to_date));
    //        }
    //        if ($request->category != 0){
    //            $query->where('order_purposal.order_purposal_category_id', '=', $request->category);
    //        }
    //        if ($request->product != 0){
    //            $query->where('order_purposal.order_purposal_product_id', '=', $request->product);
    //        }
    //        $query->where('order_purposal.order_purposal_order_id', '=', $request->order_id);
    //        $get_invoices = $query->get();
    //        $count_row = count($get_invoices);
    //        if ($count_row >  0){
    //            foreach ($get_invoices as $key => $invoices){
    //                $table_row .= '<tr><td>'.$invoices->product_name.'<br>'.$invoices->order_purposal_pro_description.'</td><td>'.$invoices->cat_category.'</td>
    //                <td class="align-right">'.$invoices->order_purposal_qty.'</td><td class="align-right">'.$invoices->order_purposal_sale.'</td>
    //                <td class="align-right">'.$invoices->order_purposal_total_amount.'</td><tc>'.$invoices->order_purposal_payment_type.'</tc></tr>';
    //                $grand_total_amount += $invoices->order_purposal_total_amount;
    //            }
    //            $grand_total = '<tr><td colspan="4"></td><td><b class="float-right">Grand Total: </b></td><td><b>'.$grand_total_amount.'</b></td></tr>';
    //            $company_name = DB::table('order')
    //                ->join('company', 'company.id', '=', 'order.company_id')
    //                ->where('order.id', '=', $request->order_id)->pluck('company_name')->first();
    //            $order_date = DB::table('order')
    //                ->where('order.id', '=', $request->order_id)->pluck('sale_date')->first();
    //        }
    //        $terms = DB::table('order')
    //            ->join('term_and_condition', 'term_and_condition.tandc_id', '=', 'order.tandc_id')
    //            ->select('order.tandc_id as order_tandc_id', 'term_and_condition.tandc_id as term_tandc_id', 'order.*', 'term_and_condition.*')
    //            ->where('order.id', '=', $request->order_id)->first();
    //        $terms_id = explode(',' , $terms->order_tandc_id);
    //        $getting_terms = DB::table('term_and_condition')
    //            ->whereIn('tandc_id', $terms_id)->get(['tandc_title', 'tandc_description']);
    //        return response(compact('count_row','table_row', 'grand_total', 'company_name', 'order_date', 'order_date', 'getting_terms'));
    //    }
    // getting product list after click on purposal dropdown item
    //    public function get_product_list(Request $request){
    //        $just_product_id = DB::table('sale_invoice')
    //            ->join('product', 'product.id', '=', 'sale_invoice.product_id')
    //            ->where('inv_id', '=', $request->order_porposal_id)
    //            ->get()->pluck('product_id');
    //        $get_product_list = DB::table('product')
    //            ->whereNotIn('id', $just_product_id)->get();
    //        echo $product_lists = '<option selected disabled hidden>Choose Purposal</option>';
    //        foreach ($get_product_list as $list){
    //            echo '<option value="'.$list->id.'">'.$list->product_name.'</option>';
    //        }
    //    }

    //checking query
    //    public function checkQuery(){
    //        $just_product_id = DB::table('sale_invoice')
    //            ->join('product', 'product.id', '=', 'sale_invoice.product_id')
    //            ->where('inv_id', '=', 31)
    //            ->get()->pluck('product_id');
    ////        dd($just_product_id);
    //        $get_product_list = DB::table('product')
    //            ->whereNotIn('id', $just_product_id)->get();
    //        dd($get_product_list);
    //    }
}
