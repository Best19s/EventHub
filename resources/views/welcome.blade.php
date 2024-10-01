<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>EventHub - @yield('title')</title>
</head>

<body>
   
    @extends('layouts.home')

    @section('title', 'EventHub')

    @section('content')
        <div class="container-fluid">

            {{-- section header --}}
            <section>
                <div class="text">
                    <h1>EventHub</h1>
                    <p>ที่เดียวครบจบทุกกิจกรรม</p>
                </div>
                <div class="img">
                    <img src="{{ asset('storage/images/img-head/element.png') }}" alt="Logo" />
                </div>
            </section>
            {{-- end section header --}}

            {{-- head title --}}
            <h2 class="head-title">กิจกรรมมาใหม่ล่าสุด</h2>

            <div class="row">
                {{-- fetch data from UserController --}}
                @foreach ($events as $event)
                    {{-- column of cards --}}
                    <div class="col-4 mb-5">
                        {{-- card container --}}
                        <div class="card d-flex flex-column rounded" style="height: 100%;">

                            <div class="rounded-top" style="width: 100%; height: 200px; overflow: hidden;">

                                {{-- status event --}}
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

                                {{-- card img event --}}
                                <img src="{{ asset('storage/images/events/' . $event->evt_img) }}" alt="ภาพกิจกรรม"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            {{-- card body --}}
                            <div class="card-body d-flex flex-column flex-grow-1">



                                {{-- card info event --}}
                                <h5 class="card-title">{{ $event->evt_name }}</h5>
                                <p>ประเภทกิจกรรม: {{ $event->eventType->evt_type_name }}</p>

                                <p class="card-text">
                                    {{-- event start date until end date --}}
                                    <strong><i class="bi bi-calendar-week-fill"></i></strong>
                                    {{ \Carbon\Carbon::parse($event->evt_start_date)->format('j') }} -
                                    {{ \Carbon\Carbon::parse($event->evt_end_date)->format('j') }}
                                    {{ \Carbon\Carbon::parse($event->evt_end_date)->translatedFormat('F Y') }}<br>

                                    {{-- event start time until end time --}}
                                    <strong><i class="bi bi-alarm-fill"></i></strong>
                                    {{ \Carbon\Carbon::parse($event->evt_start_date)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($event->evt_end_date)->format('H:i') }}<br>

                                    {{-- event address --}}
                                    <strong><i class="bi bi-geo-alt-fill"></i></strong> {{ $event->evt_addr }}

                                    {{-- if event for students only --}}
                                    @if ($event->is_student_only == 1)
                                        <p>เฉพาะนักศึกษาเท่านั้น</p>
                                    @endif
                                </p>

                                {{-- link to user-reg --}}
                                <a href="/event/{{ $event->id_evt }}" class="btn btn-primary mt-auto"
                                    id="btn-reg">ลงทะเบียน</a>

                            </div>
                            {{-- end card body --}}
                        </div>
                        {{-- end card container --}}
                    </div>
                    {{-- end card column --}}
                @endforeach
            </div>

            {{-- link pages --}}
            <div class="mt-4">
                {{ $events->links() }}
            </div>
        </div>
    @endsection

</body>

</html>
