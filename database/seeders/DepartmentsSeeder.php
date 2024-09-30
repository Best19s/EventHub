<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      $departments = [
         ['dept_name' => 'วิศวกรรมโยธา', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมไฟฟ้า', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมเกษตร', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมอุตสาหการ', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมเครื่องกล', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมสิ่งแวดล้อม', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมเคมี', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมคอมพิวเตอร์', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมโทรคมนาคม', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมโลจิสติกส์', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมสื่อดิจิทัล', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมระบบอัตโนมั้ติ หุ่นยนต์ และปัญญาประดิษฐ์', 'idFaculties' => 2],
         ['dept_name' => 'วิศวกรรมระบบอิเล็กทรอนิกส์', 'idFaculties' => 2],

         ['dept_name' => 'การสอนภาษาไทย', 'idFaculties' => 3],
         ['dept_name' => 'การสอนภาษาจีนฯ', 'idFaculties' => 3],
         ['dept_name' => 'การสอนภาษาอังกฤษฯ', 'idFaculties' => 3],
         ['dept_name' => 'การสอนภาษาญี่ปุ่น', 'idFaculties' => 3],
         ['dept_name' => 'คอมพิวเตอร์ศึกษา', 'idFaculties' => 3],
         ['dept_name' => 'วิทยาศาสตร์ศึกษา', 'idFaculties' => 3],
         ['dept_name' => 'คณิตศาสตรศึกษา', 'idFaculties' => 3],
         ['dept_name' => 'สังคมศึกษา', 'idFaculties' => 3],
         ['dept_name' => 'ศิลปศึกษา', 'idFaculties' => 3],
         ['dept_name' => 'พลศึกษา', 'idFaculties' => 3],

         ['dept_name' => 'ชีววิทยา', 'idFaculties' => 5],
         ['dept_name' => 'เคมี', 'idFaculties' => 5],
         ['dept_name' => 'ฟิสิกส์', 'idFaculties' => 5],
         ['dept_name' => 'คณิตศาสตร์', 'idFaculties' => 5],
         ['dept_name' => 'สถิติศาสตร์', 'idFaculties' => 5],
         ['dept_name' => 'สารสนเทศสถิติและวิทยาการข้อมูล', 'idFaculties' => 5],
         ['dept_name' => 'วัสดุศาสตร์และนาโนเทคโนโลยี', 'idFaculties' => 5],
         ['dept_name' => 'จุลชีววิทยา', 'idFaculties' => 5],
         ['dept_name' => 'วิทยาศาสตร์สิ่งแวดล้อม', 'idFaculties' => 5],
         ['dept_name' => 'เทคโนโลยีชีวภาพ', 'idFaculties' => 5],
         ['dept_name' => 'วิทยาศาสตร์การอาหาร', 'idFaculties' => 5],

         ['dept_name' => 'แพทยศาสตร์', 'idFaculties' => 6],
         ['dept_name' => 'เวชนิทัศน์', 'idFaculties' => 6],
         ['dept_name' => 'รังสีเทคนิค', 'idFaculties' => 6],
         ['dept_name' => 'วิทยาศาสตร์การแพทย์', 'idFaculties' => 6],
         ['dept_name' => 'เทคโนโลยีการศึกษาแพทยศาสตร์', 'idFaculties' => 6],

         ['dept_name' => 'ภาษาอังกฤษ', 'idFaculties' => 7],
         ['dept_name' => 'สารสนเทศศาสตร์', 'idFaculties' => 7],
         ['dept_name' => 'เอเชียตะวันออกเฉียงใต้ศึกษา', 'idFaculties' => 7],
         ['dept_name' => 'ภาษาไทย', 'idFaculties' => 7],
         ['dept_name' => 'ภาษาตะวันออก', 'idFaculties' => 7],
         ['dept_name' => 'ภาษาตะวันตก', 'idFaculties' => 7],
         ['dept_name' => 'รัฐประศาสนศาสตร์', 'idFaculties' => 7],
         ['dept_name' => 'สังคมวิทยาและมานุษยวิทยา', 'idFaculties' => 7],
         ['dept_name' => 'พัฒนาสังคม', 'idFaculties' => 7],

         ['dept_name' => 'เทคนิคการแพทย์', 'idFaculties' => 8],
         ['dept_name' => 'กายภาพบำบัด', 'idFaculties' => 8],

         ['dept_name' => 'สาธารณสุขศาสตร์', 'idFaculties' => 8],
         ['dept_name' => 'อาชีวอนามัยและความปลอดภัย', 'idFaculties' => 8],

         ['dept_name' => 'เทคโนโลยีธรณี', 'idFaculties' => 11],
         ['dept_name' => 'เทคโนโลยีชีวภาพ', 'idFaculties' => 11],
         ['dept_name' => 'เทคโนโลยีการอาหาร', 'idFaculties' => 11],
         ['dept_name' => 'เทคโนโลยีระบบการผลิตและการจัดการอุตสาหกรรม', 'idFaculties' => 11],
         ['dept_name' => 'วิทยาศาสตร์และเทคโนโลยีการประกอบอาหาร', 'idFaculties' => 11],

         ['dept_name' => 'กายวิภาคศาสตร์', 'idFaculties' => 13],
         ['dept_name' => 'พยาธิชีววิทยา', 'idFaculties' => 13],
         ['dept_name' => 'เภสัชวิทยาและพิษวิทยา', 'idFaculties' => 13],
         ['dept_name' => 'สรีรวิทยา', 'idFaculties' => 13],
         ['dept_name' => 'สัตวแพทย์สาธารณสุข', 'idFaculties' => 13],
         ['dept_name' => 'ศัลยศาสตร์', 'idFaculties' => 13],
         ['dept_name' => 'วิทยาการสืบพันธุ์', 'idFaculties' => 13],
         ['dept_name' => 'อายุรศาสตร์สัตว์เลี้ยง', 'idFaculties' => 13],
         ['dept_name' => 'อายุรศาสตร์ปศุสัตว์', 'idFaculties' => 13],

         ['dept_name' => 'สถาปัตยกรรมศาสตร์', 'idFaculties' => 14],
         ['dept_name' => 'การออกแบบอุตสาหกรรม', 'idFaculties' => 14],

         ['dept_name' => 'ทัศนศิลป์', 'idFaculties' => 15],
         ['dept_name' => 'ดุริยางคศิลป์', 'idFaculties' => 15],
         ['dept_name' => 'ออกแบบนิเทศศิลป์', 'idFaculties' => 15],
         ['dept_name' => 'ศิลปะการแสดง', 'idFaculties' => 15],

         ['dept_name' => 'การเงิน', 'idFaculties' => 17],
         ['dept_name' => 'การตลาด', 'idFaculties' => 17],
         ['dept_name' => 'การจัดการการประกอบการพาณิชย์และนวัตกรรม', 'idFaculties' => 17],
         ['dept_name' => 'การจัดการธุรกิจบริการและการจัดงาน', 'idFaculties' => 17],
         ['dept_name' => 'การจัดการอุตสาหกรรมการท่องเที่ยว', 'idFaculties' => 17],

         ['dept_name' => 'การจัดการปกครองเเละกิจการสาธารณะ', 'idFaculties' => 19],
         ['dept_name' => 'การจัดการเงินเเละการคลัง', 'idFaculties' => 19],
         ['dept_name' => 'การจัดการเมืองและเทคโนโลยีเมือง', 'idFaculties' => 19],
         ['dept_name' => 'การจัดการอุตสาหกรรมการท่องเที่ยว', 'idFaculties' => 19],

         ['dept_name' => 'การจัดการการท่องเที่ยว (หลักสูตรนานาชาติ)', 'idFaculties' => 20],
         ['dept_name' => 'การระหว่างประเทศ (หลักสูตรนานาชาติ)', 'idFaculties' => 20],
         ['dept_name' => 'เทคโนโลยีสื่อสร้างสรรค์ (หลักสูตรนานาชาติ)', 'idFaculties' => 20],
         ['dept_name' => 'วารสารศาสตร์ระหว่างประเทศ (หลักสูตรนานาชาติ)', 'idFaculties' => 20],
         ['dept_name' => 'ธุรกิจสากล (หลักสูตรนานาชาติ)', 'idFaculties' => 20],
         ['dept_name' => 'การตลาดระหว่างประเทศ (หลักสูตรนานาชาติ)', 'idFaculties' => 20],
         ['dept_name' => 'การเป็นผู้ประกอบการระหว่างประเทศ (หลักสูตรนานาชาติ)', 'idFaculties' => 20],

         ['dept_name' => 'วิทยาการคอมพิวเตอร์', 'idFaculties' => 21],
         ['dept_name' => 'เทคโนโลยีสารสนเทศ', 'idFaculties' => 21],
         ['dept_name' => 'ภูมิสารสนเทศศาสตร์', 'idFaculties' => 21],
         ['dept_name' => 'ปัญญาประดิษฐ์', 'idFaculties' => 21],
         ['dept_name' => 'ความมั่นคงปลอดภัยไซเบอร์', 'idFaculties' => 21],

         ['dept_name' => 'Executive MBA', 'idFaculties' => 22],
         ['dept_name' => 'Young Executive MBA', 'idFaculties' => 22]
      ];
      DB::table('departments')->insert($departments);
   }
}
