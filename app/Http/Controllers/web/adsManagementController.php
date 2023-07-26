<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adsManagementController extends Controller
{
    public function index()
    {

        $free_category = DB::table('ad_category')->where('id', 1)->where('status', 1)->get();
        $silver_category = DB::table('ad_category')->where('id', 2)->where('status', 1)->get();
        $gold_category = DB::table('ad_category')->where('id', 3)->where('status', 1)->get();
        $platinum_category = DB::table('ad_category')->where('id', 4)->where('status', 1)->get();



        $free_data = DB::table('packages')->where('category_id', 1)->where('status', 1)->get();
        $silver_data = DB::table('packages')->where('category_id', 2)->where('status', 1)->get();
        $gold_data = DB::table('packages')->where('category_id', 3)->where('status', 1)->get();
        $platinum_data = DB::table('packages')->where('category_id', 4)->where('status', 1)->get();

        return view('Web.adsManagement', compact('free_data', 'silver_data', 'gold_data', 'platinum_data', 'free_category', 'silver_category', 'gold_category', 'platinum_category'));
    }
}
