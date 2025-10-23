<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eepy Hotel</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;0,800;1,300;1,400;1,500;1,700;1,800&display=swap"
        rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- 300, 400, 500, 700, 800 -->

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar">
        <div class="avatar">
            <img src="{{ asset('images/eepy.png') }}" alt="avatar" width="96" height="54" />
        </div>

        <div class="navbar-title">
            <a href="{{ route('home') }}">Homepage</a>
            <a href="{{ route('room') }}">Room</a>
        </div>

        <div class="navbar-extra">
            @if (Auth::check())
                <!-- Kalau user sudah login -->
                <div class="profile">
                    <a href="{{ route('profile') }}" id="user" class="flex items-center gap-4">
                        <i data-feather="user"></i>
                        <span class="text-black">{{ Auth::user()->name }}</span>
                    </a>
                </div>
            @else
                <!-- Kalau belum login -->
                <div class="sign">
                    <a href="{{ route('login') }}" class="btn white-login" id="loginbtn">Login</a>
                    <a href="{{ route('register') }}" class="btn" id="registbtn">Register</a>
                </div>
            @endif

            <div class="hamburger">
                <a href="#" id="ham-menu"><i data-feather="menu"></i></a>
            </div>
        </div>

        <!-- Sidebar muncul di mobile/tablet -->
        <div class="sidebar" id="sidebar">
            <a href="#home">Homepage</a>
            <a href="room/room.html">Room</a>
            <div class="side-sign">
                <button class="btn white-login" id="side-login">Login</button>
                <button class="btn" id="side-register">Register</button>
                <a href="#" id="side-profile" class="side-profile"><i data-feather="user"></i></a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Main Section -->
    <main>
        <div class="min-h-screen w-full px-[100px] flex flex-col items-center justify-center" data-aos="fade-up"
            data-aos-duration="1000">
            <div class="flex justify-center items-start w-full gap-8">
                <x-sidebar-user-admin profile="Profile" orders="Orders" :active="$active ?? 'profile'" :user="$user" />

                @if ($active === 'profile')
                    <div class="w-full max-w-[830px] rounded-3xl p-10 gap-6 shadow-md border-[#f2f2f2] border-4">
                        <h1 class="text-[#040720] font-semibold text-2xl mb-4">My Account</h1>

                        <!-- Notifikasi sukses -->
                        @if (session('success'))
                            <p class="text-green-600 mb-4">{{ session('success') }}</p>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" value="{{ $user->name }}"
                                    class="text-[#040720] w-full p-2 border-2 rounded-[12px] outline-none focus:border-[#f96e2a] bg-[#EAF8FC]">
                                @error('name')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="telp_number" value="{{ $user->telp_number }}"
                                    class="text-[#040720] w-full p-2 border-2 rounded-[12px] outline-none focus:border-[#f96e2a] bg-[#EAF8FC]">
                                @error('telp_number')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}"
                                    class="text-[#040720] w-full p-2 border-2 rounded-[12px] outline-none focus:border-[#f96e2a] bg-[#EAF8FC]">
                                @error('email')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit"
                                class="bg-[#f96e2a] text-white px-4 py-2 rounded-md hover:bg-[#f15e15] transition">
                                Update
                            </button>
                        </form>
                    </div>
                @elseif($active === 'orders')
                    <div class="w-full max-w-[830px] rounded-3xl p-10 gap-6 shadow-md border-[#f2f2f2] border-4">
                        <h1 class="text-[#040720] font-semibold text-2xl mb-4">My Orders</h1>

                        <!-- Notifikasi sukses -->
                        @if (session('success'))
                            <p class="text-green-600 mb-4">{{ session('success') }}</p>
                        @endif

                        <livewire:orders />
                    </div>
                @endif
            </div>
        </div>
    </main>
    <!-- Main End -->

    <!-- Footer Section -->
    <footer>
        <div class="credit flex flex-col justify-center items-center">
            <img src="{{ asset('images/eepy.png') }}" alt="eepy logo" width="96" height="54" />
            <p>Created by Neb & Shab | &copy; 2025</p>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Icons -->
    <script>
        feather.replace();
    </script>

    <!-- JS -->
    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>
