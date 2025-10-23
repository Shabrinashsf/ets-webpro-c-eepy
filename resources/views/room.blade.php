@php
    use Illuminate\Support\Facades\Auth;
@endphp

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
        rel="stylesheet"
    />

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/room.css') }}" />
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
            @if (Auth::check() && Auth::user()->role == 'user')
                <div class="profile">
                    <a href="{{ route('profile') }}" id="user" class="flex items-center gap-2">
                        <i data-feather="user"></i>
                        <span class="text-black">{{ Auth::user()->name }}</span>
                    </a>
                </div>
            @elseif (Auth::check() && Auth::user()->role == 'admin')
                <div class="profile">
                    <a href="{{ route('admin') }}" id="user" class="flex items-center gap-4">
                        <i data-feather="user"></i>
                        <span class="text-black">{{ Auth::user()->name }}</span>
                    </a>
                </div>
            @else
                <div class="sign">
                    <a href="{{ route('login') }}" class="btn white-login" id="loginbtn">Login</a>
                    <a href="{{ route('register') }}" class="btn" id="registbtn">Register</a>
                </div>
            @endif

            <div class="hamburger">
                <a href="#" id="ham-menu"><i data-feather="menu"></i></a>
            </div>
        </div>

        <div class="sidebar" id="sidebar">
            <a href="{{ route('home') }}">Homepage</a>
            <a href="{{ route('room') }}">Room</a>
            <div class="side-sign">
                <button class="btn white-login" id="side-login">Login</button>
                <button class="btn" id="side-register">Register</button>
                <a href="#" id="side-profile" class="side-profile">
                    <i data-feather="user"></i>
                </a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Main Section -->
    <main>
        <div class="bg"></div>

        <div class="hero">
            <h1>When do you want to relax?</h1>
            <div class="datepicker">
          <input type="text" placeholder="Select date" />
          <div class="calendar" hidden>
            <div class="left-side">
              <div class="controls">
                <button class="prev"><i data-feather="arrow-left"></i></button>
                <strong class="label"></strong>
              </div>
              <div class="days">
                <span>Su</span>
                <span>Mo</span>
                <span>Tu</span>
                <span>We</span>
                <span>Th</span>
                <span>Fr</span>
                <span>Sa</span>
              </div>
              <div class="dates"></div>
            </div>

            <div class="right-side">
              <div class="controls">
                <button class="next"><i data-feather="arrow-right"></i></button>
                <strong class="label"></strong>
              </div>
              <div class="days">
                <span>Su</span>
                <span>Mo</span>
                <span>Tu</span>
                <span>We</span>
                <span>Th</span>
                <span>Fr</span>
                <span>Sa</span>
              </div>
              <div class="dates"></div>
            </div>

            <div class="action-menu">
              <span class="selection"></span>

              <button class="cancel">Cancel</button>
              <button class="apply">Apply</button>
            </div>
          </div>
        </div>
      </div>
        </div>

        <div class="types">
            @foreach($roomTypes as $id => $data)
            <div class="box">
                <div class="{{ strtolower($data['name']) }}">
                    <h1>{{ $data['name'] }} Room</h1>
                    <p class="price">Rp{{ number_format($data['price']) }}/night</p>

                    <div class="room-detail">
                        <img src="{{ asset('images/' . $data['image']) }}" alt="{{ $data['name'] }}" width="300px" />
                        <div class="desc-info">
                            <div class="room-desc">
                                <h2>Description</h2>
                                <p>{{ $data['description'] }}</p>
                            </div>
                            <div class="room-info">
                                <h2>Room Information</h2>
                                <div class="content">
                                    <div class="area">
                                        <i data-feather="maximize"></i>
                                        <p>{{ $data['area'] }}</p>
                                    </div>
                                    <div class="capac">
                                        <i data-feather="users"></i>
                                        <p>{{ $data['capacity'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="room-fac">
                            <div class="room-fac-title"><h2>Facilities</h2></div>
                            <div class="room-fac-list">
                                @foreach($data['facilities'] as $fac)
                                    <li>{{ $fac }}</li>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="avail">
                        <p>Only {{ $availableRooms[$id] ?? 0 }} room(s) left!</p>
                            <button class="btn choose-btn" data-roomid="{{ $id }}" data-roomname="{{ $data['name'] }}" data-price="{{ $data['price'] }}">Choose</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
    <!-- Main End -->

    <!-- Footer Section -->
    <footer>
        <div class="credit">
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
