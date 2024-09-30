<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\EventDetail;

class CheckEventRegistration
{
   /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
   public function handle(Request $request, Closure $next): Response
   {
      // ดึง ID ผู้ใช้ที่ล็อกอินอยู่
      $authenticatedUserId = Auth::id();

      // ดึง ID ที่ส่งเข้ามาใน route
      $userId = $request->route('idUser');

      // ตรวจสอบว่าผู้ใช้มีสิทธิ์เข้าถึงข้อมูลหรือไม่
      if ($authenticatedUserId != $userId) {
         return redirect()->route('home')->with('error', 'คุณไม่สามารถเข้าถึงข้อมูลของผู้ใช้อื่นได้');
      }

      return $next($request);
   }
}
