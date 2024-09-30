<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="chart" style="width: 50%;">
    <canvas id="myChart" style="width: 100%;"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', // หรือ 'line', 'pie' ตามที่คุณต้องการ
        data: {
            labels: ['5', '4', '3', '2', '1'], // เปลี่ยนเป็น label ของคุณ
            datasets: [{
                label: 'คะแนนความพึงพอใจ',
                data: [
                    {{ $ratingCounts[5] }},
                    {{ $ratingCounts[4] }},
                    {{ $ratingCounts[3] }},
                    {{ $ratingCounts[2] }},
                    {{ $ratingCounts[1] }}
                ], // ใช้ค่าจำนวนคะแนนที่ส่งมาจาก Controller
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 2, // คุณสามารถปรับได้ตามต้องการ
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1 // ตั้งค่าขนาดขั้นตอนของแกน Y
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw +
                                ' คน'; // แสดงจำนวนคนที่ให้คะแนนใน tooltip
                        }
                    }
                }
            }
        }
    });
</script>


<a href="{{ route('home') }}">กลับ</a>

<div class="container">
    <h1>รายชื่อผู้เข้าร่วมกิจกรรม</h1>
    <p>จำนวนผู้เข้าร่วมทั้งหมด: {{ $participantCount }} / {{ $participantsMax }}</p>

    <table class="table" border="1px">
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
                        <!-- ตรวจสอบว่ามีคะแนนหรือไม่ -->
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

                <!-- Modal สำหรับข้อเสนอแนะ -->
                <div class="modal fade" id="feedbackModal{{ $participant->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="feedbackModalLabel{{ $participant->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="feedbackModalLabel{{ $participant->id }}">ข้อเสนอแนะจาก
                                    {{ $participant->user->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ $participant->feedback ?? 'ไม่มีข้อเสนอแนะ' }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>คะแนนเฉลี่ย:</strong></td>
                <td>{{ number_format($averageRating, 2) }}/5</td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- รวม CSS และ JS สำหรับ Bootstrap (ถ้ายังไม่ได้เพิ่ม) -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
