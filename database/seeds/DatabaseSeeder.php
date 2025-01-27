<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        \App\Models\BusinessProfile::truncate();
        $user_credentials = [
            [
                'name' => 'Admin',
                'username' => 'admin123',
                'email' => 'admin@gmail.com',
                'mob' => '2342380923',
                'password' => 'admin123',
                'address' => 'multan',
                'role' => 'Admin',
                'supervisor' => '',
                'image' => 'no_image.jpg',
                'created_at' => "Carbon::now('Asia/Karachi');",
                'updated_at' => "Carbon::now('Asia/Karachi');",
            ],
            [
                'name' => 'Tele Caller',
                'username' => 'telecaller123',
                'email' => 'telecaller@gmail.com',
                'mob' => '2342380923',
                'password' => 'telecaller123',
                'address' => 'multan',
                'role' => 'Tele Caller',
                'supervisor' => '1',
                'image' => 'no_image.jpg',
                'created_at' => "Carbon::now('Asia/Karachi');",
                'updated_at' => "Carbon::now('Asia/Karachi');",
            ],
            [
                'name' => 'Price Manager',
                'username' => 'pricemanager123',
                'email' => 'pricemanager@gmail.com',
                'mob' => '2342380923',
                'password' => 'pricemanager123',
                'address' => 'multan',
                'role' => 'Price Manager',
                'supervisor' => '1',
                'image' => 'no_image.jpg',
                'created_at' => "Carbon::now('Asia/Karachi');",
                'updated_at' => "Carbon::now('Asia/Karachi');",
            ],
            [
                'name' => 'Product Manager',
                'username' => 'productmanager123',
                'email' => 'productmanager@gmail.com',
                'mob' => '2342380923',
                'password' => 'productmanager123',
                'address' => 'multan',
                'role' => 'Product Manager',
                'supervisor' => '1',
                'image' => 'no_image.jpg',
            ],
        ];
        foreach ($user_credentials as $key => $value){
            $user = new User;
            $user->name = $value['name'];
            $user->username = $value['username'];
            $user->email = $value['email'];
            $user->mob = $value['mob'];
            $user->password = Hash::make($value['password']);
            $user->address = $value['address'];
            $user->role = $value['role'];
            $user->supervisor = $value['supervisor'];
            $user->image = $value['image'];
            $user->created_at = Carbon::now('Asia/Karachi');
            $user->updated_at = Carbon::now('Asia/Karachi');
            $user->save();
        }

        $business_profile = new \App\Models\BusinessProfile;
        $business_profile->business_profile_logo = 'softagics_crop_1597301391.png';
        $business_profile->business_profile_name = 'Softagics';
        $business_profile->business_profile_address = 'Cantt Multan Pakistan';
        $business_profile->business_profile_ntn_no = '0029320384320';
        $business_profile->business_profile_gst_no = '2309482309233';
        $business_profile->business_profile_mobile_no = '03324883453';
        $business_profile->business_profile_ptcl_no = '0613945483';
        $business_profile->business_profile_email = 'softagics@gmail.com';
        $business_profile->business_profile_web_address = 'www.softagics.com';
        $business_profile->business_profile_created_at = Carbon::now('Asia/Karachi');
        $business_profile->business_profile_updated_at = Carbon::now('Asia/Karachi');
        $business_profile->save();
    }
}
