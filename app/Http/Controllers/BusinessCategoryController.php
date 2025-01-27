<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\BusinessCategory;
use App\Models\Company;
use App\Models\ScheduleTarget;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class BusinessCategoryController extends Controller
{
    public function businessCategory()
    {
        return view('businessCategory.businessCategory');
    }
    public function view_businessCategory(Request $request)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->get()
            ->pluck('id');
        $query = DB::table('business_category')->where('business_category_company_id', $auth->users_company_id);
        $query->join('users', 'users.id', '=', 'business_category.business_category_user_id');
        $query->select('business_category.*', 'users.name as user_name');
        $ar = json_decode($request->array);
        $business_category = !isset($request->business_category) && empty($request->business_category) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->business_category;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($business_category)) {
            $query->where('business_category.business_category_id', '=', $business_category);
        }
        if (!empty($created_by)) {
            $query->where('business_category.business_category_user_id', '=', $created_by);
        }
        if (!empty($from_date)) {
            $query->where('business_category.business_category_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('business_category.business_category_created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('business_category.business_category_created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('business_category.business_category_name', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('business_category.business_category_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('business_category.business_category_user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('business_category.business_category_user_id', $user);
        }
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->where('company_company_id', $auth->users_company_id)
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('business_category')->pluck('business_category_user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $all_business_category = DB::table('business_category')
            ->whereIn('business_category_id', DB::table('business_category')->pluck('business_category_id')->all())
            ->where('business_category_company_id', $auth->users_company_id)
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_businessCategory';
        $pge_title = 'Business Category List';
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
            return view('businessCategory.view_businessCategory', compact('datas', 'count_row', 'pge_title', 'type', 'business_category', 'all_business_category', 'created_by', 'all_created_by', 'from_date', 'to_date', 'reminder'));
        }
    }
    public function store_businessCategory(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'business_category' => 'required',
        ]);
        $store_business_category = new BusinessCategory();
        $store_business_category->business_category_user_id = Auth::user()->id;
        $store_business_category->business_category_name = $request->input('business_category');
        $store_business_category->business_category_created_at = Carbon::now('Asia/Karachi');
        $store_business_category->business_Category_updated_at = Carbon::now('Asia/Karachi');
        $store_business_category->business_Category_company_id = $auth->users_company_id;
        $store_business_category->ip_address = $this->get_ip();
        $store_business_category->os_name = $this->get_os();
        $store_business_category->browser = $this->get_browsers();
        $store_business_category->device = $this->get_device();
        $store_business_category->save();
        return redirect('/view_businessCategory')->with('success', 'Successfully Inserted');
    }
    public function edit_businessCategory(Request $request)
    {
        $edit = BusinessCategory::find($request->id);
        return view('businessCategory.edit_businessCategory', compact('edit'));
    }
    public function update_businessCategory(Request $request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'business_category' => 'required',
        ]);
        $store_business_category = BusinessCategory::find($request->id);
        $store_business_category->business_category_user_id = Auth::user()->id;
        $store_business_category->business_category_name = $request->input('business_category');
        $store_business_category->business_Category_updated_at = Carbon::now('Asia/Karachi');
        $store_business_category->business_Category_company_id = $auth->users_company_id;
        $store_business_category->ip_address = $this->get_ip();
        $store_business_category->os_name = $this->get_os();
        $store_business_category->browser = $this->get_browsers();
        $store_business_category->device = $this->get_device();
        $store_business_category->save();
        return redirect('/view_businessCategory')->with('success', 'Successfully Updated');
    }
    public function delete_businessCategory(Request $request)
    {
        $auth = Auth::user();
        $company = Company::where('business_category_id', $request->id)
            ->where('company_company_id', $auth->users_company_id)
            ->count();
        $schedule_target = ScheduleTarget::where('sch_target_business_category_id', $request->id)
            ->where('schedule_target_company_id', $auth->users_company_id)
            ->count();
        if ($company == 0 && $schedule_target == 0) {
            $business_category = BusinessCategory::find($request->id);
            $business_category->delete();
            return redirect('/view_businessCategory')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/view_businessCategory')->with('error', 'This Company is using on another Table');
        }
    }
}
