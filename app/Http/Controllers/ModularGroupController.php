<?php

namespace App\Http\Controllers;

use App\Libraries\Permissions;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModularGroupController extends Controller
{
    public function modular_group()
    {
        $auth = Auth::user();

        // dd($auth);
        $modular_groups = Role::where('roles_company_id', $auth->users_company_id);
        if ($auth->type == 'Master') {
            $modular_groups->where('roles_company_id', $auth->users_company_id);
        } else {
            $modular_groups->where('type', '!=', 1);
        }
        $modular_groups = $modular_groups->orderBy('id', 'DESC')->paginate(30);
        // $modular_groups = Role::all();
        return view('modular_group.modular_group', compact('modular_groups'));
    }

    public function create_modular_group()
    {
        // dd(1);
        return view('modular_group.create_modular_group');
    }

    public function store_modular_group(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $this->validate($request, [
            'modular_group' => [
                'required',
                Rule::unique('roles', 'name')->where(function ($query) use ($auth) {
                    return $query->where('roles_company_id', $auth->users_company_id);
                }),
            ],
            'module_permissions' => 'required',
        ]);
        $role = Role::create([
            'name' => $request->modular_group,
            'roles_company_id' => $auth->users_company_id,
            'created_by' => $auth->id,
            'type' => 2,
        ]);
        // dd(1);
        $role->syncPermissions($request->input('module_permissions'));

        return redirect()->route('modular_group')->with('success', 'Permissions Assigned');
        // $role = \Spatie\Permission\Models\Role::findOrCreate($request->modular_group);
        // $role->syncPermissions($request->module_permissions);
        // return redirect()->route('modular_group')->with('success', 'Permissions Assigned');
    }

    public function edit_modular_group(Request $request)
    {
        // $role = Role::find(3);
        // $permissions = [184, 185];
        // $role->syncPermissions($permissions);
        // dd(1);
        $role = Role::with('permissions')->find($request->id);
        return view('modular_group.edit_modular_group', ['role' => $role]);
    }

    public function update_modular_group(Request $request)
    {
        $role = Role::find($request->id);

        $role->update([
            'name' => $request->modular_group,
        ]);
        $role->syncPermissions($request->module_permissions);
        return redirect()->route('modular_group')->with('success', 'Permissions Assigned');
    }

    public function delete_modular_group(Request $request)
    {
        $count_model_has_roles = DB::table('model_has_roles')
            ->where('role_id', '=', $request->id)
            ->count();
        if ($count_model_has_roles > 0) {
            DB::table('model_has_roles')
                ->where('role_id', '=', $request->id)
                ->delete();
        }
        $role = Role::find($request->id);
        $role->delete();
        return back()->with('success', 'Successfully Deleted');
    }
}
