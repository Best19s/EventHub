<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    @php
        $registrationStart = \Carbon\Carbon::parse($evt->evt_reg_start_date);
        $registrationEnd = \Carbon\Carbon::parse($evt->evt_reg_end_date);
        $eventStart = \Carbon\Carbon::parse($evt->evt_start_date);
        $eventEnd = \Carbon\Carbon::parse($evt->evt_end_date);
        $dates = [];
        if ($eventStart->eq($eventEnd)) {
            // วันเริ่มและวันสุดท้ายเป็นวันเดียวกัน แสดงวันที่เริ่มกิจกรรม
            $dates[] = $eventStart->format('Y-m-d');
        } else {
            // วันเริ่มและวันสุดท้ายไม่ใช่วันเดียวกัน เก็บข้อมูลตามช่วงวันที่ รวมถึงวันสุดท้าย
            for ($date = $eventStart->copy(); $date->lte($eventEnd); $date->addDay()) {
                $dates[] = $date->format('Y-m-d');
            }
        }
    @endphp

</head>

<body>
    @extends('layouts.evt_detail')
    @section('title', $evt->evt_name)



    @section('content')



        <div class="evt_info">
            <div class="img-wrapper">
                <img src="{{ asset('storage/images/events/' . $evt->evt_img) }}" alt="ภาพกิจกรรม" width="100%"
                    height="500px" style="object-fit: cover" height="auto">
            </div>
            <h1>{{ $evt->evt_name }}</h1>
            <p>{{ $evt->evt_detail }}</p>
        </div>
        <div class="evt_reg">
            <a href="{{ url('/event/' . $evt->id_evt) }}" class="btn">กลับ</a>


            <div class="tag">
                <h4>ประเภทกิจกรรม - <span>{{ $evt->eventType->evt_type_name }}</span></h4>

            </div>
            <h2>รายละเอียดกิจกรรม</h2> <br>
            <strong><i class="bi bi-calendar-week-fill"></i></strong>
            {{ \Carbon\Carbon::parse($evt->evt_start_date)->format('j') }} -
            {{ \Carbon\Carbon::parse($evt->evt_end_date)->format('j') }}
            {{ \Carbon\Carbon::parse($evt->evt_end_date)->translatedFormat('F Y') }}<br>
            <br>

            <strong><i class="bi bi-alarm-fill"></i></strong>
            {{ \Carbon\Carbon::parse($evt->evt_start_date)->format('H:i') }} -
            {{ \Carbon\Carbon::parse($evt->evt_end_date)->format('H:i') }}<br>
            <br>
            <strong><i class="bi bi-geo-alt-fill"></i></strong> {{ $evt->evt_addr }} <br>
            <br>
            <strong><i class="bi bi-person-circle"></i></strong> {{ $evt->evt_host }}
            @if ($evt->is_student_only == 1)
                <p class="alert alert-primary" role="alert">เฉพาะนักศึกษาเท่านั้น</p>
            @endif
            <br>
        </div>
        <div class="form-reg">


           <form action="{{ route('user_reg') }}" method="POST" id="registration-form">
               @csrf
               @if (session('error_evt'))
                   <div class="alert alert-danger">
                       {{ session('error_evt') }}
                   </div>
               @endif
               @if (session('error'))
                   <div class="alert alert-danger">
                       {{ session('error') }}
                   </div>
               @endif
               <h4>เลือกวันเข้าร่วมอีเว้นท์</h4>
               @foreach ($dates as $date)
                   <label>
                       <input type="checkbox" name="dates[]" value="{{ $date }}"> วันที่
                       {{ \Carbon\Carbon::parse($date)->format('j') }}
                   </label><br>
               @endforeach

               <input type="hidden" name="id_evt" value="{{ $evt->id_evt }}">
               <input type="hidden" name="id_user" value="{{ $user->id }}">
               <input type="hidden" name="password" value="{{ $user->password }}">
               <div class="info">

                   <h4>ข้อมูลผู้เข้าร่วม</h4>
                   <div class="name">
                       <label for="name">ชื่อผู้เข้าร่วม:</label> <br>
                       <input type="text" name="name" value="{{ $user->name }}" readonly>
                   </div>
                   <div class="email">
                       <label for="email">อีเมลล์:</label> <br>
                       <input type="text" name="email" value="{{ $user->email }}" readonly>
                   </div>
                   <div class="phone">
                       <label for="phone">เบอร์โทรศัพท์:</label> <br>
                       <input type="text" name="phone" value="{{ $user->phone }}" readonly>
                   </div>
               </div>


               <div class="std">
                   <div class="std">
                       <h4 for="student-checkbox"> <input type="checkbox" name="std"
                               id="student-checkbox">สำหรับนักศึกษา</h4>
                   </div>

               </div>
               <div class="std_id">
                   <label for="std_id">รหัสนักศึกษา:</label> <br>
                   <input type="text" name="std_id" id="std_id" value="{{ $user->std_id ?? '' }}"
                       {{ !empty($user->std_id) ? 'readonly' : '' }}>
               </div>

               <div class="fac">
                   <label for="faculty">เลือกคณะ:</label> <br>
                   <select id="faculty" name="faculty" {{ !empty($user->std_id) ? 'disabled' : '' }}>

                       @if (empty($user->std_id))
                           <option value="">เลือกคณะ</option>
                           @foreach ($facs as $fac)
                               <option value="{{ $fac->idFaculties }}">{{ $fac->fac_name }}</option>
                           @endforeach
                       @else
                           <option value="{{ $user->department->faculty->idFaculties ?? '' }}">
                               {{ optional($user->department->faculty)->fac_name ?? 'เลือกคณะ' }}
                           </option>
                       @endif
                   </select>
               </div>


               <div class="major">
                   <label for="major">เลือกสาขา:</label> <br>
                   <select id="major" name="major" {{ !empty($user->std_id) ? 'disabled' : '' }}>
                       @if (empty($user->std_id))
                           <option value="">เลือกสาขา:</option>
                           @foreach ($depts as $dept)
                               <option data-faculty-id="{{ $dept->faculty->idFaculties }}"
                                   value="{{ $dept->idDepartments }}">
                                   {{ $dept->dept_name }}
                               </option>
                           @endforeach
                       @else
                           <option value="{{ $user->idDepartments ?? '' }}">
                               {{ optional($user->department)->dept_name ?? 'เลือกสาขา' }}
                           </option>
                       @endif
                   </select>
               </div>



               <input type="submit" value="ลงทะเบียน">
           </form>

        </div>
    @endsection
