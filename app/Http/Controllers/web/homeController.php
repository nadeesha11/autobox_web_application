<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\vehicle_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  Session;

class homeController extends Controller
{
    public function index()
    {

        $districts = DB::table('districts')->pluck('name_en');
        $slider = DB::table('slider')->get(); // sliders
        $vehicle_types = DB::table('vehicle_types')->where('vt_status', 1)->pluck('vt_name', 'id');

        $latest_ads = DB::table('ads')
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->orderBy('ads.created_at', 'desc')
            ->take(6)
            ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
            ->get();

        return view('Web.index', compact(['latest_ads', 'districts', 'vehicle_types', 'slider']));
    }

    public function detailed($id)
    {
        $customer_id = DB::table('ads')->where('id', $id)->pluck('ads_customers_id')->first();
        $check_member_ = DB::table('dealer')->where('user_id', $customer_id)->get(); //check member or not
        $member_details = DB::table('dealer')->where('user_id', $customer_id)->first();

        $detailed_ads = DB::table('ads')
            ->join('ads_images', 'ads.id', '=', 'ads_images.ads_id')
            ->join('vehicle_types', 'ads.vehicle_types_id', '=', 'vehicle_types.id')
            ->join('brand', 'ads.brands_id', '=', 'brand.id')
            ->join('users', 'ads.ads_customers_id', '=', 'users.id')
            ->join('model', 'ads.models_id', '=', 'model.id')
            ->where('ads.id', $id)
            ->select('ads.*', 'ads_images.*', 'vehicle_types.vt_name', 'brand.brand_name', 'model.model_name', 'users.First_Name', 'users.Last_Name', 'users.email', 'users.phone', 'users.Fb_link', 'users.Twitter_link', 'users.Linkedin_link', 'users.Youtube_link', 'users.district', 'users.city')
            ->get();

        $more_ads = DB::table('ads')
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->orderBy('ads.created_at', 'desc')
            ->where('ads_customers_id', $customer_id)
            ->inRandomOrder() // Add this line to get random records
            ->take(4)
            ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
            ->get();


        return view('Web.detailed_ad', compact('detailed_ads', 'member_details', 'check_member_', 'more_ads'));
    }

    public function memberShop($id)
    {
        $member_details = DB::table('dealer')->where('user_id', $id)->first();
        $user_data = DB::table('users')->find($id);
        $filterd_ads = DB::table('ads')
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->orderBy('ads.created_at', 'desc')
            ->where('ads_customers_id', $id)
            ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.is_top_id')
            ->paginate(12);

        $totalCount = $filterd_ads->total();
        return view('Web.shop', compact('filterd_ads', 'totalCount', 'member_details', 'user_data'));
    }

    public function getBrands($id)
    {
        $brands = DB::table('brand')->where('vt_id', $id)->where('status', 1)->get();
        return $brands;
    }

    public function getModels($id)
    {
        $models = DB::table('model')->where('brand_id', $id)->where('status', 1)->get();
        return $models;
    }

    public function mainFilterd(Request $request)
    {

        $request->validate([
            // 'district' => 'required',
            'type' => 'required',
            'brand' => 'required',
            'model' => 'required',
        ]);

        return redirect()->route('show.filtered.ads', $request->only(['district', 'type', 'brand', 'model', 'title']));
    }

    public function showFilteredAds(Request $request)
    {
        session()->forget('keep_old_filter_values');
        session()->forget('check_request_for_filter');
        session([
            'filter_data' => [
                'district' => $request->district,
                'type' => $request->type,
                'brand' => $request->brand,
                'model' => $request->model,
                'title' => $request->title,
            ]
        ]);

        $title = $request->title;

        $filterd_ads = DB::table('ads')
            ->where(function ($query) use ($title) {
                $query->where('ad_title', 'LIKE', '%' . $title . '%')
                    ->orWhereNull('ad_title');
            })
            ->when($request->district, function ($query, $district) {
                return $query->where('ad_district', $district);
            })
            ->where('vehicle_types_id', $request->type)
            ->where('brands_id', $request->brand)
            ->where('models_id', $request->model)
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

        return view('Web.ads_filterd', compact('filterd_ads', 'totalCount'));
    }

