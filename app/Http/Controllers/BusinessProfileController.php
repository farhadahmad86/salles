<?php

namespace App\Http\Controllers;
use App\Models\BusinessProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessProfileController extends Controller
{
    public function businessProfile()
    {
        $auth = Auth::user();
        $business_profile = BusinessProfile::where('business_profile_company_id', $auth->users_company_id)->first();
        if (empty($business_profile)) {
            $business_profile = '';
            return view('businessProfile.businessProfile', compact('business_profile'));
        } else {
            return view('businessProfile.businessProfile', compact('business_profile'));
        }
    }
    public function updateBusinessProfile(Request $request)
    {
        $auth = Auth::user();
        $updateBusinessProfile = BusinessProfile::find($request->id);
        // Handle File Upload
        if ($request->hasFile('logo')) {
            //Get filename with extension
            $fileNameWithExt = $request->file('logo')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('logo')->getClientOriginalExtension();
            //Filename to Store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //            $fileNameToStore = $filename.'.'.$extension;
            //Upload the image
            $path = $request->file('logo')->storeAs('public/img', $fileNameToStore);
        } else {
            $fileNameToStore = 'no_image.png';
        }
        $updateBusinessProfile->business_profile_name = $request->name;
        $updateBusinessProfile->business_profile_email = $request->email;
        $updateBusinessProfile->business_profile_mobile_no = $request->mobile_no;
        $updateBusinessProfile->business_profile_company_id = $auth->users_company_id;
        $updateBusinessProfile->business_profile_ptcl_no = $request->ptcl_no;
        $updateBusinessProfile->business_profile_ntn_no = $request->ntn_no;
        $updateBusinessProfile->business_profile_gst_no = $request->gst_no;
        $updateBusinessProfile->business_profile_web_address = $request->web_address;
        $updateBusinessProfile->business_profile_address = $request->address;
        $updateBusinessProfile->business_profile_created_at = Carbon::now('Asia/Karachi');
        $updateBusinessProfile->business_profile_updated_at = Carbon::now('Asia/Karachi');
        if ($request->hasFile('logo')) {
            $updateBusinessProfile->business_profile_logo = $fileNameToStore;
        }
        $updateBusinessProfile->ip_address = $this->get_ip();
        $updateBusinessProfile->os_name = $this->get_os();
        $updateBusinessProfile->browser = $this->get_browsers();
        $updateBusinessProfile->device = $this->get_device();
        $updateBusinessProfile->save();
        return redirect('/businessProfile')->with('success', 'Successfully Updated');
    }
}
