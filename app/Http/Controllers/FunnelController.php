<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyPocProfile;
use App\Models\CompProfile;
use App\Models\Funnel;
use App\Models\Product;
use App\Models\Schedule;
use App\Models\Status;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FunnelController extends Controller
{
    public function index(Request $request, $array = null, $str = null)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->get()
            ->pluck('id');
        $query = DB::table('funnel')->where('funnel_company_id', $auth->users_company_id);
        $query->join('users', 'users.id', '=', 'funnel.user_id');
        $query->join('company', 'company.id', '=', 'funnel.company_id');
        $query->join('category', 'category.cat_id', '=', 'funnel.category_id');
        $query->select('company.id as compId', 'funnel.id as funId', 'funnel.created_at as funnel_created_at', 'category.*', 'funnel.user_id as funnel_user_id', 'users.id as userId', 'funnel.*', 'users.*', 'company.*');
        if ($auth->role == 'Tele Caller') {
            $query->where('funnel.user_id', session('id'));
        }
        $ar = json_decode($request->array);
        $companies = $request->companies ?? ($ar[0]->{'value'} ?? '');
        $created_by = $request->created_by ?? ($ar[1]->{'value'} ?? '');
        $status = $request->status ?? ($ar[2]->{'value'} ?? '');
        $from_date = $request->from_date ?? ($ar[3]->{'value'} ?? '');
        $to_date = $request->to_date ?? ($ar[4]->{'value'} ?? '');
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('funnel.created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('funnel.created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('funnel.company_id', '=', $companies);
        }
        if (!empty($status)) {
            $query->where('funnel.status_id', '=', $status);
        }
        if (!empty($created_by)) {
            $query->where('funnel.user_id', '=', $created_by);
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('company_name', 'like', '%' . $search . '%');
        //         $query->orWhere('funnel.date', 'like', '%' . $search . '%');
        //         $query->orWhere('otc', 'like', '%' . $search . '%');
        //         $query->orWhere('mrc', 'like', '%' . $search . '%');
        //         $query->orWhere('category_id', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //         $query->orWhere('sta_status', 'like', '%' . $search . '%');
        //         $query->orWhere('status_remarks', 'like', '%' . $search . '%');
        //         $query->orWhere('cat_remarks', 'like', '%' . $search . '%');
        //         $query->orWhere('funnel.created_at', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderBy('funnel.id', 'desc');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('funnel.user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('funnel.user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        // dd($datas);
        $reminder = DB::table('funnel')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->where('funnel_company_id', $auth->users_company_id)
            ->get();
        $all_companies = DB::table('company')
            ->whereIn('id', DB::table('funnel')->pluck('company_id')->all())
            ->where('company_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_companies->where('company.user_id', session('id'));
        }
        $all_companies = $all_companies->get();

        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('funnel')->pluck('user_id')->all())
            ->where('users_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_created_by->where('id', session('id'));
        }
        $all_created_by = $all_created_by->get();

        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_funnel';
        $pge_title = 'Funnel List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $status, $from_date, $to_date);
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
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                $pdf->setPaper('A4', 'Landscape');
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view(
                'funnel.index',
                compact(
                    'datas',
                    'count_row',
                    'pge_title',
                    'type',
                    'companies',
                    'created_by',

                    'from_date',
                    'to_date',
                    'reminder',
                    'all_companies',
                    'all_created_by',
                ),
            );
        }
    }
    public function create()
    {
        // $auth = Auth::user();
        // $user_id = Auth::user()->id;
        // $get_supervisor = DB::table('users')
        //     ->where('users.id', Auth::user()->id)
        //     ->where('users_company_id', $auth->users_company_id)
        //     ->pluck('supervisor')
        //     ->all();
        // array_push($get_supervisor, $user_id);
        // $comp_name = DB::table('company')
        //     ->whereIn('user_id', $get_supervisor)
        //     ->where('company_company_id', $auth->users_company_id)
        //     ->where('user_id', $user_id)
        //     ->get();
        // //        $category = DB::table('category')->whereIn('cat_user_id', $array)->get();
        // $category = DB::table('category')
        //     ->where('category_company_id', $auth->users_company_id)
        //     ->get();
        // return view('funnel.createFunnel', compact('comp_name', 'category'));
        $auth = Auth::user();
        if (Auth::user()->role == 'Admin') {
            $comp_name = DB::table('company')
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $category = DB::table('category')
                ->where('category_company_id', $auth->users_company_id)
                ->get();
            return view('funnel.createFunnel', compact('comp_name', 'category'));
        } elseif (Auth::user()->role == 'Supervisor') {
            $get_supervisor = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('id', Auth::user()->id)
                ->orwhere('supervisor', Auth::user()->id)
                ->pluck('supervisor');
            $comp_name = DB::table('company')
                ->whereIn('user_id', $get_supervisor)
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $category = DB::table('category')
                ->whereIn('cat_user_id', $get_supervisor)
                ->where('category_company_id', $auth->users_company_id)
                ->get();
            return view('funnel.createFunnel', compact('comp_name', 'category'));
        } elseif (Auth::user()->role == 'Sale Person') {
            $get_supervisor = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('id', Auth::user()->id)
                ->orwhere('supervisor', Auth::user()->id)
                ->pluck('supervisor');
            $comp_name = DB::table('company')
                ->where('user_id', Auth::user()->id)
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $category = DB::table('category')
                ->where('category_company_id', $auth->users_company_id)
                ->get();
            return view('funnel.createFunnel', compact('category', 'comp_name'));
        } elseif (Auth::user()->role == 'Tele Caller') {
            $get_supervisor = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('id', session('id'))
                ->orwhere('supervisor', session('id'))
                ->pluck('supervisor');
            $comp_name = DB::table('company')
                ->where('user_id', session('id'))
                ->where('company_company_id', $auth->users_company_id)
                ->get();
            $category = DB::table('category')
                ->where('category_company_id', $auth->users_company_id)
                ->get();
            return view('funnel.createFunnel', compact('comp_name', 'category'));
        }
    }
    public function store(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'date' => 'required',
            'mrc' => 'required',
            'comp_id' => 'required',
            'otc' => 'required',
            'category' => 'required',
        ]);
        $storeFunnel = new Funnel();
        if ($auth->role == 'Tele Caller') {
            $storeFunnel->user_id = session('id');
        } else {
            $storeFunnel->user_id = Auth::user()->id;
        }
        $storeFunnel->company_id = $request->input('comp_id');
        $storeFunnel->category_id = implode(',', $request->input('category'));
        $storeFunnel->date = $request->input('date');
        $storeFunnel->mrc = $request->input('mrc');
        $storeFunnel->status_remarks = $request->input('sta_remarks');
        $storeFunnel->cat_remarks = $request->input('cat_remarks');
        $storeFunnel->otc = $request->input('otc');
        $storeFunnel->created_at = Carbon::now('Asia/Karachi');
        $storeFunnel->updated_at = Carbon::now('Asia/Karachi');
        $storeFunnel->ip_address = $this->get_ip();
        $storeFunnel->os_name = $this->get_os();
        $storeFunnel->browser = $this->get_browsers();
        $storeFunnel->device = $this->get_device();
        $storeFunnel->funnel_company_id = $auth->users_company_id;
        $storeFunnel->save();
        return redirect('/funnel')->with('success', 'Successfully Inserted');
    }
    public function edit(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->get()
            ->pluck('id');
        $all_comp_poc_profile = DB::table('company_poc_profile')
            ->where('company_poc_profile_company_id', $auth->users_company_id)
            ->whereIn('com_poc_profile_user_id', $userID)
            ->get();
        $edit_id = $request->id;
        $all_comp = Company::where('company_company_id', $auth->users_company_id)->get();
        // $all_status = Status::where('funnel_company_id', $auth->users_company_id)->get();
        $all_category = Category::where('category_company_id', $auth->users_company_id)->get();
        $edit = DB::table('funnel')
            ->where('funnel_company_id', $auth->users_company_id)
            ->where('funnel.id', '=', $request->id)
            ->first();
        // dd($edit);
        return view('funnel.editFunnel', compact('edit', 'all_comp', 'all_comp_poc_profile', 'all_category', 'edit_id'));
    }
    public function update(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'date' => 'required',
            'mrc' => 'required',
            'comp_id' => 'required',
            'otc' => 'required',
            // 'cat_remarks' => 'required',
            'category' => 'required',
            // 'sta_remarks' => 'required',
        ]);
        $storeFunnel = Funnel::find($request->id);
        if ($auth->role == 'Tele Caller') {
            $storeFunnel->user_id = session('id');
        } else {
            $storeFunnel->user_id = Auth::user()->id;
        }
        $storeFunnel->company_id = $request->input('comp_id');
        $storeFunnel->category_id = implode(',', $request->input('category'));
        $storeFunnel->date = $request->input('date');
        $storeFunnel->mrc = $request->input('mrc');
        $storeFunnel->status_remarks = $request->input('sta_remarks');
        $storeFunnel->cat_remarks = $request->input('cat_remarks');
        $storeFunnel->otc = $request->input('otc');
        $storeFunnel->updated_at = Carbon::now('Asia/Karachi');
        $storeFunnel->ip_address = $this->get_ip();
        $storeFunnel->os_name = $this->get_os();
        $storeFunnel->browser = $this->get_browsers();
        $storeFunnel->device = $this->get_device();
        $storeFunnel->funnel_company_id = $auth->users_company_id;
        $storeFunnel->save();
        return redirect('/funnel')->with('success', 'Successfully Updated');
    }
    public function delete(Request $request)
    {
        $auth = Auth::user();
        $remarks = DB::table('remarks')
            ->where('remarks_funnel_id', $request->id)
            ->where('remarks_company_id', $auth->users_company_id)
            ->count();
        $reminder = DB::table('reminder')
            ->where('reminder_funnel_id', $request->id)
            ->where('reminder_company_id', $auth->users_company_id)
            ->count();
        if ($remarks == 0 && $reminder == 0) {
            $del = Funnel::find($request->id);
            $del->delete();
            return redirect('/funnel')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/funnel')->with('error', 'This Funnel is using on another Table');
        }
    }
    //Show poc after click on company
    public function get_poc(Request $request)
    {
        $get_poc = DB::table('company_profile')
            ->where('comprofile_company_id', '=', $request->value)
            ->where('comprofile_status', '=', 'Active')
            ->get();
        foreach ($get_poc as $poc) {
            echo '<option value="' . $poc->comprofile_id . '">' . $poc->comprofile_name . '</option>';
        }
    }
    public function changeStatus(Request $request)
    {
        // dd($request->all());

        $user = Funnel::find($request->user_id);
        $user->status_id = $request->status;
        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