    public function advancedFilter(Request $request)
    {

        if ($request->title) {
            $filterSessionData = session('filter_data');
            $filterSessionData['title'] = $request->title;
            session(['filter_data' => $filterSessionData]); //update session with title in all ads
        }

        $request->validate([
            'from' => 'required_with:to',
            'to' => 'required_with:from',
        ]);

        session([
            'keep_old_filter_values' => [
                'condition_new' => $request->condition_new,
                'condition_used' => $request->condition_used,
                'condition_reconditioned' => $request->condition_reconditioned,
                'from' => $request->from,
                'to' => $request->to,
                'title' => $request->title

            ]
        ]);

        if ($request->condition_new) {
            $condition_new = $request->condition_new;
        } else {
            $condition_new = null;
        }
        if ($request->condition_used) {
            $condition_used =  $request->condition_used;
        } else {
            $condition_used = null;
        }
        if ($request->condition_reconditioned) {
            $condition_reconditioned =  $request->condition_reconditioned;
        } else {
            $condition_reconditioned = null;
        }

        return redirect()->route('show.advanced.filtered.ads', [
            'title' => $request->input('title'),
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'condition_new' => $condition_new,
            'condition_used' => $condition_used,
            'condition_reconditioned' => $condition_reconditioned,
        ]);
    }

    public function showAdvancedFilter(Request $request)
    {

        $filterSessionData = session('filter_data');

        $title = $filterSessionData['title'] ?? null; // new added this is not created when i access it on all ads filter

        if ($request->title) { // new added
            $filterSessionData['title'] = $request->title;
            $title = $filterSessionData['title'] ?? null; // new added this is not created when i access it on all ads filter
        }

        $filterd_ads = DB::table('ads')
            ->where(function ($query) use ($title) {
                $query->where('ad_title', 'LIKE', '%' . $title . '%')
                    ->orWhereNull('ad_title');
            })
            ->when($filterSessionData['district'] ?? null, function ($query, $district) {
                return $query->where('ad_district', $district);
            })
            // ->where('ad_district', $filterSessionData['district'])
            ->where('vehicle_types_id', $filterSessionData['type'])
            ->where('brands_id', $filterSessionData['brand'])
            ->where('models_id', $filterSessionData['model'])
            ->when($request->condition_reconditioned || $request->condition_new || $request->condition_used, function ($query) use ($request) {
                $query->whereIn('ads_condition', [$request->condition_reconditioned, $request->condition_new, $request->condition_used]);
            })
            ->where(function ($query) use ($request) {
                if ($request->from) {
                    $query->where('ads.ad_price', '>=', $request->from);
                }
                if ($request->to) {
                    $query->where('ads.ad_price', '<=', $request->to);
                }
            })
            ->orWhere(function ($query) use ($request) {
                if (!$request->from && !$request->to) {
                    $query->whereNull('ads.ad_price');
                }
            })
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->orderBy('ads.is_top_id', 'desc')
            ->orderBy('ads.created_at', 'desc')
            ->select('ads_images.name', 'ads.ad_title', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.created_at', 'ads.ad_number', 'ads.ad_city', 'ads.ad_district', 'ads.is_top_id')
            ->paginate(12);

        if (session()->has('check_request_for_filter')) {
            $category = vehicle_type::with('getBrands')->get();
            $filterSessionData = session('filter_data');
            $id = $filterSessionData['type'];
            $viewBrand = $filterSessionData['brand'];
            $viewModel = $filterSessionData['model'];
        } else {
            $category = null;
            $filterSessionData = null;
            $id = null;
            $viewBrand = null;
            $viewModel = null;
        }

        $totalCount = $filterd_ads->total();
        return view('Web.ads_filterd', compact('filterd_ads', 'category', 'id', 'viewBrand', 'viewModel', 'totalCount'));
    }

    public function removeFilter()
    {

        if (session()->has('check_request_for_filter')) {
            $category = vehicle_type::with('getBrands')->get();
            $filterSessionData = session('filter_data');
            $id = $filterSessionData['type'];
            $viewBrand = $filterSessionData['brand'];
            $viewModel = $filterSessionData['model'];

            $filterSessionData = session('filter_data');
            $filterSessionData['title'] = null;
            session(['filter_data' => $filterSessionData]); //update session with title in all ads

            $title = $filterSessionData['title']; // keep title because this is main filter
        } else {
            $category = null;
            $filterSessionData = null;
            $id = null;
            $viewBrand = null;
            $viewModel = null;

            $filterSessionData = session('filter_data');
            $title = $filterSessionData['title']; // keep title because this is main filter
        } // get category data before session destryed

        session()->forget('keep_old_filter_values');
        $filterd_ads = DB::table('ads')
            ->where(function ($query) use ($title) {
                $query->where('ad_title', 'LIKE', '%' . $title . '%')
                    ->orWhereNull('ad_title');
            })
            // ->where('ad_district', $filterSessionData['district'])
            ->when($filterSessionData['district'] ?? null, function ($query, $district) {
                return $query->where('ad_district', $district);
            })
            ->where('vehicle_types_id',  $filterSessionData['type'])->where('brands_id',  $filterSessionData['brand'])->where('models_id',  $filterSessionData['model'])
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

        return view('Web.ads_filterd', compact('filterd_ads', 'category', 'id', 'viewBrand', 'viewModel', 'totalCount'));
    }
}
