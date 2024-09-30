<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusEventSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {

      $statusIds = [
         ['status_evt_name' => 'รอการอนุมัติ'],
         ['status_evt_name' => 'อนุมัติแล้ว'],
         ['status_evt_name' => 'ไม่ผ่านการอนุมัติ'],
         ['status_evt_name' => 'กำลังดำเนินการ'],
         ['status_evt_name' => 'สิ้นสุดแล้ว'],
         ['status_evt_name' => 'ยกเลิก'],
         ['status_evt_name' => 'เลื่อน']
      ];

      foreach ($statusIds as $status) {
         DB::table('status_events')->insert([
             'status_evt_name' => $status['status_evt_name'],
             'created_at' => Carbon::now()
         ]);
         }

   }
}
