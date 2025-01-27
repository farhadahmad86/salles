<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Funnel;
use App\Models\Group;
use App\User;
use Carbon\Carbon;
use Session;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
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
        $query = DB::table('groups')
            ->where('groups_company_id', $auth->users_company_id)
            ->join('users as user', 'user.id', '=', 'groups.groups_user_id')
            ->select('groups.*', 'user.name as username');
        //     ->get();

        // dd($query);
        //
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
        $query->orderBy('groups.groups_id', 'desc');
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
            ->where('company_company_id', $auth->users_company_id)
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('funnel')->pluck('user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
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
                'group.group',
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
        $auth = Auth::user();
        $get_users = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->whereNotIn('type', ['Master'])
            ->get();
        // dd($get_users);
        return view('group.createGroup', compact('get_users'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $this->validate($request, [
            'group_name' => 'required',
            'users' => 'required',
        ]);
        $storegroup = new Group();
        $storegroup->groups_user_id = Auth::user()->id;
        $storegroup->groups_name = $request->input('group_name');
        $storegroup->groups_users = implode(',', $request->input('users'));
        $storegroup->groups_created_at = Carbon::now('Asia/Karachi');
        $storegroup->groups_updated_at = Carbon::now('Asia/Karachi');
        $storegroup->ip_address = $this->get_ip();
        $storegroup->os_name = $this->get_os();
        $storegroup->browser = $this->get_browsers();
        $storegroup->device = $this->get_device();
        $storegroup->groups_company_id = $auth->users_company_id;
        $storegroup->save();
        return redirect('/group')->with('success', 'Successfully Inserted');
    }
    public function edit(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $edit_id = $request->id;
        $get_users = User::where('users_company_id', $auth->users_company_id)
            ->whereNotIn('type', ['Master'])
            ->get();
        $edit = DB::table('groups')
            ->where('groups_company_id', $auth->users_company_id)
            ->where('groups.groups_id', '=', $request->id)
            ->first();
        // dd($edit);
        return view('group.editgroup', compact('edit', 'get_users', 'edit_id'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $this->validate($request, [
            'group_name' => 'required',
            'users' => 'required',
        ]);
        $Updategroup = Group::find($request->id);
        $Updategroup->groups_user_id = Auth::user()->id;
        $Updategroup->groups_name = $request->input('group_name');
        $Updategroup->groups_users = implode(',', $request->input('users'));
        $Updategroup->groups_created_at = Carbon::now('Asia/Karachi');
        $Updategroup->groups_updated_at = Carbon::now('Asia/Karachi');
        $Updategroup->ip_address = $this->get_ip();
        $Updategroup->os_name = $this->get_os();
        $Updategroup->browser = $this->get_browsers();
        $Updategroup->device = $this->get_device();
        $Updategroup->groups_company_id = $auth->users_company_id;
        $Updategroup->save();
        return redirect('/group')->with('success', 'Successfully Updated');
    }
    public function delete(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $groupIds = [$request->id];
        $query = DB::table('users')
            ->whereIn('group_id', $groupIds)
            ->where('users_company_id', $auth->users_company_id);

        // dd($query->toSql(), $query->getBindings());

        $checkUsers = $query->count();

        dd($checkUsers, $groupIds, $request->id);
        if ($checkUsers == 0) {
            $del = Group::find($request->id);
            $del->delete();
            return redirect('/funnel')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/funnel')->with('error', 'This Funnel is using on another Table');
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
    public function user_session($id)
    {
        $user = User::where('id',$id)->select('name','id')->first();
        Session::put(['id'=>$id, 'name'=>$user->name, 'id'=>$user->id]);

        return back();
    }
}
