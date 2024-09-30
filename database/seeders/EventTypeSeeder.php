<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $eventTypes = [
         ['evt_type_name' => 'การสัมมนา'],
         ['evt_type_name' => 'การอบรมเชิงปฏิบัติการ'],
         ['evt_type_name' => 'การประกวด'],
         ['evt_type_name' => 'งานนิทรรศการ'],
         ['evt_type_name' => 'การประชุม'],
         ['evt_type_name' => 'งานเสวนา'],
         ['evt_type_name' => 'งานเทศกาล'],
         ['evt_type_name' => 'งานเลี้ยง'],
         ['evt_type_name' => 'กิจกรรมกีฬา'],
         ['evt_type_name' => 'กิจกรรมบันเทิง'],
         ['evt_type_name' => 'กิจกรรมการกุศล'],
         ['evt_type_name' => 'การทัศนศึกษา'],
         ['evt_type_name' => 'การประกอบพิธี'],
         ['evt_type_name' => 'การเปิดตัวผลิตภัณฑ์'],
         ['evt_type_name' => 'งานแถลงข่าว'],
         ['evt_type_name' => 'การแสดงผลงานศิลปะ'],
         ['evt_type_name' => 'กิจกรรมเพื่อสิ่งแวดล้อม'],
         ['evt_type_name' => 'กิจกรรมสร้างแรงบันดาลใจ'],
         ['evt_type_name' => 'การเรียนรู้แบบกลุ่ม'],
         ['evt_type_name' => 'การเวิร์กช็อปสร้างสรรค์'],
         ['evt_type_name' => 'กิจกรรมเชิงธุรกิจ'],
         ['evt_type_name' => 'กิจกรรมวิชาการ'],
         ['evt_type_name' => 'งานสังคม'],
         ['evt_type_name' => 'งานแสดงภาพยนตร์'],
         ['evt_type_name' => 'กิจกรรมส่งเสริมสุขภาพ']
     ];

     foreach ($eventTypes as $eventType) {
      DB::table('event_types')->insert([
          'evt_type_name' => $eventType['evt_type_name'],
          'created_at' => Carbon::now()
      ]);
      }

    }
}
