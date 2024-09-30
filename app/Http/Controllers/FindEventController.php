<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;

class FindEventController extends Controller
{
   public function event_find()
   {
      $evt = Event::whereIn('id_status_evt', [4, 2])->paginate(10);

      $evt_type = EventType::all();

      return view('user.user-find-event', compact('evt', 'evt_type'));
   }

   public function event_find_name(Request $request)
   {
      $evt_find = Event::where('evt_name', 'like', '%' . $request->searching . '%')->whereIn('id_status_evt', [4, 2])->paginate(10);

      session()->forget('error');
      if ($evt_find->isEmpty()) {
         session()->flash('error', 'ไม่มีกิจกรรมที่ตรงกับชื่อที่ค้นหา');
      }
      $evt_type = EventType::all();

      return view('user.user-find-event', compact('evt_find', 'evt_type'))->with('evt', $evt_find);
   }


   public function filterEvent(Request $request)
   {
      // เริ่มต้น query สำหรับค้นหา Event
      $query = Event::query();

      // ลบข้อความ error ใน session
      session()->forget('error');

      // ถ้ามีการกรอกวันที่เริ่มกิจกรรม
      if ($request->filled('evt_date')) {
         $query->whereDate('evt_start_date', $request->evt_date);
      }

      // ถ้ามีการเลือกประเภทกิจกรรม
      if ($request->filled('evt_type')) {
         $query->where('id_evt_type', $request->evt_type);
      }

      // ถ้ามีการกรอกสถานที่
      if ($request->filled('evt_addr')) {
         $query->where('evt_addr', 'like', '%' . $request->evt_addr . '%');
      }

      // ถ้าเลือกเฉพาะนักศึกษา
      if ($request->filled('std_only') && $request->std_only == 1) {
         $query->where('is_student_only', 1);
      }

      // เพิ่มเงื่อนไขเพื่อเลือกเฉพาะกิจกรรมที่มี id_status_evt เป็น 4
      $query->whereIn('id_status_evt', [4,2]);

      // ดึงข้อมูลและแบ่งหน้า
      $events = $query->paginate(10);

      // ตรวจสอบว่ามีผลลัพธ์หรือไม่
      if ($events->isEmpty()) {
         session()->flash('error', 'ไม่มีกิจกรรมที่ตรงตามเงื่อนไขที่ค้นหา');
      }

      // ดึงประเภทกิจกรรมทั้งหมด
      $evt_type = EventType::all();

      // ส่งผลลัพธ์ไปที่ view
      return view('user.user-find-event', compact('events', 'evt_type'))->with('evt', $events);
   }
}
