<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Mail\WelcomeMail;
use App\Models\Group;
use App\User;
use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();
        $query = DB::table('users')->join('users as super', 'super.id', '=', 'users.supervisor')->select('users.*', 'super.name as supervisor_name');
        // ->get();
        // dd($query);
        $ar = json_decode($request->array);
        $name = !isset($request->name) && empty($request->name) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->name;
        $role = !isset($request->role) && empty($request->role) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->role;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->to_date;
        // $search = !isset($request->search) && empty($request->search) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($name)) {
            $query->where('users.id', '=', $name);
        }
        if (!empty($role)) {
            $query->where('users.role', '=', $role);
        }
        if (!empty($from_date)) {
            $query->where('users.created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->where('users.created_at', '<=', date($to_date));
        }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('users.name', 'like', '%' . $search . '%');
        //         $query->orWhere('users.username', 'like', '%' . $search . '%');
        //         $query->orWhere('users.email', 'like', '%' . $search . '%');
        //         $query->orWhere('users.mob', 'like', '%' . $search . '%');
        //         $query->orWhere('users.address', 'like', '%' . $search . '%');
        //         $query->orWhere('users.role', 'like', '%' . $search . '%');
        //         $query->orWhere('super.name', 'like', '%' . $search . '%');
        //         $query->orWhere('users.created_at', 'like', '%' . $search . '%');
        //     });
        // }
        // $query->orderByDesc('users.created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        // $datas = $query->paginate($pagination_number);

        // $query->where('users_company_id',$auth->users_company_id);

        $query = $query->where('users.users_company_id', $auth->users_company_id);
        if ($auth->type == 'Master' || $auth->id == 1) {
            // dd(1);
            $datas = $query->orderBy('users.id', 'DESC')->paginate($pagination_number);
        } else {
            // dd(2);
            $datas = $query->where('users.id', '!=', 1)->where('users.type', '!=', 'Master')->orderBy('users.id', 'DESC')->paginate($pagination_number);
        }

        if ($auth->type == 'Master') {
            $all_name = DB::table('users')
                ->whereIn('id', DB::table('users')->pluck('id')->all())
                ->where('users.users_company_id', $auth->users_company_id) // specify the table alias
                ->get();
        } else {
            $all_name = DB::table('users')
                ->whereIn('id', DB::table('users')->pluck('id')->all())
                ->where('users.type', '!=', 'Master')
                ->where('users.users_company_id', $auth->users_company_id) // specify the table alias
                ->get();
        }

        // dd($all_name);
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_role';
        $pge_title = 'Users List';
        $srch_fltr = [];
        array_push($srch_fltr, $from_date, $to_date);
        $type = '';
        $reminder = '';
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
            return view('user.index', compact('datas', 'auth', 'count_row', 'pge_title', 'type', 'name', 'all_name', 'from_date', 'to_date', 'role'));
        }
    }
    public function create()
    {
        $auth = Auth::user();
        if ($auth->type == 'Master') {
            $get_all_users = DB::table('users')
                ->where('users.users_company_id', $auth->users_company_id)
                // ->whereNotIn('users.id', [$request->name])
                ->get();
        } else {
            $get_all_users = DB::table('users')
                ->where('users.users_company_id', $auth->users_company_id)
                ->whereNotIn('users.type', ['Master'])
                ->get();
        }
        $roles = DB::table('users')
            ->where('role', '=', 'supervisor')
            ->where('users.users_company_id', $auth->users_company_id)
            ->whereNotIn('name', ['Admin', 'Tele Caller', 'Price Manager', 'Product Manager'])
            ->get();
        // dd($roles);
        $modular_groups = Role::where('roles_company_id', $auth->users_company_id);
        if ($auth->type == 'Master') {
            $modular_groups->where('roles_company_id', $auth->users_company_id);
        } else {
            $modular_groups->where('type', '!=', 1);
        }
        $modular_groups = $modular_groups->get();
        $groups = Group::where('groups_company_id', $auth->users_company_id)->get();
        // dd($groups);
        return view('user.createuser', compact('roles', 'modular_groups', 'get_all_users', 'auth', 'groups'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $this->validate(
            $request,
            [
                'name' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|unique:users',
                'mobile' => 'required',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password',
                //            'role' => 'required',
            ],
            [
                'password.required' => 'Please enter Password',
                'password.min' => 'Password should contain minimum 8 character.',
                'confirm_password.same' => 'Password and Confirm Password should be same.',
            ],
        );
        // Handle File Upload
        if ($request->hasFile('img')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('img')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('img')->getClientOriginalExtension();

            // Filename to Store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Upload the image directly to the public/storage/img directory
            $path = $request->file('img')->move(public_path('storage/img'), $fileNameToStore);
            // dd($path);
            // Alternatively, you can use storeAs
            // $path = $request->file('img')->storeAs('public/storage/img/', $fileNameToStore);
        } else {
            $fileNameToStore = 'no_image.jpg';
        }
        // dd($request->all());

        $user = new User();
        // dd($user);
        // Mail::to($request->input('email'))->send(new WelcomeMail());
        $user->name = $request->input('name');
        $user->group_id = implode(',', $request->input('groups'));
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mob = $request->input('mobile');
        $user->password = Hash::make($request->input('password'));
        $user->address = $request->input('adrs');
        $user->supervisor = $request->input('line_manager');
        $user->role = $request->input('role');
        $user->modular_group = $request->input('modular_group');
        $user->f_name = $request->input('f_name');
        $user->cnic = $request->input('cnic');
        $user->doj = $request->input('doj');
        $user->users_company_id = $auth->users_company_id;
        $user->emergency_contact = $request->input('emergency_contact');
        //        if(Auth::user()->role == 'Admin'){
        //            if ($request->input('role') == 'Supervisor'){
        //                $user->role = $request->input('role');
        //                $user->supervisor = '1';
        //            }else if ($request->input('role') == 'Sale Person'){
        //                $user->role = $request->input('role');
        //                $user->supervisor = $request->input('supervisor');
        //            }
        //        }else if(Auth::user()->role == 'Supervisor'){
        //            $user->role = 'Sale Person';
        //            $user->supervisor = Auth::user()->id;
        //        }else{
        //            $user->role = '';
        //            $user->supervisor = '';
        //        }
        $user->image = $fileNameToStore;
        $user->created_at = Carbon::now('Asia/Karachi');
        $user->updated_at = Carbon::now('Asia/Karachi');
        $user->ip_address = $this->get_ip();
        $user->os_name = $this->get_os();
        $user->browser = $this->get_browsers();
        $user->device = $this->get_device();
        $user->assignRole($request->modular_group);
        $user->save();
        // $user_id = User::find(id);
        // dd($user_id);
        // $user_id->assignRole($request->modular_group);
        // $user_id = auth()->user()->find($request->user_id);

        return redirect('user')->with('success', 'Successfully Created');
    }
    public function edit(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $user = User::find($request->id);
        $groups = Group::where('groups_company_id', $auth->users_company_id)->get();
        if ($user->role == 'Admin') {
            if (Auth::user()->role == 'Admin') {
                if ($auth->type == 'Master') {
                    $get_all_users = DB::table('users')
                        ->where('users.users_company_id', $auth->users_company_id)
                        ->get();
                } else {
                    $get_all_users = DB::table('users')
                        ->where('users.users_company_id', $auth->users_company_id)
                        ->whereNotIn('users.type', ['Master'])
                        ->get();
                }
                $roles = DB::table('users')
                    ->where('role', '=', 'supervisor')
                    ->whereNotIn('name', ['Admin', 'Tele Caller', 'Price Manager', 'Product Manager'])
                    ->get();
                // dd($roles);
                $modular_groups = Role::where('roles_company_id', $auth->users_company_id);
                if ($auth->type == 'Master') {
                    $modular_groups->where('roles_company_id', $auth->users_company_id);
                } else {
                    $modular_groups->where('type', '!=', 1);
                }
                $modular_groups = $modular_groups->get();
                $userSupervisors = DB::table('users')->where('role', '=', 'Supervisor')->get();
                // return view('user.edituser', compact('user', 'userSupervisors','auth'));
                return view('user.edituser', compact('user', 'userSupervisors', 'roles', 'modular_groups', 'get_all_users', 'auth', 'groups'));
            } else {
                return back()->with('error', 'You can not edit Admin');
            }
        } else {
            if ($auth->type == 'Master') {
                $get_all_users = DB::table('users')
                    ->where('users.users_company_id', $auth->users_company_id)
                    ->get();
            } else {
                $get_all_users = DB::table('users')
                    ->where('users.users_company_id', $auth->users_company_id)
                    ->whereNotIn('users.type', ['Master'])
                    ->get();
            }
            $roles = DB::table('users')
                ->where('role', '=', 'supervisor')
                ->whereNotIn('name', ['Admin', 'Tele Caller', 'Price Manager', 'Product Manager'])
                ->get();
            // dd($roles);
            // $modular_groups = \Spatie\Permission\Models\Role::all();
            $modular_groups = Role::where('roles_company_id', $auth->users_company_id);
            if ($auth->type == 'Master') {
                $modular_groups->where('roles_company_id', $auth->users_company_id);
            } else {
                $modular_groups->where('type', '!=', 1);
            }
            $modular_groups = $modular_groups->get();
            $userSupervisors = DB::table('users')->where('role', '=', 'Supervisor')->get();
            // dd($get_all_users);
            return view('user.edituser', compact('user', 'userSupervisors', 'roles', 'modular_groups', 'get_all_users', 'auth', 'groups'));
        }
    }
    public function update(Request $request)
    {
        $auth = Auth::user();
        $this->validate(
            $request,
            [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                // 'password' => 'required|min:8',
                // 'confirm_password' => 'required|same:password',
                //            'role' => 'required',
            ],
            [
                'password.required' => 'Please enter Password',
                'password.min' => 'Password should contain minimum 8 character.',
                'confirm_password.same' => 'Password and Confirm Password should be same.',
            ],
        );
        // Handle File Upload
        if ($request->hasFile('img')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('img')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('img')->getClientOriginalExtension();

            // Filename to Store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Upload the image directly to the public/storage/img directory
            $path = $request->file('img')->move(public_path('storage/img'), $fileNameToStore);
            // dd($path);
            // Alternatively, you can use storeAs
            // $path = $request->file('img')->storeAs('public/storage/img/', $fileNameToStore);
        } else {
            $fileNameToStore = 'no_image.jpg';
        }

        $user = User::find($request->id);
        $user->name = $request->input('name');
        $user->group_id = implode(',', $request->input('groups'));
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mob = $request->input('mobile');
        $user->address = $request->input('adrs');
        $user->supervisor = $request->input('line_manager');
        $user->role = $request->input('role');
        $user->modular_group = $request->input('modular_group');
        $user->f_name = $request->input('f_name');
        $user->cnic = $request->input('cnic');
        $user->doj = $request->input('doj');
        $user->emergency_contact = $request->input('emergency_contact');
        $user->users_company_id = $auth->users_company_id;
        //        if (($request->input('password')) != ''){
        //            $user->password = Hash::make($request->input('password'));
        //        }
        //        $user->address = $request->input('adrs');
        //        if(Auth::user()->role == 'Admin') {
        //            if ($request->input('role') == 'Supervisor') {
        //                $user->role = $request->input('role');
        //                $user->supervisor = '1';
        //            } else if ($request->input('role') == 'Sale Person') {
        //                $user->role = $request->input('role');
        //                $user->supervisor = $request->input('supervisor');
        //            }
        //        }else if(Auth::user()->role == 'Supervisor'){
        //            $user->role = 'Supervisor';
        //            $user->supervisor = Auth::user()->id;
        //        }
        if ($request->hasFile('img')) {
            $user->image = $fileNameToStore;
        }
        $user->updated_at = Carbon::now('Asia/Karachi');
        $user->ip_address = $this->get_ip();
        $user->os_name = $this->get_os();
        $user->browser = $this->get_browsers();
        $user->device = $this->get_device();
        $user->assignRole($request->modular_group);
        $user->save();
        // $user_id = auth()->user()->Find($request->user_id);
        // // dd($user);
        // $user_id->assignRole($request->modular_group);
        return redirect('user')->with('success', 'Updated Successfully');
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if ($user->role == 'Admin') {
            return redirect('/user')->with('error', 'Admin can not be Delete');
        }
        //delete image from folder
        if ($user->images != 'no_image.jpg') {
            Storage::delete('public/img/' . $user->images);
        }
        $user->delete();
        return redirect('user')->with('success', 'Successfully Deleted');
    }
    public function editProfile()
    {
        $user = Auth::user();
        return view('user.editProfile', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        // Handle File Upload
        if ($request->hasFile('img')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('img')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('img')->getClientOriginalExtension();

            // Filename to Store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            // Upload the image directly to the public/storage/img directory
            $path = $request->file('img')->move(public_path('storage/img'), $fileNameToStore);
            // dd($path);
            // Alternatively, you can use storeAs
            // $path = $request->file('img')->storeAs('public/storage/img/', $fileNameToStore);
        } else {
            $fileNameToStore = 'no_image.jpg';
        }

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->mob = $request->input('mobile');
        // if (($request->input('password')) != '') {
        //     $user->password = Hash::make($request->input('password'));
        // }
        $user->address = $request->input('adrs');
        if ($request->hasFile('img')) {
            $user->image = $fileNameToStore;
        }
        $user->updated_at = Carbon::now('Asia/Karachi');
        $user->ip_address = $this->get_ip();
        $user->os_name = $this->get_os();
        $user->browser = $this->get_browsers();
        $user->device = $this->get_device();
        $user->save();
        return redirect('editProfile')->with('success', 'Updated Successfully');
    }
    public function checkUser(Request $request)
    {
        $username = $request->username;
        $data = DB::table('users')->where('username', $username)->count();
        if ($data > 0) {
            return 'not unique';
        } else {
            return 'unique';
        }
    }
    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $data = DB::table('users')->where('email', $email)->count();
        if ($data > 0) {
            return 'not unique';
        } else {
            return 'unique';
        }
    }
    public function changeStatus(Request $request)
    {
        // dd($request->all());

        $user = User::find($request->user_id);
        $user->user_status = $request->status;
        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
