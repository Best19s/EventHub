<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    <link rel="stylesheet" href="{{ asset('css/find.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
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

                            <form method="POST" action="{{ route('logout') }}" x-data class="inline" style="margin-top: 20px; margin-left:10px;">
                                @csrf
                                <button type="submit"
                                    class="nav-btn" style="color: #000; border: none; background: none">
                                    {{ __('ออกจากระบบ') }}
                                </button>
                            </form>

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
                <i class="bi bi-forward-fill" id="icon"></i>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
