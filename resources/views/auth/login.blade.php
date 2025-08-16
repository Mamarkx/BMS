<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="h-screen w-full bg-[#1E3A8A] flex justify-center items-center">
    <div class="bg-white w-auto md:w-[500px] h-auto p-8 rounded-lg shadow-lg">
        <div class="text-center mb-6">
            <img src="{{ asset('images/san-agustin.png') }}" class="mx-auto mb-4 h-[66px] w-[66px]" alt="Barangay Logo" />
            <h2 class="text-2xl font-bold text-gray-900 ">Barangay Management System</h2>
            <p class="mt-4 text-black font-semibold">BMS Login</p>
        </div>
        <form action="" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-1">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="space-y-1">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mt-6">
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-center gap-1">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Login</span>
            </button>

            </div>
            @if(session('error'))
                <div class="text-red-500 text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    </div>
</div>
</body>
</html>
