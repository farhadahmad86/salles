<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Models\Funnel;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Reminder;
use App\Models\Schedule;
use App\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Carbon\Traits\Date;
use function foo\func;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use function React\Promise\all;

class ReminderController extends Controller
{
    //    GETTING USERS AFTER CHOOSING ROLE
    public function role(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        if ($auth->type == 'Master') {
            $role = User::where('role', $request->role)
                ->where('users_company_id', $auth->users_company_id)
                ->get();
        } else {
            $role = User::where('role', $request->role)
                ->where('users_company_id', $auth->users_company_id)
                ->whereNotIn('type', ['Master'])
                ->get();
        }
        $data[] = '<option value="">All</option>';
        foreach ($role as $user) {
            $data[] =
                '
                <option value="' .
                $user->id .
                '">' .
                $user->name .
                '</option>
            ';
        }
        return response()->json(compact('data'));
    }
    public function all_work()
    {
        $auth = Auth::user();
        return view('tele_caller_reports.all_work', compact('auth'));
    }
    //    FETCHING DATA AFTER ON ALL WORK PAGE
    public function all_work_data(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $get_supervisor = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', $request->role)
            ->pluck('id');
        if ($request->user_table == 'schedule') {
            $user_id = $request->user_id;
            $query = DB::table('schedule')
                ->where('schedule_company_id', $auth->users_company_id)
                ->where('schedule_company_id', $auth->users_company_id);
            $query->join('users', 'users.id', '=', 'schedule.user_id');
            $query->join('company', 'company.id', '=', 'schedule.company_id');
            $query->join('visit_type', 'visit_type.visit_type_id', '=', 'schedule.type_of_visit');
            $query->select('schedule.*', 'schedule.user_id as schedule_user_id', 'schedule.id as schId', 'users.*', 'company.*', 'visit_type.*', 'schedule.created_at as sch_created_at', 'schedule.updated_at as sch_updated_at');
            if (isset($request->from_date)) {
                $query->whereDate('schedule.created_at', '>=', date($request->from_date));
            }
            if (isset($request->to_date)) {
                $query->whereDate('schedule.created_at', '<=', date($request->to_date));
            }
            if (isset($user_id)) {
                $query->where('schedule.user_id', '=', $user_id);
            }
            $query->where(function ($q) {
                $q->whereNotIn('sch_reminder_reason', ['kem_reminder', 'close_reminder'])->orWhereNull('sch_reminder_reason');
            });
            $query->whereIn('schedule.user_id', $get_supervisor);
            $data = $query->get();
            // dd($data, $get_supervisor);
            $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Visit Type</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            ';
            foreach ($data as $key => $schedule_data) {
                $table_data[] =
                    '
                     <tbody>
                        <tr>
                            <td>' .
                    ($key + 1) .
                    '</td><td>' .
                    $schedule_data->date .
                    '</td><td>' .
                    $schedule_data->name .
                    '</td><td>' .
                    $schedule_data->company_name .
                    '</td>
                            <td>' .
                    $schedule_data->visit_type_name .
                    '</td><td>' .
                    $schedule_data->sch_remarks .
                    '</td><td>' .
                    date('d-M-Y', strtotime($schedule_data->sch_created_at)) .
                    '</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item my_reminder" href="#" data-toggle="modal"  data-target=".my_modal" data-reminder_row_id="' .
                    $schedule_data->schId .
                    '" data-reminder_for_id="' .
                    $schedule_data->schedule_user_id .
                    '">Reminder</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                ';
            }
        } elseif ($request->user_table == 'funnel') {
            $user_id = $request->user_id;
            $query = DB::table('funnel')->where('funnel_company_id', $auth->users_company_id);
            $query->join('users', 'users.id', '=', 'funnel.user_id');
            $query->join('company', 'company.id', '=', 'funnel.company_id');
            $query->join('category', 'category.cat_id', '=', 'funnel.category_id');
            $query->join('status', 'status.sta_id', '=', 'funnel.status_id');
            $query->select('funnel.*', 'funnel.user_id as funnel_user_id', 'funnel.id as funId', 'users.*', 'company.*', 'category.*', 'funnel.created_at as funnel_created_at', 'status.*');
            if (isset($request->from_date)) {
                $query->whereDate('funnel.created_at', '>=', date($request->from_date));
            }
            if (isset($request->to_date)) {
                $query->wheredate('funnel.created_at', '<=', date($request->to_date));
            }
            if (isset($user_id)) {
                $query->where('funnel.user_id', '=', $user_id);
            }
            $query->where(function ($q) {
                $q->whereNotIn('funnel_reminder_reason', ['kem_reminder', 'close_reminder'])->orWhereNull('funnel_reminder_reason');
            });
            $query->whereIn('funnel.user_id', $get_supervisor);
            $data = $query->get();
            $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Category</th>
                        <th>MRC</th>
                        <th>OTC</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            ';
            foreach ($data as $key => $funnel_data) {
                $table_data[] =
                    '
                     <tbody>
                        <tr>
                            <td>' .
                    ($key + 1) .
                    '</td><td>' .
                    $funnel_data->date .
                    '</td><td>' .
                    $funnel_data->name .
                    '</td><td>' .
                    $funnel_data->company_name .
                    '</td>
                            <td>' .
                    $funnel_data->cat_category .
                    '</td><td>' .
                    $funnel_data->mrc .
                    '</td><td>' .
                    $funnel_data->otc .
                    '</td><td>' .
                    $funnel_data->sta_status .
                    '</td>
                            <td>' .
                    date('d-M-Y', strtotime($funnel_data->funnel_created_at)) .
                    '</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item my_reminder" href="#" data-toggle="modal"  data-target=".my_modal" data-reminder_row_id="' .
                    $funnel_data->funId .
                    '" data-reminder_for_id="' .
                    $funnel_data->funnel_user_id .
                    '">Reminder</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                ';
            }
        } elseif ($request->user_table == 'invoice') {
            $role = $request->role;
            $user_id = $request->user_id;
            $query = DB::table('invoice')->where('invoice_company_id', $auth->users_company_id);
            $query->join('users', 'users.id', '=', 'invoice.user_id');
            $query->join('company', 'company.id', '=', 'invoice.company_id');
            $query->select('invoice.*', 'invoice.user_id as invoice_user_id', 'invoice.id as invoiceId', 'users.*', 'company.*', 'invoice.created_at as invoice_created_at');
            if (isset($request->from_date)) {
                $query->whereDate('invoice.created_at', '>=', date($request->from_date));
            }
            if (isset($request->to_date)) {
                $query->wheredate('invoice.created_at', '<=', date($request->to_date));
            }
            if (isset($user_id)) {
                $query->where('invoice.user_id', '=', $user_id);
            }
            $query->where(function ($q) {
                $q->whereNotIn('invoice_reminder_reason', ['kem_reminder', 'close_reminder'])->orWhereNull('invoice_reminder_reason');
            });
            $query->whereIn('invoice.user_id', $get_supervisor);
            $data = $query->get();
            $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Grand Total</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            ';
            foreach ($data as $key => $invoice_data) {
                $table_data[] =
                    '
                     <tbody>
                        <tr>
                            <td>' .
                    ($key + 1) .
                    '</td><td>' .
                    $invoice_data->inv_date .
                    '</td><td>' .
                    $invoice_data->name .
                    '</td><td>' .
                    $invoice_data->company_name .
                    '</td><td>' .
                    $invoice_data->grand_total .
                    '</td><td>' .
                    date('d-M-Y', strtotime($invoice_data->invoice_created_at)) .
                    '</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item my_reminder" href="#" data-toggle="modal"  data-target=".my_modal" data-reminder_row_id="' .
                    $invoice_data->invoiceId .
                    '" data-reminder_for_id="' .
                    $invoice_data->invoice_user_id .
                    '">Reminder</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                ';
            }
        } elseif ($request->user_table == 'order') {
            $user_id = $request->user_id;
            $query = DB::table('order')->where('order_company_id', $auth->users_company_id);
            $query->join('users', 'users.id', '=', 'order.user_id');
            $query->join('company', 'company.id', '=', 'order.company_id');
            $query->select('order.*', 'order.user_id as order_user_id', 'order.id as orderId', 'users.*', 'company.*', 'order.created_at as order_created_at');
            if (isset($request->from_date)) {
                $query->whereDate('order.created_at', '>=', date($request->from_date));
            }
            if (isset($request->to_date)) {
                $query->wheredate('order.created_at', '<=', date($request->to_date));
            }
            if (isset($user_id)) {
                $query->where('order.user_id', '=', $user_id);
            }
            $query->where(function ($q) {
                $q->whereNotIn('order_reminder_reason', ['kem_reminder', 'close_reminder'])->orWhereNull('order_reminder_reason');
            });
            $query->whereIn('order.user_id', $get_supervisor);
            $data = $query->get();
            $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Grand Total</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            ';
            foreach ($data as $key => $order_data) {
                $table_data[] =
                    '
                     <tbody>
                        <tr>
                            <td>' .
                    ($key + 1) .
                    '</td><td>' .
                    $order_data->sale_date .
                    '</td><td>' .
                    $order_data->name .
                    '</td><td>' .
                    $order_data->company_name .
                    '</td><td>' .
                    $order_data->grand_total .
                    '</td><td>' .
                    date('d-M-Y', strtotime($order_data->order_created_at)) .
                    '</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item my_reminder" href="#" data-toggle="modal"  data-target=".my_modal" data-reminder_row_id="' .
                    $order_data->orderId .
                    '" data-reminder_for_id="' .
                    $order_data->order_user_id .
                    '">Reminder</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                ';
            }
        }
        return response()->json(compact('table_data'));
        //        return response()->json(compact('role', 'user_id'));
    }
    //    INSERTING REMINDERS
    public function add_reminder(Request $request)
    {
        $auth = Auth::user();
        if ($request->reminder_table == 'schedule') {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_schedule_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_reason = $request->input('reminder_reason');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();

            $update_schedule = Schedule::find($request->input('reminder_row_id'));
            $update_schedule->sch_reminder_reason = $request->input('reminder_reason');
            $update_schedule->ip_address = $this->get_ip();
            $update_schedule->os_name = $this->get_os();
            $update_schedule->browser = $this->get_browsers();
            $update_schedule->device = $this->get_device();
            $update_schedule->save();
        } elseif ($request->reminder_table == 'funnel') {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_funnel_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->reminder_reason = $request->input('reminder_reason');
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();

            $update_funnel = Funnel::find($request->input('reminder_row_id'));
            $update_funnel->funnel_reminder_reason = $request->input('reminder_reason');
            $update_funnel->ip_address = $this->get_ip();
            $update_funnel->os_name = $this->get_os();
            $update_funnel->browser = $this->get_browsers();
            $update_funnel->device = $this->get_device();
            $update_funnel->save();
        } elseif ($request->reminder_table == 'invoice') {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_purposal_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->reminder_reason = $request->input('reminder_reason');
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();

            $update_purposal = Invoice::find($request->input('reminder_row_id'));
            $update_purposal->invoice_reminder_reason = $request->input('reminder_reason');
            $update_purposal->ip_address = $this->get_ip();
            $update_purposal->os_name = $this->get_os();
            $update_purposal->browser = $this->get_browsers();
            $update_purposal->device = $this->get_device();
            $update_purposal->save();
        } elseif ($request->reminder_table == 'order') {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_order_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->reminder_reason = $request->input('reminder_reason');
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();

            $update_order = Order::find($request->input('reminder_row_id'));
            $update_order->order_reminder_reason = $request->input('reminder_reason');
            $update_order->ip_address = $this->get_ip();
            $update_order->os_name = $this->get_os();
            $update_order->browser = $this->get_browsers();
            $update_order->device = $this->get_device();
            $update_order->save();
        }
    }
    public function completed_work()
    {
        $auth = Auth::user();
        return view('tele_caller_reports.completed_work', compact('auth'));
    }
    //    FETCHING DATA AFTER ON COMPLETED WORK PAGE
    public function completed_work_data(Request $request)
    {
        $auth = Auth::user();
        $get_supervisor = DB::table('users')
            ->where('role', '=', $request->role)
            ->pluck('id');
        if ($request->user_table == 'schedule') {
            $user_id = $request->user_id;
            $query = DB::table('schedule')->where('schedule_company_id', $auth->users_company_id);
            $query->join('users', 'users.id', '=', 'schedule.user_id');
            $query->join('company', 'company.id', '=', 'schedule.company_id');
            $query->join('visit_type', 'visit_type.visit_type_id', '=', 'schedule.type_of_visit');
            $query->select('schedule.*', 'schedule.id as schId', 'users.*', 'company.*', 'visit_type.*', 'schedule.created_at as sch_created_at', 'schedule.updated_at as sch_updated_at');
            if (isset($request->from_date)) {
                $query->whereDate('schedule.created_at', '>=', date($request->from_date));
            }
            if (isset($request->to_date)) {
                $query->wheredate('schedule.created_at', '<=', date($request->to_date));
            }
            if (isset($user_id)) {
                $query->where('schedule.user_id', '=', $user_id);
            }
            $query->where(function ($q) {
                $q->whereIn('sch_reminder_reason', ['kem_reminder', 'close_reminder']);
            });
            $query->whereIn('schedule.user_id', $get_supervisor);
            $data = $query->get();
            // dd($data);
            if ($data->isEmpty()) {
                // Display a message indicating no data is found
                $table_data = '<div>No data found</div>';
            } else {
                $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Visit Type</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            ';
                foreach ($data as $key => $schedule_data) {
                    $table_data[] =
                        '
                     <tbody>
                        <tr>
                            <td>' .
                        ($key + 1) .
                        '</td><td>' .
                        $schedule_data->date .
                        '</td><td>' .
                        $schedule_data->name .
                        '</td><td>' .
                        $schedule_data->company_name .
                        '</td>
                            <td>' .
                        $schedule_data->visit_type_name .
                        '</td><td>' .
                        $schedule_data->sch_remarks .
                        '</td><td>' .
                        date('d-M-Y', strtotime($schedule_data->sch_created_at)) .
                        '</td>
                            <!-- <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item my_reminder" href="#" data-toggle="modal"  data-target=".my_modal" data-reminder_row_id="' .
                        $schedule_data->schId .
                        '" data-reminder_for_id="' .
                        $schedule_data->user_id .
                        '">Reminder</a>
                                    </div>
                                </div>
                            </td> -->
                        </tr>
                    </tbody>
                ';
                }
            }
        } elseif ($request->user_table == 'funnel') {
            $user_id = $request->user_id;
            $query = DB::table('funnel')->where('funnel_company_id', $auth->users_company_id);
            $query->join('users', 'users.id', '=', 'funnel.user_id');
            $query->join('company', 'company.id', '=', 'funnel.company_id');
            $query->join('category', 'category.cat_id', '=', 'funnel.category_id');
            $query->join('status', 'status.sta_id', '=', 'funnel.status_id');
            $query->select('funnel.*', 'funnel.id as funId', 'users.*', 'company.*', 'category.*', 'funnel.created_at as funnel_created_at', 'status.*');
            if (isset($request->from_date)) {
                $query->whereDate('funnel.created_at', '>=', date($request->from_date));
            }
            if (isset($request->to_date)) {
                $query->wheredate('funnel.created_at', '<=', date($request->to_date));
            }
            if (isset($user_id)) {
                $query->where('funnel.user_id', '=', $user_id);
            }
            $query->where(function ($q) {
                $q->whereIn('funnel_reminder_reason', ['kem_reminder', 'close_reminder']);
            });
            $query->whereIn('funnel.user_id', $get_supervisor);
            $data = $query->get();
            if ($data->isEmpty()) {
                // Display a message indicating no data is found
                $table_data = '<div>No data found</div>';
            } else {
                $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Category</th>
                        <th>MRC</th>
                        <th>OTC</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            ';
                foreach ($data as $key => $funnel_data) {
                    $table_data[] =
                        '
                     <tbody>
                        <tr>
                            <td>' .
                        ($key + 1) .
                        '</td><td>' .
                        $funnel_data->date .
                        '</td><td>' .
                        $funnel_data->name .
                        '</td><td>' .
                        $funnel_data->company_name .
                        '</td>
                            <td>' .
                        $funnel_data->cat_category .
                        '</td><td>' .
                        $funnel_data->mrc .
                        '</td><td>' .
                        $funnel_data->otc .
                        '</td><td>' .
                        $funnel_data->sta_status .
                        '</td>
                            <td>' .
                        date('d-M-Y', strtotime($funnel_data->funnel_created_at)) .
                        '</td>
                            <!-- <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item my_reminder" href="#" data-toggle="modal"  data-target=".my_modal" data-reminder_row_id="' .
                        $funnel_data->funId .
                        '" data-reminder_for_id="' .
                        $funnel_data->user_id .
                        '">Reminder</a>
                                    </div>
                                </div>
                            </td> -->
                        </tr>
                    </tbody>
                ';
                }
            }
        } elseif ($request->user_table == 'invoice') {
            $user_id = $request->user_id;
            $query = DB::table('invoice')->where('invoice_company_id', $auth->users_company_id);
            $query->join('users', 'users.id', '=', 'invoice.user_id');
            $query->join('company', 'company.id', '=', 'invoice.company_id');
            $query->select('invoice.*', 'invoice.id as invoiceId', 'users.*', 'company.*', 'invoice.created_at as invoice_created_at');
            if (isset($request->from_date)) {
                $query->whereDate('invoice.created_at', '>=', date($request->from_date));
            }
            if (isset($request->to_date)) {
                $query->wheredate('invoice.created_at', '<=', date($request->to_date));
            }
            if (isset($user_id)) {
                $query->where('invoice.user_id', '=', $user_id);
            }
            $query->where(function ($q) {
                $q->whereIn('invoice_reminder_reason', ['kem_reminder', 'close_reminder']);
            });
            $query->whereIn('invoice.user_id', $get_supervisor);
            $data = $query->get();
            if ($data->isEmpty()) {
                // Display a message indicating no data is found
                $table_data = '<div>No data found</div>';
            } else {
                $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Grand Total</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            ';
                foreach ($data as $key => $invoice_data) {
                    $table_data[] =
                        '
                     <tbody>
                        <tr>
                            <td>' .
                        ($key + 1) .
                        '</td><td>' .
                        $invoice_data->date .
                        '</td><td>' .
                        $invoice_data->name .
                        '</td><td>' .
                        $invoice_data->company_name .
                        '</td><td>' .
                        $invoice_data->grand_total .
                        '</td><td>' .
                        date('d-M-Y', strtotime($invoice_data->invoice_created_at)) .
                        '</td>
                            <!-- <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item my_reminder" href="#" data-toggle="modal"  data-target=".my_modal" data-reminder_row_id="' .
                        $invoice_data->invoiceId .
                        '" data-reminder_for_id="' .
                        $invoice_data->user_id .
                        '">Reminder</a>
                                    </div>
                                </div>
                            </td> -->
                        </tr>
                    </tbody>
                ';
                }
            }
        } elseif ($request->user_table == 'order') {
            $user_id = $request->user_id;
            $query = DB::table('order')->where('order_company_id', $auth->users_company_id);
            $query->join('users', 'users.id', '=', 'order.user_id');
            $query->join('company', 'company.id', '=', 'order.company_id');
            $query->select('order.*', 'order.id as orderId', 'users.*', 'company.*', 'order.created_at as order_created_at');
            if (isset($request->from_date)) {
                $query->whereDate('order.created_at', '>=', date($request->from_date));
            }
            if (isset($request->to_date)) {
                $query->wheredate('order.created_at', '<=', date($request->to_date));
            }
            if (isset($user_id)) {
                $query->where('order.user_id', '=', $user_id);
            }
            $query->where(function ($q) {
                $q->whereIn('order_reminder_reason', ['kem_reminder', 'close_reminder']);
            });
            $query->whereIn('order.user_id', $get_supervisor);
            $data = $query->get();
            if ($data->isEmpty()) {
                // Display a message indicating no data is found
                $table_data = '<div>No data found</div>';
            } else {
                $table_data[] = '
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Grand Total</th>
                        <th>Created At</th>
                    </tr>
                </thead>
            ';
                foreach ($data as $key => $order_data) {
                    $table_data[] =
                        '
                     <tbody>
                        <tr>
                            <td>' .
                        ($key + 1) .
                        '</td><td>' .
                        $order_data->sale_date .
                        '</td><td>' .
                        $order_data->name .
                        '</td><td>' .
                        $order_data->company_name .
                        '</td><td>' .
                        $order_data->grand_total .
                        '</td><td>' .
                        date('d-M-Y', strtotime($order_data->order_created_at)) .
                        '</td>
                            <!-- <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item my_reminder" href="#" data-toggle="modal"  data-target=".my_modal" data-reminder_row_id="' .
                        $order_data->orderId .
                        '" data-reminder_for_id="' .
                        $order_data->user_id .
                        '">Reminder</a>
                                    </div>
                                </div>
                            </td> -->
                        </tr>
                    </tbody>
                ';
                }
            }
        }
        return response()->json(compact('table_data'));
    }
    public function sch_reminder(Request $request)
    {
        $auth = Auth::user();
        $has_reason = $request->input('reminder_reason');
        if (isset($has_reason)) {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_schedule_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_reason = $request->input('reminder_reason');
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();
            $update_funnel = Schedule::find($request->input('reminder_row_id'));
            $update_funnel->sch_reminder_reason = $request->input('reminder_reason');
            $update_funnel->ip_address = $this->get_ip();
            $update_funnel->os_name = $this->get_os();
            $update_funnel->browser = $this->get_browsers();
            $update_funnel->device = $this->get_device();
            $update_funnel->save();
        } else {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_schedule_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();
        }
        return redirect('/schedule_show')->with('success', 'Reminder Added');
    }
    //    public function re_schedule_reminder(Request $request){
    //        $add_reminder = Reminder::find($request->input('update_reminder_id'));
    //        $add_reminder->reminder_user_id = Auth::user()->id;
    //        $add_reminder->reminder_schedule_id = $request->input('update_sch_id');
    //        $add_reminder->reminder_for_id = $request->input('update_reminder_for_id');
    //        $add_reminder->reminder_remarks = $request->input('update_sch_reminder_remarks');
    //        $add_reminder->reminder_date = $request->input('update_sch_reminder_date');
    //        $add_reminder->reminder_reason = $request->input('update_reason');
    //        $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
    //        $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
    //$add_reminder->ip_address = $this->get_ip();
    //$add_reminder->os_name = $this->get_os();
    //$add_reminder->browser = $this->get_browsers();
    //$add_reminder->device = $this->get_device();
    //        $add_reminder->save();
    //
    //        $update_schedule = Schedule::find($request->input('update_sch_id'));
    //        $update_schedule->sch_reminder_reason = $request->input('update_reason');
    //$update_schedule->ip_address = $this->get_ip();
    //$update_schedule->os_name = $this->get_os();
    //$update_schedule->browser = $this->get_browsers();
    //$update_schedule->device = $this->get_device();
    //        $update_schedule->save();
    //        return redirect('/schedule_show')->with('success', 'Reminder Added');
    //    }
    public function scheduleReminder(Request $request, $array = null, $str = null)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->get()
            ->pluck('id');
        $query = DB::table('reminder')->where('reminder_company_id', $auth->users_company_id);
        $query->join('users as users_user_id', 'users_user_id.id', '=', 'reminder.reminder_user_id');
        $query->join('users as users_reminder_for', 'users_reminder_for.id', '=', 'reminder.reminder_for_id');
        $query->join('schedule', 'schedule.id', '=', 'reminder.reminder_schedule_id');
        $query->join('company', 'company.id', '=', 'schedule.company_id');
        $query->join('visit_type', 'visit_type_id', '=', 'schedule.type_of_visit');
        $query->select('users_user_id.id as user_id', 'users_user_id.name as user_id_name', 'reminder.reminder_remarks', 'reminder.reminder_id', 'reminder.reminder_schedule_id', 'reminder.reminder_date', 'reminder.reminder_created_at', 'schedule.sch_remarks', 'company.id', 'company.company_name', 'visit_type.visit_type_id', 'visit_type.visit_type_name', 'reminder.reminder_reason', 'reminder.reminder_user_id', 'users_reminder_for.id as users_reminder_for_id', 'users_reminder_for.name as users_reminder_for_name');
        //        $query->where('reminder.reminder_for_id', '=', Auth::user()->id);
        $ar = json_decode($request->array);
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $visit_type = !isset($request->visit_type) && empty($request->visit_type) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->visit_type;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->to_date;
        $search = !isset($request->search) && empty($request->search) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('reminder.reminder_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('reminder.reminder_created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('company.id', '=', $companies);
        }
        if (!empty($visit_type)) {
            $query->where('visit_type.visit_type_id', '=', $visit_type);
        }
        if (!empty($created_by)) {
            $query->where('reminder.reminder_user_id', '=', $created_by);
        }
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('company_name', 'like', '%' . $search . '%');
                $query->orWhere('reminder_date', 'like', '%' . $search . '%');
                $query->orWhere('visit_type_name', 'like', '%' . $search . '%');
                $query->orWhere('users_reminder_for.name', 'like', '%' . $search . '%');
                $query->orWhere('reminder_remarks', 'like', '%' . $search . '%');
                $query->orWhere('reminder_created_at', 'like', '%' . $search . '%');
            });
        } else {
            $query->whereIn(
                'reminder.reminder_user_id',
                DB::table('users')
                    ->where('role', '=', 'Tele Caller')
                    ->orWhere('id', '=', Auth::user()->id)
                    ->pluck('id'),
            );
        }
        $query->orderByDesc('reminder_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('schedule')
            ->where('schedule_company_id', $auth->users_company_id)
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $tele_caller = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', 'Tele Caller')
            ->pluck('id');
        // dd($tele_caller);
        $sch_reminder = DB::table('reminder')
            ->where('reminder_company_id', $auth->users_company_id)
            ->join('users as users_user_id', 'users_user_id.id', '=', 'reminder.reminder_user_id')
            ->join('users as users_reminder_for', 'users_reminder_for.id', '=', 'reminder.reminder_for_id')
            ->join('schedule', 'schedule.id', '=', 'reminder.reminder_schedule_id')
            ->join('company', 'company.id', '=', 'schedule.company_id')
            ->join('visit_type', 'visit_type_id', '=', 'schedule.type_of_visit')
            ->select('users_user_id.id as user_id', 'users_user_id.name as user_id_name', 'reminder.reminder_remarks', 'reminder.reminder_id', 'reminder.reminder_schedule_id', 'reminder.reminder_date', 'reminder.reminder_created_at', 'schedule.sch_remarks', 'company.id', 'company.company_name', 'visit_type.visit_type_id', 'visit_type.visit_type_name', 'reminder.reminder_reason', 'reminder.reminder_user_id')
            ->groupBy('company_name') // ->whereIn('reminder.reminder_user_id', $tele_caller)
            ->get();
        // dd($sch_reminder);
        $all_created_by = DB::table('reminder')
            ->where('reminder_company_id', $auth->users_company_id)
            ->join('users', 'id', '=', 'reminder.reminder_user_id')
            ->select('users.id', 'users.name')
            ->where('users.role', '=', 'Tele Caller')
            ->orWhere('reminder.reminder_for_id', Auth::user()->id)
            ->groupBy('reminder.reminder_user_id')
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_schedule_reminder';
        $pge_title = 'Schedule Reminder List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $visit_type, $from_date, $to_date, $search);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = isset($request->str) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('scheduleReminder.scheduleReminder', compact('datas', 'count_row', 'pge_title', 'type', 'created_by', 'from_date', 'to_date', 'search', 'reminder', 'sch_reminder', 'all_created_by', 'companies', 'visit_type'));
        }
    }
    public function funnel_reminder(Request $request)
    {
        $auth = Auth::user();
        $has_reason = $request->input('reminder_reason');
        $auth = Auth::user();
        if (isset($has_reason)) {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_funnel_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_reason = $request->input('reminder_reason');
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();
            $update_funnel = Funnel::find($request->input('reminder_row_id'));
            $update_funnel->sch_reminder_reason = $request->input('reminder_reason');
            $update_funnel->ip_address = $this->get_ip();
            $update_funnel->os_name = $this->get_os();
            $update_funnel->browser = $this->get_browsers();
            $update_funnel->device = $this->get_device();
            $update_funnel->save();
        } else {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_funnel_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();
        }
        return redirect('/funnel')->with('success', 'Reminder Added');
    }
    //    public function re_funnel_reminder(Request $request){
    //        $add_reminder = Reminder::find($request->input('update_reminder_id'));
    //        $add_reminder->reminder_user_id = Auth::user()->id;
    //        $add_reminder->reminder_funnel_id = $request->input('update_funnel_id');
    //        $add_reminder->reminder_for_id = $request->input('update_reminder_for_id');
    //        $add_reminder->reminder_remarks = $request->input('update_funnel_reminder_remarks');
    //        $add_reminder->reminder_date = $request->input('update_funnel_reminder_date');
    //        $add_reminder->reminder_reason = $request->input('update_reason');
    //        $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
    //        $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
    //$add_reminder->ip_address = $this->get_ip();
    //        $add_reminder->os_name = $this->get_os();
    //        $add_reminder->browser = $this->get_browsers();
    //        $add_reminder->device = $this->get_device();
    //        $add_reminder->save();
    //
    //        $update_funnel = Funnel::find($request->input('update_funnel_id'));
    //        $update_funnel->funnel_reminder_reason = $request->input('update_reason');
    //$update_funnel->ip_address = $this->get_ip();
    //        $update_funnel->os_name = $this->get_os();
    //        $update_funnel->browser = $this->get_browsers();
    //        $update_funnel->device = $this->get_device();
    //        $update_funnel->save();
    //        return redirect('/funnel')->with('success', 'Reminder Added');
    //    }
    public function funnelReminder(Request $request, $array = null, $str = null)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->get()
            ->pluck('id');
        $query = DB::table('reminder')->where('reminder_company_id', $auth->users_company_id);
        $query->join('users as users_user_id', 'users_user_id.id', '=', 'reminder.reminder_user_id');
        $query->join('users as users_reminder_for', 'users_reminder_for.id', '=', 'reminder.reminder_for_id');
        $query->join('funnel', 'funnel.id', '=', 'reminder.reminder_funnel_id');
        $query->join('company', 'company.id', '=', 'funnel.company_id');
        $query->join('status', 'sta_id', '=', 'funnel.status_id');
        $query->select('users_user_id.name as user_id_name', 'reminder.reminder_remarks', 'reminder.reminder_id', 'reminder.reminder_reason', 'reminder.reminder_date', 'reminder.reminder_created_at', 'funnel.mrc', 'funnel.otc', 'company.company_name', 'status.sta_status', 'users_reminder_for.id as users_reminder_for_id', 'users_reminder_for.name as users_reminder_for_name');
        //        $query->where('reminder.reminder_for_id', '=', Auth::user()->id);
        $ar = json_decode($request->array);
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $status = !isset($request->status) && empty($request->status) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->status;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->to_date;
        $search = !isset($request->search) && empty($request->search) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('reminder.reminder_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('reminder.reminder_created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('company.id', '=', $companies);
        }
        if (!empty($status)) {
            $query->where('status.sta_id', '=', $status);
        }
        if (!empty($created_by)) {
            $query->where('reminder.reminder_user_id', '=', $created_by);
        }
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('company_name', 'like', '%' . $search . '%');
                $query->orWhere('reminder_date', 'like', '%' . $search . '%');
                $query->orWhere('sta_status', 'like', '%' . $search . '%');
                $query->orWhere('users_reminder_for.name', 'like', '%' . $search . '%');
                $query->orWhere('reminder_remarks', 'like', '%' . $search . '%');
                $query->orWhere('reminder_created_at', 'like', '%' . $search . '%');
            });
        } else {
            $query->whereIn(
                'reminder.reminder_user_id',
                DB::table('users')
                    ->where('role', '=', 'Tele Caller')
                    ->orWhere('id', '=', Auth::user()->id)
                    ->pluck('id'),
            );
        }
        $query->orderByDesc('reminder_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('funnel')
            ->where('funnel_company_id', $auth->users_company_id)
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $tele_caller = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', 'Tele Caller')
            ->pluck('id');
        $funnel_reminder = DB::table('reminder')
            ->where('reminder_company_id', $auth->users_company_id)
            ->join('users as users_user_id', 'users_user_id.id', '=', 'reminder.reminder_user_id')
            ->join('funnel', 'funnel.id', '=', 'reminder.reminder_funnel_id')
            ->join('company', 'company.id', '=', 'funnel.company_id')
            ->join('status', 'sta_id', '=', 'funnel.status_id')
            ->select('users_user_id.name as user_id_name', 'reminder.reminder_remarks', 'reminder.reminder_id', 'reminder.reminder_reason', 'reminder.reminder_date', 'reminder.reminder_created_at', 'funnel.mrc', 'funnel.otc', 'company.id', 'company.company_name', 'status.sta_id', 'status.sta_status')
            ->groupBy('company_name') // ->whereIn('reminder.reminder_user_id', $tele_caller)
            ->get();
        $all_created_by = DB::table('reminder')
            ->where('reminder_company_id', $auth->users_company_id)
            ->join('users', 'id', '=', 'reminder.reminder_user_id')
            ->select('users.id', 'users.name')
            ->where('users.role', '=', 'Tele Caller')
            ->orWhere('reminder.reminder_for_id', Auth::user()->id)
            ->groupBy('reminder.reminder_user_id')
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_funnel_reminder';
        $pge_title = 'Funnel Reminder List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $status, $from_date, $to_date, $search);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = isset($request->str) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('funnelReminder.funnelReminder', compact('datas', 'count_row', 'pge_title', 'type', 'created_by', 'from_date', 'to_date', 'search', 'reminder', 'funnel_reminder', 'all_created_by', 'companies', 'status'));
        }
    }
    public function purposal_reminder(Request $request)
    {
        $auth = Auth::user();
        $auth = Auth::user();
        $has_reason = $request->input('reminder_reason');
        if (isset($has_reason)) {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_purposal_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_reason = $request->input('reminder_reason');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();
            $update_funnel = Invoice::find($request->input('reminder_row_id'));
            $update_funnel->invoice_reminder_reason = $request->input('reminder_reason');
            $update_funnel->ip_address = $this->get_ip();
            $update_funnel->os_name = $this->get_os();
            $update_funnel->browser = $this->get_browsers();
            $update_funnel->device = $this->get_device();
            $update_funnel->save();
        } else {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_purposal_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();
        }
        return redirect('/quotations')->with('success', 'Reminder Added');
    }
    //    public function re_purposal_reminder(Request $request){
    //        $add_reminder = Reminder::find($request->input('update_reminder_id'));
    //        $add_reminder->reminder_user_id = Auth::user()->id;
    //        $add_reminder->reminder_purposal_id = $request->input('update_purposal_id');
    //        $add_reminder->reminder_for_id = $request->input('update_reminder_for_id');
    //        $add_reminder->reminder_remarks = $request->input('update_purposal_reminder_remarks');
    //        $add_reminder->reminder_date = $request->input('update_purposal_reminder_date');
    //        $add_reminder->reminder_reason = $request->input('update_reason');
    //        $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
    //        $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
    //$add_reminder->ip_address = $this->get_ip();
    //$add_reminder->os_name = $this->get_os();
    //$add_reminder->browser = $this->get_browsers();
    //$add_reminder->device = $this->get_device();
    //        $add_reminder->save();
    //
    //        $update_purposal = Invoice::find($request->input('update_purposal_id'));
    //        $update_purposal->invoice_reminder_reason = $request->input('update_reason');
    //$update_purposal->ip_address = $this->get_ip();
    //$update_purposal->os_name = $this->get_os();
    //$update_purposal->browser = $this->get_browsers();
    //$update_purposal->device = $this->get_device();
    //        $update_purposal->save();
    //        return redirect('/allInvoices')->with('success', 'Reminder Added');
    //    }
    public function purposalReminder(Request $request, $array = null, $str = null)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->get()
            ->pluck('id');
        $query = DB::table('reminder')->where('reminder_company_id', $auth->users_company_id);
        $query->join('users as users_user_id', 'users_user_id.id', '=', 'reminder.reminder_user_id');
        $query->join('users as users_reminder_for', 'users_reminder_for.id', '=', 'reminder.reminder_for_id');
        $query->join('invoice', 'invoice.id', '=', 'reminder.reminder_purposal_id');
        $query->join('company', 'company.id', '=', 'invoice.company_id');
        $query->select('users_user_id.name as user_id_name', 'reminder.reminder_remarks', 'reminder.reminder_date', 'reminder.reminder_reason', 'reminder.reminder_created_at', 'reminder.reminder_id', 'invoice.grand_total', 'company.id', 'company.company_name', 'users_reminder_for.id as users_reminder_for_id', 'users_reminder_for.name as users_reminder_for_name');
        //        $query->where('reminder.reminder_for_id', '=', Auth::user()->id);
        $ar = json_decode($request->array);
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->to_date;
        $search = !isset($request->search) && empty($request->search) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('reminder.reminder_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('reminder.reminder_created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('company.id', '=', $companies);
        }
        if (!empty($created_by)) {
            $query->where('reminder.reminder_user_id', '=', $created_by);
        }
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('company_name', 'like', '%' . $search . '%');
                $query->orWhere('reminder_date', 'like', '%' . $search . '%');
                $query->orWhere('users_reminder_for.name', 'like', '%' . $search . '%');
                $query->orWhere('reminder_remarks', 'like', '%' . $search . '%');
                $query->orWhere('reminder_created_at', 'like', '%' . $search . '%');
            });
        } else {
            $query->whereIn(
                'reminder.reminder_user_id',
                DB::table('users')
                    ->where('role', '=', 'Tele Caller')
                    ->orWhere('id', '=', Auth::user()->id)
                    ->pluck('id'),
            );
        }
        $query->orderByDesc('reminder_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('invoice')
            ->where('invoice_company_id', $auth->users_company_id)
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $tele_caller = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', 'Tele Caller')
            ->pluck('id');
        $purposal_reminder = DB::table('reminder')
            ->where('reminder_company_id', $auth->users_company_id)
            ->join('users as users_user_id', 'users_user_id.id', '=', 'reminder.reminder_user_id')
            ->join('invoice', 'invoice.id', '=', 'reminder.reminder_purposal_id')
            ->join('company', 'company.id', '=', 'invoice.company_id')
            ->select('users_user_id.name as user_id_name', 'reminder.reminder_remarks', 'reminder.reminder_date', 'reminder.reminder_reason', 'reminder.reminder_created_at', 'reminder.reminder_id', 'invoice.grand_total', 'company.id', 'company.company_name')
            ->groupBy('company_name') // ->whereIn('reminder.reminder_user_id', $tele_caller)
            ->get();
        $all_created_by = DB::table('reminder')
            ->where('reminder_company_id', $auth->users_company_id)
            ->join('users', 'id', '=', 'reminder.reminder_user_id')
            ->select('users.id', 'users.name')
            ->where('users.role', '=', 'Tele Caller')
            ->orWhere('reminder.reminder_for_id', Auth::user()->id)
            ->groupBy('reminder.reminder_user_id')
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_invoice_reminder';
        $pge_title = 'Invoice Reminder List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date, $search);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = isset($request->str) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('purposalReminder.purposalReminder', compact('datas', 'count_row', 'pge_title', 'type', 'created_by', 'from_date', 'to_date', 'search', 'reminder', 'purposal_reminder', 'all_created_by', 'companies'));
        }
    }
    //    public function reminder_quotation_advance_search (Request $request, $array = null, $str = null){
    //        $user = Auth::user()->id;
    //        $table_row = '';
    //        $query = DB::table('reminder');
    //        $query->join('users as users_user_id', 'users_user_id.id', '=', 'reminder.reminder_user_id');
    //        $query->join('invoice', 'invoice.id', '=', 'reminder.reminder_purposal_id');
    //        $query->join('company', 'company.id', '=', 'invoice.company_id');
    //        $query->select('users_user_id.name as user_id_name', 'reminder.reminder_remarks', 'reminder.reminder_date', 'reminder.reminder_reason',
    //                'reminder.reminder_created_at','reminder.reminder_id','invoice.grand_total', 'company.id', 'company.company_name', 'users_reminder_for.id as users_reminder_for_id',
    //            'users_reminder_for.name as users_reminder_for_name');
    ////        $query->where('reminder.reminder_for_id', '=', Auth::user()->id);
    //
    //        $ar = json_decode($request->array);
    //        $companies = (!isset($request->companies) && empty($request->companies)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->companies;
    //        $created_by = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->created_by;
    //        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->from_date;
    //        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->to_date;
    //
    //        if (!empty($from_date)){
    //            $query->whereDate('reminder.reminder_created_at', '>=', date($from_date));
    //        }
    //        if (!empty($to_date)){
    //            $query->whereDate('reminder.reminder_created_at', '<=', date($to_date));
    //        }
    //        if (!empty($companies)){
    //            $query->where('company.id', '=', $companies);
    //        }
    //        if (!empty($created_by)){
    //            $query->where('reminder.reminder_user_id', '=', $created_by);
    //        }else{
    //            $query->whereIn('reminder.reminder_user_id', DB::table('users')
    //                ->where('role', '=', 'Tele Caller')
    //                ->orWhere('id', '=', Auth::user()->id)->pluck('id')
    //            );
    //        }
    ////        if (Auth::user()->role == 'Supervisor'){
    ////            $userID = DB::table('users')->where('supervisor', $user)->orWhere('id',$user)->get()->pluck('id');
    ////            $query->whereIn('schedule.user_id', $userID);
    ////        }elseif (Auth::user()->role == 'Sale Person'){
    ////            $query->where('schedule.user_id', '=', $user);
    ////        }
    //        $datas = $query->get();
    //        $count_row = count($datas);
    //        if ($count_row >  0){
    //            foreach ($datas as $key => $schedule){
    //                $table_row .= '<tr><td>'.($key+1).'</td><td>'.$schedule->reminder_created_at.'</td><td>'.date('d-M-Y', strtotime($schedule->reminder_date)).'</td>
    //                                <td>'.$schedule->company_name.'</td><td>'.$schedule->reminder_remarks.'</td><td>'.$schedule->grand_total.'</td>
    //                                <td>'.$schedule->user_id_name.'</td>
    //                                </tr>';
    //            }
    //        }
    //        //            PRINT
    //        $prnt_page_dir = 'print.pages.p_invoice_reminder';
    //        $pge_title = 'Invoice Reminder List';
    //        $srch_fltr = [];
    //        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date);
    //
    //        if (isset($request->array) && !empty($request->array)) {
    //            $type = (isset($request->str)) ? $request->str : '';
    //            $footer = view('print._partials.pdf_footer')->render();
    //            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
    //            $options = [
    //                'footer-html' => $footer,
    //                'header-html' => $header,
    //            ];
    //            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'type', 'pge_title'));
    //            $pdf->setOptions($options);
    //            if( $type === 'pdf') {
    //                return $pdf->stream($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_pdf') {
    //                return $pdf->download($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_excel') {
    //                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title), $pge_title.'_x.xlsx');
    //            }
    //        }
    //        else {
    //            return response(compact('count_row', 'table_row'));
    //        }
    //    }
    public function order_reminder(Request $request)
    {
        $auth = Auth::user();
        $auth = Auth::user();
        $has_reason = $request->input('reminder_reason');
        if (isset($has_reason)) {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_order_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_reason = $request->input('reminder_reason');
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();
            $update_funnel = Order::find($request->input('reminder_row_id'));
            $update_funnel->order_reminder_reason = $request->input('reminder_reason');
            $update_funnel->ip_address = $this->get_ip();
            $update_funnel->os_name = $this->get_os();
            $update_funnel->browser = $this->get_browsers();
            $update_funnel->device = $this->get_device();
            $update_funnel->save();
        } else {
            $add_reminder = new Reminder();
            $add_reminder->reminder_user_id = Auth::user()->id;
            $add_reminder->reminder_order_id = $request->input('reminder_row_id');
            $add_reminder->reminder_for_id = $request->input('reminder_for_id');
            $add_reminder->reminder_remarks = $request->input('reminder_remarks');
            $add_reminder->reminder_date = $request->input('reminder_date');
            $add_reminder->reminder_company_id = $auth->users_company_id;
            $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
            $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
            $add_reminder->ip_address = $this->get_ip();
            $add_reminder->os_name = $this->get_os();
            $add_reminder->browser = $this->get_browsers();
            $add_reminder->device = $this->get_device();
            $add_reminder->save();
        }
        return redirect('/order')->with('success', 'Reminder Added');
    }
    //    public function re_order_reminder(Request $request){
    //        $add_reminder = Reminder::find($request->input('update_reminder_id'));
    //        $add_reminder->reminder_user_id = Auth::user()->id;
    //        $add_reminder->reminder_order_id = $request->input('update_order_id');
    //        $add_reminder->reminder_for_id = $request->input('update_reminder_for_id');
    //        $add_reminder->reminder_remarks = $request->input('update_order_reminder_remarks');
    //        $add_reminder->reminder_date = $request->input('update_order_reminder_date');
    //        $add_reminder->reminder_reason = $request->input('update_reason');
    //        $add_reminder->reminder_created_at = Carbon::now('Asia/Karachi');
    //        $add_reminder->reminder_updated_at = Carbon::now('Asia/Karachi');
    //$add_reminder->ip_address = $this->get_ip();
    //$add_reminder->os_name = $this->get_os();
    //$add_reminder->browser = $this->get_browsers();
    //$add_reminder->device = $this->get_device();
    //        $add_reminder->save();
    //
    //        $update_order = Order::find($request->input('update_order_id'));
    //        $update_order->order_reminder_reason = $request->input('update_reason');
    //$update_order->ip_address = $this->get_ip();
    //$update_order->os_name = $this->get_os();
    //$update_order->browser = $this->get_browsers();
    //$update_order->device = $this->get_device();
    //        $update_order->save();
    //        return redirect('/order')->with('success', 'Reminder Added');
    //    }
    public function orderReminder(Request $request, $array = null, $str = null)
    {
        $auth = Auth::user();
        $user = Auth::user()->id;
        $userID = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('supervisor', $user)
            ->orWhere('id', $user)
            ->get()
            ->pluck('id');
        $query = DB::table('reminder')->where('reminder_company_id', $auth->users_company_id);
        $query->join('users as users_user_id', 'users_user_id.id', '=', 'reminder.reminder_user_id');
        $query->join('users as users_reminder_for', 'users_reminder_for.id', '=', 'reminder.reminder_for_id');
        $query->join('order', 'order.id', '=', 'reminder.reminder_order_id');
        $query->join('company', 'company.id', '=', 'order.company_id');
        $query->select('users_user_id.name as user_id_name', 'reminder.reminder_remarks', 'reminder.reminder_date', 'reminder.reminder_reason', 'reminder.reminder_created_at', 'reminder.reminder_id', 'order.grand_total', 'company.id', 'company.company_name', 'users_reminder_for.id as users_reminder_for_id', 'users_reminder_for.name as users_reminder_for_name');
        //        $query->where('reminder.reminder_for_id', '=', Auth::user()->id);
        $ar = json_decode($request->array);
        $companies = !isset($request->companies) && empty($request->companies) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->companies;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->created_by;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->to_date;
        $search = !isset($request->search) && empty($request->search) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->search;
        if (!empty($from_date)) {
            $query->whereDate('reminder.reminder_created_at', '>=', date($from_date));
        }
        if (!empty($to_date)) {
            $query->whereDate('reminder.reminder_created_at', '<=', date($to_date));
        }
        if (!empty($companies)) {
            $query->where('company.id', '=', $companies);
        }
        if (!empty($created_by)) {
            $query->where('reminder.reminder_user_id', '=', $created_by);
        }
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->orWhere('company_name', 'like', '%' . $search . '%');
                $query->orWhere('reminder_date', 'like', '%' . $search . '%');
                $query->orWhere('users_reminder_for.name', 'like', '%' . $search . '%');
                $query->orWhere('reminder_remarks', 'like', '%' . $search . '%');
                $query->orWhere('reminder_created_at', 'like', '%' . $search . '%');
            });
        } else {
            $query->whereIn(
                'reminder.reminder_user_id',
                DB::table('users')
                    ->where('role', '=', 'Tele Caller')
                    ->orWhere('id', '=', Auth::user()->id)
                    ->pluck('id'),
            );
        }
        $query->orderByDesc('reminder_created_at');
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = $query->paginate($pagination_number);
        $reminder = DB::table('invoice')
            ->where('invoice_company_id', $auth->users_company_id)
            ->where('user_id', Auth::user()->id)
            ->select('user_id')
            ->get();
        $tele_caller = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', 'Tele Caller')
            ->pluck('id');
        $order_reminder = DB::table('reminder')
            ->where('reminder_company_id', $auth->users_company_id)
            ->join('users as users_user_id', 'users_user_id.id', '=', 'reminder.reminder_user_id')
            ->join('order', 'order.id', '=', 'reminder.reminder_order_id')
            ->join('company', 'company.id', '=', 'order.company_id')
            ->select('users_user_id.name as user_id_name', 'reminder.reminder_remarks', 'reminder.reminder_date', 'reminder.reminder_reason', 'reminder.reminder_created_at', 'reminder.reminder_id', 'order.grand_total', 'company.id', 'company.company_name')
            ->groupBy('company_name') // ->whereIn('reminder.reminder_user_id', $tele_caller)
            ->get();
        $all_created_by = DB::table('reminder')
            ->where('reminder_company_id', $auth->users_company_id)
            ->join('users', 'id', '=', 'reminder.reminder_user_id')
            ->select('users.id', 'users.name')
            ->where('users.role', '=', 'Tele Caller')
            ->orWhere('reminder.reminder_for_id', Auth::user()->id)
            ->groupBy('reminder.reminder_user_id')
            ->get();
        $count_row = count($datas);
        //            PRINT
        $prnt_page_dir = 'print.pages.p_order_reminder';
        $pge_title = 'Order Reminder List';
        $srch_fltr = [];
        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date, $search);
        $type = '';
        if (isset($request->array) && !empty($request->array)) {
            $type = isset($request->str) ? $request->str : '';
            $footer = view('print._partials.pdf_footer')->render();
            $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
            $options = [
                'footer-html' => $footer,
                'header-html' => $header,
            ];
            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
            $pdf->setOptions($options);
            if ($type === 'pdf') {
                return $pdf->stream($pge_title . '_x.pdf');
            } elseif ($type === 'download_pdf') {
                return $pdf->download($pge_title . '_x.pdf');
            } elseif ($type === 'download_excel') {
                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
            }
        } else {
            return view('orderReminder.orderReminder', compact('datas', 'count_row', 'pge_title', 'type', 'created_by', 'from_date', 'to_date', 'search', 'reminder', 'order_reminder', 'all_created_by', 'companies'));
        }
    }
    //    public function reminder_order_advance_search (Request $request, $array = null, $str = null){
    //        $user = Auth::user()->id;
    //        $table_row = '';
    //        $query = DB::table('reminder');
    //        $query->join('users as users_user_id', 'users_user_id.id', '=', 'reminder.reminder_user_id');
    //        $query->join('order', 'order.id', '=', 'reminder.reminder_order_id');
    //        $query->join('company', 'company.id', '=', 'order.company_id');
    //        $query->select('users_user_id.name as user_id_name', 'reminder.reminder_remarks', 'reminder.reminder_date', 'reminder.reminder_reason',
    //                'reminder.reminder_created_at','reminder.reminder_id','order.grand_total', 'company.id', 'company.company_name', 'users_reminder_for.id as users_reminder_for_id',
    //            'users_reminder_for.name as users_reminder_for_name');
    ////        $query->where('reminder.reminder_for_id', '=', Auth::user()->id);
    //
    //        $ar = json_decode($request->array);
    //        $companies = (!isset($request->companies) && empty($request->companies)) ? ((!empty($ar)) ? $ar[0]->{'value'} : '') : $request->companies;
    //        $created_by = (!isset($request->created_by) && empty($request->created_by)) ? ((!empty($ar)) ? $ar[1]->{'value'} : '') : $request->created_by;
    //        $from_date = (!isset($request->from_date) && empty($request->from_date)) ? ((!empty($ar)) ? $ar[2]->{'value'} : '') : $request->from_date;
    //        $to_date = (!isset($request->to_date) && empty($request->to_date)) ? ((!empty($ar)) ? $ar[3]->{'value'} : '') : $request->to_date;
    //
    //        if (!empty($from_date)){
    //            $query->whereDate('reminder.reminder_created_at', '>=', date($from_date));
    //        }
    //        if (!empty($to_date)){
    //            $query->whereDate('reminder.reminder_created_at', '<=', date($to_date));
    //        }
    //        if (!empty($companies)){
    //            $query->where('company.id', '=', $companies);
    //        }
    //        if (!empty($created_by)){
    //            $query->where('reminder.reminder_user_id', '=', $created_by);
    //        }else{
    //            $query->whereIn('reminder.reminder_user_id', DB::table('users')
    //                ->where('role', '=', 'Tele Caller')
    //                ->orWhere('id', '=', Auth::user()->id)->pluck('id')
    //            );
    //        }
    ////        if (Auth::user()->role == 'Supervisor'){
    ////            $userID = DB::table('users')->where('supervisor', $user)->orWhere('id',$user)->get()->pluck('id');
    ////            $query->whereIn('schedule.user_id', $userID);
    ////        }elseif (Auth::user()->role == 'Sale Person'){
    ////            $query->where('schedule.user_id', '=', $user);
    ////        }
    //        $datas = $query->get();
    //        $count_row = count($datas);
    //        if ($count_row >  0){
    //            foreach ($datas as $key => $schedule){
    //                $table_row .= '<tr><td>'.($key+1).'</td><td>'.$schedule->reminder_created_at.'</td><td>'.date('d-M-Y', strtotime($schedule->reminder_date)).'</td>
    //                                <td>'.$schedule->company_name.'</td><td>'.$schedule->reminder_remarks.'</td><td>'.$schedule->grand_total.'</td>
    //                                <td>'.$schedule->user_id_name.'</td>
    //                                </tr>';
    //            }
    //        }
    //        //            PRINT
    //        $prnt_page_dir = 'print.pages.p_order_reminder';
    //        $pge_title = 'Order Reminder List';
    //        $srch_fltr = [];
    //        array_push($srch_fltr, $companies, $created_by, $from_date, $to_date);
    //
    //        if (isset($request->array) && !empty($request->array)) {
    //            $type = (isset($request->str)) ? $request->str : '';
    //            $footer = view('print._partials.pdf_footer')->render();
    //            $header = view('print._partials.pdf_header', compact('pge_title','srch_fltr'))->render();
    //            $options = [
    //                'footer-html' => $footer,
    //                'header-html' => $header,
    //            ];
    //            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('datas', 'type', 'pge_title'));
    //            $pdf->setOptions($options);
    //            if( $type === 'pdf') {
    //                return $pdf->stream($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_pdf') {
    //                return $pdf->download($pge_title.'_x.pdf');
    //            }
    //            else if( $type === 'download_excel') {
    //                return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title), $pge_title.'_x.xlsx');
    //            }
    //        }
    //        else {
    //            return response(compact('count_row', 'table_row'));
    //        }
    //    }
    //    HOW TO USE FUNCTION IN CONTROLLER
    //    function table_reports($request){
    //        $get_supervisor = DB::table('users')
    //            ->where('role', '=', $request['role'])->pluck('id');
    //            $user_id = $request['user_id'];
    //            $data = DB::table($request['user_table'])
    //                ->join('users', 'user.id', '=', $request['user_table'].'.user_id')
    //                ->join('company', 'company.id', '=', $request['user_table'].'.company_id')
    //                ->select('users.*', 'company.*', 'company.created_at as company_created_at', 'users.created_at as users_created_at',
    //                    $request['user_table'].'.created_at as '.$request['user_table'].'created_at')
    //                ->whereDate('created_at', '>=', date($request['from_date']))
    //                ->wheredate('created_at', '<=', date($request['to_date']))
    //                ->where(function($query) use ($user_id){
    //                    if (isset($user_id)){
    //                        $query->where('user_id', '=', $user_id);
    //                    }
    //                })
    //                ->whereIn('user_id', $get_supervisor)
    //                ->get();
    //        return $data;
    //    }
    //    public function fetching_data(Request $request){
    //        $input = $request->all();
    //        $data = $this->table_reports($input);
    //        return response()->json(compact('data'));
    //    }
    //    DELETING REMINDER
    public function delete_schedule_reminder(Request $request)
    {
        $auth = Auth::user();
        $delete_from_reminder = Reminder::where('reminder_company_id', $auth->users_company_id)->find($request->reminder_id);
        $delete_from_reminder->delete();
        return back();
    }
    public function delete_funnel_reminder(Request $request)
    {
        $auth = Auth::user();
        $delete_from_reminder = Reminder::where('reminder_company_id', $auth->users_company_id)->find($request->reminder_id);
        $delete_from_reminder->delete();
        return back();
    }
    public function delete_invoice_reminder(Request $request)
    {
        $auth = Auth::user();
        $delete_from_reminder = Reminder::where('reminder_company_id', $auth->users_company_id)->find($request->reminder_id);
        $delete_from_reminder->delete();
        return back();
    }
    public function delete_order_reminder(Request $request)
    {
        $auth = Auth::user();
        $delete_from_reminder = Reminder::where('reminder_company_id', $auth->users_company_id)->find($request->reminder_id);
        $delete_from_reminder->delete();
        return back();
    }
}
