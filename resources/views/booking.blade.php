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
        <!-- 300, 400, 500, 700, 800 -->

        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons"></script>

        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('css/booking.css') }}" />
    </head>

    <body>
        <!-- Main Section -->
        <main>
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <div class="booking">
                    <div class="box">
                        <div class="book-data">
                            <!-- Hidden fields untuk passing data -->
                            <input type="hidden" name="userid" value="{{ $data['user_id'] }}">
                            <input type="hidden" name="room_type_id" value="{{ $data['room_type_id'] }}">
                            <input type="hidden" name="checkin" value="{{ $data['checkin'] }}">
                            <input type="hidden" name="checkout" value="{{ $data['checkout'] }}">
                            <input type="hidden" name="price_per_night" value="{{ $data['price_per_night'] }}">

                            <div class="title">
                                <i data-feather="edit"></i>
                                <h1>Guest Data</h1>
                            </div>
                            <p>
                                Please fill in all fields correctly to receive your booking
                                confirmation.
                            </p>

                            <div class="input-box">
                                <h2>Name</h2>
                                <input type="text" name="name" placeholder="Full Name" required />
                            </div>
                            <div class="input-box">
                                <h2>Phone Number</h2>
                                <input type="text" name="phone" placeholder="+62XXX" required />
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="book-detail">
                            <div class="title">
                                <i data-feather="file-text"></i>
                                <h1>Booking Details</h1>
                            </div>

                            <div class="book-time">
                                <div class="box-check">
                                    <p class="b-title">Check In</p>
                                    <!-- butuh be (date)-->
                                    <h2>{{ $data['checkin'] }}</h2>
                                    <p>From 2 PM</p>
                                </div>
                                <i data-feather="arrow-right"></i>

                                <div class="box-check">
                                    <p class="b-title">Check Out</p>
                                    <!-- butuh be (date)-->
                                    <h2>{{ $data['checkout'] }}</h2>
                                    <p>Before 12 PM</p>
                                </div>
                            </div>

                            <!-- butuh be (room, night, price)-->
                            <div class="room-qty">
                                <h3>(1x) Standard Room</h3>
                                <h3>{{ $data['nights'] }} night(s) x Rp{{ number_format($data['price_per_night']) }}
                                </h3>
                            </div>

                            <div class="total">
                                <h2>Total Price :</h2>
                                <!-- butuh be (price)-->
                                <h2 class="price">Rp{{ number_format($data['nights'] * $data['price_per_night']) }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="payment">
                            <div class="title">
                                <i data-feather="dollar-sign"></i>
                                <h1>Payment Methods</h1>
                            </div>

                            <div class="method">
                                <input type="radio" id="option-1" name="payment_method" value="VA" />
                                <input type="radio" id="option-2" name="payment_method" value="Bank" />
                                <input type="radio" id="option-3" name="payment_method" value="E-Money" />
                                <label for="option-1" class="option option-1">
                                    <div class="dot"></div>
                                    <span>VA</span>
                                </label>
                                <label for="option-2" class="option option-2">
                                    <div class="dot"></div>
                                    <span>Bank</span>
                                </label>
                                <label for="option-3" class="option option-3">
                                    <div class="dot"></div>
                                    <span>E-Money</span>
                                </label>
                            </div>

                            <div class="total">
                                <h2>Total Price :</h2>
                                <!-- butuh be (price)-->
                                <h2 class="price">Rp{{ number_format($data['nights'] * $data['price_per_night']) }}
                                </h2>
                            </div>
                            <button type="submit" class="payment btn">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
