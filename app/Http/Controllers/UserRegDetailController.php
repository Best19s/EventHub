<?php

namespace App\Http\Controllers;

use App\Models\EventDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRegDetailController extends Controller
{
   public function index($id_user)
   {
      $evt = EventDetail::where('id_user', $id_user)
         ->whereNotIn('id_status_user', [5, 6])
         ->get();

      $status_done = EventDetail::where('id_user', $id_user)->where('id_status_user', 5)->get();

      return view('user.user-detail', compact('evt', 'status_done'));
   }

   public function feedback_form($id_evt)
   {
      // ตรวจสอบผู้ใช้ที่ล็อกอินอยู่
      $userId = Auth::id();

      // ดึงข้อมูล EventDetail โดยตรวจสอบทั้ง id_evt และ id_user
      $event = EventDetail::where('id_evt', $id_evt)
         ->where('id_user', $userId)
         ->first();

      // ตรวจสอบว่าพบข้อมูลหรือไม่
      if (!$event) {
         return redirect()->back()->with('error', 'ไม่พบข้อมูลกิจกรรมสำหรับผู้ใช้ที่ระบุ');
      }

      // ตรวจสอบวันที่สุดท้ายที่เข้าร่วมกิจกรรม
      $registrationEndDate = \Carbon\Carbon::parse($event->join_last_date);
      if (now()->lt($registrationEndDate)) {
         return redirect()->back()->with('error', 'ยังไม่สามารถประเมินผลได้จนถึงวันสุดท้ายที่เข้าร่วมกิจกรรม');
      }

      return view('user.user-review', compact('event'));
   }



   public function feedback(Request $request)
   {

      $evt = EventDetail::where('id', $request->id)->first();
      $evt->feedback = $request->feedback;
      $evt->rating = $request->rating;
      $evt->id_status_user = 5;
      $evt->save();
      return redirect()->route('home');
   }
}
