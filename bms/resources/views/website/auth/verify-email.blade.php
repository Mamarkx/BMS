<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">

    <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden">
        <!-- Top accent gradient -->
        <div class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

        <div class="p-8 sm:p-10">
            <!-- Heading -->
            <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-gray-800 mb-6">
                Verify Your Email
            </h2>
            <p class="text-center text-gray-500 mb-6 text-sm sm:text-base">
                Enter the OTP code sent to <span class="font-medium text-gray-700">{{ $email }}</span>
            </p>

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4 text-center text-sm sm:text-base shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded-lg mb-4 text-center text-sm sm:text-base shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- OTP Form -->
            <form action="{{ route('verify.otp') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div>
                    <label for="otp" class="block text-gray-700 font-semibold text-sm sm:text-base mb-2">Enter OTP
                        Code</label>
                    <input type="text" name="otp" id="otp" maxlength="6" required
                        class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm sm:text-base text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-center tracking-widest">
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200 text-sm sm:text-base">
                    Verify Email
                </button>
            </form>

            <!-- Resend OTP -->
            <form action="{{ route('resend.otp') }}" method="POST" class="mt-4 text-center">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <button type="submit"
                    class="text-blue-600 hover:text-blue-700 font-medium underline text-sm sm:text-base transition-colors duration-200">
                    Resend OTP
                </button>
            </form>
        </div>
    </div>

</body>

</html>
