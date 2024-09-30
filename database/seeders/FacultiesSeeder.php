<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultiesSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      $faculties = [
         ['fac_name' => 'คณะเกษตรศาสตร์'],
         ['fac_name' => 'คณะวิศวกรรมศาสตร์'],
         ['fac_name' => 'คณะศึกษาศาสตร์'],
         ['fac_name' => 'คณะพยาบาลศาสตร์'],
         ['fac_name' => 'คณะวิทยาศาสตร์'],
         ['fac_name' => 'คณะแพทยศาสตร์'],
         ['fac_name' => 'คณะมนุษยศาสตร์และสังคมศาสตร์'],
         ['fac_name' => 'คณะเทคนิคการแพทย์'],
         ['fac_name' => 'คณะสาธารณสุขศาสตร์'],
         ['fac_name' => 'คณะทันตแพทยศาสตร์'],
         ['fac_name' => 'คณะเภสัชศาสตร์'],
         ['fac_name' => 'คณะเทคโนโลยี'],
         ['fac_name' => 'คณะสัตวแพทยศาสตร์'],
         ['fac_name' => 'คณะสถาปัตยกรรมศาสตร์'],
         ['fac_name' => 'คณะศิลปกรรมศาสตร์'],
         ['fac_name' => 'คณะนิติศาสตร์'],
         ['fac_name' => 'คณะบริหารธุรกิจและการบัญชี'],
         ['fac_name' => 'คณะเศรษฐศาสตร์'],
         ['fac_name' => 'วิทยาลัยการปกครองท้องถิ่น'],
         ['fac_name' => 'วิทยาลัยนานาชาติ'],
         ['fac_name' => 'วิทยาลัยการคอมพิวเตอร์'],
         ['fac_name' => 'วิทยาลัยบัณฑิตศึกษาการจัดการ'], // แก้ไขที่นี่
         ['fac_name' => 'บัณฑิตวิทยาลัย'],
         ['fac_name' => 'คณะสหวิทยาการ'],
      ];

      DB::table('faculties')->insert($faculties); //
   }
}
