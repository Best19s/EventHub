<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventReportController;
use App\Http\Controllers\FilterEventController;
use App\Http\Controllers\FilterUserController;
use App\Http\Controllers\FindEventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRegController;
use App\Http\Controllers\UserRegDetailController;
use Illuminate\Support\Facades\Route;

// หน้าแรก
Route::get('/', [UserController::class, 'index']);

// กลุ่มเส้นทางสำหรับผู้ใช้ที่ล็อกอินแล้ว
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
   // หน้าแดชบอร์ดสำหรับผู้ดูแล
   Route::get('/dashboard', [AdminController::class, 'show_evt'])
      ->name('dashboard')
      ->middleware('admin'); // Middleware สำหรับผู้ดูแล

   // หน้าแบบฟอร์มสร้างกิจกรรม
   Route::get('/events/create', [AdminController::class, 'create_evt_form'])
      ->name('create_evt_form')
      ->middleware('admin'); // Middleware สำหรับผู้ดูแล

   // เส้นทางสำหรับการจัดการกิจกรรม
   Route::post('/events/create', [AdminController::class, 'create_evt'])->name('create_evt');
   Route::get('/delete/{idEvent}', [AdminController::class, 'delete'])->middleware('admin');
   Route::get('/update/{idEvent}', [AdminController::class, 'update'])->middleware('admin');
   Route::post('/update', [AdminController::class, 'updateEvent'])->middleware('admin');
});

// เส้นทางสำหรับผู้ใช้ทั่วไป
Route::get('/home', [AdminController::class, 'index'])->name('home');
Route::get('event/{idEvent}', [UserRegController::class, 'index']);
Route::get('event-form/{idEvent}', [UserRegController::class, 'evt_form']);
Route::post('/event', [UserRegController::class, 'reg'])->name('user_reg');
Route::get('reg/{idUser}', [UserRegController::class, 'show_evt'])->name('user_detail');

// เส้นทางสำหรับการกรองผู้เข้าร่วม
Route::get('/reg/all/{id_evt}', [FilterUserController::class, 'show_all'])->name('event.all');
Route::get('/reg/wait/{id_evt}', [FilterUserController::class, 'show_waiting_approval'])->name('event.waiting_approval');
Route::get('/reg/approved/{id_evt}', [FilterUserController::class, 'show_approved'])->name('event.approved');
Route::get('/reg/not-approved/{id_evt}', [FilterUserController::class, 'show_not_approved'])->name('event.not_approved');
Route::get('/reg/evaluated/{id_evt}', [FilterUserController::class, 'show_evaluated'])->name('event.evaluated');

// เส้นทางสำหรับการยกเลิกการลงทะเบียน
Route::get('/event/unreg/{id}', [UserRegController::class, 'unreg']);

// หน้าอนุมัติผู้เข้าร่วม
Route::post('/user/action', [UserRegController::class, 'userAction'])->name('userAction');

// เส้นทางสำหรับการจัดการกิจกรรม
Route::get('/evt/all', [FilterEventController::class, 'show_all'])->name('evt_all')->middleware('clearSessionMessage');
Route::get('/evt/wait', [FilterEventController::class, 'show_waiting_approval'])->name('evt_wait')->middleware('clearSessionMessage');
Route::get('/evt/approved', [FilterEventController::class, 'show_approved'])->name('evt_app')->middleware('clearSessionMessage');
Route::get('/evt/inprogress', [FilterEventController::class, 'inprogress'])->name('evt_inp')->middleware('clearSessionMessage');
Route::get('/evt/ended', [FilterEventController::class, 'show_ended'])->name('evt_ended')->middleware('clearSessionMessage');
Route::get('/evt/deleted', [FilterEventController::class, 'show_deleted'])->name('evt_deleted')->middleware('clearSessionMessage');

// เส้นทางสำหรับรายละเอียดบัญชีผู้ใช้
Route::get('/account/{idUser}', [UserRegDetailController::class, 'index'])->name('account')->middleware('check');
Route::get('/feedback/{idEvent}', [UserRegDetailController::class, 'feedback_form']);
Route::post('/feedback', [UserRegDetailController::class, 'feedback'])->name('feedback');

// เส้นทางสำหรับการรายงานกิจกรรม
Route::get('/report/{idEvent}', [EventReportController::class, 'index']);

// เส้นทางสำหรับการค้นหากิจกรรม
Route::get('/evt/find', [FindEventController::class, 'event_find'])->name('event_find');
Route::post('/evt/find/name', [FindEventController::class, 'event_find_name'])->name('event_find_name');
Route::post('/evt/find/filter', [FindEventController::class, 'filterEvent'])->name('event_filter');
