<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @extends('layouts.admin_home')
    @section('title', 'Admin_Dashboard')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @section('content')

    <h4>กรองสถานะกิจกรรม</h4>
        <select id="eventSelect" onchange="navigateToPage()">
            <option value="">{{ __('เลือกกิจกรรม') }}</option>
            <option value="{{ route('home') }}">กิจกรรมทั้งหมด</option>
            <option value="{{ route('evt_wait') }}">กิจกรรมที่รออนุมัติ</option>
            <option value="{{ route('evt_app') }}">กิจกรรมที่อนุมัติแล้ว</option>
            <option value="{{ route('evt_inp') }}">กิจกรรมที่กำลังดำเนินการ</option>
            <option value="{{ route('evt_ended') }}">กิจกรรมที่สิ้นสุดแล้ว</option>
            <option value="{{ route('evt_deleted') }}">กิจกรรมที่เพิ่งลบ</option>
        </select>

        <script>
            function navigateToPage() {
                var selectedValue = document.getElementById('eventSelect').value;
                if (selectedValue) {
                    window.location.href = selectedValue;
                }
            }
        </script>



        <h1 class="display-5">{{ $title }}</h1>
        @if (session('status'))
            <div class="alert alert-warning">
                {{ session('status') }}
            </div>
        @endif



        {{-- <div class="container"> --}}
        <div class="row">
            @foreach ($events as $evt)
                <div class="col-4 mb-5">
                    <div class="card d-flex flex-column rounded" style="height: 100%;">
                        @if ($evt->evt_img)
                            <div class="rounded-top" style="width: 100%; height: 200px; overflow: hidden;" id="img_wrapper">
                                <div id="btn-link">
                                    <a href="\update\{{ $evt->id_evt }}" class="btn btn-primary"><i
                                            class="bi bi-pen-fill"></i></a>
                                    <a href="\delete\{{ $evt->id_evt }}" class="btn btn-danger"
                                        onclick="return confirm('ต้องการจะลบ Event {{ $evt->evt_name }} จริงหรือไม่?')"><i
                                            class="bi bi-trash3-fill"></i></a>
                                </div>
                                <div class="prt-count">
                                    <p><strong>จำนวนผู้เข้าร่วม:</strong> {{ $evt->attendant_count }} /
                                        {{ $evt->evt_max_attendant }}</p>
                                </div>
                                <img src="{{ asset('storage/images/events/' . $evt->evt_img) }}" alt="ภาพกิจกรรม"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <p class="tag"><strong>รหัสอีเว้นท์:</strong> {{ $evt->id_evt }}</p>
                            <h5 class="card-title">{{ $evt->evt_name }}</h5>
                            <p><strong>ผู้จัดทำ:</strong> {{ $evt->evt_host }}</p>
                            <p class="card-text">
                                <strong>ที่อยู่:</strong> {{ $evt->evt_addr }}<br>

                            </p>

                            <p><strong>ประเภทกิจกรรม:</strong> {{ $evt->eventType->evt_type_name }}
                                @if ($evt->is_student_only == 1)
                                    , เฉพาะนักศึกษา
                                @endif
                            </p>


                            <p><strong><i class="bi bi-calendar-fill"></i> วันที่ลงทะเบียน:</strong> <br>
                                {{ \Carbon\Carbon::parse($evt->evt_reg_start_date)->translatedFormat('d') }} -
                                {{ \Carbon\Carbon::parse($evt->evt_reg_end_date)->translatedFormat('d F Y') }}
                                {{ \Carbon\Carbon::parse($evt->evt_reg_start_date)->translatedFormat('H:i') }} -
                                {{ \Carbon\Carbon::parse($evt->evt_reg_end_date)->translatedFormat('H:i') }}
                            </p>
                            <p><strong><i class="bi bi-calendar-fill"></i> วันที่จัดกิจกรรม:</strong> <br>
                                {{ \Carbon\Carbon::parse($evt->evt_start_date)->translatedFormat('d') }} -
                                {{ \Carbon\Carbon::parse($evt->evt_end_date)->translatedFormat('d F Y') }}
                                {{ \Carbon\Carbon::parse($evt->evt_start_date)->translatedFormat('H:i') }} -
                                {{ \Carbon\Carbon::parse($evt->evt_end_date)->translatedFormat('H:i') }}
                            </p>

                            <p><strong>สถานะอีเว้นท์:</strong> {{ $evt->statusEvent->status_evt_name }}</p>
                            <div class="btn-column mt-auto">

                                <div class="btn-opt">
                                    <a href="\reg\{{ $evt->id_evt }}" class="btn btn-success mb-2"><i
                                            class="bi bi-check-circle-fill mt-auto"></i> อนุมัติผู้เข้าร่วม</a>
                                    <a href="/report/{{ $evt->id_evt }}" class="btn btn-info mb-2"><i
                                            class="bi bi-file-earmark-check-fill mt-auto"></i> ดูรายงานกิจกรรม</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
        <div id="page">
            {{ $events->links() }}
        </div>

    @endsection
</body>

</html>
