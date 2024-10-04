<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @extends('layouts.admin_report')
    @section('title', 'Event_Report')

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    @section('content')
        <a href="{{ route('home') }}" class="btn-link">กลับ</a>




        <div class="container-fluid">

            <div class="warpper">

                <div class="chart" style="width: 500px;">
                    <canvas id="myChart" style="width: 100%;"></canvas>
                </div>

                <div class="table_info">
                    <h1>รายชื่อผู้เข้าร่วมกิจกรรม</h1>
                    <p>จำนวนผู้เข้าร่วมทั้งหมด: {{ $participantCount }} / {{ $participantsMax }}</p>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ชื่อผู้เข้าร่วม</th>
                                <th>ข้อมูลเพิ่มเติม</th>
                                <th>ข้อเสนอแนะ</th>
                                <th>คะแนนความพึงพอใจ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $participant)
                                <tr>
                                    <td>{{ $participant->user->name }}</td>
                                    <td>{{ $participant->statusUser->status_user_name }}</td>
                                    @if ($participant->rating)
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#feedbackModal{{ $participant->id }}">
                                                อ่านข้อเสนอแนะ
                                            </button>
                                        </td>
                                    @else
                                        <td>
                                            <button type="button" class="btn btn-secondary" disabled>
                                                ยังไม่ได้ประเมินผล
                                            </button>
                                        </td>
                                    @endif
                                    <td>{{ $participant->rating ?? '-' }}</td>
                                </tr>

                                <div class="modal fade" id="feedbackModal{{ $participant->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="feedbackModalLabel{{ $participant->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="feedbackModalLabel{{ $participant->id }}">
                                                    ข้อเสนอแนะจาก
                                                    {{ $participant->user->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{ $participant->feedback ?? 'ไม่มีข้อเสนอแนะ' }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">ปิด</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>คะแนนเฉลี่ย:</strong></td>
                                <td>{{ number_format($averageRating, 2) }}/5.00</td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
