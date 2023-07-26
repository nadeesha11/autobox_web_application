<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class modelsController extends Controller
{
  public function index($id)
  {
    return view('Admin.modelsIndex', compact('id'));
  }

  public function create(Request $request)
  {
    $request->validate([
      'model_name' => "required|max:100",
    ]);

    $result = DB::table('model')->insert([
      'model_name' => $request->model_name,
      'updated_at' => Carbon::now(),
      'created_at' => Carbon::now(),
      'status' => 1,
      'brand_id' => $request->id,
    ]);

    if ($result) {
      return response()->json(['code' => 'true', 'msg' => "Record Created"]);
    } else {
      return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
    }
  }

  public function getData($id)
  {
    $data =  DB::table('model')->where('brand_id', $id)->orderBy('id', 'asc')->get();
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
    $data = DB::table('model')->find($id);
    return $data;
  }

  public function update(Request $request)
  {

    $request->validate([
      'name' => "required|max:100",
    ]);

    if (isset($request->ModelEdit)) {
      $status = 1;
    } else {
      $status = 0;
    }

    //  update data 
    $result = DB::table('model')->where('id', $request->model_hidden)->update([
      'model_name' => $request->name,
      'updated_at' => Carbon::now(),
      'status' => $status,
    ]);

    if ($result) {
      return response()->json(['code' => 'true', 'msg' => "Record edited"]);
    } else {
      return response()->json(['code' => 'false', 'msg' => "Something went wrong !!!"]);
    }
  }
}
