<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\Rule;
use Validator;
use Intervention\Image\Facades\Image;
use File;
use Illuminate\Console\View\Components\Alert;

class VendorDashboard extends Controller
{
     public function index()
     {
          $current_package_details = DB::table('assign_packages')->where('customer_id', session()->get('vendor_data')->id)
               ->join('packages', 'assign_packages.package_id', '=', 'packages.id')
               ->select('packages.*', 'assign_packages.*')
               ->first();

          $vendorData = session('vendor_data');
          $check_is_this_dealer = DB::table('dealer')->where('user_id', $vendorData->id)->first(); //check is this dealer

          $vendor_has_premium = DB::table('assign_packages') //check vendor has primium packages or not 
               ->where('customer_id', $vendorData->id)
               ->where('package_id', '!=', 5) // Exclude rows with package_id equal to 5
               ->exists();

          if ($check_is_this_dealer) { // check this user dealer or not
               $dealer = "true";
          } else {
               $dealer = "false";
          }

          $vendor_details = DB::table('users')->where('id', session('vendor_data')->id)->first();
          $district = DB::table('districts')->get(['name_en', 'id']);
          return view('Web.dashboard', compact('district', 'vendor_details', 'current_package_details', 'dealer', 'vendor_has_premium'));
     }

     public function updateDealer(Request $request)
     {
          if ($request->hidden_single_type === 'Company_Name') {
               $request->validate([
                    'single_value' => 'required|max:100'
               ]);
          } else if ($request->hidden_single_type === 'address') {
               $request->validate([
                    'single_value' => 'required|max:500'
               ]);
          } else if ($request->hidden_single_type === 'google_location') {
               $request->validate([
                    'single_value' => 'required|url'
               ]);
          } else if ($request->hidden_single_type === 'company_logo') {
               $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
               ]);
          }
          try {
               if ($request->hidden_single_type === 'Company_Name') {
                    $result = DB::table('dealer')->where('id', $request->hidden_id)->update(
                         ['Company_Name' => $request->single_value]
                    );
                    if ($result) {
                         return response()->json(['code' => 'true']);
                    } else {
                         return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
                    }
               } else if ($request->hidden_single_type === 'address') {
                    $result = DB::table('dealer')->where('id', $request->hidden_id)->update(
                         ['address' => $request->single_value]
                    );
                    if ($result) {
                         return response()->json(['code' => 'true']);
                    } else {
                         return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
                    }
               } else if ($request->hidden_single_type === 'google_location') {
                    $result = DB::table('dealer')->where('id', $request->hidden_id)->update(
                         ['google_location' => $request->single_value]
                    );
                    if ($result) {
                         return response()->json(['code' => 'true']);
                    } else {
                         return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
                    }
               } else if ($request->hidden_single_type === 'company_logo') {
                    $exist_image = DB::table('dealer')->where('id', $request->hidden_id)->pluck('company_logo')->first();

                    // delete current image 
                    $image_path = public_path('assets/myCustomThings/dealer/' . $exist_image);
                    if (File::exists($image_path)) {
                         File::delete($image_path);
                    }

                    // Store image and get its path, then save the path in the database
                    $image_1 = time() . rand(1, 1000) . '.' . $request->image->extension();
                    $image = Image::make($request->file('image'))->resize(484, 600); // Create an instance of the image
                    $image->save(public_path("assets/myCustomThings/dealer/{$image_1}"));

                    $result = DB::table('dealer')->where('id', $request->hidden_id)->update([
                         'company_logo' => $image_1
                    ]);

                    if ($result) {
                         return response()->json(['code' => 'true']);
                    } else {
                         return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
                    }
               }
          } catch (\Throwable $th) {
               return response()->json(['code' => 500, 'msg' => $th->getMessage()]);
          }
     }

     public function getCity(Request $request)
     {

          $data = DB::table('cities')->where('district_id', $request->value)->get('name_en');
          return $data;
     }

     public function createBasicForm(Request $request)
     {
          $vendor_data = session('vendor_data'); //need to get current vendor details because check unique values except current values
          $id = $vendor_data->id;

          $request->validate([
               'First_Name' => 'required|max:25',
               'Last_Name' => 'required|max:25',
               'phone' => 'required|max:25|digits:9',
               'district' => 'required',
               'city' => 'required',
               'Fb_link' => 'url|max:500|nullable',
               'Twitter_link' => 'max:500|url|nullable',
               'Linkedin_link' => 'max:500|url|nullable',
               'Youtube_link' => 'max:500|url|nullable',
               'Profile_Image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
          ]);

          $profile_image = time() . rand(1, 1000) . '.' . $request->Profile_Image->extension();
          // $request->Profile_Image->move(public_path("assets/myCustomThings/vehicleTypes"), $profile_image); //rename image and upload
          $imagePath = $request->Profile_Image->path();

          // Open the image using Intervention Image
          $image = Image::make($imagePath);

          // Resize the image to your desired dimensions
          $image->resize(300, 300); // Replace 300 with your desired width and height

          // Save the resized image
          $image->save(public_path("assets/myCustomThings/vehicleTypes/") . $profile_image);

          $result  = DB::table('users')->where('id', $id)->update([
               'First_Name' => $request->First_Name,
               'Last_Name' => $request->Last_Name,
               'phone' => $request->phone,
               'district' => $request->district,
               'city' => $request->city,
               'Fb_link' => $request->Fb_link,
               'Twitter_link' => $request->Twitter_link,
               'Linkedin_link' => $request->Linkedin_link,
               'Youtube_link' => $request->Youtube_link,
               'Profile_Image' => $profile_image,
          ]);

          if ($result) {
               $vendor_details = DB::table('users')->where('id', session('vendor_data')->id)->first();
               session()->put('vendor_data', $vendor_details); //update session with new data
               return response()->json(['code' => 'true', 'msg' => "Profile Updated"]);
          } else {
               return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
          }
     }

     public function logout()
     {

          Session::flush();
          Auth::logout();
          return redirect()->route('web.vendor.login');
     }

     public function becomeDealer()
     {
          $cities = DB::table('cities')->get('name_en');

          return view('Web.become_dealer', compact('cities'));
     }

     public function becomeDealerEdit()
     {
          $vendor_data = session('vendor_data'); //need to get current vendor details because check unique values except current values
          $dealerData = DB::table('dealer')->where('user_id', $vendor_data->id)->first(); //get dealer data
          return view('Web.editDealer', compact('dealerData'));
     }

     public function become_dealer_create(Request $request)
     {

          $vendorData = $request->session()->get('vendor_data');
          $request->validate([
               'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
               'Company_Name' => 'required|max:100',
               'address' => 'required|max:500',
               'google_location' => 'required|url',

          ]);
          try {

               // Store image and get its path, then save the path in the database
               $image_1 = time() . rand(1, 1000) . '.' . $request->company_logo->extension();
               $image = Image::make($request->file('company_logo'))->resize(484, 600); // Create an instance of the image
               $image->save(public_path("assets/myCustomThings/dealer/{$image_1}"));

               $result = DB::table('dealer')->insert([
                    'user_id' =>  $vendorData->id,
                    'company_logo' => $image_1,
                    'Company_Name' => $request->Company_Name,
                    'address' => $request->address,
                    'google_location' => $request->google_location,
                    'created_at' => Carbon::now(),
               ]);

               if ($result) {
                    return response()->json(['code' => 200, 'msg' => 'Become dealer success']);
               } else {
                    return response()->json(['code' => 400, 'msg' => 'Something went wrong']);
               }
          } catch (\Throwable $th) {
               return response()->json(['code' => 500, 'msg' => $th->getMessage()]);
          }
     }

     public function currentPackageDetails()
     {
          return redirect()->route('web.dashboardIndex')->with('display_current_package', 'display_current_package');
     }

     public function updateVendorData(Request $request)
     {
          if ($request->hidden_single_type === 'First Name') {
               $rules['single_value'] = 'required|max:25';
          } elseif ($request->hidden_single_type === 'Last Name') {
               $rules['single_value'] = 'required|max:25';
          } elseif ($request->hidden_single_type === 'Phone') {
               $rules['single_value'] = 'required|max:25|digits:9';
          } elseif ($request->hidden_single_type === 'Fb link') {
               $rules['single_value'] = 'url|max:500';
          } elseif ($request->hidden_single_type === 'Twitter link') {
               $rules['single_value'] = 'url|max:500';
          } elseif ($request->hidden_single_type === 'Linkedin link') {
               $rules['single_value'] = 'url|max:500';
          } elseif ($request->hidden_single_type === 'Youtube link') {
               $rules['single_value'] = 'url|max:500'; //validate depends on hidden value
          }

          $request->validate($rules);

          if ($request->hidden_single_type === 'First Name') { //update specific data

               $check = DB::table('users')->where('id', session('vendor_data')->id)->update([
                    'First_Name' => $request->single_value
               ]);
          } elseif ($request->hidden_single_type === 'Last Name') {
               $check = DB::table('users')->where('id', session('vendor_data')->id)->update([
                    'Last_Name' => $request->single_value
               ]);
          } elseif ($request->hidden_single_type === 'Phone') {
               $check = DB::table('users')->where('id', session('vendor_data')->id)->update([
                    'phone' => $request->single_value
               ]);
          } elseif ($request->hidden_single_type === 'Fb link') {
               $check = DB::table('users')->where('id', session('vendor_data')->id)->update([
                    'Fb_link' => $request->single_value
               ]);
          } elseif ($request->hidden_single_type === 'Twitter link') {
               $check = DB::table('users')->where('id', session('vendor_data')->id)->update([
                    'Twitter_link' => $request->single_value
               ]);
          } elseif ($request->hidden_single_type === 'Linkedin link') {
               $check = DB::table('users')->where('id', session('vendor_data')->id)->update([
                    'Linkedin_link' => $request->single_value
               ]);
          } elseif ($request->hidden_single_type === 'Youtube link') {
               $check = DB::table('users')->where('id', session('vendor_data')->id)->update([
                    'Youtube_link' => $request->single_value
               ]);
          }
          if ($check) {

               return response()->json(['code' => 'true']);
          } else {
               return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
          }
     }

     public function adsmanagement()
     {
          // return session('vendor_data')->id;
          $my_ads = DB::table('ads') //get vendor active ads
               ->where('ads_customers_id', session('vendor_data')->id)
               ->where('status', 1)
               ->where('adminStatus', null)
               ->leftJoin('ads_images', function ($join) {
                    $join->on('ads.id', '=', 'ads_images.ads_id')
                         ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
               })
               ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
               ->orderBy('ads.created_at', 'desc')
               ->select('ads_images.name', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.ad_expire_date', 'ads.top_ad_expire_date', 'ads.is_top_id')
               ->paginate(2, ['*'], 'my_ads');
          $myads_RecordsCount = $my_ads->total(); // Get the total count of all records that match the conditions (need paginate values to be differebt because one pagination affect to next pagination)

          $my_deactivate_ads = DB::table('ads') //get vendor active ads
               ->where('ads_customers_id', session('vendor_data')->id)
               ->where(function ($query) {
                    $query->where('adminStatus', 1)
                         ->orWhere('status', 0);
               })
               ->leftJoin('ads_images', function ($join) {
                    $join->on('ads.id', '=', 'ads_images.ads_id')
                         ->whereRaw('ads_images.id = (SELECT id FROM ads_images WHERE ads_id = ads.id LIMIT 1)');
               })
               ->join('vehicle_types', 'vehicle_types.id', '=', 'ads.vehicle_types_id')
               ->orderBy('ads.created_at', 'desc')
               ->select('ads_images.name', 'ads.ad_price', 'ads.ad_title', 'ads.id', 'vehicle_types.vt_name', 'ads.ad_district', 'ads.ad_city', 'ads.created_at', 'ads.ad_number', 'ads.ad_expire_date', 'ads.top_ad_expire_date', 'ads.is_top_id', 'ads.adminStatus')
               ->paginate(2, ['*'], 'my_deactivate_ads');
          $my_deactivate_ads_RecordsCount = $my_deactivate_ads->total(); // Get the total count of all records that match the conditions (need paginate values to be differebt because one pagination affect to next pagination)

          return view('Web.vendorAdsDisplay', compact(['my_ads', 'my_deactivate_ads', 'myads_RecordsCount', 'my_deactivate_ads_RecordsCount']));
     }

     public function adEdit($id)
     {
          $vendor_assigned_package = DB::table('assign_packages')->where('customer_id', session('vendor_data')->id)->pluck('package_id')->first();
          $image_count = DB::table('packages')->where('id', $vendor_assigned_package)->pluck('image_count')->first();

          $ad_edit = DB::table('ads')->find($id);
          $ad_images = DB::table('ads_images')->where('ads_id', $id)->get();

          $currentNumberOfImage = $ad_images->count();
          $available_images = $image_count - $currentNumberOfImage;
          // return $ad_images;

          return view('Web.ad_edit', compact('ad_edit', 'ad_images', 'id', 'available_images'));
     }

     public function adUpdate(Request $request)
     {

          if ($request->hidden_single_type === 'Title') {
               $rules['input'] = 'required|max:160';
          } elseif ($request->hidden_single_type === 'Price') {
               $rules['input'] = 'required|numeric';
          } elseif ($request->hidden_single_type === 'Description') {
               $rules['input'] = 'required';
          } elseif ($request->hidden_single_type === 'Condition') {
               $rules['input'] = 'required';
          }

          $request->validate($rules);

          try {
               if ($request->hidden_single_type === 'Title') { //update specific data
                    $check = DB::table('ads')->where('id', $request->id)->update([
                         'ad_title' => $request->input
                    ]);
               } elseif ($request->hidden_single_type === 'Price') {
                    $check = DB::table('ads')->where('id', $request->id)->update([
                         'ad_price' => $request->input
                    ]);
               } elseif ($request->hidden_single_type === 'Description') {
                    $check = DB::table('ads')->where('id', $request->id)->update([
                         'ad_description' => $request->input
                    ]);
               } elseif ($request->hidden_single_type === 'Condition') {
                    $check = DB::table('ads')->where('id', $request->id)->update([
                         'ads_condition' => $request->input
                    ]);
               }
               if ($check) {
                    return response()->json(['code' => 'true']);
               } else {
                    return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
               }
          } catch (\Throwable $th) {
               return response()->json(['code' => 'false', 'msg' => $th->getMessage()]);
          }
     }

     public function adDelete($id)
     {
          $check = DB::table('ads_images')->where('id', $id)->delete();
          if ($check) {
               return redirect()->back()->with('delete_success', 'Image succesfully deleted');
          } else {
               return redirect()->back()->with('delete_error', 'Something went wrong !!!');
          }
     }

     public function imageUpdate(Request $request)
     {

          $request->validate([
               'image_edit_update' => 'required|image',
          ]);

          $exist_image = DB::table('ads_images')->where('id', $request->id)->pluck('name')->first();
          $image_path = public_path('assets/myCustomThings/vehicleTypes/' . $exist_image);
          if (File::exists($image_path)) {
               File::delete($image_path);
          }

          try {
               // resize image start
               $image_1 = time() . rand(1, 1000) . '.' . $request->image_edit_update->extension();
               $image = Image::make($request->file('image_edit_update'))->resize(484, 600);

               // Reduce image size until it reaches approximately 100KB

               // Add the watermark text to the image
               $watermarkText = "AUTOBOX";
               $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(20); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(0); // Set the text rotation angle
               });
               // Save the image
               $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_1}"));
               // resize image end
               $result = DB::table('ads_images')->where('id', $request->id)->update([
                    'name' => $image_1,
               ]);
          } catch (Exception $e) {
               return $e;
          }
          if ($result) {
               return response()->json(['code' => 'true']);
          } else {
               return response()->json(['code' => 'false', 'msg' => "Something went wrong."]);
          }
     }

     public function addNewImage(Request $request)
     {

          if ($request->hasFile('image_1')) {
               $image_1 = time() . rand(1, 1000) . '.' . $request->file('image_1')->extension();
               return $image_1;
               $image = Image::make($request->file('image_1'))->resize(484, 600);
               // Reduce image size until it reaches approximately 100KB

               // Add the watermark text to the image
               $watermarkText = "AUTOBOX";
               $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(20); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(0); // Set the text rotation angle
               });

               // Save the image
               $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_1}"));
               $result = DB::table('ads_images')->insert([
                    'name' => $image_1,
                    'ads_id' => $request->ad_id
               ]);
          }

          if ($request->hasFile('image_2')) {
               $image_2 = time() . rand(1, 1000) . '.' . $request->file('image_2')->extension();
               return $image_2;
               $image = Image::make($request->file('image_2'))->resize(484, 600);

               // Reduce image size until it reaches approximately 100KB

               // Add the watermark text to the image
               $watermarkText = "AUTOBOX";
               $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(20); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(0); // Set the text rotation angle
               });

               // Save the image
               $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_2}"));
               $result = DB::table('ads_images')->insert([
                    'name' => $image_2,
                    'ads_id' => $request->ad_id
               ]);
          }


          if ($request->hasFile('image_3')) {
               $image_3 = time() . rand(1, 1000) . '.' . $request->file('image_3')->extension();
               return $image_3;
               $image = Image::make($request->file('image_3'))->resize(484, 600);

               // Reduce image size until it reaches approximately 100KB

               // Add the watermark text to the image
               $watermarkText = "AUTOBOX";
               $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(20); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(0); // Set the text rotation angle
               });

               // Save the image
               $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_3}"));
               $result = DB::table('ads_images')->insert([
                    'name' => $image_3,
                    'ads_id' => $request->ad_id
               ]);
          }

          if ($request->hasFile('image_4')) {
               $image_4 = time() . rand(1, 1000) . '.' . $request->file('image_4')->extension();
               return $image_4;
               $image = Image::make($request->file('image_4'))->resize(484, 600);

               // Reduce image size until it reaches approximately 100KB

               // Add the watermark text to the image
               $watermarkText = "AUTOBOX";
               $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(20); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(0); // Set the text rotation angle
               });

               // Save the image
               $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_4}"));
               $result = DB::table('ads_images')->insert([
                    'name' => $image_4,
                    'ads_id' => $request->ad_id
               ]);
          }

          if ($request->hasFile('image_5')) {
               $image_5 = time() . rand(1, 1000) . '.' . $request->file('image_5')->extension();
               return $image_5;
               $image = Image::make($request->file('image_5'))->resize(484, 600);

               // Reduce image size until it reaches approximately 100KB

               // Add the watermark text to the image
               $watermarkText = "AUTOBOX";
               $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(20); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(0); // Set the text rotation angle
               });

               // Save the image
               $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_5}"));
               $result = DB::table('ads_images')->insert([
                    'name' => $image_5,
                    'ads_id' => $request->ad_id
               ]);
          }

          if ($request->hasFile('image_6')) {
               $image_6 = time() . rand(1, 1000) . '.' . $request->file('image_6')->extension();
               return $image_6;
               $image = Image::make($request->file('image_6'))->resize(484, 600);

               // Reduce image size until it reaches approximately 100KB

               // Add the watermark text to the image
               $watermarkText = "AUTOBOX";
               $image->text($watermarkText, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('fonts/FiraSans-Black.ttf')); // Replace with the actual path to your font file
                    $font->size(20); // Set the font size
                    $font->color(['255', '255', '255']); // Set the font color
                    $font->align('center'); // Set the text alignment
                    $font->valign('middle'); // Set the text vertical alignment
                    $font->angle(0); // Set the text rotation angle
               });

               // Save the image
               $image->save(public_path("assets/myCustomThings/vehicleTypes/{$image_6}"));
               $result = DB::table('ads_images')->insert([
                    'name' => $image_6,
                    'ads_id' => $request->ad_id
               ]);
          }
     }

     public function deleteVendorAd($id)
     {
          $check = DB::table('ads')->where('id', $id)->delete();
          if ($check) {
               return redirect()->back()->with('delete_success', 'Ad succesfully deleted');
          } else {
               return redirect()->back()->with('delete_error', 'Something went wrong !!!');
          }
     }
}
