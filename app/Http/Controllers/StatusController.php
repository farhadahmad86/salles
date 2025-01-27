<?php

namespace App\Http\Controllers;

use App\Models\Funnel;
use App\Models\Status;
use Carbon\Carbon;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    public function index()
    {
        $allStatus = DB::table('status')->get();
        return view('status.index', compact('allStatus'));
    }
    public function create()
    {
        return view('status.createStatus');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|unique:status,sta_status'
        ]);
        $add_status = new Status;
        $add_status->sta_status = $request->input('status');
        $add_status->created_at = Carbon::now('Asia/Karachi');
        $add_status->updated_at = Carbon::now('Asia/Karachi');
        $add_status->ip_address = $this->get_ip();
        $add_status->os_name = $this->get_os();
        $add_status->browser = $this->get_browsers();
        $add_status->device = $this->get_device();
        $add_status->save();
        return redirect('/status')->with('success', 'Successfully Added');
    }
    public function edit(Request $request)
    {
        $edit_status = DB::table('status')->where('sta_id', $request->id)->first();
        return view('status.editStatus', compact('edit_status'));
    }
    public function update(Request $request)
    {
        $update_status = Status::find($request->id);
        $update_status->sta_status = $request->input('status');
        $update_status->updated_at = Carbon::now('Asia/Karachi');
        $update_status->ip_address = $this->get_ip();
        $update_status->os_name = $this->get_os();
        $update_status->browser = $this->get_browsers();
        $update_status->device = $this->get_device();
        $update_status->save();
        return redirect('/status')->with('success', 'Successfully Updated');
    }
    public function delete(Request $request)
    {
        $funnel = Funnel::where('status_id', $request->id)->count();
        if ($funnel == 0) {
            $delete_status = Status::find($request->id);
            $delete_status->delete();
            return redirect('/status')->with('success', 'Successfully Deleted');
        }
        return redirect('/status')->with('error', 'This Status is using on another Table');
    }
}
