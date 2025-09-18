<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\AssetStateController;
use App\Http\Controllers\CompanyAssetController;
use App\Http\Controllers\AssetFurnitureController;
use App\Http\Controllers\AssetHardwareController;
use App\Http\Controllers\AssetMachineryController;
use App\Http\Controllers\AssetSoftwareController;
use App\Http\Controllers\AssetToolController;
use App\Http\Controllers\AssetOtherController;
use App\Http\Controllers\SoftwareTypeController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

// Rutas públicas
Route::view('/terms', 'terms')->name('terms.show');
Route::view('/policy', 'policy')->name('policy.show');

// Rutas protegidas
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'user.status'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('job-positions', JobPositionController::class)->names('job_positions');
    Route::resource('offices', OfficeController::class)->names('offices');
    Route::resource('contract-types', ContractTypeController::class)->names('contract_types');
    Route::resource('workers', WorkerController::class)->names('workers');
    Route::resource('asset-types', AssetTypeController::class)->names('asset_types');
    Route::resource('asset-states', AssetStateController::class)->names('asset_states');
    Route::resource('company-assets', CompanyAssetController::class)->names('company_assets');
    Route::resource('asset-furnitures', AssetFurnitureController::class)->names('asset_furnitures');
    Route::resource('asset-hardwares', AssetHardwareController::class)->names('asset_hardwares');
    Route::resource('asset-machineries', AssetMachineryController::class)->names('asset_machineries');
    Route::resource('asset-softwares', AssetSoftwareController::class)->names('asset_softwares');
    Route::resource('asset-tools', AssetToolController::class)->names('asset_tools');
    Route::resource('asset-others', AssetOtherController::class)->names('asset_others');
    Route::resource('software-types', SoftwareTypeController::class)->names('software_types');
    Route::get('/company-assets/get-workers-by-office/{officeId}', [CompanyAssetController::class, 'getWorkersByOffice'])->name('company_assets.get_workers');
    Route::put('/company-assets/{companyAsset}/delete-photo', [CompanyAssetController::class, 'deletePhoto'])->name('company_assets.delete_photo');

    Route::resource('users', UserController::class)->names('users');
    Route::resource('roles', RoleController::class)->names('roles');
    Route::resource('permissions', PermissionController::class)->names('permissions');
    Route::post('/users/{userId}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');

    Route::post('/send-credentials', [UserController::class, 'sendCredentials'])->name('send-credentials');
    Route::post('/update-password-and-send', [UserController::class, 'updatePasswordAndSend'])->name('update-password-and-send');


    Route::get('/manual-usuario', [StaticPageController::class, 'manual'])->name('manual');
    Route::get('/soporte', [StaticPageController::class, 'support'])->name('support');
    Route::get('/about', [StaticPageController::class, 'about'])->name('about');
});