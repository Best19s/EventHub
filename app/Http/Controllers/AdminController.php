<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\StatusEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{
   public function index()
   {
      $user_type = Auth::user()->user_type;

      if ($user_type == 'user') {
         // $events = Event::all()->order;
         $events = Event::whereIn('id_status_evt', [4, 2])
            ->orderBy('evt_start_date', 'desc')
            ->paginate(3);
         // แสดง 3 รายการต่อหน้า

         return view('dashboard', compact('events'));
      } else {
         return redirect()->route('dashboard');
      }
   }

   public function create_evt_form()
   {
      $evt_type = EventType::all();
      $evt_status = StatusEvent::all();
      return view('admin.admin-evt-form', compact('evt_type', 'evt_status'));
   }
   public function create_evt(Request $request)
   {

      $new_evt = new Event;
      $new_evt->id_evt_type = $request->evt_type;
      $new_evt->id_status_evt  = $request->evt_status;
      $new_evt->evt_name = $request->evt_name;
      $new_evt->is_student_only = $request->for_std;
      $new_evt->evt_host = $request->evt_host;
      $new_evt->evt_addr = $request->evt_addr;
      $new_evt->evt_detail = $request->evt_detail;


      if ($request->hasFile('evt_img')) {

         $file = $request->file('evt_img');
         $ext = $file->getClientOriginalExtension();
         $filename = time() . '.' . $ext;
         $file->move(public_path('storage/images/events/'), $filename);
      }

      $new_evt->evt_img = $filename;
      $new_evt->evt_max_attendant = $request->max_attd;
      $new_evt->evt_start_date = $request->evt_start;
      $new_evt->evt_end_date = $request->evt_end;
      $new_evt->evt_reg_start_date = $request->reg_evt_start;
      $new_evt->evt_reg_end_date = $request->reg_evt_end;
      $new_evt->save();

      return redirect()->route('dashboard');
   }

   public function show_evt()
   {
      $events = Event::with(['statusEvent', 'eventDetails'])->withCount('eventDetails as attendant_count')->orderBy('id_evt', 'asc')->paginate(6);

      // foreach ($events as $event) {
      //    if (\Carbon\Carbon::now()->greaterThan($event->evt_end_date)) {
      //       // ถ้าหากกิจกรรมเสร็จสิ้น
      //       // เปลี่ยนสถานะของ event ก่อน
      //       $event->id_status_evt = 5; // เปลี่ยนเป็นสถานะเสร็จสิ้น

      //    } elseif (\Carbon\Carbon::now()->greaterThanOrEqualTo($event->evt_reg_start_date)) {
      //       // ถ้าหากกำลังดำเนินการ
      //       $event->id_status_evt = 4; // เปลี่ยนเป็นสถานะกำลังดำเนินการ
      //    } else
      //       $event->id_status_evt = 1;
      // }
      // $event->save();

      $title = 'กิจกรรมทั้งหมด';

      // อัพเดตสถานะใน status_events ที่เชื่อมโยงกับ event
      StatusEvent::whereIn('id_status_evt', [4, 5])->update(['updated_at' => now()]);

      return view('admin.admin-home', compact('events', 'title'));
   }
   public function update($idEvent)
   {
      $evt_type = EventType::all();
      $evt_status = StatusEvent::all();
      $evt_find = Event::find($idEvent);
      return view('admin.admin-evt-form', compact('evt_type', 'evt_status', 'evt_find'));
   }
   public function updateEvent(Request $request)
   {
      // ค้นหา event ที่ต้องการอัปเดต
      $evt = Event::find($request->id);

      // อัปเดตข้อมูลตามที่ได้รับจาก request
      $evt->id_evt_type = $request->evt_type;
      $evt->id_status_evt  = $request->evt_status;

      // ตรวจสอบว่าค่า for_std ถูกส่งมาจาก request หรือไม่
      if ($request->has('for_std')) {
         $evt->is_student_only = $request->for_std; // จะได้ค่าเป็น 1 ถ้าติ๊ก
      } else {
         $evt->is_student_only = 0; // ถ้าไม่ถูกติ๊ก
      }

      $evt->evt_name = $request->evt_name;
      $evt->evt_host = $request->evt_host;
      $evt->evt_addr = $request->evt_addr;
      $evt->evt_detail = $request->evt_detail;

      // ตรวจสอบว่ามีการอัปโหลดรูปภาพใหม่หรือไม่
      if ($request->hasFile('evt_img')) {
         // ลบไฟล์รูปภาพเดิมออก (ถ้ามี)
         if ($evt->evt_img && file_exists(public_path('storage/images/events/' . $evt->evt_img))) {
            unlink(public_path('storage/images/events/' . $evt->evt_img));
         }

         // อัปโหลดไฟล์ใหม่
         $file = $request->file('evt_img');
         $ext = $file->getClientOriginalExtension();
         $filename = time() . '.' . $ext;
         $file->move(public_path('storage/images/events/'), $filename);
         $evt->evt_img = $filename;  // อัปเดตรูปภาพใหม่
      }

      // อัปเดตข้อมูลอื่นๆ
      $evt->evt_max_attendant = $request->max_attd;
      $evt->evt_start_date = $request->evt_start;
      $evt->evt_end_date = $request->evt_end;
      $evt->evt_reg_start_date = $request->reg_evt_start;
      $evt->evt_reg_end_date = $request->reg_evt_end;

      // บันทึกการอัปเดตลงในฐานข้อมูล
      $evt->save();

      // หลังจากอัปเดตเสร็จ ให้เปลี่ยนเส้นทางกลับไปที่แสดงข้อมูลกิจกรรม
      return redirect()->route('dashboard');
   }

   public function delete($idEvent)
   {
      // ค้นหาอีเว้นท์ที่ต้องการลบ
      $event = Event::find($idEvent);

      if ($event) {
         // เปลี่ยนสถานะเป็น 6
         $event->id_status_evt = 6;
         $event->save(); // บันทึกการเปลี่ยนแปลง

         // ลบอีเว้นท์
         $event->delete(); // นี่จะทำให้เกิด soft delete
      }

      return redirect()->route('dashboard')->with('status', 'กิจกรรมถูกลบและสถานะเปลี่ยนเป็น 6'); // ส่งข้อความสถานะ
   }
}
