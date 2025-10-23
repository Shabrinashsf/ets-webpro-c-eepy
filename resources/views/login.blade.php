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

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- 300, 400, 500, 700, 800 -->

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>
  </head>

  <body class="min-h-screen flex flex-col justify-between items-center bg-[#78b3ce] text-[#040720] overflow-hidden">
    <main class="flex-1 flex justify-center items-center w-full">
        <div class="flex flex-col justify-center items-center bg-white p-8 rounded-2xl">
            <h1 class="font-normal text-3xl mx-4 my-2">Sign In</h1>
            <form action="{{ route('logincheck') }}" method="post" class="flex flex-col justify-center items-center">
                @csrf
                <div class="mb-2">
                    <label for="email" class="block text-black font-medium mb-1">
                        Email <span class="text-[#E72727]">*</span>
                    </label>
                    <input type="email" name="email" placeholder="Enter your email" class="w-full p-2 border-2 rounded-[12px] outline-none focus:border-[#f96e2a] bg-[#EAF8FC]"><br>
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-black font-medium mb-1">
                        Password <span class="text-[#E72727]">*</span>
                    </label>
                    <input type="password" name="password" placeholder="Enter your password" class="w-full p-2 border-2 rounded-[12px] outline-none focus:border-[#f96e2a] bg-[#EAF8FC]"><br>
                    @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <input type="submit" name="login" value="login" class="px-5 py-2 bg-[#f96e2a] text-white rounded-xl hover:bg-[#f15e15] transition duration-200 w-[100px]"><br>
            </form>

            <div>
                <p class="pt-4">Don't have an account? <a href="{{ route('register') }}" class="text-[#78b3ce]">Sign up</a></p>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="w-full">
      <div class="credit flex flex-col justify-center items-center">
        <img src="{{ asset('images/eepy.png') }}" alt="eepy logo" width="96" height="54" />
        <p>Created by Neb & Shab | &copy; 2025</p>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- Icons -->
    <script>
      feather.replace();
  </body>
</html>
