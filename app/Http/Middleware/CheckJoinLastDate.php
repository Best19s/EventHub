<?php

namespace App\Http\Middleware;

use App\Models\EventDetail;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckJoinLastDate
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle(Request $request, Closure $next): Response
   {
      // ดึง id ของกิจกรรมจาก URL
      $eventId = $request->route('idEvent');

      // ดึงข้อมูล EventDetail ที่มี join_last_date และ created_at (วันลงทะเบียน)
      $eventDetail = EventDetail::where('id_evt', $eventId)->first();

      // ตรวจสอบว่า created_at น้อยกว่าวันสิ้นสุดการเข้าร่วมหรือไม่
      if ($eventDetail && Carbon::now()->lt(Carbon::parse($eventDetail->join_first_date))) {
         if (Carbon::now()->lt(Carbon::parse($eventDetail->join_last_date))) {
            // ถ้าปัจจุบันยังไม่ถึงวันที่สุดท้ายที่เข้าร่วม ป้องกันการเข้าถึง
            return redirect()->back()->with('error', 'ยังไม่ถึงวันที่สุดท้ายของกิจกรรม คุณไม่สามารถประเมินผลได้');
         }
      }

      return $next($request);
   }
}
