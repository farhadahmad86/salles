<?php

namespace App\Http\Controllers;

use App\Models\FunnelTarget;
use App\Models\OrderTarget;
use App\Models\ProductGroupTarget;
use App\Models\QuotationTarget;
use App\Models\ScheduleTarget;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TargetController extends Controller
{
    public function createTarget()
    {
        $auth = Auth::user();
        // dd(Auth::user());
        if (Auth::user()->role == 'Supervisor') {
            $users = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('supervisor', Auth::user()->id)
                ->get();
            // dd($users);
            return view('target.createTarget', compact('users'));
        }
        return view('target.createTarget');
    }

    public function fetch_users(Request $request)
    {
        $auth = Auth::user();
        $all_users = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', $request->role)
            ->get();
        return response()->json(compact('all_users'));
    }

    //    SCHEDULE
    public function show_users_schedules(Request $request)
    {
        $auth = Auth::user();
        $fetch_schedule_targets = DB::table('schedule_target')
            ->where('schedule_target_company_id', $auth->users_company_id)
            ->join('users', 'users.id', '=', 'schedule_target.sch_target_user_id')
            ->join('users as target_by', 'target_by.id', '=', 'schedule_target.sch_target_by')
            ->join('business_category', 'business_category.business_category_id', '=', 'schedule_target.sch_target_business_category_id')
            ->select('schedule_target.*', 'users.*', 'users.name as user_name', 'target_by.*', 'business_category.*', 'target_by.name as target_by_name')
            ->where('sch_target_user_id', $request->schedule_username)
            ->get();
        $supervisor_name = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->select('name')
            ->where('id', $request->your_manager)
            ->first();
        if (count($fetch_schedule_targets) > 0) {
            foreach ($fetch_schedule_targets as $key => $targets) {
                $schedule_targets[] = '<tr><td>' . ($key + 1) . '</td><td>' . $targets->sch_target_date . '</td><td>' . $targets->user_name . '</td><td>' . $supervisor_name->name . '</td><td>' . $targets->target_by_name . '</td><td>' . $targets->business_category_name . '</td><td>' . $targets->sch_target_total_visits . '</td><td>' . $targets->sch_target_min_new_visits . '</td><td>' . $targets->sch_target_created_at . '</td></tr>';
            }
        } else {
            $schedule_targets = 0;
        }

        $select_business_category = DB::table('schedule_target')
            ->where('schedule_target_company_id', $auth->users_company_id)
            ->where('sch_target_user_id', '=', $request->schedule_username)
            ->pluck('sch_target_business_category_id');
        $get_business_category = DB::table('business_category')
            ->whereNotIn('business_category_id', $select_business_category)
            ->where('business_category_company_id', $auth->users_company_id)
            ->get();
        if (count($get_business_category) > 0) {
            foreach ($get_business_category as $business_category) {
                $business_category_options[] = '<option value="' . $business_category->business_category_id . '">' . $business_category->business_category_name . '</option>';
            }
        } else {
            $business_category_options = 0;
        }

        return response()->json(compact('schedule_targets', 'business_category_options'));
    }
    public function schedule_target(Request $request)
    {
        $auth = Auth::user();
        $insert_schedule_target = new ScheduleTarget();
        if ($request->schedule_your_manager == null) {
            $insert_schedule_target->sch_target_your_manager = Auth::user()->id;
        } else {
            $insert_schedule_target->sch_target_your_manager = $request->schedule_your_manager;
        }
        if ($request->schedule_role == null) {
            $insert_schedule_target->sch_target_role = Auth::user()->role;
        } else {
            $insert_schedule_target->sch_target_role = $request->schedule_role;
        }
        $insert_schedule_target->sch_target_user_id = $request->schedule_user_id;
        $insert_schedule_target->schedule_target_company_id = $auth->users_company_id;
        $insert_schedule_target->sch_target_by = $request->schedule_target_by;
        $insert_schedule_target->sch_target_date = $request->schedule_date;
        $insert_schedule_target->sch_target_business_category_id = $request->schedule_business_category_id;
        $insert_schedule_target->sch_target_total_visits = $request->schedule_total_visits;
        $insert_schedule_target->sch_target_min_new_visits = $request->schedule_min_new_visits;
        $insert_schedule_target->sch_target_created_at = Carbon::now('Asia/Karachi');
        $insert_schedule_target->sch_target_updated_at = Carbon::now('Asia/Karachi');
        $insert_schedule_target->ip_address = $this->get_ip();
        $insert_schedule_target->os_name = $this->get_os();
        $insert_schedule_target->browser = $this->get_browsers();
        $insert_schedule_target->device = $this->get_device();
        $insert_schedule_target->save();

        $fetch_schedule_targets = DB::table('schedule_target')
            ->where('schedule_target_company_id', $auth->users_company_id)
            ->join('users', 'users.id', '=', 'schedule_target.sch_target_user_id')
            ->join('users as target_by', 'target_by.id', '=', 'schedule_target.sch_target_by')
            ->join('business_category', 'business_category.business_category_id', '=', 'schedule_target.sch_target_business_category_id')
            ->select('schedule_target.*', 'users.*', 'users.name as user_name', 'target_by.*', 'business_category.*', 'target_by.name as target_by_name')
            ->where('sch_target_user_id', $request->schedule_user_id)
            ->get();
        $supervisor_name = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->select('name')
            ->where('id', $request->schedule_your_manager)
            ->first();
        foreach ($fetch_schedule_targets as $key => $targets) {
            $schedule_targets[] = '<tr><td>' . ($key + 1) . '</td><td>' . $targets->sch_target_date . '</td><td>' . $targets->user_name . '</td><td>' . $supervisor_name->name . '</td><td>' . $targets->target_by_name . '</td><td>' . $targets->business_category_name . '</td><td>' . $targets->sch_target_total_visits . '</td><td>' . $targets->sch_target_min_new_visits . '</td><td>' . $targets->sch_target_created_at . '</td></tr>';
        }

        $select_business_category = DB::table('schedule_target')
            ->where('schedule_target_company_id', $auth->users_company_id)
            ->where('sch_target_user_id', '=', $request->schedule_user_id)
            ->pluck('sch_target_business_category_id');
        $get_business_category = DB::table('business_category')
            ->whereNotIn('business_category_id', $select_business_category)
            ->where('business_category_company_id', $auth->users_company_id)
            ->get();
        if (count($get_business_category) > 0) {
            foreach ($get_business_category as $business_category) {
                $business_category_options[] = '<option value="' . $business_category->business_category_id . '">' . $business_category->business_category_name . '</option>';
            }
        } else {
            $business_category_options = 0;
        }
        return response()->json(compact('schedule_targets', 'business_category_options'));
    }

    //    FUNNEL
    public function show_users_funnel(Request $request)
    {
        $auth = Auth::user();
        $fetch_funnel_targets = DB::table('funnel_target')
            ->where('funnel_target_company_id', $auth->users_company_id)
            ->join('users', 'users.id', '=', 'funnel_target.funnel_target_user_id')
            ->join('users as target_by', 'target_by.id', '=', 'funnel_target.funnel_target_by')
            ->join('category', 'category.cat_id', '=', 'funnel_target.funnel_target_product_category')
            ->select('funnel_target.*', 'users.*', 'users.name as user_name', 'target_by.*', 'category.*', 'target_by.name as target_by_name')
            ->where('funnel_target_user_id', $request->funnel_username)
            ->get();
        $supervisor_name = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->select('name')
            ->where('id', $request->your_manager)
            ->first();
        if (count($fetch_funnel_targets) > 0) {
            foreach ($fetch_funnel_targets as $key => $targets) {
                $funnel_targets[] = '<tr><td>' . ($key + 1) . '</td><td>' . $targets->funnel_target_date . '</td><td>' . $targets->user_name . '</td><td>' . $supervisor_name->name . '</td><td>' . $targets->target_by_name . '</td><td>' . $targets->cat_category . '</td><td>' . $targets->funnel_target_otc . '</td><td>' . $targets->funnel_target_mrc . '</td><td>' . $targets->funnel_target_created_at . '</td></tr>';
            }
        } else {
            $funnel_targets = 0;
        }
        $select_product_category = DB::table('funnel_target')
            ->where('funnel_target_company_id', $auth->users_company_id)
            ->where('funnel_target_user_id', '=', $request->funnel_username)
            ->pluck('funnel_target_product_category');
        $get_product_category = DB::table('category')
            ->whereNotIn('cat_id', $select_product_category)
            ->where('category_company_id', $auth->users_company_id)
            ->get();
        if (count($get_product_category) > 0) {
            foreach ($get_product_category as $product_category) {
                $product_category_options[] = '<option value="' . $product_category->cat_id . '">' . $product_category->cat_category . '</option>';
            }
        } else {
            $product_category_options = 0;
        }
        return response()->json(compact('funnel_targets', 'product_category_options'));
    }
    public function show_funnel_target(Request $request)
    {
        $auth = Auth::user();
        $insert_funnel_target = new FunnelTarget();
        if ($request->funnel_your_manager == null) {
            $insert_funnel_target->funnel_target_your_manager = Auth::user()->id;
        } else {
            $insert_funnel_target->funnel_target_your_manager = $request->funnel_your_manager;
        }
        if ($request->funnel_role == null) {
            $insert_funnel_target->funnel_target_role = Auth::user()->role;
        } else {
            $insert_funnel_target->funnel_target_role = $request->funnel_role;
        }
        $insert_funnel_target->funnel_target_user_id = $request->funnel_user_id;
        $insert_funnel_target->funnel_target_company_id = $auth->users_company_id;
        $insert_funnel_target->funnel_target_by = $request->funnel_target_by;
        $insert_funnel_target->funnel_target_date = $request->funnel_date;
        $insert_funnel_target->funnel_target_product_category = $request->funnel_product_category_id;
        $insert_funnel_target->funnel_target_otc = $request->funnel_otc;
        $insert_funnel_target->funnel_target_mrc = $request->funnel_mrc;
        $insert_funnel_target->funnel_target_created_at = Carbon::now('Asia/Karachi');
        $insert_funnel_target->funnel_target_updated_at = Carbon::now('Asia/Karachi');
        $insert_funnel_target->ip_address = $this->get_ip();
        $insert_funnel_target->os_name = $this->get_os();
        $insert_funnel_target->browser = $this->get_browsers();
        $insert_funnel_target->device = $this->get_device();
        $insert_funnel_target->save();

        $fetch_funnel_targets = DB::table('funnel_target')
            ->where('funnel_target_company_id', $auth->users_company_id)
            ->join('users', 'users.id', '=', 'funnel_target.funnel_target_user_id')
            ->join('users as target_by', 'target_by.id', '=', 'funnel_target.funnel_target_by')
            ->join('category', 'category.cat_id', '=', 'funnel_target.funnel_target_product_category')
            ->select('funnel_target.*', 'users.*', 'users.name as user_name', 'target_by.*', 'category.*', 'target_by.name as target_by_name')
            ->where('funnel_target_user_id', $request->funnel_user_id)
            ->get();
        $supervisor_name = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->select('name')
            ->where('id', $request->funnel_your_manager)
            ->first();
        foreach ($fetch_funnel_targets as $key => $targets) {
            $funnel_targets[] = '<tr><td>' . ($key + 1) . '</td><td>' . $targets->funnel_target_date . '</td><td>' . $targets->user_name . '</td><td>' . $supervisor_name->name . '</td><td>' . $targets->target_by_name . '</td><td>' . $targets->cat_category . '</td><td>' . $targets->funnel_target_otc . '</td><td>' . $targets->funnel_target_mrc . '</td><td>' . $targets->funnel_target_created_at . '</td></tr>';
        }
        $select_product_category = DB::table('funnel_target')
            ->where('funnel_target_company_id', $auth->users_company_id)
            ->where('funnel_target_user_id', '=', $request->funnel_user_id)
            ->pluck('funnel_target_product_category');
        $get_product_category = DB::table('category')->whereNotIn('cat_id', $select_product_category)->get();
        if (count($get_product_category) > 0) {
            foreach ($get_product_category as $product_category) {
                $product_category_options[] = '<option value="' . $product_category->cat_id . '">' . $product_category->cat_category . '</option>';
            }
        } else {
            $product_category_options = 0;
        }
        return response()->json(compact('funnel_targets', 'product_category_options'));
    }

    //    QUOTATION
    public function show_users_quotation(Request $request)
    {
        $auth = Auth::user();
        $fetch_quotation_targets = DB::table('quotation_target')
            ->where('quotation_target_company_id', $auth->users_company_id)
            ->join('users', 'users.id', '=', 'quotation_target.quotation_target_user_id')
            ->join('users as target_by', 'target_by.id', '=', 'quotation_target.quotation_target_by')
            ->join('category', 'category.cat_id', '=', 'quotation_target.quotation_target_product_category')
            ->select('quotation_target.*', 'users.*', 'users.name as user_name', 'target_by.*', 'category.*', 'target_by.name as target_by_name')
            ->where('quotation_target_user_id', $request->quotation_username)
            ->get();
        $supervisor_name = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->select('name')
            ->where('id', $request->your_manager)
            ->first();
        if (count($fetch_quotation_targets) > 0) {
            foreach ($fetch_quotation_targets as $key => $targets) {
                $quotation_targets[] = '<tr><td>' . ($key + 1) . '</td><td>' . $targets->quotation_target_date . '</td><td>' . $targets->user_name . '</td><td>' . $supervisor_name->name . '</td><td>' . $targets->target_by_name . '</td><td>' . $targets->cat_category . '</td><td>' . $targets->quotation_target_otc . '</td><td>' . $targets->quotation_target_mrc . '</td><td>' . $targets->quotation_target_created_at . '</td></tr>';
            }
        } else {
            $quotation_targets = 0;
        }
        $select_product_category = DB::table('quotation_target')
            ->where('quotation_target_company_id', $auth->users_company_id)
            ->where('quotation_target_user_id', '=', $request->quotation_username)
            ->pluck('quotation_target_product_category');
        $get_product_category = DB::table('category')
        ->where('category_company_id', $auth->users_company_id)
            ->whereNotIn('cat_id', $select_product_category)
            ->get();
        if (count($get_product_category) > 0) {
            foreach ($get_product_category as $product_category) {
                $product_category_options[] = '<option value="' . $product_category->cat_id . '">' . $product_category->cat_category . '</option>';
            }
        } else {
            $product_category_options = 0;
        }
        // dd($fetch_quotation_targets, $get_product_category, $product_category_options);
        return response()->json(compact('quotation_targets', 'product_category_options'));
    }
    public function show_quotation_target(Request $request)
    {
        $auth = Auth::user();
        $insert_quotation_target = new QuotationTarget();
        if ($request->quotation_your_manager == null) {
            $insert_quotation_target->quotation_target_your_manager = Auth::user()->id;
        } else {
            $insert_quotation_target->quotation_target_your_manager = $request->quotation_your_manager;
        }
        if ($request->quotation_role == null) {
            $insert_quotation_target->quotation_target_role = Auth::user()->role;
        } else {
            $insert_quotation_target->quotation_target_role = $request->quotation_role;
        }
        $insert_quotation_target->quotation_target_user_id = $request->quotation_user_id;
        $insert_quotation_target->quotation_target_company_id = $auth->users_company_id;
        $insert_quotation_target->quotation_target_by = $request->quotation_target_by;
        $insert_quotation_target->quotation_target_date = $request->quotation_date;
        $insert_quotation_target->quotation_target_product_category = $request->quotation_product_category_id;
        $insert_quotation_target->quotation_target_otc = $request->quotation_otc;
        $insert_quotation_target->quotation_target_mrc = $request->quotation_mrc;
        $insert_quotation_target->quotation_target_created_at = Carbon::now('Asia/Karachi');
        $insert_quotation_target->quotation_target_updated_at = Carbon::now('Asia/Karachi');
        $insert_quotation_target->ip_address = $this->get_ip();
        $insert_quotation_target->os_name = $this->get_os();
        $insert_quotation_target->browser = $this->get_browsers();
        $insert_quotation_target->device = $this->get_device();
        $insert_quotation_target->save();

        $fetch_quotation_targets = DB::table('quotation_target')
            ->where('quotation_target_company_id', $auth->users_company_id)
            ->join('users', 'users.id', '=', 'quotation_target.quotation_target_user_id')
            ->join('users as target_by', 'target_by.id', '=', 'quotation_target.quotation_target_by')
            ->join('category', 'category.cat_id', '=', 'quotation_target.quotation_target_product_category')
            ->select('quotation_target.*', 'users.*', 'users.name as user_name', 'target_by.*', 'category.*', 'target_by.name as target_by_name')
            ->where('quotation_target_user_id', $request->quotation_user_id)
            ->get();
        $supervisor_name = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->select('name')
            ->where('id', $request->quotation_your_manager)
            ->first();
        foreach ($fetch_quotation_targets as $key => $targets) {
            $quotation_targets[] = '<tr><td>' . ($key + 1) . '</td><td>' . $targets->quotation_target_date . '</td><td>' . $targets->user_name . '</td><td>' . $supervisor_name->name . '</td><td>' . $targets->target_by_name . '</td><td>' . $targets->cat_category . '</td><td>' . $targets->quotation_target_otc . '</td><td>' . $targets->quotation_target_mrc . '</td><td>' . $targets->quotation_target_created_at . '</td></tr>';
        }
        $select_product_category = DB::table('quotation_target')
            ->where('quotation_target_user_id', '=', $request->quotation_user_id)
            ->pluck('quotation_target_product_category');
        $get_product_category = DB::table('category')
            ->whereNotIn('cat_id', $select_product_category)
            ->where('category_company_id', $auth->users_company_id)
            ->get();
        if (count($get_product_category) > 0) {
            foreach ($get_product_category as $product_category) {
                $product_category_options[] = '<option value="' . $product_category->cat_id . '">' . $product_category->cat_category . '</option>';
            }
        } else {
            $product_category_options = 0;
        }
        return response()->json(compact('quotation_targets', 'product_category_options'));
    }

    //    ORDER
    public function show_users_order(Request $request)
    {
        $auth = Auth::user();
        $fetch_order_targets = DB::table('order_target')
            ->where('order_target_company_id', $auth->users_company_id)
            ->join('users', 'users.id', '=', 'order_target.order_target_user_id')
            ->join('users as target_by', 'target_by.id', '=', 'order_target.order_target_by')
            ->join('category', 'category.cat_id', '=', 'order_target.order_target_product_category')
            ->select('order_target.*', 'users.*', 'users.name as user_name', 'target_by.*', 'category.*', 'target_by.name as target_by_name')
            ->where('order_target_user_id', $request->order_username)
            ->get();
        $supervisor_name = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->select('name')
            ->where('id', $request->your_manager)
            ->first();
        if (count($fetch_order_targets) > 0) {
            foreach ($fetch_order_targets as $key => $targets) {
                $order_targets[] = '<tr><td>' . ($key + 1) . '</td><td>' . $targets->order_target_date . '</td><td>' . $targets->user_name . '</td><td>' . $supervisor_name->name . '</td><td>' . $targets->target_by_name . '</td><td>' . $targets->cat_category . '</td><td>' . $targets->order_target_otc . '</td><td>' . $targets->order_target_mrc . '</td><td>' . $targets->order_target_created_at . '</td></tr>';
            }
        } else {
            $order_targets = 0;
        }
        $select_product_category = DB::table('order_target')
            ->where('order_target_company_id', $auth->users_company_id)
            ->where('order_target_user_id', '=', $request->order_username)
            ->pluck('order_target_product_category');
        $get_product_category = DB::table('category')
            ->whereNotIn('cat_id', $select_product_category)
            ->where('category_company_id', $auth->users_company_id)
            ->get();
        if (count($get_product_category) > 0) {
            foreach ($get_product_category as $product_category) {
                $product_category_options[] = '<option value="' . $product_category->cat_id . '">' . $product_category->cat_category . '</option>';
            }
        } else {
            $product_category_options = 0;
        }
        return response()->json(compact('order_targets', 'product_category_options'));
    }
    public function show_order_target(Request $request)
    {
        $auth = Auth::user();
        $insert_order_target = new OrderTarget();
        if ($request->order_your_manager == null) {
            $insert_order_target->order_target_your_manager = Auth::user()->id;
        } else {
            $insert_order_target->order_target_your_manager = $request->order_your_manager;
        }
        if ($request->order_role == null) {
            $insert_order_target->order_target_role = Auth::user()->role;
        } else {
            $insert_order_target->order_target_role = $request->order_role;
        }
        $insert_order_target->order_target_user_id = $request->order_user_id;
        $insert_order_target->order_target_by = $request->order_target_by;
        $insert_order_target->order_target_company_id = $auth->users_company_id;
        $insert_order_target->order_target_date = $request->order_date;
        $insert_order_target->order_target_product_category = $request->order_product_category_id;
        $insert_order_target->order_target_otc = $request->order_otc;
        $insert_order_target->order_target_mrc = $request->order_mrc;
        $insert_order_target->order_target_created_at = Carbon::now('Asia/Karachi');
        $insert_order_target->order_target_updated_at = Carbon::now('Asia/Karachi');
        $insert_order_target->ip_address = $this->get_ip();
        $insert_order_target->os_name = $this->get_os();
        $insert_order_target->browser = $this->get_browsers();
        $insert_order_target->device = $this->get_device();
        $insert_order_target->save();

        $fetch_order_targets = DB::table('order_target')
            ->where('order_target_company_id', $auth->users_company_id)
            ->join('users', 'users.id', '=', 'order_target.order_target_user_id')
            ->join('users as target_by', 'target_by.id', '=', 'order_target.order_target_by')
            ->join('category', 'category.cat_id', '=', 'order_target.order_target_product_category')
            ->select('order_target.*', 'users.*', 'users.name as user_name', 'target_by.*', 'category.*', 'target_by.name as target_by_name')
            ->where('order_target_user_id', $request->order_user_id)
            ->get();
        $supervisor_name = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->select('name')
            ->where('id', $request->order_your_manager)
            ->first();
        foreach ($fetch_order_targets as $key => $targets) {
            $order_targets[] = '<tr><td>' . ($key + 1) . '</td><td>' . $targets->order_target_date . '</td><td>' . $targets->user_name . '</td><td>' . $supervisor_name->name . '</td><td>' . $targets->target_by_name . '</td><td>' . $targets->cat_category . '</td><td>' . $targets->order_target_otc . '</td><td>' . $targets->order_target_mrc . '</td><td>' . $targets->order_target_created_at . '</td></tr>';
        }
        $select_product_category = DB::table('order_target')
            ->where('order_target_company_id', $auth->users_company_id)
            ->where('order_target_user_id', '=', $request->order_user_id)
            ->pluck('order_target_product_category');
        $get_product_category = DB::table('category')
            ->whereNotIn('cat_id', $select_product_category)
            ->where('category_company_id', $auth->users_company_id)
            ->get();
        if (count($get_product_category) > 0) {
            foreach ($get_product_category as $product_category) {
                $product_category_options[] = '<option value="' . $product_category->cat_id . '">' . $product_category->cat_category . '</option>';
            }
        } else {
            $product_category_options = 0;
        }
        return response()->json(compact('order_targets', 'product_category_options'));
    }

    //    PRODUCT GROUP
    public function show_users_product_group(Request $request)
    {
        $auth = Auth::user();
        $fetch_product_group_targets = DB::table('product_group_target')
            ->where('product_group_target_company_id', $auth->users_company_id)
            ->join('product_group', 'product_group_id', '=', 'product_group_target.product_group_target')
            ->join('users', 'users.id', '=', 'product_group_target.product_group_target_user_id')
            ->join('users as target_by', 'target_by.id', '=', 'product_group_target.product_group_target_by')
            ->select('product_group_target.*', 'users.*', 'product_group.product_group_name', 'users.name as user_name', 'target_by.*', 'target_by.name as target_by_name')
            ->where('product_group_target_user_id', $request->product_group_username)
            ->get();
        $supervisor_name = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->select('name')
            ->where('id', $request->your_manager)
            ->first();
        if (count($fetch_product_group_targets) > 0) {
            foreach ($fetch_product_group_targets as $key => $targets) {
                $product_group_targets[] = '<tr><td>' . ($key + 1) . '</td><td>' . $targets->product_group_target_date . '</td><td>' . $targets->user_name . '</td><td>' . $supervisor_name->name . '</td><td>' . $targets->target_by_name . '</td><td>' . $targets->product_group_name . '</td><td>' . $targets->product_group_target_created_at . '</td></tr>';
            }
        } else {
            $product_group_targets = 0;
        }
        $select_product_group = DB::table('product_group_target')
            ->where('product_group_target_company_id', $auth->users_company_id)
            ->where('product_group_target_user_id', '=', $request->product_group_username)
            ->pluck('product_group_target');
        $get_product_group = DB::table('product_group')
            ->whereNotIn('product_group_id', $select_product_group)
            ->where('product_group_company_id', $auth->users_company_id)
            ->get();
        if (count($get_product_group) > 0) {
            foreach ($get_product_group as $product_group) {
                $product_group_options[] = '<option value="' . $product_group->product_group_id . '">' . $product_group->product_group_name . '</option>';
            }
        } else {
            $product_group_options = 0;
        }
        return response()->json(compact('product_group_targets', 'product_group_options'));
    }
    public function show_product_group_target(Request $request)
    {
        $auth = Auth::user();
        $insert_product_group_target = new ProductGroupTarget();
        if ($request->product_group_your_manager == null) {
            $insert_product_group_target->product_group_target_your_manager = Auth::user()->id;
        } else {
            $insert_product_group_target->product_group_target_your_manager = $request->product_group_your_manager;
        }
        if ($request->product_group_role == null) {
            $insert_product_group_target->product_group_target_role = Auth::user()->role;
        } else {
            $insert_product_group_target->product_group_target_role = $request->product_group_role;
        }
        $insert_product_group_target->product_group_target_user_id = $request->product_group_user_id;
        $insert_product_group_target->product_group_target_company_id = $auth->users_company_id;
        $insert_product_group_target->product_group_target_by = $request->product_group_target_by;
        $insert_product_group_target->product_group_target_date = $request->product_group_date;
        $insert_product_group_target->product_group_target = $request->product_group_id;
        $insert_product_group_target->product_group_target_created_at = Carbon::now('Asia/Karachi');
        $insert_product_group_target->product_group_target_updated_at = Carbon::now('Asia/Karachi');
        $insert_product_group_target->ip_address = $this->get_ip();
        $insert_product_group_target->os_name = $this->get_os();
        $insert_product_group_target->browser = $this->get_browsers();
        $insert_product_group_target->device = $this->get_device();
        $insert_product_group_target->save();

        $fetch_product_group_targets = DB::table('product_group_target')
            ->where('product_group_target_company_id', $auth->users_company_id)
            ->join('users', 'users.id', '=', 'product_group_target.product_group_target_user_id')
            ->join('users as target_by', 'target_by.id', '=', 'product_group_target.product_group_target_by')
            ->join('product_group', 'product_group.product_group_id', '=', 'product_group_target.product_group_target')
            ->select('product_group_target.*', 'users.*', 'users.name as user_name', 'target_by.*', 'product_group.*', 'target_by.name as target_by_name')
            ->where('product_group_target_user_id', $request->product_group_user_id)
            ->get();
        $supervisor_name = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->select('name')
            ->where('id', $request->product_group_your_manager)
            ->first();
        if (count($fetch_product_group_targets) > 0) {
            foreach ($fetch_product_group_targets as $key => $targets) {
                $product_groups_targets[] = '<tr><td>' . ($key + 1) . '</td><td>' . $targets->product_group_target_date . '</td><td>' . $targets->user_name . '</td><td>' . $supervisor_name->name . '</td><td>' . $targets->target_by_name . '</td><td>' . $targets->product_group_name . '</td><td>' . $targets->product_group_target_created_at . '</td></tr>';
            }
        } else {
            $product_groups_targets = 0;
        }
        $select_product_group = DB::table('product_group_target')
            ->where('product_group_target_company_id', $auth->users_company_id)
            ->where('product_group_target_user_id', '=', $request->product_group_user_id)
            ->pluck('product_group_target');
        $get_product_group = DB::table('product_group')
            ->whereNotIn('product_group_id', $select_product_group)
            ->where('product_group_company_id', $auth->users_company_id)
            ->get();
        if (count($get_product_group) > 0) {
            foreach ($get_product_group as $product_group) {
                $product_groups_options[] = '<option value="' . $product_group->product_group_id . '">' . $product_group->product_group_name . '</option>';
            }
        } else {
            $product_groups_options = 0;
        }
        return response()->json(compact('product_groups_targets', 'product_groups_options'));
    }
}
