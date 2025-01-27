<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    //    SCHEDULE REPORTS
    public function scheduleReports()
    {
        $auth = Auth::user();
        $sale_persons = User::where('supervisor', Auth::user()->id)
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        return view('scheduleReports.scheduleReports', compact('sale_persons'));
    }
    //    showing users after click on role dropdown
    public function showScheduleUsers(Request $request)
    {
        $auth = Auth::user();
        $check_user_in_schedule_target = DB::table('schedule_target')
            ->where('schedule_target_company_id', $auth->users_company_id)
            ->pluck('sch_target_user_id');
        $all_user = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->whereIn('users.id', $check_user_in_schedule_target)
            ->where('users.role', '=', $request->schedule_role)
            ->get();
        if (count($all_user) > 0) {
            $schedule_users[] = '<option selected value="0">All</option>';
            foreach ($all_user as $users) {
                $schedule_users[] = '<option value="' . $users->id . '">' . $users->name . '</option>';
            }
            return response()->json(compact('schedule_users'));
        } else {
            $schedule_users = '<option disabled selected hidden>No User Found</option>';
            return response()->json(compact('schedule_users'));
        }
    }
    //    showing data after click on filter
    public function sch_target(Request $request)
    {
        $auth = Auth::user();
        if ($request->user_id != '0') {
            $query = DB::table('schedule')->where('schedule_company_id', $auth->users_company_id);
            if (!empty($request->from_date)) {
                $query->whereDate('schedule.date', '>=', date($request->from_date));
            }
            if (!empty($request->to_date)) {
                $query->whereDate('schedule.date', '<=', date($request->to_date));
            }
            $query->where('user_id', $request->user_id);
            $achieved_targets = $query->count();

            $total_targets = DB::table('schedule_target')
                ->where('schedule_target_company_id', $auth->users_company_id)
                ->select('sch_target_total_visits')
                ->where('schedule_target.sch_target_user_id', $request->user_id)
                ->first();

            $query = DB::table('schedule')->where('schedule_company_id', $auth->users_company_id);
            if (!empty($request->from_date)) {
                $query->whereDate('schedule.date', '>=', date($request->from_date));
            }
            if (!empty($request->to_date)) {
                $query->whereDate('schedule.date', '<=', date($request->to_date));
            }
            //                ->whereBetween('schedule.date', array($request->from_date, $request->to_date))
            $query->where('schedule_status', '=', 'new');
            $query->where('user_id', $request->user_id);
            $new_targets = $query->count();

            $query = DB::table('schedule')->where('schedule_company_id', $auth->users_company_id);
            if (!empty($request->from_date)) {
                $query->whereDate('schedule.date', '>=', date($request->from_date));
            }
            if (!empty($request->to_date)) {
                $query->whereDate('schedule.date', '<=', date($request->to_date));
            }
            $query->where('schedule_status', '=', 'reSchedule');
            $query->where('user_id', $request->user_id);
            $old_targets = $query->count();
            $username = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('id', $request->user_id)
                ->first('name');
            return response()->json(compact('achieved_targets', 'total_targets', 'username', 'new_targets', 'old_targets'));
        }
        if ($request->user_id == '0') {
            // dd(1);
            //            SQL QUERY CREATED BY ARBAZ (START)
            $query_data = DB::select('select id, name, total, sum(achieved) as sum_achieved, sum(new) as sum_new, sum(old) as sum_old, sum(remaining) as sum_remaining, sum(per) as sum_per
                from (
                    select u.id, u.name, st.sch_target_total_visits as total,
                       count(s.user_id) as achieved,
                       if (s.schedule_status = "new", count(s.schedule_status), 0) as new,
                       if (s.schedule_status = "reSchedule", count(s.schedule_status), 0) as old,
                       (st.sch_target_total_visits - count(s.user_id)) as remaining,
                       ROUND((count(s.user_id) * 100 / st.sch_target_total_visits), 2) as per
                    from users u
                    join schedule s on s.user_id = u.id
                    join schedule_target st on st.sch_target_user_id = u.id
                    group by u.id
                    union
                    select u.id, u.name, st.sch_target_total_visits as total,
                           0 as achieved,
                           0 as new,
                           0 as old,
                           0 as remaining,
                           0 as per
                    from users u
                    join schedule s on s.user_id != u.id
                    join schedule_target st on st.sch_target_user_id != u.id
                    group by u.id
                    ) aa
                where id in (select sch_target_user_id from schedule_target)
                group by id
                ');

            $data = '';
            foreach ($query_data as $key => $item) {
                $data .= '<tr>';
                $data .= '<td>' . $item->name . '</td>';
                $data .= '<td>' . $item->total . '</td>';
                $data .= '<td>' . $item->sum_achieved . '</td>';
                $data .= '<td>' . $item->sum_new . '</td>';
                $data .= '<td>' . $item->sum_old . '</td>';
                $data .= '<td>' . $item->sum_remaining . '</td>';
                $data .= '<td>' . $item->sum_per . '</td>';
                $data .= '<td><button class="btn btn-sm btn-primary C_total_sch_target" data-toggle="modal" data-user_id="' . $query_data[$key]->id . '" data-from_date="' . $request->from_date . '" data-to_date="' . $request->to_date . '" data-target=".total_sch_target">View</button></td>';
                $data .= '</tr>';
            }
            return response()->json(compact('data'));
            //            SQL QUERY CREATED BY ARBAZ (END)

            //            LARAVEL QUERY BUILDER (BUT THERE IS A PROBLEM OF JIONING OF TWO TABLES) (START)

            //            $if_no_data = DB::table('users as u');
            //            $if_no_data->join('schedule as s', 's.user_id', '!=', 'u.id');
            //            $if_no_data->join('schedule_target as st', 'st.sch_target_user_id', '!=', 'u.id');
            //            $if_no_data->select('u.id', 'u.name', 'st.sch_target_total_visits as total',
            //                DB::raw('0 as achieved'),
            //                DB::raw('0 as new'),
            //                DB::raw('0 as old'),
            //                DB::raw('0 as remaining'),
            //                DB::raw('0 as percentage')
            //            );
            //            $if_no_data->whereIn('u.id', DB::table('schedule_target')->pluck('sch_target_user_id'));
            //            $if_no_data->groupBy('u.id');
            //
            //            $query = DB::table('users as u');
            //            $query->join('schedule as s', 's.user_id', '=', 'u.id');
            //            $query->join('schedule_target as st', 'st.sch_target_user_id', '=', 'u.id');
            //            $query->select('u.id', 'u.name', 'st.sch_target_total_visits as total',
            //                DB::raw('count(s.user_id) as achieved'),
            //                DB::raw('if(s.schedule_status = "new", count(s.schedule_status), 0) as new'),
            //                DB::raw('if(s.schedule_status = "reSchedule", count(s.schedule_status), 0) as old'),
            //                DB::raw('(st.sch_target_total_visits - count(s.user_id)) as remaining'),
            //                DB::raw('ROUND((count(s.user_id) * 100 / st.sch_target_total_visits),2) as percentage')
            //                );
            //            $query->union($if_no_data);
            //            $query->whereIn('u.id', DB::table('schedule_target')->pluck('sch_target_user_id'));
            //            $query->groupBy('u.id');
            //            $all_data = $query->get();
            //
            //            $data = '';
            //                foreach ($all_data as $key => $item){
            //                    $data .= '<tr>';
            //                    $data .= '<td>'.$item->name.'</td>';
            //                    $data .= '<td>'.$item->total.'</td>';
            //                    $data .= '<td>'.$item->achieved.'</td>';
            //                    $data .= '<td>'.$item->new.'</td>';
            //                    $data .= '<td>'.$item->old.'</td>';
            //                    $data .= '<td>'.$item->remaining.'</td>';
            //                    $data .= '<td>'.$item->percentage.'</td>';
            //                    $data .= '<td><button class="btn btn-sm btn-primary C_total_sch_target" data-toggle="modal" data-user_id="'.$all_data[$key]->id.'" data-from_date="'.$request->from_date.'" data-to_date="'.$request->to_date.'" data-target=".total_sch_target">View</button></td>';
            //                    $data .= '</tr>';
            //                }
            //            return response()->json(compact('all_data'));
        }

        //            LARAVEL QUERY BUILDER (BUT THERE IS A PROBLEM OF JIONING OF TWO TABLES) (END)
    }
    public function total_sch_target(Request $request)
    {
        $auth = Auth::user();
        $query = DB::table('schedule')->where('schedule_company_id', $auth->users_company_id);
        $query->leftJoin('users', 'users.id', '=', 'schedule.user_id');
        $query->leftJoin('company', 'company.id', '=', 'schedule.company_id');
        $query->leftJoin('visit_type', 'visit_type.visit_type_id', '=', 'schedule.type_of_visit');
        if (!empty($request->from_date)) {
            $query->whereDate('schedule.date', '>=', date($request->from_date));
        }
        if (!empty($request->to_date)) {
            $query->whereDate('schedule.date', '<=', date($request->to_date));
        }
        //            ->whereBetween('schedule.date', array($request->from_date, $request->to_date))
        $query->where('schedule.user_id', $request->user_id);
        $total_targets = $query->get();
        // dd($total_targets);
        return response()->json(compact('total_targets'));
    }
    //    FUNNEL REPORTS
    public function funnelReports()
    {
        $auth = Auth::user();
        $sale_persons = User::where('supervisor', Auth::user()->id)
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        return view('funnelReports.funnelReports', compact('sale_persons'));
    }
    //    showing users after click on role dropdown
    public function showFunnelUsers(Request $request)
    {
        $auth = Auth::user();
        $check_user_in_funnel_target = DB::table('funnel_target')
            ->where('funnel_target_company_id', $auth->users_company_id)
            ->pluck('funnel_target_user_id');
        $all_user = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->whereIn('users.id', $check_user_in_funnel_target)
            ->where('users.role', '=', $request->funnel_role)
            ->get();
        if (count($all_user) > 0) {
            $funnel_users = '<option selected value="0">All</option>';
            foreach ($all_user as $users) {
                $funnel_users .= '<option value="' . $users->id . '">' . $users->name . '</option>';
            }
            return response()->json(compact('funnel_users'));
        } else {
            $funnel_users = '<option disabled selected hidden>No User Found</option>';
            return response()->json(compact('funnel_users'));
        }
    }
    public function funnel_target(Request $request)
    {
        $auth = Auth::user();
        if (!empty($request->user_id)) {
            $username = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('id', $request->user_id)
                ->first('name');
            $total_targets = DB::table('funnel_target')
                ->where('funnel_target_company_id', $auth->users_company_id)
                ->select('funnel_target_otc', 'funnel_target_mrc')
                ->where('funnel_target.funnel_target_user_id', $request->user_id)
                ->first();
            $total_otc = DB::table('funnel')
                ->where('funnel_company_id', $auth->users_company_id)
                ->whereBetween('funnel.date', [$request->from_date, $request->to_date])
                ->where('user_id', $request->user_id)
                ->sum('otc');
            $total_mrc = DB::table('funnel')
                ->where('funnel_company_id', $auth->users_company_id)
                ->whereBetween('funnel.date', [$request->from_date, $request->to_date])
                ->where('user_id', $request->user_id)
                ->sum('mrc');
            // dd($username, $total_targets, $total_otc, $total_mrc);
            return response()->json(compact('username', 'total_targets', 'total_otc', 'total_mrc'));
        }
        if (empty($request->user_id)) {
            // dd(1);
            //            SQL QUERY CREATED BY ARBAZ (START)
            $query_data = DB::select('select id, name, fotc, fmrc, sum_fotc, sum_fmrc, percentage
                from (
                    select u.id, u.name, ft.funnel_target_otc as fotc, ft.funnel_target_mrc as fmrc,
                    sum(f.otc) as sum_fotc, sum(f.mrc) as sum_fmrc,
                    Round((f.otc + f.mrc) / (ft.funnel_target_otc + ft.funnel_target_mrc) * 100) as percentage
                    from users u
                    join funnel f on f.user_id = u.id
                    join funnel_target ft on ft.funnel_target_user_id = u.id
                    group by u.id
                    ) aa
                where id in (select funnel_target_user_id from funnel_target)
                group by id
                ');
            // dd($query_data);
            $data = '';
            foreach ($query_data as $key => $item) {
                $data .= '<tr>';
                $data .= '<td>' . $item->name . '</td>';
                $data .= '<td>' . $item->fotc . '</td>';
                $data .= '<td>' . $item->fmrc . '</td>';
                $data .= '<td>' . $item->sum_fotc . '</td>';
                $data .= '<td>' . $item->sum_fmrc . '</td>';
                $data .= '<td>' . $item->percentage . '</td>';
                $data .= '<td><button class="btn btn-sm btn-primary C_total_funnel_target" data-toggle="modal" data-user_id="' . $query_data[$key]->id . '" data-from_date="' . $request->from_date . '" data-to_date="' . $request->to_date . '" data-target=".total_funnel_target">View</button></td>';
                $data .= '</tr>';
            }
            return response()->json(compact('data'));
            //            SQL QUERY CREATED BY ARBAZ (END)
        }
    }
    public function total_funnel_target(Request $request)
    {
        $auth = Auth::user();
        $total_targets = DB::table('funnel')
            ->where('funnel_company_id', $auth->users_company_id)
            ->leftJoin('users', 'users.id', '=', 'funnel.user_id')
            ->leftJoin('company', 'company.id', '=', 'funnel.company_id');

        if (!empty($request->from_date)) {
            $total_targets->whereDate('funnel.date', '>=', date($request->from_date));
        }

        if (!empty($request->to_date)) {
            $total_targets->whereDate('funnel.date', '<=', date($request->to_date));
        }

        $total_targets = $total_targets->where('funnel.user_id', $request->user_id)->get();

        // dd($total_targets);

        return response()->json(compact('total_targets'));
    }
    //    PURPOSAL REPORTS
    public function purposalReports()
    {
        $auth = Auth::user();
        $sale_persons = User::where('supervisor', Auth::user()->id)
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        return view('purposalReports.purposalReports', compact('sale_persons'));
    }
    //    showing users after click on role dropdown
    public function showPurposalUsers(Request $request)
    {
        $auth = Auth::user();
        $check_user_in_task = DB::table('quotation_target')
            ->where('quotation_target_company_id', $auth->users_company_id)
            ->pluck('quotation_target_user_id');
        $all_user = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', $request->purposal_role)
            ->whereIn('users.id', $check_user_in_task)
            ->get();
        if (count($all_user)) {
            $purposal_users = '<option selected value="0">All</option>';
            foreach ($all_user as $users) {
                $purposal_users .= '<option value="' . $users->id . '">' . $users->name . '</option>';
            }
            return response()->json(compact('purposal_users'));
        } else {
            $purposal_users = '<option disabled selected hidden>No User Found</option>';
            return response()->json(compact('purposal_users'));
        }
    }
    public function purposal_target(Request $request)
    {
        $auth = Auth::user();
        if (!empty($request->user_id)) {
            $username = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('id', $request->user_id)
                ->first('name');
            $total_targets = DB::table('quotation_target')
                ->where('quotation_target_company_id', $auth->users_company_id)
                ->select('quotation_target_otc', 'quotation_target_mrc')
                ->where('quotation_target.quotation_target_user_id', $request->user_id)
                ->first();
            $total_otc = DB::table('sale_invoice')
                ->where('sale_invoice_company_id', $auth->users_company_id)
                ->whereBetween('sale_invoice.date', [$request->from_date, $request->to_date])
                ->where('user_id', $request->user_id)
                ->where('payment_type', '=', 'OTC')
                ->sum('total_amount');
            $total_mrc = DB::table('sale_invoice')
                ->where('sale_invoice_company_id', $auth->users_company_id)
                ->whereBetween('sale_invoice.date', [$request->from_date, $request->to_date])
                ->where('user_id', $request->user_id)
                ->where('payment_type', '=', 'MRC')
                ->sum('total_amount');
            return response()->json(compact('username', 'total_targets', 'total_otc', 'total_mrc'));
        }
        if (empty($request->user_id)) {
            //            SQL QUERY CREATED BY ARBAZ (START)
            $query_data = DB::select('select id, name, qotc, qmrc, sum_qotc, sum_qmrc, otc_percentage,mrc_percentage
                from (
                    select u.id, u.name, qt.quotation_target_otc as qotc, qt.quotation_target_mrc as qmrc,
                    if(si.payment_type = "OTC", sum(total_amount), 0) as sum_qotc,
                    if(si.payment_type = "MRC", sum(total_amount), 0) as sum_qmrc,
                    Round((if(si.payment_type = "OTC", sum(total_amount), 0)) / (qt.quotation_target_otc) * 100) as otc_percentage,
                    Round((if(si.payment_type = "MRC", sum(total_amount), 0)) / (qt.quotation_target_mrc) * 100) as mrc_percentage
                    from users u
                    join sale_invoice si on si.user_id = u.id
                    join quotation_target qt on qt.quotation_target_user_id = u.id
                    group by u.id
                    ) aa
                where id in (select quotation_target_user_id from quotation_target)
                group by id
                ');

            $data = '';
            foreach ($query_data as $key => $item) {
                $data .= '<tr>';
                $data .= '<td>' . $item->name . '</td>';
                $data .= '<td>' . $item->qotc . '</td>';
                $data .= '<td>' . $item->qmrc . '</td>';
                $data .= '<td>' . $item->sum_qotc . '</td>';
                $data .= '<td>' . $item->sum_qmrc . '</td>';
                $data .= '<td>' . $item->otc_percentage . '</td>';
                $data .= '<td>' . $item->mrc_percentage . '</td>';
                $data .= '<td><button class="btn btn-sm btn-primary C_total_purposal_target" data-toggle="modal" data-user_id="' . $query_data[$key]->id . '" data-from_date="' . $request->from_date . '" data-to_date="' . $request->to_date . '" data-target=".total_purposal_target">View</button></td>';
                $data .= '</tr>';
            }
            return response()->json(compact('data'));
            //            SQL QUERY CREATED BY ARBAZ (END)
        }
    }
    public function total_purposal_target(Request $request)
    {
        $auth = Auth::user();
        $total_targets = DB::table('sale_invoice')
            ->where('sale_invoice_company_id', $auth->users_company_id)
            ->join('invoice', 'invoice.id', '=', 'sale_invoice.inv_id')
            ->join('users', 'users.id', '=', 'sale_invoice.user_id')
            ->join('company', 'company.id', '=', 'invoice.company_id');
        if (!empty($request->from_date)) {
            $total_targets->whereDate('funnel.date', '>=', date($request->from_date));
        }

        if (!empty($request->to_date)) {
            $total_targets->whereDate('funnel.date', '<=', date($request->to_date));
        }
        // ->whereBetween('sale_invoice.date', [$request->from_date, $request->to_date])

        $total_targets = $total_targets
            ->select('sale_invoice.date', 'sale_invoice.sale', 'sale_invoice.total_amount', 'users.name', 'company.company_name', 'sale_invoice.created_at', 'sale_invoice.payment_type')
            ->where('sale_invoice.user_id', $request->user_id)
            ->get();
        //        $sum_of_otc = DB::table('sale_invoice')
        //            ->whereBetween('sale_invoice.date', array($request->from_date, $request->to_date))
        //            ->where('sale_invoice.user_id', $request->user_id)
        //            ->where('payment_type', '=', 'OTC')
        //            ->sum('total_amount');
        //        $sum_of_mrc = DB::table('sale_invoice')
        //            ->whereBetween('sale_invoice.date', array($request->from_date, $request->to_date))
        //            ->where('sale_invoice.user_id', $request->user_id)
        //            ->where('payment_type', '=', 'MRC')
        //            ->sum('total_amount');
        $total_amount = DB::table('sale_invoice')->where('sale_invoice_company_id', $auth->users_company_id);
        if (!empty($request->from_date)) {
            $total_amount->whereDate('funnel.date', '>=', date($request->from_date));
        }

        if (!empty($request->to_date)) {
            $total_amount->whereDate('funnel.date', '<=', date($request->to_date));
        }
        // ->whereBetween('sale_invoice.date', [$request->from_date, $request->to_date])

        $total_amount = $total_amount->where('sale_invoice.user_id', $request->user_id)->sum('total_amount');
        return response()->json(compact('total_targets', 'total_amount'));
    }

    //    ORDER REPORTS
    public function orderReports()
    {
        $auth = Auth::user();
        $sale_persons = User::where('supervisor', Auth::user()->id)
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        return view('orderReports.orderReports', compact('sale_persons'));
    }
    //    showing users after click on role dropdown
    public function showOrderUsers(Request $request)
    {
        $auth = Auth::user();
        $check_user_in_task = DB::table('order_target')
            ->where('order_target_company_id', $auth->users_company_id)
            ->pluck('order_target_user_id');
        $all_user = DB::table('users')
            ->where('users_company_id', $auth->users_company_id)
            ->where('role', '=', $request->order_role)
            ->whereIn('users.id', $check_user_in_task)
            ->get();
        // dd($check_user_in_task, $all_user);
        if (count($all_user)) {
            $order_users = '<option selected value="0">All</option>';
            foreach ($all_user as $users) {
                $order_users .= '<option value="' . $users->id . '">' . $users->name . '</option>';
            }
            return response()->json(compact('order_users'));
        } else {
            $order_users = '<option disabled selected hidden>No User Found</option>';
            return response()->json(compact('order_users'));
        }
    }
    public function order_target(Request $request)
    {
        $auth = Auth::user();
        if (!empty($request->user_id)) {
            $username = DB::table('users')
                ->where('users_company_id', $auth->users_company_id)
                ->where('id', $request->user_id)
                ->first('name');
            $total_targets = DB::table('order_target')
                ->where('order_target_company_id', $auth->users_company_id)
                ->select('order_target_otc', 'order_target_mrc')
                ->where('order_target.order_target_user_id', $request->user_id)
                ->first();
            $total_otc = DB::table('order_purposal')
                ->where('order_purposal_company_id', $auth->users_company_id)
                ->whereBetween('order_purposal.order_purposal_date', [$request->from_date, $request->to_date])
                ->where('order_purposal_user_id', $request->user_id)
                ->where('order_purposal_payment_type', '=', 'OTC')
                ->sum('order_purposal_total_amount');
            $total_mrc = DB::table('order_purposal')
                ->where('order_purposal_company_id', $auth->users_company_id)
                ->whereBetween('order_purposal.order_purposal_date', [$request->from_date, $request->to_date])
                ->where('order_purposal_user_id', $request->user_id)
                ->where('order_purposal_payment_type', '=', 'MRC')
                ->sum('order_purposal_total_amount');
            return response()->json(compact('username', 'total_targets', 'total_otc', 'total_mrc'));
        }
        if (empty($request->user_id)) {
            //            SQL QUERY CREATED BY ARBAZ (START)
            $query_data = DB::select('select id, name, ootc, omrc, sum_ootc, sum_omrc, otc_percentage,mrc_percentage
                from (
                    select u.id, u.name, ot.order_target_otc as ootc, ot.order_target_mrc as omrc,
                    if(op.order_purposal_payment_type = "OTC", sum(order_purposal_total_amount), 0) as sum_ootc,
                    if(op.order_purposal_payment_type = "MRC", sum(order_purposal_total_amount), 0) as sum_omrc,
                    Round((if(op.order_purposal_payment_type = "OTC", sum(order_purposal_total_amount), 0)) / (ot.order_target_otc) * 100) as otc_percentage,
                    Round((if(op.order_purposal_payment_type = "MRC", sum(order_purposal_total_amount), 0)) / (ot.order_target_mrc) * 100) as mrc_percentage
                    from users u
                    join order_purposal op on op.order_purposal_user_id = u.id
                    join order_target ot on ot.order_target_user_id = u.id
                    group by u.id
                    ) aa
                where id in (select order_target_user_id from order_target)
                group by id
                ');

            $data = '';
            foreach ($query_data as $key => $item) {
                $data .= '<tr>';
                $data .= '<td>' . $item->name . '</td>';
                $data .= '<td>' . $item->ootc . '</td>';
                $data .= '<td>' . $item->omrc . '</td>';
                $data .= '<td>' . $item->sum_ootc . '</td>';
                $data .= '<td>' . $item->sum_omrc . '</td>';
                $data .= '<td>' . $item->otc_percentage . '</td>';
                $data .= '<td>' . $item->mrc_percentage . '</td>';
                $data .= '<td><button class="btn btn-sm btn-primary C_total_order_target" data-toggle="modal" data-user_id="' . $query_data[$key]->id . '" data-from_date="' . $request->from_date . '" data-to_date="' . $request->to_date . '" data-target=".total_order_target">View</button></td>';
                $data .= '</tr>';
            }
            return response()->json(compact('data'));
            //            SQL QUERY CREATED BY ARBAZ (END)
        }
    }
    public function total_order_target(Request $request)
    {
        $auth = Auth::user();
        $total_targets = DB::table('order_purposal')
            ->where('order_purposal_company_id', $auth->users_company_id)
            ->join('order', 'order.id', '=', 'order_purposal.order_purposal_order_id')
            ->join('users', 'users.id', '=', 'order_purposal.order_purposal_user_id')
            ->join('company', 'company.id', '=', 'order.company_id');
        if (!empty($request->from_date)) {
            $total_targets->whereDate('funnel.date', '>=', date($request->from_date));
        }

        if (!empty($request->to_date)) {
            $total_targets->whereDate('funnel.date', '<=', date($request->to_date));
        }
        $total_targets = $total_targets
            ->select('order_purposal.order_purposal_date', 'order_purposal.order_purposal_qty', 'order_purposal.order_purposal_sale', 'order_purposal.order_purposal_total_amount', 'users.name', 'company.company_name', 'order_purposal.order_purposal_created_at', 'order_purposal.order_purposal_payment_type')
            ->where('order_purposal.order_purposal_user_id', $request->user_id)
            ->get();

        $total_amount = DB::table('order_purposal')->where('order_purposal_company_id', $auth->users_company_id);
        if (!empty($request->from_date)) {
            $total_amount->whereDate('funnel.date', '>=', date($request->from_date));
        }

        if (!empty($request->to_date)) {
            $total_amount->whereDate('funnel.date', '<=', date($request->to_date));
        }
        $total_amount = $total_amount->where('order_purposal.order_purposal_user_id', $request->user_id)->sum('order_purposal_total_amount');
        return response()->json(compact('total_targets', 'total_amount'));
    }
}
