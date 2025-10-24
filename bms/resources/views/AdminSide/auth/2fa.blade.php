<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Two-Factor Authentication - Barangay System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #e0f2fe, #dbeafe);
            font-family: 'Inter', sans-serif;
        }

        .glass {
            backdrop-filter: blur(16px);
            background-color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 ">

    <div class="max-w-lg w-full h-screen flex items-center justify-center">
        <!-- Card -->
        <div class="glass rounded-3xl shadow-2xl overflow-hidden w-full h-full max-h-[95vh] flex flex-col">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-12 text-center flex-shrink-0">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-6">
                    <i class="fa-solid fa-shield-halved text-white text-4xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Two-Factor Authentication</h1>
                <p class="text-blue-100 text-lg">Enter the code to verify your identity and continue.</p>
            </div>

            <!-- Scrollable content -->
            <div class="px-8 py-6 overflow-y-auto flex-1 space-y-6">

                <!-- Info Box -->
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-5">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-circle-info text-blue-600 text-xl mt-0.5"></i>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Verification Code Sent</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                We've sent a 6-digit verification code to your registered email address. Enter it below
                                to continue.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- OTP Input -->
                <form method="POST" action="{{ route('admin.2fa.verify') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="two_factor_code" class="block text-sm font-semibold text-gray-800 mb-4 text-center">
                            Enter Verification Code
                        </label>
                        <div class="flex justify-center">
                            <input type="text" name="two_factor_code" id="two_factor_code" maxlength="6" required
                                class="w-full h-14 text-center text-2xl font-bold border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition bg-gray-50 focus:bg-white tracking-widest" />
                        </div>
                        <p class="text-xs text-gray-500 mt-3 text-center">
                            <i class="fa-solid fa-clock mr-1"></i>
                            Code expires in 10 minutes
                        </p>
                    </div>

                    <button type="submit"
                        class="w-full py-4 px-6 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-base font-semibold rounded-xl shadow-lg hover:shadow-xl flex items-center justify-center gap-3 transition duration-200">
                        <i class="fa-solid fa-check-circle"></i>
                        <span>Verify & Continue</span>
                    </button>
                </form>


                <!-- Actions -->
                <div class="mt-4 flex flex-col gap-3">
                    <form action="{{ route('resend.otp.admin') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full py-3 px-4 border-2 border-gray-200 hover:border-blue-500 hover:bg-blue-50
               text-gray-700 hover:text-blue-700 font-medium rounded-xl flex items-center
               justify-center gap-2 transition duration-200">
                            <i class="fa-solid fa-rotate-right"></i>
                            <span>Resend Verification Code</span>
                        </button>
                    </form>

                    <a href="{{ route('LoginAdmin') }}"
                        class="w-full py-3 px-4 text-center border-2 border-gray-200 hover:border-blue-500 hover:bg-blue-50 text-gray-700 hover:text-blue-700 font-medium rounded-xl transition duration-200">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Back to Login
                    </a>
                </div>

            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 flex-shrink-0 text-center text-sm text-gray-500">
                <i class="fa-solid fa-shield-halved text-blue-600"></i>
                <span>Secured by Barangay Management System</span>
            </div>

        </div>
    </div>

</body>

</html>
@if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            customClass: {
                popup: 'colored-toast'
            },
            background: '#ffffff',
            color: '#16a34a', // green text
        });
    </script>

    <style>
        .colored-toast {
            border-left: 6px solid #16a34a !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding-left: 12px !important;
        }
    </style>
@endif
