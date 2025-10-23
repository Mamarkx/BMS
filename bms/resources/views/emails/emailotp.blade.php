<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification Code</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans text-gray-800">
    <div class="max-w-md mx-auto mt-12 bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Hello {{ $user->first_name }},</h2>

            <p class="text-gray-700 leading-relaxed mb-6">
                To verify your email address for the <span class="font-semibold">Barangay E-Services Syte,</span>,
                please use the verification code below:
            </p>

            <div class="text-center my-8">
                <p class="text-gray-600 text-lg mb-2">Your Email Verification Code:</p>
                <h1 class="text-4xl font-bold tracking-widest text-blue-600">{{ $otp }}</h1>
            </div>

            <p class="text-gray-700 leading-relaxed">
                This code will expire in <span class="font-semibold">10 minutes</span>.
                If you didn’t request this verification, please ignore this email.
            </p>

            <div class="mt-10 border-t border-gray-200 pt-6 text-center">
                <p class="text-sm text-gray-500">— Barangay San Agustin</p>
            </div>
        </div>
    </div>
</body>

</html>
