<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class viewUsersController extends Controller
{
    public function index()
    {


        return view('Admin.users');
    }

    public function getData()
    {
        $data = DB::table('users')->orderBy('id', 'desc')->where('isAdmin', 0)->get();

        return datatables()->of($data)
            ->addIndexColumn()

            ->addColumn('deatils', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="more "> <i class="fa-solid fa-circle-info fa-beat" style="color: #1ebe46; font-size: 26px;"></i> </a>';
                return $btn;
            })
            ->addColumn('image', function ($data) {
                if (!empty($data->Profile_Image)) {
                    $url = asset("assets/myCustomThings/vehicleTypes/$data->Profile_Image");
                } else {
                    $url = "https://i.ibb.co/xS0GMYT/profile.png";
                }
                return '<img style="  width:55px !important; height:55px !important; object-fit:contain !important;" src=' . $url . ' border="0"  class="img-rounded" align="center" />';
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $status = '<span class="badge badge-pill badge-soft-success">Active</span>';
                } else {
                    $status = ' <span class="badge badge-pill badge-soft-danger">Deactive</span>';
                }
                return $status;
            })
            ->addColumn('position', function ($data) {
                if ($data->cus_role_id  == 2) {
                    $status = '<span class="badge badge-pill badge-soft-success">Dealer</span>';
                } else {
                    $status = ' <span class="badge badge-pill badge-soft-danger">Vendor</span>';
                }
                return $status;
            })
            ->rawColumns(['image', 'status', 'position', 'deatils'])
            ->make(true);
    }

    public function more($id)
    {

        $my_ads = DB::table('ads') //get vendor ads
            ->where('ads_customers_id', $id)
            ->leftJoin('ads_images', function ($join) {
                $join->on('ads.id', '=', 'ads_images.ads_id')
                    ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
            })
            ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
            ->orderBy('ads.created_at', 'desc')
            ->select('ads_images.name', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.ad_expire_date', 'ads.top_ad_expire_date', 'ads.is_top_id', 'ads.status', 'ads.adminStatus')
            ->get();

        $userDetailed = DB::table('users')
            ->where('users.id', $id)
            ->leftJoin('assign_packages', 'assign_packages.customer_id', '=', 'users.id')
            ->select('users.*', 'assign_packages.*')
            ->selectRaw('users.created_at AS user_joined')
            ->first(); //user details

        $package_name = DB::table('packages')->where('id', $userDetailed->package_id)->pluck('package_name')->first(); //package details


        return view('Admin.userDetailed', compact('userDetailed', 'package_name', 'my_ads'));
    }

    public function delete($id)
    {

        // delete images start 
        $exist_images = DB::table('ads_images')->where('ads_id', $id)->get();
        foreach ($exist_images  as $image) {
            $image_path = public_path('assets/myCustomThings/vehicleTypes/' . $image->name);
            if (File::exists($image_path)) {
                File::delete($image_path);
                //1690282460161.jpg  1690282462445.jpg  1690282463557.jpg
            }
        }

        // Perform the delete operation
        $deleted = DB::table('ads')->where('id', '=', $id)->delete();



        // delete images end 

        // Check if the delete was successful
        if ($deleted) {
            // If successful, redirect back with a success message
            return redirect()->back()->with('success', 'Ad deleted successfully!');
        } else {
            // If unsuccessful, redirect back with an error message
            return redirect()->back()->with('error', 'Failed to delete the ad.');
        }
    }

    public function changeStatus($id)
    {
        $admin_status = DB::table('ads')->where('id', '=', $id)->pluck('adminStatus')->first();
        // Determine the new value based on the current value
        $new_admin_status = $admin_status === 1 ? null : 1;
        // Update the database record with the new adminStatus value
        DB::table('ads')->where('id', '=', $id)->update(['adminStatus' => $new_admin_status]);
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Admin status updated successfully!');
    }
}
