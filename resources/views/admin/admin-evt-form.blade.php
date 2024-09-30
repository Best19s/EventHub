<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if (isset($evt_find))

        <form action="/update" method="post">
            @csrf

            <input type="text" name="id" value="{{ $evt_find->id_evt }}" readonly>

            <label for="name">ใส่ชื่อกิจกรรม: </label>
            <input type="text" name="evt_name" id="name" value="{{ $evt_find->evt_name }}">
            <br>


            <label for="location">ใส่สถานที่จัดกิจกรรม: </label>
            <input type="text" name="evt_addr" id="location" value="{{ $evt_find->evt_addr }}">
            <br>

            <label for="org">ใส่ชื่อคณะ/ผู้จัดทำ: </label>
            <input type="text" name="evt_host" id="org" value="{{ $evt_find->evt_host }}">
            <br>

            <input type="checkbox" name="for_std" id="for_std" value="1"
                {{ $evt_find->is_student_only == 1 ? 'checked' : '' }}>



            <label for="for_std">เฉพาะนักศึกษา: </label>
            <br>

            <label>ใส่รายละเอียดกิจกรรม:</label><br>
            <textarea name="evt_detail" cols="30" rows="10">{{ $evt_find->evt_detail }}</textarea>
            <br>

            <label for="max">ใส่จำนวนผู้เข้าร่วมสูงสุด: </label>
            <input type="number" name="max_attd" id="max" value="{{ $evt_find->evt_max_attendant }}">
            <br>

            <label>ใส่วันที่เริ่มกิจกรรม: </label>
            <input type="datetime-local" name="evt_start" value="{{ $evt_find->evt_start_date }}">
            <br>

            <label>ใส่วันที่สิ้นสุดกิจกรรม: </label>
            <input type="datetime-local" name="evt_end" value="{{ $evt_find->evt_end_date }}">
            <br>

            <label>ใส่วันที่เริ่มการลงทะเบียน: </label>
            <input type="datetime-local" name="reg_evt_start" value="{{ $evt_find->evt_reg_start_date }}">
            <br>

            <label>ใส่วันที่สิ้นสุดการลงทะเบียน: </label>
            <input type="datetime-local" name="reg_evt_end" value="{{ $evt_find->evt_reg_end_date }}">
            <br>

            <label for="evt-img">ใส่รูปภาพกิจกรรม:</label>
            @if ($evt_find->evt_img)
                <div>
                    <img src="{{ asset('storage/images/events/' . $evt_find->evt_img) }}" alt="ภาพกิจกรรม"
                        width="50%">
                    <p>ชื่อไฟล์รูป: {{ $evt_find->evt_img }}</p>
                </div>
            @endif
            <input type="file" name="evt_img" value="{{ $evt_find->evt_img }}">



            <label for="evt_type">ใส่ประเภทกิจกรรม : </label>
            <select name="evt_type">
                <option value="">เลือกประเภทกิจกรรม: </option>
                @foreach ($evt_type as $type)
                    <option value="{{ $type->id_evt_type }}" @if ($evt_find->id_evt_type == $type->id_evt_type) selected @endif>
                        {{ $type->evt_type_name }}</option>
                @endforeach
            </select>
            <br>



            <label for="">ใส่สถานะกิจกรรม:</label>
            <select name="evt_status">
                @foreach ($evt_status as $status)
                    <option value="{{ $status->id_status_evt }}" @if ($evt_find->id_status_evt == $status->id_status_evt) selected @endif>
                        {{ $status->status_evt_name }}</option>
                @endforeach
            </select>
            <br>

            <input type="submit" value="อัพเดตอีเว้นท์">
        </form>
    @else
        <form action="{{ route('create_evt') }}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="name">ใส่ชื่อกิจกรรม: </label>
            <input type="text" name="evt_name" id="name">
            <br>

            <label for="location">ใส่สถานที่จัดกิจกรรม: </label>
            <input type="text" name="evt_addr" id="location">
            <br>

            <label for="org">ใส่ชื่อคณะ/ผู้จัดทำ: </label>
            <input type="text" name="evt_host" id="org">
            <br>

            <input type="checkbox" name="for_std" value="1" id="for_std">

            <label for="for_std">เฉพาะนักศึกษา: </label>
            <br>

            <label>ใส่รายละเอียดกิจกรรม:</label><br>
            <textarea name="evt_detail" cols="30" rows="10">ใส่รายละเอียดตรงนี้.</textarea>
            <br>

            <label for="max">ใส่จำนวนผู้เข้าร่วมสูงสุด: </label>
            <input type="number" name="max_attd" id="max">
            <br>

            <label>ใส่วันที่เริ่มกิจกรรม: </label>
            <input type="datetime-local" name="evt_start">
            <br>

            <label>ใส่วันที่สิ้นสุดกิจกรรม: </label>
            <input type="datetime-local" name="evt_end">
            <br>

            <label>ใส่วันที่เริ่มการลงทะเบียน: </label>
            <input type="datetime-local" name="reg_evt_start">
            <br>

            <label>ใส่วันที่สิ้นสุดการลงทะเบียน: </label>
            <input type="datetime-local" name="reg_evt_end">
            <br>

            <label for="evt-img">ใส่รูปภาพกิจกรรม:</label>
            <input type="file" name="evt_img">
            <br>

            <label for="evt_type">ใส่ประเภทกิจกรรม : </label>
            <select name="evt_type">
                <option value="">เลือกประเภทกิจกรรม: </option>
                @foreach ($evt_type as $type)
                    <option value="{{ $type->id_evt_type }}">{{ $type->evt_type_name }}</option>
                @endforeach
            </select>
            <br>



            <label for="">ใส่สถานะกิจกรรม:</label>
            <select name="evt_status">
                @foreach ($evt_status as $status)
                    <option value="{{ $status->id_status_evt }}">{{ $status->status_evt_name }}</option>
                @endforeach
            </select>
            <br>

            <input type="submit" value="สร้างอีเว้นท์">
        </form>
    @endif


</body>

</html>
