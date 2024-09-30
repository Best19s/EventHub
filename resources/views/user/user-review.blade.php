<x-app-layout>
<form action="/feedback" method="POST">
    @csrf
    <input type="text" name="id" value="{{ $event->id }}">
    <input type="text" name="id_user" value="{{ Auth::id() }}">
    <input type="text" name="id_evt" value="{{ $event->id_evt }}">

    <label for="fb">ข้อเสนอแนะ</label><br>
    <textarea name="feedback" id="fb" cols="30" rows="10" required></textarea><br>

    <label>คะแนนความพึงพอใจ</label><br>
    @for ($i = 5; $i >= 1; $i--)
        <input type="radio" name="rating" value="{{ $i }}" id="rt{{ $i }}" required>
        <label for="rt{{ $i }}">{{ $i }}
            {{ $i == 5 ? 'พึงพอใจมาก' : ($i == 1 ? 'ไม่พึงพอใจ' : 'พึงพอใจ') }}</label><br>
    @endfor

    <input type="submit" value="ประเมินผล">
</form>
</x-app-layout>
