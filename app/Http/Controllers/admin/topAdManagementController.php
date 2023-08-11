<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class topAdManagementController extends Controller
{
    public function index()
    {
        return view('Admin.topAdsManagement');
    }

    public function create(Request $request)
    {
        $request->validate([
            'package_name' => 'required|max:50',
            'ads_count' => 'required|max:1000|integer|gt:0',
            'package_price' => 'required|numeric',
        ]);

        $result = DB::table('top_ads_package')->insert([
            'package_name' => $request->package_name,
            'package_price' => $request->package_price,
            'count' => $request->ads_count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'status' => 1,
        ]);

        if ($result) {
            return response()->json(['code' => 'true', 'msg' => "Package Created"]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
        }
    }

    public function getData()
    {
        $data =  DB::table('top_ads_package')->orderBy('id', 'asc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit btn btn-success btn-sm m-1"><i class="bi bi-x-lg"></i>Edit</a>';
                return $btn;
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $status = '<span class="badge badge-pill badge-soft-success">Active</span>';
                } else {
                    $status = ' <span class="badge badge-pill badge-soft-danger">Deactive</span>';
                }
                return $status;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function edit($id)
    {
        $data = DB::table('top_ads_package')->find($id);
        return $data;
    }

    public function update(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
            'name' => 'required|max:50',
            'count' => 'required|max:1000|integer'
        ]);

        if (isset($request->status)) {
            $status = 1;
        } else {
            $status = 0;
        }

        $result = DB::table('top_ads_package')->where('id', $request->id)->update([
            'package_name' => $request->name,
            'count' => $request->count,
            'updated_at' => Carbon::now(),
            'status' => $status,
            'package_price' => $request->price,
        ]);

        if ($result) {
            return response()->json(['code' => 'true', 'msg' => "Package Updated"]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
        }
    }
}
