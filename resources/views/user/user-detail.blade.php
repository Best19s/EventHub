<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<x-app-layout>


    <div class="container">
        <h1 style="font-size: 2rem">ประวัติการลงทะเบียนอีเว้นท์</h1>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif




        <h2>สถานะกิจกรรม</h2>
        <div class="row">
            @foreach ($evt as $event)
                <div class="card mb-4" style="width: 30%;">
                    <img src="{{ asset('storage/images/events/' . $event->event->evt_img) }}" width="20%"
                        class="card-img-top" alt="ภาพกิจกรรม">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->event->evt_name }}</h5>
                        <p class="card-text">
                            <strong>ที่อยู่:</strong> {{ $event->event->evt_addr }}<br>
                            <strong>สถานะ:</strong> {{ $event->statusUser->status_user_name }}
                        </p>
                        @if ($event->id_status_user == 5)
                            {{-- <p>{{ $event->statusUser->status_user_name }}</p> --}}
                            <p>ลงทะเบียนวันที่: {{ \Carbon\Carbon::parse($event->join_first_date)->format('d/m/Y') }}
                            </p>
                            <p>เข้าร่วมถึงวันที่สุดท้าย:
                                {{ \Carbon\Carbon::parse($event->join_last_date)->format('d/m/Y') }}</p>
                            <div class="alert alert-success">{{ $event->statusUser->status_user_name }}</div>
                        @elseif ($event->id_status_user == 1)
                            <a href="/event/unreg/{{$event->id}}" class="btn btn-danger">ยกเลิกลงทะเบียน</a>
                        @else
                            <p>ลงทะเบียนวันที่: {{ \Carbon\Carbon::parse($event->join_first_date)->format('d/m/Y') }}
                            </p>
                            <p>เข้าร่วมถึงวันที่สุดท้าย:
                                {{ \Carbon\Carbon::parse($event->join_last_date)->format('d/m/Y') }}</p>
                            <a href="/feedback/{{ $event->event->id_evt }}" class="btn btn-primary">ประเมินผล</a>
                            <a href="" class="btn btn-danger">ยกเลิกลงทะเบียน</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @if ($status_done)
            <h2>กิจกรรมที่ประเมินผลแล้ว</h2>
            <div class="row">
                @foreach ($status_done as $event)
                    <div class="card mb-4" style="width: 30%;">
                        <img src="{{ asset('storage/images/events/' . $event->event->evt_img) }}" width="20%"
                            class="card-img-top" alt="ภาพกิจกรรม">
                        <div class="card-body">
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
                            <div class="alert alert-success">{{ $event->statusUser->status_user_name }}</div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif


    </div>

</x-app-layout>
