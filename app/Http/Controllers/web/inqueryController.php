<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Illuminate\Support\Facades\DB;

class inqueryController extends Controller
{
    public function index()
    {

        return view('Web.ads_inquery');
    }

    public function create(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg',
            'title' => 'required|max:200',
            'phone' => 'required|digits:9',
            'additional_information' => 'required|max:3000',
        ]);

        try {
            $image_1 = '';
            if ($request->image) {

                $image_1 = time() . rand(1, 1000) . '.' . $request->image->extension();
                $image = Image::make($request->file('image'))->resize(460, 400); // Create an instance of the image

                $watermarkText = "AUTOBOX";
                $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(20); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(0); // Set the text rotation angle

                });
                $image->save(public_path("assets/myCustomThings/Inquery/{$image_1}"));
            }

            $result = DB::table('ads_inquery')->insert([
                'image' => $image_1,
                'title' => $request->title,
                'phone' =>  $request->phone,
                'additional_information' => $request->additional_information,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

            if ($result) {
                return response()->json(['code' => 200, 'msg' => 'ad inquery added succesfully']);
            } else {
                return response()->json(['code' => 400, 'msg' => 'something went wrong']);
            }
        } catch (Exception $e) {
            // Exception occurred, handle it here
            return response()->json(['code' => 500, 'msg' => $e->getMessage()]);
        }
    }

    public function display()
    {  // function to display inquery ads on the blade
        $inquery_ads = DB::table('ads_inquery')->paginate(2);
        $inquery_ads_count = DB::table('ads_inquery')->count();

        return view('Web.inqueryAds', compact('inquery_ads', 'inquery_ads_count'));
    }
}
