<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\ApprovalController;


Route::get('/', [LoginController::class, 'index']);

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
Route::post('profilePassword', [ProfileController::class, 'updatePassword'])->name('updateProfilePassword');

Route::get('event', [EventController::class, 'index'])->name('event');
Route::get('createEvent', [EventController::class, 'create']);
Route::post('createEvent', [EventController::class, 'store']);
Route::get('showEvent/{key}', [EventController::class, 'show']);
Route::get('showEvent/{key}/edit',[EventController::class, 'edit']);
Route::post('showEvent/{key}/update', [EventController::class, 'update'])->name('updateEvent');
Route::get('showEvent/{key}/delete', [EventController::class, 'destroy'])->name('deleteEvent');

Route::get('news', [NewsController::class, 'index'])->name('news');
Route::get('createNews', [NewsController::class, 'create']);
Route::post('createNews', [NewsController::class, 'store']);
Route::get('showNews/{key}', [NewsController::class, 'show']);
Route::get('showNews/{key}/edit',[NewsController::class, 'edit']);
Route::post('showNews/{key}/update', [NewsController::class, 'update'])->name('updateNews');
Route::get('showNews/{key}/delete', [NewsController::class, 'destroy'])->name('deleteNews');

Route::get('project', [ProjectController::class, 'index'])->name('project');
Route::get('createProject', [ProjectController::class, 'create']);
Route::post('createProject', [ProjectController::class, 'store']);
Route::get('showProject/{key}', [ProjectController::class, 'show']);
Route::get('showProject/{key}/edit',[ProjectController::class, 'edit']);
Route::post('showProject/{key}/update',[ProjectController::class, 'update'])->name('updateProject');
Route::get('showProject/{key}/delete',[ProjectController::class, 'destroy'])->name('deleteProject');

Route::get('approval', [ApprovalController::class, 'index'])->name('approval');
Route::get('createApproval', [ApprovalController::class, 'create']);
Route::post('createApproval', [ApprovalController::class, 'store']);

Route::get('register', [RegisterController::class, 'index']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('login', [LoginController::class, 'index'])->name('login')->Middleware('guest');
Route::post('login', [LoginController::class, 'login']);

Route::get('logout', [LogoutController::class, 'index'])->name('logOut');

Route::get('userlist', [UserListController::class, 'index']);

Route::get('calender', [CalenderController::class, 'index'])->name('calender');
Route::get('listCal', [CalenderController::class, 'listEvent'])->name('listCal');
