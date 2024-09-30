<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventDetail;
use Illuminate\Http\Request;

class FilterUserController extends Controller
{
   public function show_all($id_evt)
   {
      // ดึงข้อมูลผู้เข้าร่วมที่มีสถานะเป็น 1 (รออนุมัติ)
      $event = EventDetail::with('user.department', 'event', 'statusUser')
         ->where('id_evt', $id_evt)
         ->get();

      $evt_name = Event::find($id_evt);

      return view('user.user-check', compact('event', 'evt_name'));
   }
   public function show_waiting_approval($id_evt)
   {
      // ดึงข้อมูลผู้เข้าร่วมที่มีสถานะเป็น 1 (รออนุมัติ)
      $event = EventDetail::with('user.department', 'event', 'statusUser')
         ->where('id_evt', $id_evt)
         ->where('id_status_user', 1) // เงื่อนไขสถานะเป็น 1
         ->get();

      $evt_name = Event::find($id_evt);

      return view('user.user-check', compact('event', 'evt_name'));
   }

   public function show_approved($id_evt)
   {
      // ดึงข้อมูลผู้เข้าร่วมที่มีสถานะเป็น 2 (อนุมัติแล้ว)
      $event = EventDetail::with('user.department', 'event', 'statusUser')
         ->where('id_evt', $id_evt)
         ->where('id_status_user', 2) // เงื่อนไขสถานะเป็น 2
         ->get();

      $evt_name = Event::find($id_evt);

      return view('user.user-check', compact('event', 'evt_name'));
   }

   public function show_not_approved($id_evt)
   {
      // ดึงข้อมูลผู้เข้าร่วมที่มีสถานะเป็น 3 (ไม่อนุมัติ)
      $event = EventDetail::with('user.department', 'event', 'statusUser')
         ->where('id_evt', $id_evt)
         ->where('id_status_user', 3) // เงื่อนไขสถานะเป็น 3
         ->get();

      $evt_name = Event::find($id_evt);

      return view('user.user-check', compact('event', 'evt_name'));
   }

   public function show_evaluated($id_evt)
   {
      // ดึงข้อมูลผู้เข้าร่วมที่มีสถานะเป็น 5 (ประเมินผลแล้ว)
      $event = EventDetail::with('user.department', 'event', 'statusUser')
         ->where('id_evt', $id_evt)
         ->where('id_status_user', 5) // เงื่อนไขสถานะเป็น 5
         ->get();

      $evt_name = Event::find($id_evt);

      return view('user.user-check', compact('event', 'evt_name'));
   }
}
