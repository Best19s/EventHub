<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventDetail;
use Illuminate\Http\Request;

class EventReportController extends Controller
{
   public function index($id_event)
   {

      // ดึงข้อมูลจาก EventDetail ที่มี id_evt ตรงกับพารามิเตอร์
      $participants = EventDetail::where('id_evt', $id_event)->get();

      // นับจำนวนผู้เข้าร่วม
      $participantCount = $participants->count();
      $event = Event::find($id_event);
      $participantsMax = $event ? $event->evt_max_attendant : 0;

      // คำนวณคะแนนเฉลี่ย
      $averageRating = $participants->avg('rating');

      // คำนวณจำนวนคะแนนแต่ละระดับ
      $ratingCounts = [
         5 => $participants->where('rating', 5)->count(),
         4 => $participants->where('rating', 4)->count(),
         3 => $participants->where('rating', 3)->count(),
         2 => $participants->where('rating', 2)->count(),
         1 => $participants->where('rating', 1)->count(),
      ];

      return view('admin.admin-report', compact('participants', 'participantCount', 'participantsMax', 'averageRating', 'ratingCounts'));
   }
}
