<?php

namespace App\Http\Controllers;

use App\Models\BusinessProfile;
use App\Models\CompanyModel;
use App\Models\CompanyProfile;
use App\Models\Technician;
use App\User;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CompanyController extends Controller
{
    public function create()
    {
        // dd(1);
        // dd(Auth::user());
        return view('company.add_company');
    }
    public function store(Request $request)
    {
        // dd($request->all());

        DB::transaction(function () use ($request) {
            // $this->validation($request);

            $auth = Auth::user();
            // dd($auth);
            $company = new CompanyModel();
            $company->nc_name = $request->company_name;
            $company->nc_contact = $request->number;
            // $company->nc_created_by = $auth->id;
            $company->save();
            $permission = Permission::pluck('id');
            $modular_group = Role::create(['name' => 'Master ' . $company->nc_name, 'created_by' => $auth->id, 'roles_company_id' => $company->nc_id, 'type' => 1]);

            $modular_group->syncPermissions($permission);
            // dd($modular_group);

            // Master

            $master = new User();
            $master->name = 'Master' . $company->nc_name;
            $master->username = 'Master' . $company->nc_name;
            $master->password = bcrypt('Bismill@h512');
            $master->password = bcrypt('Bismill@h512');
            $master->email = 'master' . $company->nc_name . '@gmail.com';
            $master->user_status = 1;
            $master->users_company_id = $company->nc_id;
            $master->type = 'Master';
            $master->mob = $request->number;
            $master->cnic = '';
            $master->role = "Admin";
            $master->supervisor = 1;
            $master->save();
            $master->assignRole($modular_group->id);

            // Super Admin

            $sadmin = new User();
            $sadmin->name = 'sadmin' . $company->nc_name;
            $sadmin->username = 'sadmin' . $company->nc_name;
            $sadmin->password = bcrypt('Bismill@h786');
            $sadmin->password = bcrypt('Bismill@h786');
            $sadmin->email = 'sadmin' . $company->nc_name . '@gmail.com';
            $sadmin->user_status = 1;
            $sadmin->users_company_id = $company->nc_id;
            $sadmin->type = 'Employee';
            $sadmin->mob = $request->number;
            $sadmin->cnic = '';
            $sadmin->supervisor = 1;
            $sadmin->save();

            // Business Profile Add

            $updateBusinessProfile = new BusinessProfile();
            $updateBusinessProfile->business_profile_name =$request->company_name;
            $updateBusinessProfile->business_profile_mobile_no = $request->number;
            $updateBusinessProfile->business_profile_company_id = $company->nc_id;
            $updateBusinessProfile->save();
        });

        return redirect()->route('add_company')->with('success', 'Successfully Saved');
    }
    public function company_list(Request $request)
    {
        $auth = Auth::user();
        $ar = json_decode($request->array);
        $search_category = $request->search_category;
        $bra_name = $request->bra_name;
        $search_model = $request->search_model;
        $pagination_number = empty($ar) ? 30 : 100000000;
        // $datas = ModelTable::all();
        // $brands = Brand::where('company_id', $auth->company_id)->get();
        // $categorys = Category::where('company_id', $auth->company_id)->get();

        $datas = DB::table('new_company');
        // dd($datas);

        $query = $datas;
        // if ($search_category) {
        //     $query->where('categories.cat_name', 'like', '%' . $search_category . '%');
        // }

        // if ($bra_name) {
        //     $query->where('brands.bra_name', 'like', '%' . $bra_name . '%');
        // }

        // if ($search_model) {
        //     $query->where('model_table.mod_name', 'like', '%' . $search_model . '%');
        // }

        $query = $query->orderBy('nc_id', 'DESC')->paginate($pagination_number);
        // dd($query);

        return view('company.company_list', compact('query'));
    }
}
