<?php

namespace App\Http\Controllers;

use App\ExpiryDate;
use App\Models\ExpiryDate as ModelsExpiryDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpiryDateController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $expiry_days = ModelsExpiryDate::where('expiry_days_company_id', $auth->users_company_id)->get();
        // dd($expiry_days->all());
        return view('Quotations.list_quotations_expiry_date', compact('expiry_days'));
    }
    public function edit(Request $request)
    {
        $auth = Auth::user();
        $expiry_days = ModelsExpiryDate::where('id', $request->id)
            ->where('expiry_days_company_id', $auth->users_company_id)
            ->first();
        return view('Quotations.Quotations_expiry_date', compact('expiry_days'));
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $auth = Auth::user();
        $update_expiry_date = ModelsExpiryDate::where('id', $request->id)->first();
        $update_expiry_date->days = $request->expiry_days;
        $update_expiry_date->expiry_days_company_id = $auth->users_company_id;
        $update_expiry_date->save();
        return redirect('/view_expiry_days')->with('success', 'Successfully Updated');
    }
}
