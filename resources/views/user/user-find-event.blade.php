<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/find.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @extends('layouts.find')
    @section('title', 'ค้นหาอีเว้นท์')


</head>

<body>
    <div class="container-fluid">
        @section('content')

            <div class="filter-warpper">


                <div class="filter">

                    <h2><i class="bi bi-filter-circle"></i> ค้นหาอีเว้นท์</h2>
                    <form action="/evt/find/filter" method="post" class="form-filter">
                        @csrf
                        <div class="evt_date">

                            <label for="">เลือกวันที่เริ่มอีเว้นท์</label>
                            <input type="date" name="evt_date" id="">
                        </div>

                        <div class="evt_type">

                            <label for="evt_type">ใส่ประเภทกิจกรรม : </label>
                            <select name="evt_type">
                                <option value="">เลือกประเภทกิจกรรม</option>
                                @foreach ($evt_type as $type)
                                    <option value="{{ $type->id_evt_type }}">{{ $type->evt_type_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="evt_addr">
                            <label for="">ค้นหาสถานที่</label>
                            <input type="text" name="evt_addr" id="" placeholder="สถานที่">
                        </div>


                        <div class="std">
                            <h4><i class="bi bi-book"></i> สำหรับนักศึกษา</h4>
                            <input type="checkbox" name="std_only" id="" value="1">
                            <label for="">เฉพาะนักศึกษา</label>
                        </div>

                        <input type="submit" value="ค้นหา">
                    </form>
                </div>



            </div>


            <div class="evt">
                <div class="find_by_name">
                    <form action="/evt/find/name" method="post">
                        @csrf
                        <label for="">ค้นหาชื่ออีเว้นท์</label> <br>
                        <input type="search" name="searching" id="">
                        <input type="submit" value="ค้นหา">
                    </form>
                </div>
                <h2 class="head-title">กิจกรรมทั้งหมด</h2>
                @if (session('error'))
                    <div class="alert alert-danger" style="margin-left: 23%">{{ session('error') }}</div>
                @endif
                <div class="row">
                    @foreach ($evt as $event)
                        <div class="col-6 mb-5">
                            <div class="card d-flex flex-column rounded" style="height: 100%;">
                                @if ($event->evt_img)
                                    <div class="rounded-top" style="width: 100%; height: 200px; overflow: hidden;">
                                        @php
                                            $currentDate = \Carbon\Carbon::now();
                                            $startRegDate = \Carbon\Carbon::parse($event->evt_reg_start_date);
                                            $endRegDate = \Carbon\Carbon::parse($event->evt_reg_end_date);
                                        @endphp

                                        @if ($currentDate->between($startRegDate, $endRegDate))
                                            <span class="badge bg-success status_evt">อยู่ในช่วงลงทะเบียน</span>
                                        @elseif ($currentDate->lt($startRegDate))
                                            <span class="badge bg-warning status_evt">รอลงทะเบียน</span>
                                        @elseif ($currentDate->gt($endRegDate))
                                            <span class="badge bg-secondary status_evt">หมดเวลาลงทะเบียน</span>
                                        @endif
                                        <img src="{{ asset('storage/images/events/' . $event->evt_img) }}" alt="ภาพกิจกรรม"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endif
                                <div class="card-body flex-grow-1">
                                    <h5 class="card-title">{{ $event->evt_name }}</h5>
                                    <p>ประเภทกิจกรรม: {{ $event->eventType->evt_type_name }}</p>
                                    <p class="card-text">
                                        <strong><i class="bi bi-calendar-week-fill"></i></strong>
                                        {{ \Carbon\Carbon::parse($event->evt_start_date)->format('j') }} -
                                        {{ \Carbon\Carbon::parse($event->evt_end_date)->format('j') }}
                                        {{ \Carbon\Carbon::parse($event->evt_end_date)->translatedFormat('F Y') }}<br>

                                        <strong><i class="bi bi-alarm-fill"></i></strong>
                                        {{ \Carbon\Carbon::parse($event->evt_start_date)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($event->evt_end_date)->format('H:i') }}<br>
                                        <strong><i class="bi bi-geo-alt-fill"></i></strong> {{ $event->evt_addr }}
                                        @if ($event->is_student_only == 1)
                                            <p>เฉพาะนักศึกษาเท่านั้น</p>
                                        @endif
                                    </p>

                                    <a href="/event/{{ $event->id_evt }}" class="btn">ลงทะเบียน</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        @endsection
    </div>


</body>

</html>
