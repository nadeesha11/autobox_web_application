<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class garageController extends Controller
{
    public function index()
    {
        $data =  DB::table('cities')->get('name_en');
        return view('Web.garageManagement', compact('data'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'city' => 'required',
            'number' => 'required|digits:9',
            'url' => 'required|url',
            'address' => 'required|max:1000',
            'desc' => 'required|max:1000',
            'image' => 'required',
        ]);

        try {

            $image_1 = '';
            if ($request->image) {

                $image_1 = time() . rand(1, 1000) . '.' . $request->image->extension();
                $image = Image::make($request->file('image'))->resize(484, 600); // Create an instance of the image

                $watermarkText = "AUTOBOX";
                $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(20); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(0); // Set the text rotation angle

                });
                $image->save(public_path("assets/myCustomThings/Garage/{$image_1}"));
            }

            $result = DB::table('garage')->insert([
                'name' => $request->name,
                'city' => $request->city,
                'number' =>  $request->number,
                'url' => $request->url,
                'address' => $request->address,
                'desc' => $request->desc,
                'image' => $image_1,
                'status' => 0

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

        $data =  DB::table('garage')->orderBy('id', 'asc')->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a style="color:white !important;  background-color:#4ca6ba !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="more btn btn-success btn-sm m-1"><i class="bi bi-x-lg"></i>More</a>';
                $btn = $btn . '<a style="color:white !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="edit btn btn-success btn-sm m-1">Edit</a>';
                $btn = $btn . '<a style="color:white !important; background-color:red !important;" href="javascript:void(0)" data-id="' . $data->id . '" class="delete btn btn-danger btn-sm m-1"><i class="bi bi-x-lg"></i>Delete</a>';
                return $btn;
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $status = '<span style="color:black !important;" class="badge badge-pill badge-soft-success">Approved</span>';
                } else {
                    $status = ' <span style="color:black !important;" class="badge badge-pill badge-soft-danger">Pending</span>';
                }
                return $status;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function delete($id)
    {
        //delete current image start
        $image_to_be_deleted = DB::table('garage')->where('id', $id)->pluck('image')->first();

        $image_path = public_path('assets/myCustomThings/Garage/' . $image_to_be_deleted);
        if (File::exists($image_path)) {
            File::delete($image_path);
            //1690282460161.jpg  1690282462445.jpg  1690282463557.jpg
        }

        $result = DB::table('garage')->where('id', $id)->delete();
        if ($result) {
            return response()->json(['code' => 'success', 'msg' => 'garage deleted succesfully']);
        } else {
            return response()->json(['code' => 'error', 'msg' => 'something went wrong']);
        }
    }

    public function more($id)
    {
        $data = DB::table('garage')->find($id);
        return $data;
    }

    public function nextPage($id)
    {
        $cities =  DB::table('cities')->get('name_en');
        $data = DB::table('garage')->find($id);
        return view('Web.garageEdit', compact("data", "cities"));
    }

    public function update(Request $request)
    {

        if ($request->hidden_single_type === 'Name') {
            $rules['input'] = 'required|max:100';
        } elseif ($request->hidden_single_type === 'url') {
            $rules['input'] = 'required|url';
        } else if ($request->hidden_single_type === 'Address') {
            $rules['input'] = 'required|max:1000';
        } else if ($request->hidden_single_type === 'Description') {
            $rules['input'] = 'required|max:1000';
        } else if ($request->hidden_single_type === 'City') {
            $rules['input'] = 'required';
        } else if ($request->hidden_single_type === 'Number') {
            $rules['input'] = 'required|digits:9';
        } else if ($request->hidden_single_type === 'Image') {
            $rules['input'] = 'required';
        }

        $request->validate($rules);

        if ($request->hidden_single_type === 'Name') {
            $check = DB::table('garage')->where('id', $request->id)->update([
                'name' => $request->input
            ]);
        } elseif ($request->hidden_single_type === 'url') {
            $check = DB::table('garage')->where('id', $request->id)->update([
                'url' => $request->input
            ]);
        } elseif ($request->hidden_single_type === 'Address') {
            $check = DB::table('garage')->where('id', $request->id)->update([
                'address' => $request->input
            ]);
        } elseif ($request->hidden_single_type === 'Description') {
            $check = DB::table('garage')->where('id', $request->id)->update([
                'desc' => $request->input
            ]);
        } elseif ($request->hidden_single_type === 'City') {
            $check = DB::table('garage')->where('id', $request->id)->update([
                'city' => $request->input
            ]);
        } elseif ($request->hidden_single_type === 'Number') {
            $check = DB::table('garage')->where('id', $request->id)->update([
                'number' => $request->input
            ]);
        } elseif ($request->hidden_single_type === 'Image') {

            //delete current image start
            $image_to_be_deleted = DB::table('garage')->where('id', $request->id)->pluck('image')->first();

            $image_path = public_path('assets/myCustomThings/Garage/' . $image_to_be_deleted);
            if (File::exists($image_path)) {
                File::delete($image_path);
                //1690282460161.jpg  1690282462445.jpg  1690282463557.jpg
            }
            //rename image
            $image_1 = time() . rand(1, 1000) . '.' . $request->input->extension();
            $image = Image::make($request->file('input'))->resize(484, 600); // Create an instance of the image

            $watermarkText = "AUTOBOX";
            $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                $font->size(20); // Set the font size
                $font->color(['255', '255', '255']); // Set the font color
                $font->align('center'); // Set the text alignment
                $font->valign('middle'); // Set the text vertical alignment
                $font->angle(0); // Set the text rotation angle

            });
            $image->save(public_path("assets/myCustomThings/Garage/{$image_1}"));

            //reaname image

            $check = DB::table('garage')->where('id', $request->id)->update([
                'image' => $image_1
            ]);
        }

        if ($check) {
            return response()->json(['code' => 'true', 'msg' => "Garage details edited."]);
        } else {
            return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
        }
    }

    public function displayAllGarages()
    {
        $data =  DB::table('garage')->where('status', 1)->paginate(4);
        $totalCount = $data->total();
        return view('Web.garage', compact('data', 'totalCount'));
    }
}
