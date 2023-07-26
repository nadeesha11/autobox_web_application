<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class addCategoryController extends Controller
{
    public function index()
    {
        return view('Admin.addCategory');
    }

    public function getData()
    {
        $data =  DB::table('ad_category')->orderBy('id', 'asc')->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit btn btn-success btn-sm m-1"><i class="bi bi-x-lg"></i>Edit</a>';
                $btn = $btn . '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="add_packages btn btn-warning btn-sm m-1"><i class="bi bi-x-lg"></i> Packages</a>';
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
        $data = DB::table('ad_category')->find($id);
        return $data;
    }

    public function update(Request $request)
    {
        $request->validate([
            'Category_name' => 'required|max:20',


        ]);

        if (isset($request->status)) { //check status active or not
            $status = 1;
        } else {
            $status = 0;
        }

        $result = DB::table('ad_category')->where('id', $request->id)->update([
            'package_category_name' => $request->Category_name,

            'status' => $status,

        ]);

        if ($result) {
            return response()->json(['code' => 'true', 'msg' => "Ad Category Updated."]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
        }
    }
}
