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
use App\Models\CompanyPocProfile;
use App\Models\ExpiryDate;
use App\Models\QuotationsApproval;
use App\Models\quotations_approval;
use App\Models\TandC;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuotationsController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $business_profile = BusinessProfile::where('business_profile_company_id', $auth->users_company_id)->get();
        $all_tandc = TandC::where('term_and_condition_company_id', $auth->users_company_id)->get();
        $comp = DB::table('company')->where('company_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $comp->where('company.user_id', session('id'));
        } else {
            $comp->where('company.user_id', Auth::user()->id);
        }
        $comp = $comp->get();
        $prod = DB::table('product')
            ->where('product_company_id', $auth->users_company_id)
            ->join('product_price', 'product_price_product_id', '=', 'product.id')
            ->join('unit', 'unit.unit_id', '=', 'product.product_unit')
            ->where('product_status', 1)
            ->get();
        // dd($prod);
        $category = Category::where('category_company_id', $auth->users_company_id)->get();
        $days = ExpiryDate::where('expiry_days_company_id', $auth->users_company_id)->get();

        return view('Quotations.index', compact('comp', 'prod', 'category', 'business_profile', 'days', 'all_tandc'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'subject' => 'required',
            'comp_id' => 'required',
            'date' => 'required',
            'poc' => 'required',
            'quotation_remarks' => 'required',
        ]);

        $this->assignValue($request);

        return redirect('/quotations')->with('success', 'Saved Successfully');
    }
    public function assignValue($request, $version = '')
    {
        $auth = Auth::user();
        $days = ExpiryDate::where('expiry_days_company_id', $auth->users_company_id)->pluck('days');
        $expiry_date = '';

        foreach ($days as $day) {
            $newDateTime = Carbon::now()->addDays($day);
            $expiry_date = $newDateTime;
        }

        $invoice_no = Invoice::latest()
            ->where('invoice_company_id', $auth->users_company_id)
            ->pluck('invoice_no')
            ->first();
        $invoice_no += 1;
        $last_id = Invoice::where('invoice_company_id', $auth->users_company_id)->count();

        $inv = new Invoice();
        $inv->subject = $request->subject;
        $inv->unique_id = $last_id + 1 . '-' . $request->unique_id;

        $inv->version = $version != '' ? $version : 1;
        $inv->invoice_no = $invoice_no;
        $inv->expiry_date = $expiry_date;
        if ($auth->role == 'Tele Caller') {
            $inv->user_id = session('id');
        } else {
            $inv->user_id = Auth::user()->id;
        }

        $inv->company_id = $request->input('comp_id');
        $inv->inv_date = $request->input('date');
        $inv->tandc_id = $request->input('tandc');
        $inv->poc_id = $request->input('poc');
        $inv->grand_total = $request->input('grand_total');
        $inv->quotation_remarks = $request->input('quotation_remarks');
        $inv->invoice_company_id = $auth->users_company_id;
        $inv->created_at = Carbon::now('Asia/Karachi');
        $inv->updated_at = Carbon::now('Asia/Karachi');
        $inv->ip_address = $this->get_ip();
        $inv->os_name = $this->get_os();
        $inv->browser = $this->get_browsers();
        $inv->device = $this->get_device();
        $inv->save();

        $invoice_id = Invoice::select('id')
            ->where('invoice_company_id', $auth->users_company_id)
            ->orderBy('id', 'desc')
            ->first();
        $input = $request->all();
        for ($i = 0; $i <= count($input['qty']); $i++) {
            if (empty($input['qty'][$i]) || !is_numeric($input['qty'][$i])) {
                continue;
            }
            $sale_invoice = new SaleInvoice();
            if ($auth->role == 'Tele Caller') {
                $sale_invoice->user_id = session('id');
            } else {
                $sale_invoice->user_id = Auth::user()->id;
            }
            $sale_invoice->inv_id = $invoice_id->id;
            $sale_invoice->payment_type = $input['payment_type'][$i];
            // $sale_invoice->date = $input['sale_invoice_date'][$i];
            $sale_invoice->product_id = $input['prod_id'][$i];
            $sale_invoice->sale = $input['sale'][$i];
            $sale_invoice->qty = $input['qty'][$i];
            $sale_invoice->total_amount = $input['amount'][$i];
            $sale_invoice->category_id = $input['category'][$i];
            $sale_invoice->sale_invoice_company_id = $auth->users_company_id;
            $sale_invoice->created_at = Carbon::now('Asia/Karachi');
            $sale_invoice->updated_at = Carbon::now('Asia/Karachi');
            $sale_invoice->ip_address = $this->get_ip();
            $sale_invoice->os_name = $this->get_os();
            $sale_invoice->browser = $this->get_browsers();
            $sale_invoice->device = $this->get_device();
            $sale_invoice->save();
        }
    }
    public function versionqoutation(Request $request)
    {
        $auth = Auth::user();
        $invoice = Invoice::join('company_poc_profile', 'company_poc_profile.com_poc_profile_id', '=', 'invoice.poc_id')
            ->select('invoice.*', 'company_poc_profile.com_poc_profile_name as poc_name')
            ->where('invoice_company_id', $auth->users_company_id)
            ->where('id', $request->id)
            ->first();
        // dd($invoice);
        $last_version = Invoice::where('invoice_company_id', $auth->users_company_id)->count();
        if ($invoice->expiry_date >= Carbon::now()->isoFormat('YYYY-MM-DD')) {
            $last_version += 1;
            // return Product::all();
            $invoice_items = SaleInvoice::leftJoin('category', 'category.cat_id', '=', 'sale_invoice.category_id')
                ->leftjoin('product', 'product.id', '=', 'sale_invoice.product_id')
                ->leftjoin('unit', 'unit.unit_id', '=', 'product.product_unit')
                ->leftjoin('product_price', 'product_price.product_price_product_id', '=', 'sale_invoice.product_id')
                ->where('inv_id', $request->id)
                ->where('sale_invoice_company_id', $auth->users_company_id)
                ->select('sale_invoice.*', 'category.cat_category AS category_name', 'product.product_name', 'product.description', 'product_price.product_price_purchase', 'unit.unit_name')
                ->get();
            // dd($invoice_items);

            $business_profile = BusinessProfile::where('business_profile_company_id', $auth->users_company_id)->first();
            $comp = DB::table('company')->where('company_company_id', $auth->users_company_id);
            if ($auth->role == 'Tele Caller') {
                $comp->where('company.user_id', session('id'));
            } else {
                $comp->where('company.user_id', Auth::user()->id);
            }
            $comp = $comp->get();
            $prod = DB::table('product')
                ->join('product_price', 'product_price_product_id', '=', 'product.id')
                ->join('unit', 'unit.unit_id', '=', 'product.product_unit')
                ->join('status', 'sta_id', '=', 'product.product_status')
                ->where('product_company_id', $auth->users_company_id)
                ->where('status.sta_status', '=', 'Active')
                ->get();
            $category = Category::where('category_company_id', $auth->users_company_id)->get();
            $all_tandc = TandC::where('term_and_condition_company_id', $auth->users_company_id)->get();
            $poc = CompanyPocProfile::where('company_poc_profile_company_id', $auth->users_company_id);
            if ($auth->role == 'Tele Caller') {
                $poc->where('com_poc_profile_user_id', session('id'));
            }
            $poc = $poc->get();
            return view('Quotations.quotation_version', compact('comp', 'prod', 'category', 'business_profile', 'invoice', 'invoice_items', 'last_version', 'all_tandc', 'poc'));
        } else {
            dd('OFF');
        }
    }

    public function store_version(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        // $version = Invoice::where('unique_id', $request->unique_id)->latest()->pluck('version')->first();
        $invoice = Invoice::where('unique_id', $request->unique_id)
            ->where('invoice_company_id', $auth->users_company_id)
            ->latest()
            ->first();

        $version = $invoice->version + 1;
        $expiry_date = $invoice->expiry_date;
        // dd($expiry_date);
        // dd(Carbon::now()->isoFormat('YYYY-MM-DD'), $expiry_date);

        $this->assignVersionValue($request, $version, $expiry_date);

        return redirect('/quotations')->with('success', 'New Version Created Successfully');
    }

    public function assignVersionValue($request, $version = '', $expiry_date)
    {
        // dd($request->all());
        $auth = Auth::user();
        $invoice_no = Invoice::latest()
            ->where('invoice_company_id', $auth->users_company_id)
            ->pluck('invoice_no')
            ->first();
        $invoice_no += 1;
        // $last_id = Invoice::count();
        $inv = new Invoice();
        $inv->subject = $request->subject;
        $inv->unique_id = $request->unique_id;
        $inv->version = $version != '' ? $version : 1;
        $inv->invoice_no = $invoice_no;
        $inv->expiry_date = $expiry_date;
        $inv->version_use = $request->p_version;
        if ($auth->role == 'Tele Caller') {
            $inv->user_id = session('id');
        } else {
            $inv->user_id = Auth::user()->id;
        }
        $inv->company_id = $request->input('comp_id');
        $inv->inv_date = $request->input('date');
        $inv->tandc_id = $request->input('tandc');
        $inv->poc_id = $request->input('poc');
        $inv->grand_total = $request->input('grand_total');
        $inv->quotation_remarks = $request->input('quotation_remarks');
        $inv->invoice_company_id = $auth->users_company_id;
        $inv->created_at = Carbon::now('Asia/Karachi');
        $inv->updated_at = Carbon::now('Asia/Karachi');
        $inv->ip_address = $this->get_ip();
        $inv->os_name = $this->get_os();
        $inv->browser = $this->get_browsers();
        $inv->device = $this->get_device();
        $inv->save();

        $invoice_id = Invoice::select('id')
            ->where('invoice_company_id', $auth->users_company_id)
            ->orderBy('id', 'desc')
            ->first();
        $input = $request->all();
        for ($i = 0; $i <= count($input['qty']); $i++) {
            if (empty($input['qty'][$i]) || !is_numeric($input['qty'][$i])) {
                continue;
            }
            $sale_invoice = new SaleInvoice();
            if ($auth->role == 'Tele Caller') {
                $sale_invoice->user_id = session('id');
            } else {
                $sale_invoice->user_id = Auth::user()->id;
            }
            $sale_invoice->inv_id = $invoice_id->id;
            $sale_invoice->payment_type = $input['payment_type'][$i];
            // $sale_invoice->date = $input['sale_invoice_date'][$i];
            $sale_invoice->product_id = $input['prod_id'][$i];
            $sale_invoice->sale = $input['sale'][$i];
            $sale_invoice->qty = $input['qty'][$i];
            $sale_invoice->total_amount = $input['amount'][$i];
            $sale_invoice->category_id = $input['category'][$i];
            $sale_invoice->sale_invoice_company_id = $auth->users_company_id;
            $sale_invoice->created_at = Carbon::now('Asia/Karachi');
            $sale_invoice->updated_at = Carbon::now('Asia/Karachi');
            $sale_invoice->ip_address = $this->get_ip();
            $sale_invoice->os_name = $this->get_os();
            $sale_invoice->browser = $this->get_browsers();
            $sale_invoice->device = $this->get_device();
            $sale_invoice->save();
        }
        $Update_link = Invoice::where('id', $request->id)
            ->where('invoice_company_id', $auth->users_company_id)
            ->latest()
            ->first();
        if ($Update_link->link == null) {
            $Update_link->link = $Update_link->link . $inv->version;
        } else {
            $Update_link->link = $Update_link->link . ',' . $inv->version;
        }
        $Update_link->save();
    }
    public function allqoutations(Request $request, $array = null, $str = null)
    {
        // dd($request->all());
        $auth = Auth::user();
        $current_date = Carbon::now()->isoFormat('YYYY-MM-DD');
        $user = Auth::user()->id;
        $exp_date = Carbon::now()->isoFormat('YYYY-MM-DD');
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->orWhere('id', $user)
            ->get()
            ->pluck('id');
        // $query = DB::table('invoice')->where('expiry_date', '<', $exp_date);
        $query = DB::table('invoice')->where('invoice_company_id', $auth->users_company_id);
        $query->join('users', 'users.id', '=', 'invoice.user_id');
        $query->join('company', 'company.id', '=', 'invoice.company_id');
        $query->leftjoin('company_poc_profile', 'company_poc_profile.com_poc_profile_id', '=', 'invoice.poc_id');
        $query->leftjoin('quotations_approval', 'quotations_approval.inv_id', '=', 'invoice.id');
        $query->select('invoice.*', 'users.name', 'users.mob', 'users.address', 'company.company_name', 'company.comp_email', 'company.comp_mobile_no', 'invoice.user_id as invoice_user_id', 'invoice.id as invoice_id', 'company_poc_profile.com_poc_profile_name as poc_name', 'quotations_approval.status', 'quotations_approval.refuse_remarks');
        // $query->get();
        if ($auth->role == 'Tele Caller') {
            $query->where('invoice.user_id', session('id'));
        }
        $business_profile = BusinessProfile::where('business_profile_company_id', $auth->users_company_id)->first();
        $ar = json_decode($request->array);
        // dd($ar);
        $subject_id = !isset($request->subject_id) && empty($request->subject_id) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->subject_id;
        $pocs = !isset($request->pocs) && empty($request->pocs) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->pocs;
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->created_by;
        $expiry_from_date = !isset($request->expiry_from_date) && empty($request->expiry_from_date) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->expiry_from_date;
        $expiry_to_date = !isset($request->expiry_to_date) && empty($request->expiry_to_date) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->expiry_to_date;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[6]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[7]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[8]->{'value'} : '') : $request->search;
        if (!empty($subject_id)) {
            $query->where('invoice.unique_id', '=', $subject_id);
        }
        if (!empty($pocs)) {
            $query->where('invoice.poc_id', '=', $pocs);
        }
        if (!empty($companies)) {
            $query->where('invoice.company_id', '=', $companies);
        }
        if (!empty($created_by)) {
            $query->where('invoice.user_id', '=', $created_by);
        }
        if (!empty($expiry_from_date)) {
            $query->whereDate('invoice.expiry_date', '>=', date($expiry_from_date));
        }
        if (!empty($expiry_to_date)) {
            $query->whereDate('invoice.expiry_date', '<=', date($expiry_to_date));
        }
        if (!empty($from_date)) {
            $query->whereDate('invoice.inv_date', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('invoice.inv_date', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('company_name', 'like', '%' . $search . '%');
        //         $query->orWhere('invoice.date', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //         $query->orWhere('invoice.unique_id', 'like', '%' . $search . '%');
        //         $query->orWhere('invoice.poc_id', 'like', '%' . $search . '%');
        //         $query->orWhere('invoice.expiry_date', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('invoice.inv_date');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('invoice.user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('invoice.user_id', '=', $user);
        }
        $datas = $query->paginate($pagination_number);
        // dd($datas);
        $reminder = DB::table('invoice')
            ->where('user_id', Auth::user()->id)
            ->where('invoice_company_id', $auth->users_company_id)
            ->select('user_id')
            ->get();
        $all_companies = Company::where('company_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_companies->where('company.user_id', session('id'));
        } else {
            $all_companies->whereIn('id', Invoice::where('user_id', $user)->pluck('unique_id')->all());
        }
        $all_companies = $all_companies->get();
        // dd($all_companies);
        $all_subject_id = Invoice::where('invoice_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_subject_id->where('invoice.user_id', session('id'));
        } else {
            $all_subject_id->whereIn('id', Invoice::where('user_id', $user)->pluck('unique_id')->all());
        }
        $all_subject_id = $all_subject_id->get();
        $all_poc = CompanyPocProfile::where('company_poc_profile_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_poc->where('com_poc_profile_user_id', session('id'));
        } else {
            $all_poc->whereIn('com_poc_profile_id', Invoice::where('user_id', $user)->pluck('poc_id')->all());
        }
        $all_poc = $all_poc->get();
        $all_created_by = DB::table('users')
            ->where('users_company_id', $auth->users_company_id);
            if ($auth->role == 'Tele Caller') {
                $all_created_by->where('id', session('id'));
            }else{
                $all_created_by->whereIn('id', Invoice::where('user_id', $user)->pluck('unique_id')->all());
            }
            $all_created_by = $all_created_by->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_quotations';
        // $content_prnt_page_dir = 'print.pages.p_quotations_content';
        $pge_title = 'Invoice List';
        $pge_title_content = 'Invoice';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date, $pocs, $subject_id, $expiry_from_date);
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
            $pdf_content = PDF::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title', 'business_profile'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'content_pdf') {
                $pdf_content->setPaper('A4', 'Landscape');
                return $pdf_content->stream($pge_title_content . '_x.pdf');
            } elseif ($type === 'content_download_pdf') {
                $pdf_content->setPaper('A4', 'Landscape');
                return $pdf_content->download($pge_title_content . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('Quotations.all_quotations', compact('datas', 'count_row', 'pge_title', 'type', 'companies', 'subject_id', 'created_by', 'from_date', 'to_date', 'reminder', 'all_companies', 'all_created_by', 'current_date', 'all_subject_id', 'business_profile', 'all_poc', 'pocs', 'expiry_from_date', 'expiry_to_date'));
        }
    }

    public function delete(Request $request)
    {
        $auth = Auth::user();
        //        $sale_invoice = SaleInvoice::where('inv_id', $request->id)->count();
        $order = Order::where('invoice_id', $request->id)
            ->where('order_company_id', $auth->users_company_id)
            ->count();
        $remarks = Remarks::where('remarks_purposal_id', $request->id)
            ->where('remarks_company_id', $auth->users_company_id)
            ->count();
        $reminder = Reminder::where('reminder_purposal_id', $request->id)
            ->where('reminder_company_id', $auth->users_company_id)
            ->count();

        //        if ($sale_invoice == 0 && $order == 0 && $remarks == 0 && $reminder == 0){
        if ($order == 0 && $remarks == 0 && $reminder == 0) {
            $del_invoice = Invoice::find($request->id);
            $del_invoice->delete();
            $del_sale_invoice = SaleInvoice::where('inv_id', $request->id)->delete();
            //            $del_sale_invoice->delete();
            return redirect('/quotations')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/quotations')->with('error', 'This Invoice is using on another Table');
        }
    }
    public function approval_quotations(Request $request)
    {
        // dd($request->all());
        $user = Auth::user()->id;
        $quot_approval = new QuotationsApproval();
        $quot_approval->inv_id = $request->id;
        $quot_approval->user_id = $user;
        $quot_approval->remarks = $request->approval_remarks;
        $quot_approval->request_time = Carbon::now();
        $quot_approval->save();
        return redirect('/quotations')->with('success', 'Approval Request Submitted');
    }
    public function approval_date(Request $request)
    {
        // dd($request->all());
        $user = Auth::user()->id;
        $Update_status = QuotationsApproval::where('id', $request->id)->first();
        $Update_status->status = 'Approved';
        $Update_status->approve_time = Carbon::now();
        $Update_status->approved_by = $user;
        $Update_status->save();
        $update_date = Invoice::where('id', $Update_status->inv_id)->first();
        $days = ExpiryDate::pluck('days');
        $expiry_date = '';
        foreach ($days as $day) {
            $newDateTime = Carbon::now()->addDays($day);
            $expiry_date = $newDateTime;
        }
        $update_date->expiry_date = $expiry_date;
        $update_date->save();
        return redirect()->back();
    }
    public function refuse_approval(Request $request)
    {
        // dd($request->all());
        $user = Auth::user()->id;
        $Update_status = QuotationsApproval::where('id', $request->id)->first();
        $Update_status->status = 'Refused';
        $Update_status->refuse_time = Carbon::now();
        $Update_status->refused_by = $user;
        $Update_status->refuse_remarks = $request->refuse_remarks;
        $Update_status->save();
        // $update_date = Invoice::where('id', $Update_status->inv_id)->first();
        // $days = ExpiryDate::pluck('days');
        // $expiry_date = '';
        // foreach ($days as $day) {

        //     $newDateTime = Carbon::now()->addDays($day);
        //     $expiry_date = $newDateTime;
        // }
        // $update_date->expiry_date = $expiry_date;
        // $update_date->save();
        return redirect()->back();
    }
    public function approvals(Request $request)
    {
        // $user = Auth::user()->id;
        // $userID = DB::table('users')->where('id', $user)->pluck('supervisor');
        // if (Auth::user()->role == "Admin") {
        //     $get_sector = Sector::all();
        //     $business_category = BusinessCategory::all();
        //     return view('company.addComp', compact('get_sector', 'business_category'));
        // } elseif (Auth::user()->role == "Supervisor") {
        //     $get_sector = Sector::whereIn('sec_user_id', $userID)->orWhere('sec_user_id', $user)->get();
        //     $business_category = BusinessCategory::all();
        //     return view('company.addComp', compact('get_sector', 'business_category'));
        // } elseif (Auth::user()->role == "Sale Person") {
        //     $get_supervisor = DB::table('users')
        //         ->where('id', Auth::user()->id)->pluck('supervisor');
        //     $get_sector = Sector::where('sec_user_id', $user)
        //         //                ->orwhere('sec_user_id', '1')
        //         ->get();
        //     // dd($get_sector);
        //     $business_category = BusinessCategory::where('business_category_user_id', $user)
        //         //                ->orwhere('sec_user_id', '1')
        //         ->get();
        //     return view('company.addComp', compact('get_sector', 'business_category'));
        // }
        // dd(123);
        $user = Auth::user()->id;
        $auth = Auth::user();
        // dd($user);
        // $userID = DB::table('users')->where('supervisor', $user)->orWhere('id', $user)->get()->pluck('id');
        $userID = User::where('supervisor', $user)->pluck('id');
        // dd($userID);
        if (Auth::user()->role == 'Admin') {
            $approvals = QuotationsApproval::join('users', 'quotations_approval.user_id', '=', 'users.id')
                ->join('invoice', 'quotations_approval.inv_id', '=', 'invoice.id')
                ->where('quotations_approval_company_id', $auth->users_company_id)
                ->select('quotations_approval.*', 'users.name', 'invoice.unique_id')
                ->get();
            // dd($approvals);
            return view('Quotations.qoutations_approvals', compact('approvals'));
        } elseif (Auth::user()->role == 'Supervisor') {
            $approvals = QuotationsApproval::join('users', 'quotations_approval.user_id', '=', 'users.id')
                ->whereIn('user_id', $userID)
                ->where('status', 'PENDING')
                ->where('quotations_approval_company_id', $auth->users_company_id)
                ->select('quotations_approval.*', 'users.name')
                ->get();
            // dd($approvals);
            return view('Quotations.qoutations_approvals', compact('approvals'));
        } elseif (Auth::user()->role == 'Sale Person') {
        }

        // if (Auth::user()->role == 'Sale Person') {
        //     $approvals->where('invoice.user_id', '=', $user);
        // }
        // dd($approvals);
        // $approvals = quotations_approval::all();
        return view('Quotations.qoutations_approvals', compact('approvals'));
    }
    //    view order invoices

    public function view_qoutations(Request $request)
    {
        $auth = Auth::user();
        $dummy_data = '';
        $get_invoices = DB::table('sale_invoice')
            ->join('product', 'product.id', '=', 'sale_invoice.product_id')
            ->join('unit', 'unit.unit_id', '=', 'product.product_unit')
            ->join('invoice', 'invoice.id', '=', 'sale_invoice.inv_id')
            ->where('sale_invoice.inv_id', '=', $request->invoice_id)
            ->where('sale_invoice_company_id', $auth->users_company_id)
            ->get();
        $count_row = count($get_invoices);
        if (count($get_invoices) > 0) {
            foreach ($get_invoices as $key => $invoices) {
                $table_row[] = '<tr><td>' . ($key + 1) . '</td><td>' . $invoices->product_name . '<br>' . $invoices->description . '</td><td>' . $invoices->qty . '</td><td>' . $invoices->unit_name . '</td><td>' . $invoices->sale . '</td><td>' . number_format($invoices->total_amount, 2) . '</td></tr>';
            }
            $grand_total = '<tr><td colspan="4"></td><td><b class="float-right">Grand Total: </b></td><td><b>' . number_format($invoices->grand_total, 2) . '</b></td></tr>';
            // $get_info = DB::table('invoice')
            //     ->join('company', 'company.id', '=', 'invoice.company_id')
            //     ->leftjoin('company_poc_profile', 'company_poc_profile.com_poc_profile_id', '=', 'invoice.poc_id')
            //     ->where('invoice.id', '=', $request->invoice_id)
            //     ->select('invoice.subject', 'invoice.version', 'invoice.unique_id', 'invoice.date', 'company.company_name', 'company.comp_email', 'company.comp_mobile_no', 'company_poc_profile.com_poc_profile_name AS poc_name')
            //     ->get();
            // dd($get_info);
            $invoice_date = DB::table('invoice')
                ->where('invoice_company_id', $auth->users_company_id)
                ->where('invoice.id', '=', $request->invoice_id)
                ->first();

            // $get_uom = SaleInvoice::leftjoin('product', 'sale_invoice.product_id', '=', 'product.id')
            //     ->leftjoin('unit', 'product.product_unit', '=', 'unit.unit_id')
            //     ->select('sale_invoice.*', 'product.product_unit', 'unit.unit_name')->get();
            // dd($get_uom);
        } else {
            $dummy_data = 'No Data Found';
        }
        $categories_id = SaleInvoice::select('category_id')
            ->where('inv_id', $request->invoice_id)
            ->where('sale_invoice_company_id', $auth->users_company_id)
            ->get();
        $categories = Category::select('cat_id', 'cat_category')
            ->whereIn('cat_id', $categories_id)
            ->where('category_company_id', $auth->users_company_id)
            ->get();
        $my_category = '<option selected value="0">All</option>';
        foreach ($categories as $category) {
            $my_category .= '<option value="' . $category->cat_id . '">' . $category->cat_category . '</option>';
        }
        $products_id = SaleInvoice::select('product_id')
            ->where('sale_invoice_company_id', $auth->users_company_id)
            ->where('inv_id', $request->invoice_id)
            ->get();
        $products = Product::select('id', 'product_name')
            ->where('product_company_id', $auth->users_company_id)
            ->whereIn('id', $products_id)
            ->get();
        $my_product = '<option selected value="0">All</option>';
        foreach ($products as $product) {
            $my_product .= '<option value="' . $product->id . '">' . $product->product_name . '</option>';
        }
        $term_id = Invoice::where('id', $request->invoice_id)
            ->where('invoice_company_id', $auth->users_company_id)
            ->pluck('tandc_id')
            ->first();
        $terms_ids = explode(',', $term_id);
        // // dd($terms_id);
        $getting_terms = TandC::whereIn('tandc_id', $terms_ids)
            ->where('term_and_condition_company_id', $auth->users_company_id)
            ->get(['tandc_title', 'tandc_description']);
        // dd($terms, $getting_terms);
        return response()->json(compact('count_row', 'table_row', 'grand_total', 'invoice_date', 'dummy_data', 'my_category', 'my_product', 'getting_terms'));
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

    // Farhad
    // public function get_products(Request $request)
    // {
    //     $search = $request->filter;

    //     if (!empty($search)) {
    //         $items = DB::table('product');
    //         $items->where(function ($items) use ($search) {
    //             $items->where('product_name', 'like', '%' . $search . '%');
    //             // ->orWhere('product', 'like', '%' . $search . '%')
    //             // ->orWhere('p_code', 'like', '%' . $search . '%')
    //             // ->orWhere('clubbing', 'like', '%' . $search . '%');
    //         });
    //         $item = $items->orderBy('product_name', 'ASC')->get();
    //         return response()->json($item);
    //     }
    // }
}
