<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusUserSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      DB::table('status_users')->insert([
         ['status_user_name' => 'รอการอนุมัติ'],
         ['status_user_name' => 'อนุมัติแล้ว'],
         ['status_user_name' => 'ไม่ผ่านการอนุมัติ']
      ]);
   }
}
