<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventDetail;
use Illuminate\Http\Request;

class FilterEventController extends Controller
{
   public function show_all()
   {
      $events = Event::paginate(10);
      if ($events->isEmpty()) {
         session()->flash('status', 'ไม่พบกิจกรรม'); // ส่งข้อความ session ถ้าไม่มีข้อมูล
      }
      $title = 'กิจกรรมทั้งหมด'; // กำหนดชื่อหัวข้อ
      return view('admin.admin-home', ['events' => $events, 'title' => $title]);
   }

   public function show_waiting_approval()
   {
      $events = Event::where('id_status_evt', 1)->paginate(10);
      if ($events->isEmpty()) {
         session()->flash('status', 'ไม่พบกิจกรรมที่รออนุมัติ'); // ส่งข้อความ session ถ้าไม่มีข้อมูล
      }
      $title = 'กิจกรรมที่รออนุมัติ'; // กำหนดชื่อหัวข้อ
      return view('admin.admin-home', ['events' => $events, 'title' => $title]);
   }

   public function show_approved()
   {
      $events = Event::where('id_status_evt', 2)->paginate(10);
      if ($events->isEmpty()) {
         session()->flash('status', 'ไม่พบกิจกรรมที่อนุมัติแล้ว'); // ส่งข้อความ session ถ้าไม่มีข้อมูล
      }
      $title = 'กิจกรรมที่อนุมัติแล้ว'; // กำหนดชื่อหัวข้อ
      return view('admin.admin-home', ['events' => $events, 'title' => $title]);
   }

   public function inprogress()
   {
      $events = Event::where('id_status_evt', 4)->paginate(10);
      if ($events->isEmpty()) {
         session()->flash('status', 'ไม่พบกิจกรรมที่กำลังดำเนินการ'); // ส่งข้อความ session ถ้าไม่มีข้อมูล
      }
      $title = 'กิจกรรมที่กำลังดำเนินการ'; // กำหนดชื่อหัวข้อ
      return view('admin.admin-home', ['events' => $events, 'title' => $title]);
   }

   public function show_ended()
   {
      $events = Event::where('id_status_evt', 5)->paginate(10);
      if ($events->isEmpty()) {
         session()->flash('status', 'ไม่พบกิจกรรมที่สิ้นสุดแล้ว'); // ส่งข้อความ session ถ้าไม่มีข้อมูล
      }
      $title = 'กิจกรรมที่สิ้นสุดแล้ว'; // กำหนดชื่อหัวข้อ
      return view('admin.admin-home', ['events' => $events, 'title' => $title]);
   }

   public function show_deleted()
   {
      $events = Event::onlyTrashed()->paginate(10);
      if ($events->isEmpty()) {
         session()->flash('status', 'ไม่พบกิจกรรมที่ถูกลบ'); // ส่งข้อความ session ถ้าไม่มีข้อมูล
      }
      $title = 'กิจกรรมที่ถูกลบ'; // กำหนดชื่อหัวข้อ
      return view('admin.admin-home', ['events' => $events, 'title' => $title]);
   }


   
}
