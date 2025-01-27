<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\BusinessCategory;
use App\Models\Company;
use App\Models\CompProfile;
use App\Models\Region;
use App\Models\Schedule;
use App\Models\Funnel;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Sector;
use App\Models\Status;
use App\Models\Town;
use App\User;
use PDF;
use Carbon\Carbon;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;
use test\Mockery\MockingVoidMethodsTest;

class ClientController extends Controller
{
    public function index(Request $request, $array = null, $str = null)
    {
        $user = Auth::user()->id;
        $auth = Auth::user();
        // dd($auth);
        $userID = DB::table('users')
            ->where('supervisor', $user)
            ->where('users_company_id', $auth->users_company_id)
            ->orWhere('id', $user)
            ->get()
            ->pluck('id');
        $query = DB::table('company');
        $query->where('company_company_id', $auth->users_company_id);
        $query->leftJoin('region', 'region.region_id', '=', 'company.com_region_id');
        $query->leftJoin('area', 'area.area_id', '=', 'company.com_area_id');
        $query->leftJoin('sector', 'sector.sector_id', '=', 'company.com_sector_id');
        $query->leftJoin('town', 'town.town_id', '=', 'company.com_town_id');
        $query->leftJoin('users', 'users.id', '=', 'company.user_id');
        $query->leftJoin('business_category', 'business_category.business_category_id', '=', 'company.business_category_id');
        $query->select('sector.sec_name', 'company.*', 'region.reg_name', 'area.area_name', 'town.town_name', 'users.*', 'company.*', 'company.id as comp_id', 'company.comp_remarks', 'business_category.*', 'company.created_at as company_created_at');
        // dd($query);
        if ($auth->role == 'Tele Caller') {
            $query->where('company.user_id', session('id'));
        }
        $ar = json_decode($request->array);
        $region = !isset($request->region) && empty($request->region) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->region;
        $area = !isset($request->area) && empty($request->area) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->area;
        $sector = !isset($request->sector) && empty($request->sector) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->sector;
        $town = !isset($request->town) && empty($request->town) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->town;
        $business_category = !isset($request->business_category) && empty($request->business_category) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->business_category;
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[6]->{'value'} : '') : $request->created_by;
        $status = !isset($request->status) && empty($request->status) ? (!empty($ar) ? $ar[7]->{'value'} : '') : $request->status;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[8]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[9]->{'value'} : '') : $request->to_date;
        // $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[10]->{'value'} : '') : $request->search;

        if (!empty($region)) {
            $query->where('company.com_region_id', '=', $region);
        }
        if (!empty($area)) {
            $query->where('company.com_area_id', '=', $area);
        }
        if (!empty($sector)) {
            $query->where('company.com_sector_id', '=', $sector);
        }
        if (!empty($town)) {
            $query->where('company.com_town_id', '=', $town);
        }
        if (!empty($business_category)) {
            $query->where('company.business_category_id', '=', $business_category);
        }
        if (!empty($companies)) {
            $query->where('company.id', '=', $companies);
        }
        if (!empty($created_by)) {
            $query->where('company.user_id', '=', $created_by);
        }

        if ($status != null || $status != '') {
            $query->where('company.comp_status', '=', $status);
        }
        if (!empty($from_date)) {
            $query->where('company.created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('company.created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('company.business_category_id', 'like', '%' . $search . '%');
        //         $query->orWhere('com_region_id', 'like', '%' . $search . '%');
        //         $query->orWhere('com_area_id', 'like', '%' . $search . '%');
        //         $query->orWhere('com_sector_id', 'like', '%' . $search . '%');
        //         $query->orWhere('company.company_name', 'like', '%' . $search . '%');
        //         $query->orWhere('company.comp_email', 'like', '%' . $search . '%');
        //         $query->orWhere('company.comp_whatsapp_no', 'like', '%' . $search . '%');
        //         $query->orWhere('company.comp_mobile_no', 'like', '%' . $search . '%');
        //         $query->orWhere('company.comp_ptcl', 'like', '%' . $search . '%');
        //         $query->orWhere('company.created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //         $query->orWhere('comp_remarks', 'like', '%' . $search . '%');
        //     });
        // }
        $query->orderByDesc('company.created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('company.user_id', $userID);
        }
        if (Auth::user()->role == 'Sale Person') {
            $query->where('company.user_id', '=', $user);
        }
        $datas = $query->paginate($pagination_number);
        // dd($datas);
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->where('company_company_id', $auth->users_company_id)
            ->select('user_id')
            ->get();
        $all_region = DB::table('region')
            ->whereIn('region_id', DB::table('company')->pluck('com_region_id')->all())
            ->where('region_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_region->where('region.reg_user_id', session('id'));
        }
        $all_region = $all_region->get();

        $all_area = DB::table('area')
            ->whereIn('area_id', DB::table('company')->pluck('com_area_id')->all())
            ->where('area_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_area->where('area.area_user_id', session('id'));
        }
        $all_area = $all_area->get();

        $all_sector = DB::table('sector')
            ->whereIn('sector_id', DB::table('company')->pluck('com_sector_id')->all())
            ->where('sector_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_sector->where('sector.sec_user_id', session('id'));
        }
        $all_sector = $all_sector->get();

        $all_town = DB::table('town')
            ->whereIn('town_id', DB::table('company')->pluck('com_town_id')->all())
            ->where('town_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $all_town->where('town.town_user_id', session('id'));
        }
        $all_town = $all_town->get();

        $all_business_category = DB::table('business_category')
            ->whereIn('business_category_id', DB::table('company')->pluck('business_category_id')->all())
            ->where('business_category_company_id', $auth->users_company_id);
            if ($auth->role == 'Tele Caller') {
                $all_business_category->where('business_category.business_category_user_id', session('id'));
            }
            $all_business_category = $all_business_category->get();

        $all_companies = DB::table('company')
            ->where('company_company_id', $auth->users_company_id);
            if ($auth->role == 'Tele Caller') {
                $all_companies->where('company.user_id', session('id'));
            }

            $all_companies = $all_companies->get();
        // dd($all_companies);
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('company')->pluck('user_id')->all())
            ->where('users_company_id', $auth->users_company_id);

        if ($auth->role == 'Tele Caller') {
            $all_created_by->where('id', session('id'));
        }

        $all_created_by = $all_created_by->get();

        $count_row = count($datas);
        // dd($count_row);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_clients';
        $pge_title = 'Client List';
        $srch_fltr = [];
        array_push($srch_fltr, $region, $area, $town, $sector, $business_category, $companies, $created_by, $status, $from_date, $to_date);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            dd($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row);
            $type = isset($request->str) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            // dd(1);
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
                // try {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
                // } catch (\Exception $e) {
                //     // Log or dump the exception
                //     die($e->getMessage());
                // }
            }
        } else {
            return view('clients.index', compact('datas', 'count_row', 'pge_title', 'type', 'region', 'all_region', 'area', 'all_area', 'sector', 'town', 'all_sector', 'all_town', 'companies', 'all_companies', 'created_by', 'status', 'all_created_by', 'business_category', 'all_business_category', 'from_date', 'to_date', 'reminder'));
        }
    }

    public function create()
    {
        $user = Auth::user()->id;
        $auth = Auth::user();
        $userID = DB::table('users')->where('id', $user)->pluck('supervisor');
        if (Auth::user()->role == 'Admin') {
            $get_town = Town::where('town_company_id', $auth->users_company_id)->get();
            $business_category = BusinessCategory::where('business_category_company_id', $auth->users_company_id)->get();
            return view('clients.addClients', compact('get_town', 'business_category'));
        } elseif (Auth::user()->role == 'Supervisor') {
            $get_town = Town::whereIn('town_user_id', $userID)
                ->orWhere('town_user_id', $user)
                ->where('town_company_id', $auth->users_company_id)
                ->get();
            $business_category = BusinessCategory::where('business_category_company_id', $auth->users_company_id)->get();
            return view('clients.addClients', compact('get_town', 'business_category'));
        } elseif (Auth::user()->role == 'Sale Person') {
            $get_supervisor = DB::table('users')
                ->where('id', Auth::user()->id)
                ->pluck('supervisor');
            $get_town = Town::where('town_user_id', $user)
                ->where('town_company_id', $auth->users_company_id)
                //                ->orwhere('sec_user_id', '1')
                ->get();
            // dd($get_town);
            $business_category = BusinessCategory::where('business_category_user_id', $user)
                ->where('business_category_company_id', $auth->users_company_id)
                //                ->orwhere('sec_user_id', '1')
                ->get();
            return view('clients.addClients', compact('get_town', 'business_category'));
        } elseif (Auth::user()->role == 'Tele Caller') {
            $get_supervisor = DB::table('users')->where('id', session('id'))->pluck('supervisor');
            $get_town = Town::where('town_user_id', session('id'))
                ->where('town_company_id', $auth->users_company_id)
                //                ->orwhere('sec_user_id', '1')
                ->get();
            // dd($get_town);
            $business_category = BusinessCategory::where('business_category_user_id', session('id'))
                ->where('business_category_company_id', $auth->users_company_id)
                //                ->orwhere('sec_user_id', '1')
                ->get();
            return view('clients.addClients', compact('get_town', 'business_category'));
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $rules = [
            'comp_name' => 'required',
            'com_town_id' => 'required',
            'business_category' => 'required',
        ];
        $messages = [
            'required' => 'This field is required',
            'unique' => 'clients name already taken',
            'regex' => 'clients name contains only Letters and Numbers',
        ];
        $this->validate($request, $rules, $messages);

        $comp = new Company();
        if ($auth->role == 'Tele Caller') {
            // dd(1);
            $comp->user_id = session('id');
        } else {
            $comp->user_id = Auth::user()->id;
        }
        $comp->com_region_id = $request->input('com_region_id');
        $comp->com_area_id = $request->input('com_area_id');
        $comp->com_sector_id = $request->input('com_sector_id');
        $comp->com_town_id = $request->input('com_town_id');
        $comp->business_category_id = $request->input('business_category');
        $comp->company_name = $request->input('comp_name');
        $comp->comp_remarks = $request->input('comp_remarks');
        $comp->comp_ptcl = $request->input('ptcl');
        $comp->comp_address = $request->input('address');
        $comp->comp_mobile_no = $request->input('mobile');
        $comp->comp_whatsapp_no = $request->input('whatsapp');
        $comp->comp_email = $request->input('email');
        $comp->map_coordinate = $request->input('map_coordinate');
        $comp->comp_status = $request->input('status');
        $comp->company_company_id = $auth->users_company_id;
        $comp->comp_webaddress = $request->input('web_address');
        $comp->created_at = Carbon::now('Asia/Karachi');
        $comp->updated_at = Carbon::now('Asia/Karachi');
        $comp->ip_address = $this->get_ip();
        $comp->os_name = $this->get_os();
        $comp->browser = $this->get_browsers();
        $comp->device = $this->get_device();

        $comp->save();
        return redirect('clients')->with('success', 'Client Successfully Created');
    }

    public function edit(Request $request)
    {
        $auth = Auth::user();
        // dd($request->all());
        $edit_company = DB::table('company')
            ->where('company.id', '=', $request->id)
            ->where('company_company_id', $auth->users_company_id)
            ->first();
        // dd($edit_company);
        // $get_region = Region::all();
        $get_town = Town::where('town_id', '=', $edit_company->com_town_id)
            ->where('town_company_id', $auth->users_company_id)
            ->get();
        // $get_sector = DB::table('sector')
        //     ->get();
        $business_category = BusinessCategory::where('business_category_company_id', $auth->users_company_id)->get();
        // return view('clients.editclients', compact('edit_company', 'get_region', 'get_area', 'get_sector', 'business_category'));
        return view('clients.editclients', compact('edit_company', 'get_town', 'business_category'));
    }

    public function update(Request $request)
    {
        $auth = Auth::user();
        $rules = [
            'comp_name' => 'required|regex:/^[a-zA-Z0-9\pL\s\-]+$/',
            'com_sector_id' => 'required',
            'business_category' => 'required',
        ];
        $messages = [
            'required' => 'This field is required',
            'unique' => 'clients name already taken',
            'regex' => 'clients name contains only Letters and Numbers',
        ];
        $this->validate($request, $rules, $messages);

        $comp = Company::find($request->id);
        if ($auth->role == 'Tele Caller') {
            // dd(1);
            $comp->user_id = session('id');
        } else {
            $comp->user_id = Auth::user()->id;
        }
        $comp->com_region_id = $request->input('com_region_id');
        $comp->com_area_id = $request->input('com_area_id');
        $comp->comp_remarks = $request->input('comp_remarks');
        $comp->com_sector_id = $request->input('com_sector_id');
        $comp->comp_ptcl = $request->input('ptcl');
        $comp->comp_address = $request->input('address');
        $comp->comp_mobile_no = $request->input('mobile');
        $comp->comp_whatsapp_no = $request->input('whatsapp');
        $comp->comp_email = $request->input('email');
        $comp->comp_status = $request->input('status');
        $comp->comp_webaddress = $request->input('web_address');
        $comp->business_category_id = $request->input('business_category');
        $comp->map_coordinate = $request->input('map_coordinate');
        $comp->company_name = $request->input('comp_name');
        $comp->company_company_id = $auth->users_company_id;
        $comp->updated_at = Carbon::now('Asia/Karachi');
        $comp->ip_address = $this->get_ip();
        $comp->os_name = $this->get_os();
        $comp->browser = $this->get_browsers();
        $comp->device = $this->get_device();
        $comp->save();
        return redirect('clients')->with('success', 'Client Successfully Updated');
    }

    public function destroy(Request $request)
    {
        $auth = Auth::user();
        $company_profile = CompProfile::where('comprofile_company_id', $request->id)->count();
        $schedule = Schedule::where('company_id', $request->id)
            ->where('schedule_company_id', $auth->users_company_id)
            ->count();
        $funnel = Funnel::where('company_id', $request->id)
            ->where('funnel_company_id', $auth->users_company_id)
            ->count();
        $invoice = Invoice::where('company_id', $request->id)
            ->where('invoice_company_id', $auth->users_company_id)
            ->count();
        $order = Order::where('company_id', $request->id)
            ->where('order_company_id', $auth->users_company_id)
            ->count();
        if ($company_profile == 0 && $schedule == 0 && $funnel == 0 && $invoice == 0 && $order == 0) {
            $company = Company::find($request->id);
            $company->delete();
            return redirect('/clients')->with('success', 'Successfully Deleted');
        } else {
            return redirect('/clients')->with('error', 'This Clients is using on another Table');
        }
    }

    public function checkCompName(Request $request)
    {
        $company = $request->company;
        $data = DB::table('company')->where('company_name', $company)->count();
        if ($data > 0) {
            return 'not unique';
        } else {
            return 'unique';
        }
    }
    public function changeStatus(Request $request)
    {
        // return $request->all();
        // // dd($request->all());
        $company = Company::find($request->company_id);
        // dd($company);
        $company->comp_status = $request->status;
        $company->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
