<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class garageManagementController extends Controller
{
    public function index()
    {
        return  view('Admin.garageManagement');
    }

    public function getData()
    {
        $data = DB::table('garage')->get();

        return datatables()->of($data)
            ->addIndexColumn()

            ->addColumn('deatils', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="more "> <i class="fa-solid fa-circle-info fa-beat m-2" style="color: #1ebe46; font-size: 26px;"></i> </a>';
                $btn =   $btn . '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit "> <i class="fa-solid fa-pen-to-square fa-beat m-2" style="color: #f51945;  font-size: 26px;"></i> </a>';

                return $btn;
            })
            ->addColumn('image', function ($data) {
                if (!empty($data->image)) {
                    $url = asset("assets/myCustomThings/Garage/$data->image");
                }
                return '<img style="  width:155px !important; height:155px !important; object-fit:contain !important;" src=' . $url . ' border="0"  align="center" />';
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $status = '<span class="badge badge-pill badge-soft-success">Approved</span>';
                } else {
                    $status = ' <span class="badge badge-pill badge-soft-danger">Pending</span>';
                }
                return $status;
            })
            ->rawColumns(['image', 'status', 'deatils'])
            ->make(true);
    }

    public function more($id)
    {
        $data = DB::table('garage')->find($id);
        return $data;
    }

    public function update(Request $request)
    {
        $result = DB::table('garage')->where('id', $request->id)->update([
            'status' => $request->status
        ]);

        if ($result) {
            return response()->json(['code' => 'true', 'msg' => "Status Changed"]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
        }
    }
}
