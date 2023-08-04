<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Illuminate\Support\Facades\DB;

class sliderManagementController extends Controller
{
    public function index()
    {

        return view('Admin.sliderManagement');
    }

    public function create(Request $request)
    {
        $request->validate([
            'slider' => 'required',
        ]);

        try {

            $slider_image = time() . rand(1, 1000) . '.' . $request->slider->extension();
            $request->slider->move(public_path("assets/myCustomThings/slider"), $slider_image); //rename image and upload

            $result = DB::table('slider')->insert([
                'image' => $slider_image,
            ]);

            if ($result) {
                return response()->json(['code' => 'success', 'msg' => 'garage added succesfully']);
            } else {
                return response()->json(['code' => 'error', 'msg' => 'something went wrong']);
            }
        } catch (Exception $e) {
            // Exception occurred, handle it here
            return response()->json(['code' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function recieveData()
    {
        $data =  DB::table('slider')->orderBy('id', 'asc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="delete btn btn-danger btn-sm m-1"><i class="bi bi-x-lg"></i>Delete</a>';
                return $btn;
            })
            ->addColumn('image', function ($data) {
                $url = asset("assets/myCustomThings/slider/$data->image");
                return '<img style="  width:155px !important; height:155px !important; object-fit:contain !important;" src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />';
            })

            ->rawColumns(['action', 'image'])
            ->make(true);
    }

    public function delete($id)
    {
        $result = DB::table('slider')->where('id', $id)->delete();

        if ($result) {
            return response()->json(['code' => 'success', 'msg' => 'slider deleted']);
        } else {
            return response()->json(['code' => 'error', 'msg' => 'something went wrong']);
        }
    }
}
