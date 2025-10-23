<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Verify Your Email</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">{{ session('error') }}</div>
        @endif

        <form action="{{ route('verify.otp') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <label for="otp" class="block text-gray-700 font-semibold">Enter OTP Code</label>
            <input type="text" name="otp" id="otp" maxlength="6" required
                class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">
                Verify Email
            </button>
        </form>

        <form action="{{ route('resend.otp') }}" method="POST" class="mt-4 text-center">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <button type="submit" class="text-blue-600 hover:underline">Resend OTP</button>
        </form>
    </div>

    <!-- ✅ SweetAlert success modal + redirect -->
    @if (session('success_verified'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Email Verified!',
                text: 'Your email has been successfully verified.',
                confirmButtonColor: '#2563eb',
                confirmButtonText: 'Continue to Login',
                timer: 3000,
                timerProgressBar: true,
            }).then(() => {
                window.location.href = "{{ route('loginPage') }}";
            });
        </script>
    @endif

</body>

</html>
