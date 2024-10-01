<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @extends('layouts.admin_check')
    @section('title', 'EventHub')
</head>

<body>
    @section('content')
        <a href="{{ url()->previous() }}" class="btn-link">กลับ</a>
        @if (session('success'))
            <div class="alert alert-success" style="margin-top: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" style="margin-top: 1rem;">
                {{ session('error') }}
            </div>
        @endif





        <h1>{{ $evt_name->evt_name }}</h1>
        @if ($evt_name->is_student_only == 1)
            <p>กิจกรรมเฉพาะนักศึกษาเท่านั้น</p>
        @endif
        <p><strong>จำนวนผู้เข้าร่วม:</strong> {{ $attendantCount }} /
            {{ $maxAttendant }}</p>

        <label for="event-reg">เลือกสถานะ:</label>
        <select id="event-reg" onchange="redirectToSelected()">
            <option value="">เลือกสถานะ</option>
            <option value="/reg/all/{{ $evt_name->id_evt }}">แสดงทั้งหมด</option>
            <option value="/reg/wait/{{ $evt_name->id_evt }}">รออนุมัติ</option>
            <option value="/reg/approved/{{ $evt_name->id_evt }}">อนุมัติแล้ว</option>
            <option value="/reg/not-approved/{{ $evt_name->id_evt }}">ไม่อนุมัติ</option>
            <option value="/reg/evaluated/{{ $evt_name->id_evt }}">ประเมินผลแล้ว</option>
        </select>

        <script>
            function redirectToSelected() {
                const select = document.getElementById('event-reg');
                const selectedValue = select.value;

                // ตรวจสอบว่ามีการเลือกค่าหรือไม่
                if (selectedValue) {
                    window.location.href = selectedValue; // นำไปยังลิงก์ที่เลือก
                }
            }
        </script>


        <form action="{{ route('userAction') }}" method="POST" id="form">
            @csrf
            <div id="button_wrapper">
                <button type="submit" name="action" value="approve" class="btn btn-success">อนุมัติที่เลือก</button>
                <button type="submit" name="action" value="unapprove"
                    class="btn btn-warning text-white">ไม่อนุมัติที่เลือก</button>
                <button type="submit" name="action" value="delete" class="btn btn-danger">ลบที่เลือก</button>
            </div>
            <table class="table table-striped table-hover">
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>รหัสผู้เข้าร่วม</th>
                    <th>ชื่อผู้เข้าร่วม</th>
                    @if ($event->isNotEmpty() && $event->first()->event->is_student_only == 1)
                        <th>รหัสนักศึกษา</th>
                        <th>สาขา</th>
                        <th>คณะ</th>
                    @endif
                    <th>อีเมลล์</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>สถานะ</th>
                </tr>

                @if (isset($event) && $event->isNotEmpty())
                    @foreach ($event as $evt)
                        <tr>
                            <td>
                                @if ($evt->statusUser->id_status_user != 5)
                                    <input type="checkbox" name="selected_users[]" value="{{ $evt->id }}">
                                @endif
                            </td>
                            <td>{{ $evt->id_user }}</td>
                            <td>{{ $evt->user->name }}</td>

                            @if ($event->first()->event->is_student_only == 1)
                                <td>{{ $evt->user->std_id }}</td>
                                <td>{{ $evt->user->department->dept_name }}</td>
                                <td>{{ $evt->user->department->faculty->fac_name }}</td>
                            @endif

                            <td>{{ $evt->user->email }}</td>
                            <td>{{ $evt->user->phone }}</td>
                            <td>{{ $evt->statusUser->status_user_name }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">ไม่มีข้อมูลผู้เข้าร่วม</td>
                    </tr>
                @endif
            </table>


        </form>

        <script>
            document.getElementById('select-all').addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('input[name="selected_users[]"]');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });
        </script>

    @endsection
</body>

</html>
