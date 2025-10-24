<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barangay Management System - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gradient-to-br from-blue-200 via-white to-blue-300">
    <div class="min-h-screen w-full flex items-center justify-center p-4">
        <!-- Main Container -->
        <div class="w-full max-w-7xl grid lg:grid-cols-2 gap-0 bg-white rounded-3xl shadow-2xl overflow-hidden">

            <!-- Left Side - Branding -->
            <div
                class="hidden lg:flex flex-col justify-center items-center bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 p-16 text-white relative overflow-hidden">
                <div
                    class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0icmdiYSgyNTUsMjU1LDI1NSwwLjEpIiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-30">
                </div>

                <div class="relative z-10 text-center">
                    <div class="mb-8">
                        <img src="{{ asset('images/san-agustin.png') }}" class="mx-auto h-36 w-36 drop-shadow-2xl"
                            alt="Barangay Logo" />
                    </div>
                    <h1 class="text-4xl font-bold mb-3">Barangay San Agustin</h1>
                    <p class="text-blue-100 text-lg leading-relaxed max-w-lg mx-auto">
                        Empowering communities through efficient governance and transparent service delivery
                    </p>
                </div>

                <div class="absolute bottom-0 left-0 w-full h-40 bg-gradient-to-t from-blue-900/50 to-transparent">
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="p-8 lg:p-16 flex flex-col justify-center w-full">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-10">
                    <img src="{{ asset('images/san-agustin.png') }}" class="mx-auto h-24 w-24 mb-4"
                        alt="Barangay Logo" />
                    <h2 class="text-3xl font-bold text-gray-800">Barangay Management System</h2>
                </div>

                <!-- Login Header -->
                <div class="mb-10 text-center lg:text-left">
                    <h3 class="text-4xl font-bold text-gray-800 mb-2">Welcome Back</h3>
                    <p class="text-gray-500 text-lg">Sign in to access your account</p>
                </div>
                <!-- Error Message -->
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded mb-2">
                        <div class="flex items-center">
                            <i class="fa-solid fa-circle-exclamation text-red-500 mr-3"></i>
                            <p class="text-red-700 text-sm font-medium">
                                {{ $errors->first() }}
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('admin.login') }}" method="POST"
                    class="mt-4 space-y-6 max-w-md mx-auto lg:mx-0">
                    @csrf
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email
                            Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" placeholder="Enter your email"
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 text-gray-700"
                                required>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" id="password" name="password" placeholder="Enter your password"
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 text-gray-700"
                                required>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    {{-- <div class="flex items-center justify-between text-sm">
            <label class="flex items-center cursor-pointer">
              <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
              <span class="ml-2 text-gray-600">Remember me</span>
            </label>
            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium transition duration-200">
              Forgot Password?
            </a>
          </div> --}}



                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full py-3.5 px-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform transition duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>Sign In</span>
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-12 pt-6 border-t border-gray-200 text-center lg:text-left">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
