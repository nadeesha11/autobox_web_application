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
            $merchant_id = '1224415';
            $order_id = uniqid();
            $amount = $package_data->package_price;
            $merchant_secret = 'MjY0MDA2OTg1MjEzMzc4MjQ3NjM1ODgxNzkwMTcxOTk4OTU4NDMx';
            $currency = 'LKR';

            $hash = strtoupper(
                md5(
                    $merchant_id . 
                    $order_id . 
                    number_format($amount, 2, '.', '') . 
                    $currency .  
                    strtoupper(md5($merchant_secret)) 
                ) 
            );

            $payment_data = [];
            $payment_data['amount'] =$package_data->package_price;
            $payment_data['order_id'] =$order_id;
            $payment_data['items'] =$package_data->package_name;
            $payment_data['hash'] =$hash;

            $payment_data['currency'] ="LKR";
            $payment_data['delivery_country'] ="Sri lanka";
            $payment_data['delivery_city'] ="Anuradhapura";
            $payment_data['delivery_address'] ="44/b, ibbagamuwa";
            $payment_data['country'] ="Sri lanka";
            $payment_data['city'] = "Anuradhapura";
            $payment_data['address'] ="44/b,ibbagamuwa";
            $payment_data['phone'] ="0713439884";
            $payment_data['email'] ="jayathilaka221b@gmail.com";
            $payment_data['last_name'] ="jayathshan";
            $payment_data['first_name'] ="Nadeesha";

            $encoded_data = json_encode($payment_data);
            return $encoded_data;

        }
    }
}
