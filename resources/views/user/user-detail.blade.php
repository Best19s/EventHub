<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @extends('layouts.user-detail')
    @section('title', 'รายละเอียดเข้าร่วม')
</head>

<body>

    @section('content')

        <div class="container-fluid">
            <a href="/" class="btn_back mb-2">กลับ</a>

            <h1>ประวัติการลงทะเบียนอีเว้นท์</h1>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif




            <div class="evt_status">

                <h2>สถานะกิจกรรม</h2>
                @if (session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="row ">
                    @foreach ($evt as $event)
                        <div class="card mb-4 mr-4" style="width: 30%;">
                            <img src="{{ asset('storage/images/events/' . $event->event->evt_img) }}" height="180px"
                                style="object-fit: cover" class="card-img-top" alt="ภาพกิจกรรม">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $event->event->evt_name }}</h5>
                                <p class="card-text">
                                    <strong>สถานที่:</strong> {{ $event->event->evt_addr }}<br>
                                    <strong>สถานะผู้เข้าร่วม:</strong> {{ $event->statusUser->status_user_name }} <br>
                                    <strong>ลงทะเบียนวันที่:</strong> {{ \Carbon\Carbon::parse($event->created_at)->format('d/m/Y') }}
                                </p>
                                @if ($event->id_status_user == 5)
                                    {{-- <p>{{ $event->statusUser->status_user_name }}</p> --}}
                                    <p>ลงทะเบียนวันที่:
                                        {{ \Carbon\Carbon::parse($event->join_first_date)->format('d/m/Y') }}
                                    </p>
                                    <p>เข้าร่วมถึงวันที่สุดท้าย:
                                        {{ \Carbon\Carbon::parse($event->join_last_date)->format('d/m/Y') }}</p>
                                    <div class="alert alert-success">{{ $event->statusUser->status_user_name }}</div>
                                @elseif ($event->id_status_user == 1)
                                    <a href="/event/unreg/{{ $event->id }}" class="btn btn-danger mt-3 mt-auto"
                                        onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการยกเลิกการลงทะเบียน?')">ยกเลิกลงทะเบียน</a>
                                @else
                                    <p>เข้าร่วมวันที่:
                                        {{ \Carbon\Carbon::parse($event->join_first_date)->format('d/m/Y') }}
                                    </p>
                                    <p>เข้าร่วมถึงวันที่สุดท้าย:
                                        {{ \Carbon\Carbon::parse($event->join_last_date)->format('d/m/Y') }}</p>
                                    <a href="/feedback/{{ $event->event->id_evt }}"
                                        class="btn btn-primary mt-auto">ประเมินผล</a>
                                    <a href="/event/unreg/{{ $event->id }}" class="btn btn-danger mt-3  "
                                        onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการยกเลิกการลงทะเบียน?')">ยกเลิกลงทะเบียน</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if ($status_done)
                <div class="evt_review">

                    <h2>กิจกรรมที่ประเมินผลแล้ว</h2>
                    <div class="row">
                        @foreach ($status_done as $event)
                            <div class="card mb-4 mr-4" style="width: 30%;">
                                <img src="{{ asset('storage/images/events/' . $event->event->evt_img) }}" width="20%"
                                    class="card-img-top" alt="ภาพกิจกรรม">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $event->event->evt_name }}</h5>
                                    <p class="card-text">
                                        <strong>ที่อยู่:</strong> {{ $event->event->evt_addr }}<br>
                                        <strong>สถานะ:</strong> {{ $event->statusUser->status_user_name }}
                                    </p>
                                    <p>ลงทะเบียนวันที่:
                                        {{ \Carbon\Carbon::parse($event->join_first_date)->format('d/m/Y') }}
                                    </p>
                                    <p>เข้าร่วมถึงวันที่สุดท้าย:
                                        {{ \Carbon\Carbon::parse($event->join_last_date)->format('d/m/Y') }}</p>
                                    <div class="alert alert-success mt-auto">{{ $event->statusUser->status_user_name }}
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
            @endif
        </div>


        </div>
    @endsection
</body>

</html>
