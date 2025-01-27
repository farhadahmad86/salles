<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\CompanyPocProfile;
use App\Models\Region;
use App\Models\Sector;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function insert_region(Request $request)
    {
        $auth = Auth::user();
        $add_region = new Region();
        $add_region->reg_user_id = Auth::user()->id;
        $add_region->reg_name = $request->region;
        $add_region->reg_remarks = $request->region_remarks;
        $add_region->region_company_id = $auth->users_company_id;
        $add_region->reg_created_at = Carbon::now('Asia/Karachi');
        $add_region->reg_updated_at = Carbon::now('Asia/Karachi');
        $add_region->ip_address = $this->get_ip();
        $add_region->os_name = $this->get_os();
        $add_region->browser = $this->get_browsers();
        $add_region->device = $this->get_device();
        $add_region->save();

        $get_region = Region::where('reg_user_id', Auth::user()->id)
            ->where('region_company_id', $auth->users_company_id)
            ->get();
        echo '<option selected disabled hidden>Choose Region</option>';
        foreach ($get_region as $region) {
            echo '<option value="' . $region->region_id . '">' . $region->reg_name . '</option>';
        }
    }

    public function insert_area(Request $request)
    {
        $auth = Auth::user();
        $add_area = new Area();
        $add_area->area_user_id = Auth::user()->id;
        $add_area->area_region_id = $request->region;
        $add_area->area_name = $request->area;
        $add_area->area_remarks = $request->area_remarks;
        $add_area->area_company_id = $auth->users_company_id;
        $add_area->area_created_at = Carbon::now('Asia/Karachi');
        $add_area->area_updated_at = Carbon::now('Asia/Karachi');
        $add_area->ip_address = $this->get_ip();
        $add_area->os_name = $this->get_os();
        $add_area->browser = $this->get_browsers();
        $add_area->device = $this->get_device();
        $add_area->save();

        $get_area = DB::table('area')
            ->where('area_region_id', '=', $request->region)
            ->where('area_company_id', $auth->users_company_id)
            ->where('area_user_id', Auth::user()->id)
            ->get();
        echo '<option selected disabled hidden>Choose Area</option>';
        foreach ($get_area as $area) {
            echo '<option value="' . $area->area_id . '">' . $area->area_name . '</option>';
        }
    }

    public function insert_sector(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $add_sector = new Sector();
        $add_sector->sec_user_id = Auth::user()->id;
        $add_sector->sec_region_id = $request->region;
        $add_sector->sec_area_id = $request->area;
        $add_sector->sec_name = $request->sector;
        $add_sector->sec_remarks = $request->sector_remarks;
        $add_sector->sector_company_id = $auth->users_company_id;
        $add_sector->sec_created_at = Carbon::now('Asia/Karachi');
        $add_sector->sec_updated_at = Carbon::now('Asia/Karachi');
        $add_sector->ip_address = $this->get_ip();
        $add_sector->os_name = $this->get_os();
        $add_sector->browser = $this->get_browsers();
        $add_sector->device = $this->get_device();
        $add_sector->save();

        $get_sector = DB::table('sector')
            ->where('sec_region_id', '=', $request->region)
            ->where('sec_area_id', '=', $request->area)
            ->where('sector_company_id', $auth->users_company_id)
            ->where('sec_user_id', Auth::user()->id)
            ->get();
        echo '<option selected disabled hidden>Choose Sector</option>';
        foreach ($get_sector as $sector) {
            echo '<option value="' . $sector->sector_id . '">' . $sector->sec_name . '</option>';
        }
    }

    public function get_region()
    {
        $auth = Auth::user();
        $get_region = DB::table('region')
            ->where('reg_user_id', Auth::user()->id)
            ->where('region_company_id', $auth->users_company_id)
            ->get();
        echo '<option selected disabled hidden>Choose Region</option>';
        foreach ($get_region as $region) {
            echo '<option value="' . $region->region_id . '">' . $region->reg_name . '</option>';
        }
    }

    public function get_area(Request $request)
    {
        $auth = Auth::user();
        $get_area = DB::table('area')
            ->where('area_region_id', '=', $request->region_id)
            ->where('area_user_id', Auth::user()->id)
            ->where('area_company_id', $auth->users_company_id)
            ->get();
        echo '<option selected disabled hidden>Choose Area</option>';
        foreach ($get_area as $area) {
            echo '<option value="' . $area->area_id . '">' . $area->area_name . '</option>';
        }
    }
    public function get_poc(Request $request)
    {
        $auth = Auth::user();
        $get_poc = CompanyPocProfile::where('com_poc_profile_company_id', '=', $request->comp_id)
            ->where('com_poc_profile_status', 1)
            ->where('company_poc_profile_company_id', $auth->users_company_id);
        if ($auth->role == 'Tele Caller') {
            $get_poc->where('com_poc_profile_user_id', session('id'));
        } else {
            $get_poc->where('com_poc_profile_user_id', Auth::user()->id);
        }
        $get_poc = $get_poc->get();
        echo '<option selected disabled hidden>Choose POC</option>';
        foreach ($get_poc as $poc) {
            echo '<option value="' . $poc->com_poc_profile_id . '">' . $poc->com_poc_profile_name . '</option>';
        }
    }

    public function get_sector(Request $request)
    {
        $auth = Auth::user();
        $get_sector = DB::table('sector')
            ->where('sec_region_id', '=', $request->region_id)
            ->where('sec_area_id', '=', $request->area_id)
            ->where('sec_user_id', Auth::user()->id)
            ->where('sector_company_id', $auth->users_company_id)
            ->get();
        echo '<option selected disabled hidden>Choose Area</option>';
        foreach ($get_sector as $sector) {
            echo '<option value="' . $sector->sector_id . '">' . $sector->sec_name . '</option>';
        }
    }

    public function com_get_area(Request $request)
    {
        $auth = Auth::user();
        $get_area = DB::table('area')
            ->where('area_company_id', $auth->users_company_id)
            ->where('area_region_id', '=', $request->region)
            ->get();

        echo '<option selected disabled hidden>Choose Area</option>';
        foreach ($get_area as $area) {
            echo '<option value="' . $area->area_id . '">' . $area->area_name . '</option>';
        }
    }

    public function com_get_sec(Request $request)
    {
        $auth = Auth::user();
        $get_sector = DB::table('sector')
            ->join('region', 'region_id', '=', 'sec_region_id')
            ->join('area', 'area_id', '=', 'sec_area_id')
            ->where('sec_region_id', '=', $request->region)
            ->where('sec_area_id', '=', $request->area)
            ->where('sector_company_id', $auth->users_company_id)
            ->get();

        echo '<option selected disabled hidden>Choose Area</option>';
        foreach ($get_sector as $sector) {
            echo '<option value="' . $sector->sector_id . '">' . $sector->sec_name . '</option>';
        }
    }

    public function user_role_ajax(Request $request)
    {
        $auth = Auth::user();
        $get_all_users = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->whereNotIn('users.id', [$request->name])
            ->get();
        $selected_user = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('users.id', $request->name)
            ->first();
        $roles = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $selected_LM = ['<option selected hidden disabled>Choose Line Manager</option>'];
        foreach ($get_all_users as $user) {
            $selected = $selected_user->supervisor == $user->id ? 'selected' : '';
            $selected_LM[] = "<option value='$user->id' $selected>$user->name</option>";
        }
        //        $selected_role = ['<option selected hidden disabled>Choose Role</option>'];
        //        foreach ($roles as $role) {
        //            $selected = $selected_user->role == $role->role ? 'selected' : '';
        //            $selected_role[] = "<option value='$user->id' $selected>$role->role</option>";
        //            if ($role->role == null){
        //                $selected_role[] = "<option selected hidden disabled>Choose Role</option>";
        //            }
        //        }
        return response()->json(compact('selected_LM'));

        //        $if_line_magager_exist = DB::table('users')
        //            ->where('id', '=', $request->name)
        //            ->where('supervisor', '!=', null)->count();
        //        if ($if_line_magager_exist > 0){
        //            $selected_line_manager = DB::table('users')
        //                ->whereNotIn('users.id', [$request->name])
        //                ->get();
        //            $selected_LM = [];
        //            foreach($selected_line_manager as $line_manager){
        //                $selected = $line_manager->id == $line_manager->supervisor ? 'selected' : '';
        //                $selected_LM[] = "<option value=".$line_manager->id." $selected>".$line_manager->name."</option>";
        //            }
        //            return response()->json(compact('selected_LM', 'selected_line_manager'));
        //        }else{
        //            $line_manager = DB::table('users')
        //                ->whereNotIn('users.id', [$request->name])
        //                ->get();
        //            $selected_LM = [];
        //            foreach($line_manager as $manager){
        //                $selected_LM[] = "<option value=".$manager->id.">".$manager->name."</option>";
        //            }
        //            return response()->json(compact('selected_LM', 'selected_line_manager'));
        //        }
    }
    // farhad
    public function get_cat(Request $request)
    {
        $auth = Auth::user();
        $get_cat = DB::table('category')
            ->where('cat_product_group_id', '=', $request->pro_group_id)
            ->where('cat_user_id', Auth::user()->id)
            ->where('category_company_id', $auth->users_company_id)
            ->get();
        echo '<option selected disabled hidden>Choose Area</option>';
        foreach ($get_cat as $category) {
            echo '<option value="' . $category->cat_id . '">' . $category->cat_category . '</option>';
        }
    }
}
