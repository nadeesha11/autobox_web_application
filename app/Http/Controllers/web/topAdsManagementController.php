<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class topAdsManagementController extends Controller
{
    public function index()
    {

        $data =  DB::table('top_ads_package')->get();
        return view('Web.topAdsManagement', compact('data'));
    }
}
