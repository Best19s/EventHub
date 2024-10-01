<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>
    @extends('layouts.evt_detail')
    @section('title', $evt->evt_name)
    @php
        $registrationStart = \Carbon\Carbon::parse($evt->evt_reg_start_date);
        $registrationEnd = \Carbon\Carbon::parse($evt->evt_reg_end_date);
        $eventStart = \Carbon\Carbon::parse($evt->evt_start_date);
        $eventEnd = \Carbon\Carbon::parse($evt->evt_end_date);
        $dates = [];
        if ($eventStart->eq($eventEnd)) {
            // ถ้าวันเริ่มและวันสุดท้ายเป็นวันเดียวกัน ให้แสดงวันที่เริ่มกิจกรรมเลย
            $dates[] = $eventStart->format('Y-m-d');
        } else {
            // ถ้าวันเริ่มและวันสุดท้ายไม่ใช่วันเดียวกัน ให้เก็บข้อมูลตามช่วงวันที่ รวมถึงวันสุดท้ายด้วย
            for ($date = $eventStart->copy(); $date->lte($eventEnd); $date->addDay()) {
                $dates[] = $date->format('Y-m-d');
            }
        }
    @endphp
    <div class="container-fluid">
        @section('content')


            <div class="img-wrapper">
                <img src="{{ asset('storage/images/events/' . $evt->evt_img) }}" alt="ภาพกิจกรรม" width="100%" height="500px" style="object-fit: cover"
                    height="auto">
            </div>


            <div class="heading">
                <h1>{{ $evt->evt_name }}</h1>
                <div class="evt-detail" style="white-space: pre-wrap;">
                    <p>{{ $evt->evt_detail }}</p>
                </div>
            </div>
            <div class="evt_reg">
                <a href="/" class="btn">กลับ</a>
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
                <div class="reg">
                    <h4><i class="bi bi-calendar-check-fill"></i> เวลาลงทะเบียน</h4>
                    <p>
                        @if (\Carbon\Carbon::parse($registrationStart)->isSameDay(\Carbon\Carbon::parse($registrationEnd)))
                            {{ \Carbon\Carbon::parse($registrationStart)->format('d F Y') }}
                            เวลา {{ \Carbon\Carbon::parse($registrationStart)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($registrationEnd)->format('H:i') }}
                        @else
                            {{ \Carbon\Carbon::parse($registrationStart)->format('d') }} -
                            {{ \Carbon\Carbon::parse($registrationEnd)->format('d F Y') }}
                            เวลา {{ \Carbon\Carbon::parse($registrationStart)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($registrationEnd)->format('H:i') }}
                        @endif
                    </p>

                    @if (now()->between($registrationStart, $registrationEnd))
                        <p class="alert alert-success">ตอนนี้อยู่ในช่วงลงทะเบียน</p>
                    @elseif (now()->lt($registrationStart))
                        <p class="alert alert-warning">รอลงทะเบียน</p>
                    @elseif (now()->gt($registrationEnd))
                        <p class="alert alert-danger">หมดเวลาลงทะเบียนแล้ว</p>
                    @endif



                </div>

                <div class="evt_start">
                    <h4><i class="bi bi-calendar-check-fill"></i> เวลาที่เริ่มกิจกรรม</h4>
                    @if (\Carbon\Carbon::parse($eventStart)->isSameDay(\Carbon\Carbon::parse($eventEnd)))
                        {{ \Carbon\Carbon::parse($eventStart)->format('d F Y') }}
                        เวลา {{ \Carbon\Carbon::parse($eventStart)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($eventEnd)->format('H:i') }}
                    @else
                        {{ \Carbon\Carbon::parse($eventStart)->format('d') }} -
                        {{ \Carbon\Carbon::parse($eventEnd)->format('d F Y') }}
                        เวลา {{ \Carbon\Carbon::parse($eventStart)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($eventEnd)->format('H:i') }}
                    @endif

                </div>

                @if (now()->lt($eventStart))
                    <p class="alert alert-info">กิจกรรมยังไม่เริ่ม</p>
                @elseif (now()->between($eventStart, $eventEnd))
                    <p class="alert alert-success">กิจกรรมกำลังดำเนินอยู่</p>
                @elseif (now()->gt($eventEnd))
                    <p class="alert alert-warning">กิจกรรมสิ้นสุดแล้ว</p>
                @endif


                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="btn-reg">
                    <a href="/event-form/{{ $evt->id_evt }}">ลงทะเบียน</a>
                </div>

            </div>
        @endsection
    </div>

</body>

</html>




<script>
    // แปลงวันที่เป็น timestamp
    const registrationEnd = new Date("{{ $registrationEnd }}").getTime();
    const eventEnd = new Date("{{ $eventEnd }}").getTime();

    function startCountdown(endTime, elementId) {
        const countdownElement = document.getElementById(elementId);
        const interval = setInterval(() => {
            const now = new Date().getTime();
            const distance = endTime - now;

            // คำนวณวัน ชั่วโมง นาที และวินาที
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (distance <= 0) {
                // ถ้าเวลาผ่านไปแล้ว ให้หยุดการนับถอยหลังและล้างข้อความ
                clearInterval(interval);
                countdownElement.innerHTML = "";
                return;
            }
            // แสดงผล
            countdownElement.innerHTML = `${days} วัน, ${hours} ชั่วโมง, ${minutes} นาที, ${seconds} วินาที`;



        }, 1000);
    }

    // เริ่มการนับถอยหลัง
    startCountdown(registrationEnd, "registration-timer");
    startCountdown(eventEnd, "event-timer");
</script>
