<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">

    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-blue-700 mb-6">Verify Your Email</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center text-sm sm:text-base">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center text-sm sm:text-base">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('verify.otp') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <label for="otp" class="block text-gray-700 font-semibold text-sm sm:text-base">Enter OTP Code</label>
            <input type="text" name="otp" id="otp" maxlength="6" required
                class="w-full border rounded-lg px-4 py-2 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition text-sm sm:text-base">
                Verify Email
            </button>
        </form>

        <form action="{{ route('resend.otp') }}" method="POST" class="mt-4 text-center">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <button type="submit" class="text-blue-600 hover:underline text-sm sm:text-base">
                Resend OTP
            </button>
        </form>
    </div>

</body>

</html>
