<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    public function index(Request $request){
        $query = DB::table('users');
        $query->join('users as super', 'super.id', '=', 'users.supervisor');
        $query->select('users.*', 'super.name as supervisor_name');
        $ar = json_decode($request->array);
        $name = (!isset($request->name) && empty($request->name)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->name;
        $role = (!isset($request->role) && empty($request->role)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->role;
        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->to_date;
        $search = (!isset($request->search) && empty($request->search)) ? ((!empty($ar)) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($name)){
            $query->where('users.id', '=', $name);
        }
        if (!empty($role)){
            $query->where('users.role', '=', $role);
        }
        if (!empty($from_date)){
            $query->where('users.created_at', '>=', date($from_date));
        }
        if (!empty($to_date)){
            $query->where('users.created_at', '<=', date($to_date));
        }
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('users.name', 'like', '%' . $search . '%');
                $query->orWhere('users.username', 'like', '%' . $search . '%');
                $query->orWhere('users.email', 'like', '%' . $search . '%');
                $query->orWhere('users.mob', 'like', '%' . $search . '%');
                $query->orWhere('users.address', 'like', '%' . $search . '%');
                $query->orWhere('users.role', 'like', '%' . $search . '%');
                $query->orWhere('super.name', 'like', '%' . $search . '%');
                $query->orWhere('users.created_at', 'like', '%' . $search . '%');
            });
        }
        $query->orderByDesc('users.created_at');
        $pagination_number = (empty($ar)) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $all_name = DB::table('users')->whereIn('id', DB::table('users')->pluck('id')->all())->get();
        $count_row = count($datas);
//            PRINT
        $prnt_page_dir = 'print.pages.p_role';
        $pge_title = 'Users List';
        $srch_fltr = [];
        array_push($srch_fltr, $from_date, $to_date, $search);
        $type = '';
        $reminder = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = (isset($request->str)) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if( $type === 'pdf') {
                return $pdf->stream($pge_title.'_x.pdf');
            }
            else if( $type === 'download_pdf') {
                return $pdf->download($pge_title.'_x.pdf');
            }
            else if( $type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title.'_x.xlsx');
            }
        }
        else {
            return view('role.index', compact('datas','count_row', 'pge_title', 'type', 'name', 'all_name'
                , 'from_date', 'to_date', 'search'));
        }
    }
    public function create(){
        $roles = DB::table('users')
            ->where('role', '=', 'supervisor')->get();
        return view('role.createRole', compact('roles'));
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'mobile' => 'required',
            'password' => 'required|min:8',
            'confirm-password' => 'required|same:password',
//            'role' => 'required',
        ], [
            'password.required' => 'Please enter Password',
            'password.min' => 'Password should contain minimum 8 character.',
            'confirm-password.same' => 'Password and Confirm Password should be same.'
        ]);
        // Handle File Upload
        if ($request->hasFile('img')){
            //Get filename with extension
            $fileNameWithExt = $request->file('img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file ('img')->getClientOriginalExtension();
            //Filename to Store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the image
            $path = $request->file('img')->storeAs('public/img', $fileNameToStore);
        }else{
            $fileNameToStore = 'no_image.jpg';
        }
        $user = new User;
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mob = $request->input('mobile');
        $user->password = Hash::make($request->input('password'));
        $user->address = $request->input('adrs');
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
        $user->save();
        return redirect('role')->with('success', 'Successfully Created');
    }
    public function edit(Request $request){
        $user = User::find($request->id);
        if ($user->role == 'Admin'){
            if (Auth::user()->role == 'Admin'){
                $userSupervisors = DB::table('users')->where('role', '=', 'Supervisor')->get();
                return view('role.editRole', compact('user', 'userSupervisors'));
            }else{
                return back()->with('error', 'You can not edit Admin');
            }
        }else{
            $userSupervisors = DB::table('users')->where('role', '=', 'Supervisor')->get();
            return view('role.editRole', compact('user', 'userSupervisors'));
        }
    }
    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required|min:8',
            'confirm-password' => 'required|same:password',
//            'role' => 'required',
        ], [
            'password.required' => 'Please enter Password',
            'password.min' => 'Password should contain minimum 8 character.',
            'confirm-password.same' => 'Password and Confirm Password should be same.'
        ]);
        // Handle File Upload
        if ($request->hasFile('img')){
            //Get filename with extension
            $fileNameWithExt = $request->file('img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file ('img')->getClientOriginalExtension();
            //Filename to Store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the image
            $path = $request->file('img')->storeAs('public/img', $fileNameToStore);
        }

        $user = User::find($request->id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mob = $request->input('mobile');
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
        if ($request->hasFile('img')){
            $user->image = $fileNameToStore;
        }
        $user->updated_at = Carbon::now('Asia/Karachi');
        $user->ip_address = $this->get_ip();
        $user->os_name = $this->get_os();
        $user->browser = $this->get_browsers();
        $user->device = $this->get_device();
        $user->save();
        return redirect('role')->with('success', 'Updated Successfully');
    }
    public function delete(Request $request){
        $user = User::find($request->id);
        if ($user->role == 'Admin'){
            return redirect('/role')->with('error', 'Admin can not be Delete');
        }
        //delete image from folder
        if ($user->images != 'no_image.jpg'){
            Storage::delete('public/img/'.$user->images);
        }
        $user->delete();
        return redirect('role')->with('success', 'Successfully Deleted');
    }
    public function editProfile(){
        $user = Auth::user();
        return view('role.editProfile', compact('user'));
    }
    public function updateProfile(Request $request){
        // Handle File Upload
        if ($request->hasFile('img')){
            //Get filename with extension
            $fileNameWithExt = $request->file('img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file ('img')->getClientOriginalExtension();
            //Filename to Store
//            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the image
            $path = $request->file('img')->storeAs('public/img', $fileNameToStore);
        }

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->mob = $request->input('mobile');
        if (($request->input('password')) != ''){
            $user->password = Hash::make($request->input('password'));
        }
        $user->address = $request->input('adrs');
        if ($request->hasFile('img')){
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
    public function checkUser(Request $request){
        $username = $request->username;
        $data = DB::table("users")->where('username', $username)->count();
        if ($data > 0) {
            return 'not unique';
        } else {
            return 'unique';
        }
    }
    public function checkEmail(Request $request){
        $email = $request->email;
        $data = DB::table("users")->where('email', $email)->count();
        if ($data > 0) {
            return 'not unique';
        } else {
            return 'unique';
        }
    }
}
