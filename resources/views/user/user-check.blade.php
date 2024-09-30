<a href="{{ url()->previous() }}">กลับ</a>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif



<h1>{{ $evt_name->evt_name }}</h1>
@if ($evt_name->is_student_only == 1)
    <p>กิจกรรมเฉพาะนักศึกษาเท่านั้น</p>
@endif

<a href="/reg/all/{{ $evt_name->id_evt }}">แสดงทั้งหมด</a>
<a href="/reg/wait/{{ $evt_name->id_evt }}">รออนุมัติ</a>
<a href="/reg/approved/{{ $evt_name->id_evt }}">อนุมัติแล้ว</a>
<a href="/reg/not-approved/{{ $evt_name->id_evt }}">ไม่อนุมัติ</a>
<a href="/reg/evaluated/{{ $evt_name->id_evt }}">ประเมินผลแล้ว</a>

<form action="{{ route('userAction') }}" method="POST">
    @csrf
    <table border="1px">
        <tr>
            <th><input type="checkbox" id="select-all"></th>
            <th>รหัสผู้เข้าร่วม</th>
            <th>ชื่อผู้เข้าร่วม</th>
            @if (isset($event) && $event->isNotEmpty() && $event->first()->event->is_student_only == 1)
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

    <div style="margin-top: 20px;">
        <button type="submit" name="action" value="approve">อนุมัติที่เลือก</button>
        <button type="submit" name="action" value="unapprove">ไม่อนุมัติที่เลือก</button>
        <button type="submit" name="action" value="delete">ลบที่เลือก</button>
    </div>
</form>

<script>
    document.getElementById('select-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="selected_users[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
