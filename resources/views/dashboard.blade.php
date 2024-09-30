
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    @extends('layouts.home')
    @section('title', 'EventHub')


</head>

<body>

    @section('content')

        <div class="container-fluid">

            <section>
                <div class="text">
                    <h1>EventHub</h1>
                    <p>ที่เดียวครบจบทุกกิจกรรม</p>
                </div>
                <div class="img">
                    <img src="{{ asset('storage/images/img-head/element.png') }}" alt="Logo" />
                </div>
            </section>



            <div class="new_evt">
                <h2 class="head-title">กิจกรรมมาใหม่ล่าสุด</h2>
                <div class="row">
                    @foreach ($events as $event)
                        <div class="col-6">
                            <div class="card d-flex flex-column rounded" style="height: 100%;">
                                @if ($event->evt_img)
                                    <div class="rounded-top" style="width: 100%; height: 200px; overflow: hidden;">
                                        <img src="{{ asset('storage/images/events/' . $event->evt_img) }}" alt="ภาพกิจกรรม"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endif
                                <div class="card-body flex-grow-1">
                                    <h5 class="card-title">{{ $event->evt_name }}</h5>
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

            <div class="mt-4">
               {{ $events->links() }}
           </div>

        @endsection



        {{-- <div class="img-ad">
           <img src="{{ asset('storage/images/events/1727370470.jpg')}}" alt="">
          </div> --}}

        {{-- <h2>กิจกรรมทั้งหมด</h2>
          <div class="row">
              @foreach ($events as $event)
                  <div class="col-md-4 mb-4">
                      <div class="card d-flex flex-column" style="height: 100%;">
                          <div class="card-body flex-grow-1">
                              @if ($event->evt_img)
                                  <div style="width: 100%; height: 150px; object-fit: cover; overflow: hidden;">
                                      <img src="{{ asset('storage/images/events/' . $event->evt_img) }}"
                                          alt="ภาพกิจกรรม">
                                  </div>
                              @endif
                              <h5 class="card-title">{{ $event->evt_name }}</h5>
                              <p class="card-text">
                                  <strong>วันที่:</strong>
                                  {{ \Carbon\Carbon::parse($event->evt_start_date)->format('d/m/Y') }}<br>
                                  <strong>เวลา:</strong>
                                  {{ \Carbon\Carbon::parse($event->evt_start_date)->format('H:i') }}<br>
                                  <strong>สถานที่:</strong> {{ $event->evt_addr }}
                                  @if ($event->is_student_only == 1)
                                      <p>เฉพาะนักศึกษาเท่านั้น</p>
                                  @endif
                              </p>
                              <a href="/event/{{ $event->id_evt }}" class="btn btn-primary">ลงทะเบียน</a>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>

      </div> --}}
    </div>


</body>

</html>
