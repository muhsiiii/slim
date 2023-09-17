<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\GymController;


Route::get('/', [AdminController::class, 'home']);
Route::get('/CrowdAfrik-Admin', [AdminController::class, 'home'])->name('admin.home');
Route::get('/forgot-password', [AdminController::class, 'forgot_password']);
Route::post('/AdminMailChk' , [AdminController::class, 'admin_mail_chk']);
Route::get('/admin-password-reset/{tk}/{em}', [AdminController::class, 'admin_password_reset']);
Route::post('/adminpsw-reset' , [AdminController::class, 'adminpsw_reset']);
Route::post('/AdminLogin' , [AdminController::class, 'login'])->name('admin.login');

Route::middleware(['AdminLoginCheck','PreventBack'])->group(function () {

  Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
  Route::get('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');
  Route::get('/change-password', [AdminController::class, 'change_password']);
  Route::post('/password-update', [AdminController::class, 'password_update']);
  Route::get('/admin-profile', [AdminController::class, 'admin_profile']);
  Route::get('/edit-admin-profile', [AdminController::class, 'edit_admin_profile']);
  Route::post('/admin-profile-update', [AdminController::class, 'admin_profile_update']);

  Route::get('/agents', [AgentController::class, 'agents']);
  Route::get('/add-agent', [AgentController::class, 'add_agent']);
  Route::post('/agent-add', [AgentController::class, 'agent_add']);
  Route::get('/edit-agent/{cid}', [AgentController::class, 'edit_agent']);
  Route::post('/agent-edit', [AgentController::class, 'agent_edit']);
  Route::post('/activate-agent', [AgentController::class, 'activate_agent']);
  Route::post('/block-agent', [AgentController::class, 'block_agent']);

  Route::get('/agent-gyms/{id}', [AgentController::class, 'agentGyms'])->name('agentgyms');


  Route::get('/plans', [PlanController::class, 'plans']);
  Route::get('/add-plan', [PlanController::class, 'add_plan']);
  Route::post('/plan-add', [PlanController::class, 'plan_add']);
  Route::get('/edit-plan/{cid}', [PlanController::class, 'edit_plan']);
  Route::post('/plan-edit', [PlanController::class, 'plan_edit']);
  Route::post('/activate-plan', [PlanController::class, 'activate_plan']);
  Route::post('/block-plan', [PlanController::class, 'block_plan']);


  Route::get('/plans-gyms/{id}', [PlanController::class, 'planGyms'])->name('plansgyms');


  Route::get('/add-gym', [GymController::class, 'add_gym']);
  Route::post('/gym-add', [GymController::class, 'gym_add']);
  Route::get('/active-gym', [GymController::class, 'active_gym']);
  Route::post('/activate-gym', [GymController::class, 'activate_gym']);
  Route::post('/block-gym', [GymController::class, 'block_gym']);
  Route::get('/edit-gym/{cid}', [GymController::class, 'edit_gym']);
  Route::post('/gym-edit', [GymController::class, 'gym_edit']);

//   Route::get('/notifications', [NotificationController::class, 'add_gym']);
  Route::get('/add-notifications', [NotificationController::class, 'addNotification'])->name('addnotification');
  Route::post('/notification-save', [NotificationController::class, 'notificationSave']);







});






