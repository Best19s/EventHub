<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('home') }}">กิจกรรมทั้งหมด </a> <br>
                    <a href="{{ route('evt_wait') }}">กิจกรรมที่รออนุมัติ</a> <br>
                    <a href="{{ route('evt_app') }}">กิจกรรมที่อนุมัติแล้ว</a> <br>
                    <a href="{{ route('evt_inp') }}">กิจกรรมที่กำลังดำเนินการ</a> <br>
                    <a href="{{ route('evt_ended') }}">กิจกรรมที่สิ้นสุดแล้ว</a> <br>
                    <a href="{{ route('evt_deleted') }}">กิจกรรมที่เพิ่งลบ</a> <br>
                    <a href="{{ route('create_evt_form') }}">สร้างอีเว้นท์</a>

                    <h1 class="display-5">{{ $title }}</h1>
                    @if (session('status'))
                        <div class="alert alert-warning">
                            {{ session('status') }}
                        </div>
                    @endif

                    <style>
                        body {
                            /* background-color: aqua; */
                            font-family: "Kanit", Courier, monospace;
                        }

                        .card-container {
                            display: flex;
                            flex-wrap: wrap;
                            gap: 20px;
                            /* ระยะห่างระหว่างการ์ด */
                        }

                        .card {
                            width: 30%;
                            /* กำหนดความกว้างของการ์ด */
                            border: 1px solid black;
                            /* กรอบการ์ด */
                            padding: 15px;
                            /* ระยะห่างภายในการ์ด */
                            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
                            /* เงาของการ์ด */
                        }
                    </style>

                    <div class="card-container">
                        @foreach ($events as $evt)
                            <div class="card">
                                <h5 class="card-title">{{ $evt->evt_name }}</h5>
                                <p><strong>รหัสอีเว้นท์:</strong> {{ $evt->id_evt }}</p>
                                <p><strong>ประเภทกิจกรรม:</strong> {{ $evt->eventType->evt_type_name }}
                                    @if ($evt->is_student_only == 1)
                                        , เฉพาะนักศึกษา
                                    @endif
                                </p>
                                <p><strong>จำนวนผู้เข้าร่วม:</strong> {{ $evt->attendant_count }}</p>
                                <p><strong>จำนวนสูงสุดผู้เข้าร่วม:</strong> {{ $evt->evt_max_attendant }}</p>
                                <p><strong>สถานที่จัด:</strong> {{ $evt->evt_addr }}</p>
                                <p><strong>วันที่เริ่มกิจกรรม:</strong>
                                    {{ \Carbon\Carbon::parse($evt->evt_start_date)->format('d-m-Y H:i') }} -
                                    {{ \Carbon\Carbon::parse($evt->evt_end_date)->format('d-m-Y H:i') }}</p>
                                <p><strong>วันที่เริ่มลงทะเบียน:</strong>
                                    {{ \Carbon\Carbon::parse($evt->evt_reg_start_date)->format('d-m-Y H:i') }} -
                                    {{ \Carbon\Carbon::parse($evt->evt_reg_end_date)->format('d-m-Y H:i') }}</p>
                                <p><strong>สถานะอีเว้นท์:</strong> {{ $evt->statusEvent->status_evt_name }}</p>
                                <div class="btn-column">
                                    <div class="d-flex justify-content-between mb-2">
                                        <a href="\update\{{ $evt->id_evt }}" class="btn btn-primary">แก้ไข</a>
                                        <a href="\delete\{{ $evt->id_evt }}" class="btn btn-danger"
                                            onclick="return confirm('ต้องการจะลบ Event {{ $evt->evt_name }} จริงหรือไม่?')">ลบ</a>
                                    </div>
                                    <a href="\reg\{{ $evt->id_evt }}"
                                        class="btn btn-success mb-2">อนุมัติผู้เข้าร่วม</a>
                                    <a href="/report/{{ $evt->id_evt }}" class="btn btn-info mb-2">ดูรายงานกิจกรรม</a>
                                </div>


                            </div>
                        @endforeach
                    </div>
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
