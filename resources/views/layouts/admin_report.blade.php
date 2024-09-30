<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <link rel="stylesheet" href="{{ asset('css/admin_report.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    @if (Route::has('login'))
        <nav>

            <div class="logo">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" />
                </a>
            </div>
            <div class="nav-wrapper">
                <ul class="nav-body">
                    @auth
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex d-flex align-items-center">
                            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="nav-btn">
                                {{ __('อีเว้นท์ทั้งหมด') }}
                            </x-nav-link>
                            <x-nav-link href="/evt/find" :active="request()->routeIs('')" class="nav-btn">
                                {{ __('ค้นหาอีเว้นท์') }}
                            </x-nav-link>
                            <x-nav-link href="/account/{{ auth()->id() }}" :active="request()->routeIs('account')" class="nav-btn">
                                {{ __('ประวัติอีเว้นท์') }}
                            </x-nav-link>

                            <x-nav-link href="{{ route('profile.show') }}" class="nav-btn">
                                {{ __(Auth::user()->name) }}
                            </x-nav-link>

                        </div>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}">
                                เข้าสู่ระบบ
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}">
                                    ลงทะเบียน
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>

        </nav>
    @endif




    <main>
        @yield('content') <!-- ส่วนที่จะโหลดเนื้อหาของ view -->
    </main>

    <footer>
        <div class="footer-body">

            <div class="logo">
                <img src="{{ asset('storage/logo/logo-white.png') }}" alt="Logo" />
            </div>
            <h4>ที่เดียวครบ จบทุกกิจกรรม</h4>
            <p>© Copyright {{ date('Y') }} EventHub.com</p>
            <div class="icon">
                <img src="{{ asset('storage/icon/Facebook.png') }}" alt="">
                <img src="{{ asset('storage/icon/Instagram.png') }}" alt="">
                <img src="{{ asset('storage/icon/Gmail.png') }}" alt="">
                <img src="{{ asset('storage/icon/Google.png') }}" alt="">
            </div>
        </div>
        <div class="footer-contact">
            <h4><i class="bi bi-envelope-plus-fill"></i> Get In Touch</h4>
            <div class="btn-link">
                <input type="email" name="" id="" placeholder="Email">

            </div>
        </div>
    </footer>

   
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

    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
</body>

</html>
