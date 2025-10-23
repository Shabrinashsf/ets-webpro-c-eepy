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
    <link rel="stylesheet" href="{{ asset('css/success.css') }}" />
</head>

<body>
    <!-- Main Section -->
    <main>
        <div class="box">
            <h1>Payment Success!</h1>
            <i data-feather="check"></i>
            <a class="btn" href="{{ route('home') }}">Back to Homepage</a>
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
