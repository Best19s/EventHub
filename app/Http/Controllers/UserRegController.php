<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Event;
use App\Models\EventDetail;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRegController extends Controller
{
   public function index($id_evt)
   {

      $evt = Event::with(['statusEvent', 'eventDetails'])->withCount('eventDetails as attendant_count')->find($id_evt);

      return view('user.user-reg', compact('evt'));
   }
   public function evt_form($id_evt)
   {

      $evt = Event::with(['statusEvent', 'eventDetails'])->withCount('eventDetails as attendant_count')->find($id_evt);
      $facs = Faculty::all();
      $depts = Department::all();
      $id_user = Auth::id();
      $user = User::find($id_user);


      // dd($user->department->faculty->idFaculties);
      $attendantCount = $evt->attendant_count;
      $maxAttendant = $evt->evt_max_attendant;

      $registrationStart = \Carbon\Carbon::parse($evt->evt_reg_start_date);
      $registrationEnd = \Carbon\Carbon::parse($evt->evt_reg_end_date);

      if ($attendantCount >= $maxAttendant) {
         // ถ้าผู้เข้าร่วมเต็ม ให้ส่งกลับไปยังหน้าที่แล้วพร้อมกับข้อความแจ้งเตือน
         return redirect()->back()->with('error', 'ผู้เข้าร่วมเต็มแล้ว ไม่สามารถเข้าร่วมได้');
      }
      if (now()->lt($registrationStart)) {
         // หากยังไม่ถึงเวลาลงทะเบียน
         return redirect()->back()->with('error', 'การลงทะเบียนยังไม่เริ่ม');
      }

      if (now()->gt($registrationEnd)) {
         // หากหมดเวลาลงทะเบียนแล้ว
         return redirect()->back()->with('error', 'หมดเวลาลงทะเบียนแล้ว');
      }

      return view('user.user-reg-form', compact('evt', 'facs', 'depts', 'user', 'attendantCount', 'maxAttendant'));
   }

   public function reg(Request $request)
   {
      $existingRegistration = EventDetail::where('id_user', $request->id_user)
         ->where('id_evt', $request->id_evt)
         ->first();

      if ($existingRegistration) {
         return redirect()->back()->with('error_evt', 'คุณได้ลงทะเบียนสำหรับกิจกรรมนี้แล้ว');
      }
      if (!$request->has('dates') || count($request->dates) == 0) {
         return redirect()->back()->with('error', 'กรุณาเลือกวันก่อนที่จะลงทะเบียน');
      }

      $event = Event::find($request->id_evt);
      if ($event->is_student_only) {
         $std = User::find($request->id_user);
         if (empty($request->std_id)) {
            return redirect()->back()->with('error', 'กิจกรรมนี้สามารถลงทะเบียนได้เฉพาะนักศึกษาเท่านั้น');
         }

      }

      if ($request->has('std')) {
         $std = User::find($request->id_user);
         $std->std_id = $request->std_id;
         $std->idDepartments  = $request->major;
         $std->name  = $request->name;
         $std->email  = $request->email;
         $std->phone  = $request->phone;
         $std->password = $request->password;
         $std->save();

         $new_reg = new EventDetail;
         $new_reg->id_user = $request->id_user;
         $new_reg->id_evt = $request->id_evt;
         $new_reg->id_status_user  = '1';
         $selectedDate = $request->dates;

         if (count($selectedDate) > 0) {

            $startDate = min($selectedDate);
            $endDate = max($selectedDate);


            if ($startDate === $endDate) {
               $endDate = $startDate;
            }

            $new_reg->join_first_date = $startDate;
            $new_reg->join_last_date = $endDate;
         }
         $new_reg->save();
      } else {
         $new_reg = new EventDetail;
         $new_reg->id_user = $request->id_user;
         $new_reg->id_evt = $request->id_evt;
         $new_reg->id_status_user  = '1';
         $selectedDate = $request->dates;

         if (count($selectedDate) > 0) {

            $startDate = min($selectedDate);
            $endDate = max($selectedDate);


            if ($startDate === $endDate) {
               $endDate = $startDate;
            }

            $new_reg->join_first_date = $startDate;
            $new_reg->join_last_date = $endDate;
         }
         $new_reg->save();
      }



      return redirect()->route('home');
   }

   public function unreg($id)
   {
      // ดึงข้อมูล EventDetail โดยใช้ find หรือ first
      $evt = EventDetail::find($id);

      // ตรวจสอบว่าพบข้อมูลหรือไม่
      if ($evt) {
         $evt->id_status_user = 6; // เปลี่ยนสถานะผู้ใช้
         $evt->save(); // บันทึกการเปลี่ยนแปลง
         $evt->delete();
         return redirect()->back()->with('success', 'ยกเลิกลงทะเบียน');
      } else {
         return redirect()->back()->with('error', 'ไม่พบข้อมูลที่ต้องการยกเลิกลงทะเบียน');
      }
   }


   public function show_evt($id_evt)
   {
      // $event = EventDetail::with('user','event','statusUser')->where('id_evt',$id_evt)->first();
      $event = EventDetail::with('user.department', 'event', 'statusUser')
         ->where('id_evt', $id_evt)
         ->get();

      $evt_name = Event::find($id_evt);

      $evt = Event::with(['statusEvent', 'eventDetails'])->withCount('eventDetails as attendant_count')->find($id_evt);
      $attendantCount = $evt->attendant_count;
      $maxAttendant = $evt->evt_max_attendant;

      return view('admin.admin-check', compact('event', 'evt_name', 'attendantCount', 'maxAttendant'));
   }

   // public function check($id)
   // {
   //    $evt_detail = EventDetail::where('id', $id)->first();
   //    $evt_detail->id_status_user = 2;
   //    $evt_detail->save();
   //    return redirect()->back();
   // }
   // public function uncheck($id)
   // {
   //    $evt_detail = EventDetail::where('id', $id)->first();
   //    $evt_detail->id_status_user = 3;
   //    $evt_detail->save();
   //    return redirect()->back();
   // }

   public function userAction(Request $request)
   {
      // ตรวจสอบว่ามีการเลือกผู้เข้าร่วมหรือไม่
      if (!$request->has('selected_users')) {
         return redirect()->back()->with('error', 'กรุณาเลือกผู้เข้าร่วมอย่างน้อยหนึ่งคน');
      }

      $selectedUsers = $request->input('selected_users');
      $action = $request->input('action');

      // ตรวจสอบว่ามีการกระทำใดที่ถูกเลือก
      switch ($action) {
         case 'approve':
            EventDetail::whereIn('id', $selectedUsers)->update(['id_status_user' => 2]);
            return redirect()->back()->with('success', 'อนุมัติผู้เข้าร่วมที่เลือกเรียบร้อยแล้ว');

         case 'unapprove':
            EventDetail::whereIn('id', $selectedUsers)->update(['id_status_user' => 3]);
            return redirect()->back()->with('success', 'ไม่อนุมัติผู้เข้าร่วมที่เลือกเรียบร้อยแล้ว');

         case 'delete':
            EventDetail::whereIn('id', $selectedUsers)->delete();
            return redirect()->back()->with('success', 'ลบผู้เข้าร่วมที่เลือกเรียบร้อยแล้ว');

         default:
            return redirect()->back()->with('error', 'การกระทำไม่ถูกต้อง');
      }
   }
}