</body>

</html>
<script>
   document.addEventListener("DOMContentLoaded", function() {
       const studentCheckbox = document.getElementById("student-checkbox");
       const stdID = document.getElementById("std_id");
       const facultySelect = document.getElementById("faculty");
       const majorSelect = document.getElementById("major");

       // ปิดการใช้งาน dropdowns โดยเริ่มต้น
       facultySelect.disabled = true;
       majorSelect.disabled = true;
       stdID.disabled = true;

       // เปิดใช้งาน dropdowns เมื่อ checkbox ถูกติ๊ก
       studentCheckbox.addEventListener("change", function() {
           if (this.checked) {
               facultySelect.disabled = false;
               majorSelect.disabled = false;
               stdID.disabled = false;
           } else {
               facultySelect.disabled = true;
               majorSelect.disabled = true;
               stdID.disabled = true;
               // ไม่ทำการรีเซ็ตค่าฟิลด์
           }
       });


       // ฟังก์ชันที่มีอยู่แล้วสำหรับการกรองสาขาวิชาตามคณะที่เลือก
       facultySelect.addEventListener("change", function() {
           const selectedFacultyId = this.value;

           // ซ่อนทุกตัวเลือกในตอนแรก
           for (let option of majorSelect.options) {
               option.style.display = "none"; // ซ่อนทุกตัวเลือก
           }

           // แสดงเฉพาะตัวเลือกที่เกี่ยวข้อง
           for (let option of majorSelect.options) {
               if (option.value === "" || option.dataset.facultyId === selectedFacultyId) {
                   option.style.display = "block"; // แสดงตัวเลือกที่ตรงกับคณะที่เลือก
               }
           }

           // รีเซ็ตการเลือกใน major select ให้เป็นค่าดีฟอลต์
           majorSelect.value = ""; // ล้างการเลือก
       });
   });
</script>
