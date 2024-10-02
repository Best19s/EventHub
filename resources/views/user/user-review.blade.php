<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    @extends('layouts.user_review')
    @section('title', 'EventHub')
</head>

<body>
    @section('content')


    <a href="{{url()->previous()}}" class="btn mb-2">กลับ</a>
        <div class="form-warpper">

            <div class="box_info">
                <h1>{{ $event->event->evt_name }}</h1>
                <div class="img-wrapper">
                    <img src="{{ asset('storage/images/events/' . $event->event->evt_img) }}" alt="ภาพกิจกรรม"
                        width="100%" style="object-fit: cover" height="auto">
                </div>
                <p>เข้าร่วมวันที่: {{ $event->join_first_date }}</p>
                <p>{{ $event->event->evt_detail }}</p>
            </div>

            <form action="/feedback" method="POST" class="form-review">
                @csrf

                <div class="feedback">

                    <input type="hidden" name="id" value="{{ $event->id }}">
                    <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                    <input type="hidden" name="id_evt" value="{{ $event->id_evt }}">

                    <label for="fb">ข้อเสนอแนะเกี่ยวกับอีเว้นท์</label><br>
                    <textarea name="feedback" id="fb" cols="30" rows="10" required></textarea><br>
                </div>

                <div class="rating">
                    <label>คะแนนความพึงพอใจ</label><br>
                    <input type="radio" name="rating" value=5 id="rt5" required> <label for="rt5">พึงพอใจมาก</label> <br>
                    <input type="radio" name="rating" value=4 id="rt4" required> <label for="rt4">พึงพอใจ</label> <br>
                    <input type="radio" name="rating" value=3 id="rt3" required> <label for="rt3">พึงพอใจปานกลาง</label> <br>
                    <input type="radio" name="rating" value=2 id="rt2" required> <label for="rt2">พึงพอใจน้อย</label> <br>
                    <input type="radio" name="rating" value=1 id="rt1" required> <label for="rt1">ไม่พึงพอใจ</label> <br>
                    {{-- @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" name="rating" value="{{ $i }}" id="rt{{ $i }}"
                            required>
                        <label for="rt{{ $i }}">{{ $i }}
                            {{ $i == 5 ? 'พึงพอใจมาก' : ($i == 1 ? 'ไม่พึงพอใจ' : 'พึงพอใจ') }}</label><br>
                    @endfor --}}
                </div>

                <input type="submit" value="ประเมินผล">
            </form>
        </div>

    @endsection
</body>

</html>
