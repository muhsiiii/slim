<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserApiController;
use App\Http\Controllers\CampaignApiController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ApplicationApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [UserApiController::class, 'register']);
Route::post('/login', [UserApiController::class, 'login']);
Route::post('/check', [UserApiController::class, 'check']);
Route::post('/get-otp', [UserApiController::class, 'get_otp']);
Route::post('/get-mailotp', [UserApiController::class, 'get_mailotp']);
Route::post('/check-otp', [UserApiController::class, 'check_otp']);
Route::post('/reset-password', [UserApiController::class, 'reset_password']);
  Route::get('/get-countries', [UserApiController::class, 'get_countries']);
  Route::get('/get-states/{conid}', [UserApiController::class, 'get_states']);



Route::middleware(['auth:sanctum'])->group(function () {

  Route::get('/user-details', [UserApiController::class, 'user_details']);

  Route::post('/edit-profile', [UserApiController::class, 'edit_profile']); 

  Route::post('/add-nominee', [UserApiController::class, 'add_nominee']); 
  Route::get('/nominees', [UserApiController::class, 'nominees']); 
  Route::post('/edit-nominee', [UserApiController::class, 'edit_nominee']);
  Route::post('/delete-nominee', [UserApiController::class, 'delete_nominee']);


  Route::get('/campaign-categories', [CampaignApiController::class, 'campaign_categories']);
  Route::get('/campaigns/{catid}', [CampaignApiController::class, 'campaigns']);

  Route::get('/notifications', [NotificationController::class, 'notifications_list']);

  Route::post('/apply-application', [ApplicationApiController::class, 'apply_application']);
  Route::post('/submit-application', [ApplicationApiController::class, 'submit_application']);
  Route::post('/application-documents', [ApplicationApiController::class, 'application_documents']);


});