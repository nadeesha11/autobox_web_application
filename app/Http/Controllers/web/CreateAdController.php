<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class CreateAdController extends Controller
{
    public function index()
    {
        $vendor_id = session('vendor_data')->id; //need to get current vendor details because check unique values except current values
        $package_id = DB::table('assign_packages')->where('customer_id', $vendor_id)->pluck('package_id')->first();
        $package_max_image =  DB::table('packages')->where('id', $package_id)->pluck('image_count')->first();

        $district = DB::table('districts')->pluck('name_en', 'id');
        $vehicle_types = DB::table('vehicle_types')->where('vt_status', 1)->pluck('vt_name', 'id');
        return view('Web.create_ads', compact('district', 'vehicle_types', 'package_max_image'));
    }

    public function getBrands(Request $request)
    {
        $data = DB::table('brand')->where('vt_id', $request->value)->where('status', 1)->get();
        return $data;
    }

    public function getModels(Request $request)
    {
        $data = DB::table('model')->where('brand_id', $request->value)->where('status', 1)->get();
        return $data;
    }

    public function createSession(Request $request)
    {
        $vendor_current_location = [
            'city' => $request->city,
            'district' => $request->district,
        ];
        session(['vendor_current_location' => $vendor_current_location]);

        if (session()->has('vendor_current_location')) {
            // Session has been created
            return redirect()->back()->with('1', 'Location updated');
        } else {
            // Session has not been created
            return redirect()->back()->with('o', 'Something went wrong');
        }
    }

    public function create_ad(Request $request)
    {
        $request->validate([
            'title' => 'required|max:60',
            'price' => 'required|numeric',
            'vehicle_type' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'condition' => 'required',
            'part_accessory_type_id' => 'required',
            'image_1' => 'required',
            'additional_information' => 'required',
            'city_name' => 'required',
            'district_name' => 'required',
        ]);

        $check_ad_count = DB::table('assign_packages')->where('customer_id', session('vendor_data')->id)->pluck('available_ad_count')->first(); //if there is a 0 ads its redirect error message (check current package has ads)
        if ($check_ad_count === 0) {
            // needs to show error message
            return response()->json(['code' => 'false', 'msg' => "Your package has 0 ads"]);
        }

        if (isset($request->topad)) {
            $check_top_ad_count = DB::table('assign_packages')->where('customer_id', session('vendor_data')->id)->pluck('available_top_count')->first(); //if there is a 0 ads its redirect error message (check current package has **** top ads)
            if ($check_top_ad_count === 0) {
                // needs to show error message
                return response()->json(['code' => 'false', 'msg' => "Your package has 0 topads"]);
            }
        }

        try {
            $ads_id = DB::table('ads')->insertGetId([
                'ad_number' => str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT),
                'ad_title' => $request->title,
                'ad_district' => $request->district_name,
                'ad_city' => $request->city_name,
                'ad_description' => $request->additional_information,
                'ad_price' => $request->price,
                'ad_view_count' => 10, //need to change
                'ad_expire_date' => Carbon::now()->addDays(30), //sometimes this duration will change
                'status' => 1,
                'vehicle_types_id' => $request->vehicle_type,
                'brands_id' => $request->brand_id,
                'models_id' => $request->model_id,
                'ads_condition' => $request->condition,
                'ads_parts_accessory_type' => $request->part_accessory_type_id,
                'ads_customers_id' => session('vendor_data')->id,
                'is_top_id' => $istopad = isset($check_top_ad_count)  ? 1 : 0, // check top ad or not
                'top_ad_expire_date' => $top_ad_expire_date = isset($check_top_ad_count)  ? Carbon::now()->addDays(1) : null, // check top ad or not
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if ($ads_id) {

                $data_insert = []; // Create an empty

                $image_1 = time() . rand(1, 1000) . '.' . $request->image_1->extension();
                $image = Image::make($request->file('image_1'))->resize(484, 600); // Create an instance of the image
                $quality = 100; // Initial quality setting

                // Reduce image size until it reaches approximately 100KB


                $watermarkText = "AUTOBOX";
                $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(20); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(0); // Set the text rotation angle


                });
                $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_1}"));


                // Add watermark to the image

                $data_insert[] = $image_1;

                if ($request->image_2) {
                    // $image_2 = time() . rand(1, 1000) . '.' . $request->image_2->extension();
                    // $request->image_2->move(public_path("assets/myCustomThings/vehicleTypes"), $image_2); //rename image and upload
                    // $data_insert[] = $image_2;

                    $image_2 = time() . rand(1, 1000) . '.' . $request->image_2->extension();
                    $image = Image::make($request->file('image_2'))->resize(484, 600); // Create an instance of the image

                    $quality = 100; // Initial quality setting



                    $watermarkText = "AUTOBOX";
                    $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                        $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                        $font->size(20); // Set the font size
                        $font->color(['255', '255', '255']); // Set the font color
                        $font->align('center'); // Set the text alignment
                        $font->valign('middle'); // Set the text vertical alignment
                        $font->angle(0); // Set the text rotation angle

                    });

                    $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_2}"), $quality);

                    $data_insert[] = $image_2;
                }

                if ($request->image_3) {
                    // $image_3 = time() . rand(1, 1000) . '.' . $request->image_3->extension();
                    // $request->image_3->move(public_path("assets/myCustomThings/vehicleTypes"), $image_3); //rename image and upload
                    // $data_insert[] = $image_3;

                    $image_3 = time() . rand(1, 1000) . '.' . $request->image_3->extension();
                    $image = Image::make($request->file('image_3'))->resize(484, 600); // Create an instance of the image

                    $quality = 100; // Initial quality setting

                    $watermarkText = "AUTOBOX";
                    $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                        $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                        $font->size(20); // Set the font size
                        $font->color(['255', '255', '255']); // Set the font color
                        $font->align('center'); // Set the text alignment
                        $font->valign('middle'); // Set the text vertical alignment
                        $font->angle(0); // Set the text rotation angle

                    });

                    $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_3}"), $quality);

                    $data_insert[] = $image_3;
                }
                if ($request->image_4) {
                    // $image_4 = time() . rand(1, 1000) . '.' . $request->image_4->extension();
                    // $request->image_4->move(public_path("assets/myCustomThings/vehicleTypes"), $image_4); //rename image and upload
                    // $data_insert[] = $image_4;

                    $image_4 = time() . rand(1, 1000) . '.' . $request->image_4->extension();
                    $image = Image::make($request->file('image_4'))->resize(484, 600); // Create an instance of the image

                    $quality = 100; // Initial quality setting

                    $watermarkText = "AUTOBOX";
                    $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                        $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                        $font->size(20); // Set the font size
                        $font->color(['255', '255', '255']); // Set the font color
                        $font->align('center'); // Set the text alignment
                        $font->valign('middle'); // Set the text vertical alignment
                        $font->angle(0); // Set the text rotation angle

                    });

                    $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_4}"), $quality);


                    $data_insert[] = $image_4;
                }
                if ($request->image_5) {

                    $image_5 = time() . rand(1, 1000) . '.' . $request->image_5->extension();
                    $image = Image::make($request->file('image_5'))->resize(484, 600); // Create an instance of the image
                    $quality = 100; // Initial quality setting

                    // Reduce image size until it reaches approximately 100KB

                    $watermarkText = "AUTOBOX";
                    $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                        $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                        $font->size(20); // Set the font size
                        $font->color(['255', '255', '255']); // Set the font color
                        $font->align('center'); // Set the text alignment
                        $font->valign('middle'); // Set the text vertical alignment
                        $font->angle(0); // Set the text rotation angle

                    });

                    $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_5}"), $quality);

                    $data_insert[] = $image_5;
                }
                if ($request->image_6) {

                    $image_6 = time() . rand(1, 1000) . '.' . $request->image_6->extension();
                    $image = Image::make($request->file('image_6'))->resize(484, 600); // Create an instance of the image
                    $quality = 100; // Initial quality setting

                    // Reduce image size until it reaches approximately 100KB
                    $watermarkText = "AUTOBOX";
                    $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                        $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                        $font->size(20); // Set the font size
                        $font->color(['255', '255', '255']); // Set the font color
                        $font->align('center'); // Set the text alignment
                        $font->valign('middle'); // Set the text vertical alignment
                        $font->angle(0); // Set the text rotation angle

                    });

                    $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_6}"), $quality);

                    $data_insert[] = $image_6;
                }

                foreach ($data_insert as $item) {
                    $success =   DB::table('ads_images')->insert([
                        'name' => $item,
                        'ads_id' => $ads_id
                        // Add other columns and their respective values here
                    ]);
                }

                if ($success) {
                    // remove ad count from user 
                    DB::table('assign_packages')
                        ->where('customer_id', session('vendor_data')->id)
                        ->decrement('available_ad_count', 1);


                    if (isset($request->topad)) {
                        DB::table('assign_packages')
                            ->where('customer_id', session('vendor_data')->id)
                            ->decrement('available_top_count', 1);
                    }
                    return response()->json(['code' => 'true', 'msg' => "suceess"]);
                } else {
                    return response()->json(['code' => 'false', 'msg' => "Something went wrong"]);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function display_success_ad()
    {
        return view('Web.ads_appreved');
    }
}
