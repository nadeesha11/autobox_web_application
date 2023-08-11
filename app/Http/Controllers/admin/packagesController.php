<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Floats;
use Symfony\Contracts\Service\Attribute\Required;

class packagesController extends Controller
{
    public function index($id)
    {
        return view('Admin.packages', compact('id'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'package_name' => 'required|max:25',
            'image_count' => 'required|max:10|gt:0',
            'package_ad_count' => 'required|integer|gt:0',
            'package_duration' => "required|integer|gt:0",
            'package_price' => 'required|numeric',
            'topup_count' => 'required|numeric|gt:0',
        ]);


        $result = DB::table('packages')->insert([
            'image_count' => $request->image_count,
            'package_name' => $request->package_name,
            'package_ad_count' => $request->package_ad_count,
            'package_duration' => $request->package_duration,
            'package_price' => $request->package_price,
            'status' => 1,
            'category_id' => $request->category_id,
            'topup_count' => $request->topup_count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if ($result) {
            return response()->json(['code' => 'true', 'msg' => "Package Created"]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
        }
    }

    public function recieveData($id)
    {

        $data =  DB::table('packages')->where('category_id', $id)->orderBy('id', 'asc')->get();

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
        $data = DB::table('packages')->find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'ads_count' => 'required|integer',
            'package_duration' => 'required|integer',
            'package_price' => 'required|numeric',
            'topup_ads' => 'required|integer',
            'image_count' => 'required|max:10',
        ]);

        if (isset($request->status)) {
            $status = 1;
        } else {
            $status = 0;
        }

        $result = DB::table('packages')->where('id', $request->package_hidden)->update([
            'package_name' => $request->name,
            'package_ad_count' => $request->ads_count,
            'package_duration' => $request->package_duration,
            'package_price' => $request->package_price,
            'status' => $status,
            'topup_count' => $request->topup_ads,
            'image_count' => $request->image_count,

        ]);

        if ($result) {
            return response()->json(['code' => 'true', 'msg' => "Package Updated"]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
        }
    }
}
