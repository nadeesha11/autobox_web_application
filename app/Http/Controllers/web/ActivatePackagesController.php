<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivatePackagesController extends Controller
{
    public function index($id)
    {

        $category_id = DB::table('packages')->where('id', $id)->pluck('category_id')->first();
        $package_data = DB::table('packages')->find($id);

        if ($category_id === 1) { //to check free package or not(free package)
            // check free package already bought by user 
            $free_package_activate = DB::table('assign_packages')->where('customer_id', session()->get('vendor_data')->id)->first();
            if ($free_package_activate) {
                return redirect()->back()->with('free_package_already_activate', 'Free package already activated');
            } else {
                $assign_package = DB::table('assign_packages')->insert([
                    'customer_id' => session()->get('vendor_data')->id,
                    'package_id' => $id,
                    'package_start_date' => Carbon::now(),
                    'package_expire_date' =>  Carbon::now()->addDays($package_data->package_duration),
                    'available_ad_count' => $package_data->package_ad_count,
                    'available_top_count' => $package_data->topup_count,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                if ($assign_package) {
                    return redirect()->back()->with('free_package_success', 'Free package activated');
                } else {
                    return redirect()->back()->with('wrong', 'Something went wrong !!!');
                }
            }
        } else {
            //this is payed package

        }
    }
}
