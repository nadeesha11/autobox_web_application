<?php

use App\Http\Controllers\admin\addCategoryController;
use App\Http\Controllers\admin\adminManagement;
use App\Http\Controllers\admin\BrandsController;
use App\Http\Controllers\admin\dashBoardController;
use App\Http\Controllers\admin\modelsController;
use App\Http\Controllers\admin\packagesController;
use App\Http\Controllers\admin\topAdManagementController;
use App\Http\Controllers\admin\VehicleTypesController;
use App\Http\Controllers\admin\viewUsersController;
use App\Http\Controllers\web\ActivatePackagesController;
use App\Http\Controllers\web\adsManagementController;
use App\Http\Controllers\web\allAdsController;
use App\Http\Controllers\web\CreateAdController;
use App\Http\Controllers\web\garageController;
use App\Http\Controllers\web\homeController;
use App\Http\Controllers\web\topAdsManagementController;
use App\Http\Controllers\web\vendorManagement;
use App\Http\Controllers\web\VendorDashboard;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// web routes start 

// dashboard start 
Route::get('/Web/dashBoard', [VendorDashboard::class, 'index'])->name('web.dashboardIndex'); // web dashboard


Route::post('/Web/dashBoard/getCity', [VendorDashboard::class, 'getCity'])->name('web.dashboard.getCity'); // web get city
Route::post('/Web/dashBoard/basicFormDetailsCreate', [VendorDashboard::class, 'createBasicForm'])->name('web.dashboard.basicFormDetailsCreate'); // dashboard basicFormDetailsCreate
Route::get('/Web/dashBoard/logout', [VendorDashboard::class, 'logout'])->name('web.vendor.logout'); // web logout
Route::get('/Web/dashBoard/becomeDealer', [VendorDashboard::class, 'becomeDealer'])->name('web.dashboard.becomeDealer'); // web dashboard
Route::post('/Web/dashBoard/becomeDealer/Create', [VendorDashboard::class, 'become_dealer_create'])->name('web.dashboard.become_dealer'); // dashboard dealer create
Route::post('/Web/dashBoard/updateVendorData', [VendorDashboard::class, 'updateVendorData'])->name('web.vendorData.update'); // web vendor dashboard update
Route::get('/Web/dashBoard/adsmanagement', [VendorDashboard::class, 'adsmanagement'])->name('vendor.dashboard.adsmanagement'); // web dashboard ads management
Route::get('/Web/dashBoard/adsmanagement/edit{id}', [VendorDashboard::class, 'adEdit'])->name('web.dashboard.ad.edit'); // web dashboard ads edit
Route::post('/Web/dashBoard/adsmanagement/update', [VendorDashboard::class, 'adUpdate'])->name('web.dashboard.ad.update'); // ad update
Route::get('/Web/dashBoard/adsmanagement/delete{id}', [VendorDashboard::class, 'adDelete'])->name('web.dashboard.ad.delete'); // web ad delete
Route::post('/Web/dashBoard/adsmanagement/imageUpdate', [VendorDashboard::class, 'imageUpdate'])->name('web.dashboard.ad.imageEdit'); // ad image update
Route::post('/Web/dashBoard/adsmanagement/addNewImage', [VendorDashboard::class, 'addNewImage'])->name('web.dashboard.ad.addNewImage'); // ad new images

// garage routes for vendor 
Route::get('/Web/dashBoard/garage', [garageController::class, 'index'])->name('web.dashboard.index'); // web garage display
Route::post('/Web/dashBoard/garage/create', [garageController::class, 'create'])->name('web.garage.create'); // web garage create
Route::get('/Web/dashBoard/garage/recieveData', [garageController::class, 'recieveData'])->name('web.garage.recieveData'); // web garage recieveData
Route::get('web/garage/{id}/delete', [garageController::class, 'delete'])->name('web.garage.delete'); // web garage delete
Route::get('web/garage/{id}/more', [garageController::class, 'more'])->name('web.garage.more'); // web garage more
Route::get('web/dashboard/garage/editPage/{id}', [garageController::class, 'nextPage'])->name('web.garage.nextPage'); // web garage edit for new page


Route::get('/Web/AllAds', [allAdsController::class, 'view'])->name('web.allads.view'); // web all ads display view
Route::get('AllAds/Type{id}', [allAdsController::class, 'viewType'])->name('web.allads.vehicleType'); //view vehicletype
Route::get('AllAds/Brand/{id}/{brandId}', [allAdsController::class, 'viewBrand'])->name('web.allads.vehicleBrand'); // view vehicelbrand
Route::get('AllAds/Brand/{id}/{brandId}/{modelId}', [allAdsController::class, 'viewModel'])->name('web.allads.vehicleModel'); // view vehicleModel


