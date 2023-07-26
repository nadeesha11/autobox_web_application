<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleTypesController extends Controller
{
  public function index()
  {
    return view('Admin.VehicleTypes');
  }

  public function create(Request $request)
  {

    $request->validate([
      'Vehicle_Type_Name' => 'required|max:100',
      'Vehicle_Type_Icon' => 'required|max:500'
    ]);

    $vehicle_type_image = time() . rand(1, 1000) . '.' . $request->Vehicle_Type_Icon->extension();
    $request->Vehicle_Type_Icon->move(public_path("assets/myCustomThings/new_vehicle_image"), $vehicle_type_image); //rename image and upload

    $result = DB::table('vehicle_types')->insert([
      'vt_name' => $request->Vehicle_Type_Name,
      'vt_icon' => $vehicle_type_image,
      'vt_status' => 1,
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
    ]);

    if ($result) {
      return response()->json(['code' => 'true', 'msg' => "Record created"]);
    } else {
      return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
    }
  }

  public function getData()
  {
    $data =  DB::table('vehicle_types')->orderBy('id', 'asc')->get();
    return datatables()->of($data)
      ->addIndexColumn()
      ->addColumn('action', function ($data) {
        $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit btn btn-success btn-sm m-1"><i class="bi bi-x-lg"></i>Edit</a>';
        $btn = $btn . '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="add_brands btn btn-warning btn-sm m-1"><i class="bi bi-x-lg"></i> Manufacturer</a>';
        return $btn;
      })
      ->addColumn('image', function ($data) {
        $url = asset("assets/myCustomThings/new_vehicle_image/$data->vt_icon");
        return '<img style="  width:155px !important; height:155px !important; object-fit:contain !important;" src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />';
      })
      ->addColumn('status', function ($data) {
        if ($data->vt_status == 1) {
          $status = '<span class="badge badge-pill badge-soft-success">Active</span>';
        } else {
          $status = ' <span class="badge badge-pill badge-soft-danger">Deactive</span>';
        }
        return $status;
      })
      ->rawColumns(['action', 'image', 'status'])
      ->make(true);
  }

  public function edit($id)
  {
    $data = DB::table('vehicle_types')->find($id);
    return $data;
  }

  public function update(Request $request)
  {

    $request->validate([
      'name' => 'required|max:100',
      'vehicle_image_' => 'max:500',
    ]);

    //***start deal with  image
    if (isset($request->vehicle_image_)) {
      $Image = time() . rand(1, 1000) . '.' . $request->vehicle_image_->extension();
      $request->vehicle_image_->move(public_path("assets/myCustomThings/new_vehicle_image/"), $Image); //rename image and upload 

      $exist_image = DB::table('vehicle_types')->where('id', $request->id)->pluck('vt_icon')->first();
      $exist_old_image = 'assets/myCustomThings/new_vehicle_image/' . $exist_image;
      if (file_exists($exist_old_image)) {
        unlink($exist_old_image); //remove current image
      } else {
      }
    } else {
      $Image = DB::table('vehicle_types')->where('id', $request->id)->pluck('vt_icon')->first();
    }  //***end deal with  image

    if (isset($request->vehicleTypeEdit)) {
      $status = 1;
    } else {
      $status = 0;
    }

    //  update data 
    $result = DB::table('vehicle_types')->where('id', $request->id)->update([
      'vt_name' => $request->name,
      'vt_icon' => $Image,
      'updated_at' => Carbon::now(),
      'vt_status' => $status,
    ]);

    if ($result) {
      return response()->json(['code' => 'true', 'msg' => "Record edited"]);
    } else {
      return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
    }
  }
}
