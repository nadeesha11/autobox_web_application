<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\vehicle_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class allAdsController extends Controller
{
    public function view()
    {
        $filterd_ads = DB::table('ads')
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->orderBy('ads.created_at', 'desc')
            ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.created_at', 'ads.ad_number', 'ads.ad_city', 'ads.ad_district')
            ->paginate(12);
        $totalCount = $filterd_ads->total();
        $category = vehicle_type::with('getBrands')->where('vt_status', 1)->get();


        return view('Web.allAds', compact('filterd_ads', 'totalCount', 'category'));
    }

    public function viewType($id)
    {
        $filterd_ads = DB::table('ads')
            ->where('vehicle_types_id', $id)
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->orderBy('ads.is_top_id', 'desc')
            ->orderBy('ads.created_at', 'desc')
            ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.created_at', 'ads.ad_number', 'ads.ad_city', 'ads.ad_district', 'ads.is_top_id')
            ->paginate(12);
        $totalCount = $filterd_ads->total();
        $category = vehicle_type::with('getBrands')->where('vt_status', 1)->get();
        return view('Web.VehicleTypes', compact('filterd_ads', 'totalCount', 'category', 'id'));
    }

    public function viewBrand($id, $viewBrand)
    {
        $filterd_ads = DB::table('ads')
            ->where('vehicle_types_id', $id)
            ->where('brands_id', $viewBrand)
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->orderBy('ads.is_top_id', 'desc')
            ->orderBy('ads.created_at', 'desc')
            ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.created_at', 'ads.ad_number', 'ads.ad_city', 'ads.ad_district', 'ads.is_top_id')
            ->paginate(12);
        $totalCount = $filterd_ads->total();
        $category = vehicle_type::with('getBrands')->where('vt_status', 1)->get();

        return view('Web.viewBrands', compact('filterd_ads', 'totalCount', 'category', 'id', 'viewBrand'));
    }

    public function viewModel($id, $viewBrand, $viewModel)
    {
        // Forget the filter_data session using the session helper function
        session()->forget('keep_old_filter_values');
        session([
            'filter_data' => [
                // 'district' => $request->district,
                'type' => $id,
                'brand' => $viewBrand,
                'model' => $viewModel,
                // 'title' => $request->title,
            ]
        ]);
        //create session to check is this comes from all ads
        session([
            'check_request_for_filter' => [
                "this is all ads"
            ]
        ]);

        $filterd_ads = DB::table('ads')
            ->where('vehicle_types_id', $id)
            ->where('brands_id', $viewBrand)
            ->where('models_id', $viewModel)
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->orderBy('ads.is_top_id', 'desc')
            ->orderBy('ads.created_at', 'desc')
            ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.created_at', 'ads.ad_number', 'ads.ad_city', 'ads.ad_district', 'ads.is_top_id')
            ->paginate(12);
        $totalCount = $filterd_ads->total();
        $category = vehicle_type::with('getBrands')->where('vt_status', 1)->get();
        return view('Web.viewModel', compact('filterd_ads', 'totalCount', 'category', 'id', 'viewBrand', 'viewModel'));
    }
}