Route::post('Web/Vendor/Login', [vendorManagement::class, 'login'])->name('web.login'); // web vendor login
Route::get('/Vendor/Login', [vendorManagement::class, 'index'])->name('web.vendor.login'); // web vendor login index
Route::get('/Vendor/Register', [vendorManagement::class, 'registerIndex'])->name('web.vendor.register'); // web vendor register
Route::post('/Vendor/Create', [vendorManagement::class, 'create'])->name('web.vendor.create'); // web vendor create

Route::get('Web/Vendor/ads', [adsManagementController::class, 'index'])->name('web.dashboard.adsPackages'); // web vendor ads packages index
Route::get('Web/Vendor/topAds', [topAdsManagementController::class, 'index'])->name('web.dashboard.topAdsPackages'); // web vendor Top ads packages index

Route::get('Web/Vendor/ActivatePackage/{id}', [ActivatePackagesController::class, 'index'])->name('web.dashboard.activatePackage'); // web package activate
Route::get('Web/Vendor/CurrentPackage', [VendorDashboard::class, 'currentPackageDetails'])->name('web.dahsboard.currentPackage'); // web package activate details

Route::get('Web/Vendor/CreateAd', [CreateAdController::class, 'index'])->name('web.dashboard.create_ad'); // vendor create ad
Route::post('/Web/dashBoard/getBrands', [CreateAdController::class, 'getBrands'])->name('web.dashboard.vehicle_type'); // web get brands
Route::post('/Web/dashBoard/getModels', [CreateAdController::class, 'getModels'])->name('web.dashboard.vehicle_model'); // web get model
Route::post('/Web/dashBoard/createSession', [CreateAdController::class, 'createSession'])->name('web.dashboard.change_location.createSession'); // web get model
Route::post('/Web/dashBoard/createad', [CreateAdController::class, 'create_ad'])->name('web.vendor_dashboard.create_ad'); // web create ad
Route::get('/Web/dashBoard/Ad/Success', [CreateAdController::class, 'display_success_ad'])->name('web.dash.ad.created'); // add created
// dashboard end 

Route::get('/', [homeController::class, 'index'])->name('web.home'); // web home
Route::get('/Detailed{id}', [homeController::class, 'detailed'])->name('web.detailed_ad'); // web ad detailed


Route::get("/PrivacyPolicy", function () { //return services
  return "PrivacyPolicy";
});
Route::get("/TermsOfService", function () { //return services
  return "TermsOfService";
});
Route::get("/UserDataDeletion", function () { //return services
  return "UserDataDeletion";
});

Route::post('/Web/AdvancedFilterd', [homeController::class, 'advancedFilter'])->name('web.filterd_ads.advanced'); // web advanced filter

Route::get('Web/Brand/{id}/Get', [homeController::class, 'getBrands'])->name('web.filter.getBrands'); //get brands
Route::get('Web/Models/{id}/Get', [homeController::class, 'getModels'])->name('web.filter.getModels'); //get models
Route::post('/Web/Filterd', [homeController::class, 'mainFilterd'])->name('web.main.filter'); // web main filter
Route::get('/filtered-ads', [homeController::class, 'showFilteredAds'])->name('show.filtered.ads'); // web main filter data display

Route::get('/advanced-filtered-ads', [homeController::class, 'showAdvancedFilter'])->name('show.advanced.filtered.ads'); // web advanced filter data display
Route::get('/remove-filters', [homeController::class, 'removeFilter'])->name('web.main.removefilter'); // web remove filter

// facebook login start 
Route::get('/facebook/login', [vendorManagement::class, 'provider'])->name('login.facebook'); // facebook login
Route::get('/facebook/callback', [vendorManagement::class, 'handleCallback'])->name('facebook.callback'); // facebook redirect
// facebook login end 

// google login start 
Route::get('/google/login', [vendorManagement::class, 'providerFacebook'])->name('login.google'); // google login
Route::get('/google/callback', [vendorManagement::class, 'handleCallbackFacebook'])->name('google.callback'); // facebook redirect
// google login end 

// web routes end 

// admin panel routes start 
Route::get('/admin/index', [adminManagement::class, 'login'])->name('admin.login'); // admin login
Route::post('/admin/login', [adminManagement::class, 'create'])->name('admin.admin.login'); // admin login
Route::get('/admin/logout', [adminManagement::class, 'logout'])->name('admin.logout'); // admin logout
Route::get('/admin/forgetPassword', [adminManagement::class, 'forgetPassword'])->name('admin.forgetPassword'); // admin forgetPassword
Route::post('/admin/forgetPassword/sendMail', [adminManagement::class, 'forgetPasswordMail'])->name('admin.forgetPassword.mail'); // admin forgetPassword mail
Route::post('/admin/resetPassword', [adminManagement::class, 'resetPassword'])->name('admin.resetPassword'); // admin reset password
Route::get('/forgetPasswordToken{token}', [adminManagement::class, 'showResetForm'])->name("forget_password_link.email"); //token 
// admin panel protected routes
Route::group(['middleware' => ['adminCheck']], function () {
  Route::get('/admin/dashboard/index', [dashBoardController::class, 'index'])->name('admin.dashboard'); // admin dashboard

  Route::get('/admin/users', [viewUsersController::class, 'index'])->name('admin.users.view'); // admin users view
  Route::get('/admin/users/getData', [viewUsersController::class, 'getData'])->name('admin.users.recieveData'); // admin users getData
  Route::get('/admin/users/more/{id}', [viewUsersController::class, 'more'])->name('admin.users.more'); // admin users getData
  Route::get('/admin/users/more/delete/{id}', [viewUsersController::class, 'delete'])->name('admin.users.more.deleteAd'); // admin users delete
  Route::get('/admin/users/more/changeStatus/{id}', [viewUsersController::class, 'changeStatus'])->name('admin.users.more.changeStatus'); // admin users change

  Route::get('/admin/vehicleTypes/index', [VehicleTypesController::class, 'index'])->name('admin.vehicleTypes.view'); // admin vehicleTypes view
  Route::post('/admin/vehicleTypes/create', [VehicleTypesController::class, 'create'])->name('admin.vehicleType.create'); // admin vehicleTypes create
  Route::get('/admin/vehicleTypes/getData', [VehicleTypesController::class, 'getData'])->name('admin.vehicleTypes.recieveData'); // admin vehicleTypes Recive data
  Route::get('/admin/vehicleTypes/{id}/edit', [VehicleTypesController::class, 'edit'])->name('admin.vehicleTypes.edit'); // admin vehicleTypes edit
  Route::post('/admin/vehicleTypes/update', [VehicleTypesController::class, 'update'])->name('admin.vehicleTypes.update'); // admin vehicleTypes update
  Route::get('/admin/vehicleTypes/nextPage/{id}', [BrandsController::class, 'index'])->name('admin.BrandsController.index'); // admin vehicleTypes edit

  Route::post('/admin/brand/create', [BrandsController::class, 'create'])->name('admin.brands.create'); // admin brands create
  Route::get('/admin/Brand/getData{id}', [BrandsController::class, 'getData'])->name('admin.brands.recieveData'); // admin Brands Recive data
  Route::get('/admin/Brand/{id}/edit', [BrandsController::class, 'edit'])->name('admin.brands.edit'); // admin brand edit
  Route::post('/admin/Brand/update', [BrandsController::class, 'update'])->name('admin.brand.update'); // admin brand update
  Route::get('/admin/Brand/nextPage/{id}', [modelsController::class, 'index'])->name('admin.Models.index'); // admin model index

  Route::post('/admin/model/create', [modelsController::class, 'create'])->name('admin.model.create'); // admin model create
  Route::get('/admin/model/getData{id}', [modelsController::class, 'getData'])->name('admin.models.recieveData'); // admin Models Recive data
  Route::get('/admin/Model/{id}/edit', [modelsController::class, 'edit'])->name('admin.models.edit'); // admin models edit
  Route::post('/admin/Model/update', [modelsController::class, 'update'])->name('admin.model.update'); // admin model update

  Route::get('/admin/addCategory/view', [addCategoryController::class, 'index'])->name('admin.addCategory.view'); // admin display category
  Route::get('/admin/addCategory/getData', [addCategoryController::class, 'getData'])->name('admin.ads_category.recieveData'); // admin table data category
  Route::get('/admin/addCategory/{id}/edit', [addCategoryController::class, 'edit'])->name('admin.ads_category.edit'); // admin category edit
  Route::post('/admin/addCategory/update', [addCategoryController::class, 'update'])->name('admin.addCategory.update'); // admin addCategory edit

  Route::get('/admin/adsCategory/nextPage/{id}', [packagesController::class, 'index'])->name('admin.package.edit'); // admin package page
  Route::post('/admin/package/create', [packagesController::class, 'create'])->name('admin.package.create'); // admin package create
  Route::get('/admin/package/recieveData/{id}', [packagesController::class, 'recieveData'])->name('admin.packages.recieveData'); // admin display packages
  Route::get('/admin/Package/{id}/edit', [packagesController::class, 'edit'])->name('admin.packages.edit'); // admin package edit
  Route::post('/admin/package/update', [packagesController::class, 'update'])->name('admin.package.update'); // admin package update

  Route::get('/admin/topAdsManagement/view', [topAdManagementController::class, 'index'])->name('admin.top_ad_management.view'); // admin view topads management
  Route::post('/admin/topAdsManagement/create', [topAdManagementController::class, 'create'])->name('admin.topAdsManagement.create'); // admin create topads management
  Route::get('/admin/topAdsManagement/getData', [topAdManagementController::class, 'getData'])->name('admin.topads.recieveData'); // admin table data topads
  Route::get('/admin/topAdsManagement/{id}/edit', [topAdManagementController::class, 'edit'])->name('admin.topads.edit'); // admin table data topads
  Route::post('/admin/topAdsManagement/update', [topAdManagementController::class, 'update'])->name('admin.topAds.update'); // admin UPDATE topads management



});
// admin panel routes end 
