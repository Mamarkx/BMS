<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barangay e-Services Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/daisyui.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5/s6gTjN1jW6C9I/52Mh35Q3x/C6y7pWz8B6pGf3vK2eQ9pLqg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes glow {

            0%,
            100% {
                box-shadow: 0 0 10px rgba(79, 70, 229, 0.4), 0 0 20px rgba(79, 70, 229, 0.2);
            }

            50% {
                box-shadow: 0 0 20px rgba(79, 70, 229, 0.6), 0 0 40px rgba(79, 70, 229, 0.3);
            }
        }

        .btn-glow {
            animation: glow 2s infinite ease-in-out;
        }
    </style>
</head>

<body class="font-sans antialiased">

    <div class="h-screen w-full flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset('images/bg.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-70 "></div>


        <div
            class="relative z-10 w-full max-w-lg p-8 mx-4 bg-white/10 backdrop-blur-md  rounded-xl shadow-2xl border border-white/20">


            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow">
                    San Agustin <span class="text-blue-500">E-Services</span>
                </h1>
                <p class="text-gray-200 text-lg">Sign in to your account</p>
            </div>
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-800 rounded-lg p-4 mb-4">
                    <ul class="space-y-2 text-sm">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center gap-3 text-base">
                                <i class="fa-solid fa-circle-exclamation text-red-600 text-xl"></i>
                                <span class="font-medium text-red-800">{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-200 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" id="email" name="email"
                            class="w-full pl-10 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-white/30 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                            placeholder="Enter your email address" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">

                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                    </div>
                </div>


                <div>
                    <div class="flex justify-between">
                        <label for="password" class="block text-sm font-semibold text-gray-200 mb-2">Password</label>
                        <div class="flex justify-end text-sm">
                            <a href="#"
                                class="text-blue-200 hover:text-blue-100 hover:underline transition-colors duration-200">Forgot
                                password?</a>
                        </div>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full pl-10 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-white/30 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                            placeholder="Enter your password">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>
                </div>



                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3 px-6 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-lg shadow-lg 
                    hover:shadow-xl hover:from-indigo-600 hover:to-blue-600 transform hover:-translate-y-0.5 
                    transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-indigo-300"
                        aria-label="Sign in to your account">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                    </button>
                </div>

                {{-- <div class="flex items-center justify-center py-4">
                <hr class="flex-grow border-t border-gray-400" />
                <span class="mx-4 text-gray-300 text-sm font-medium">or</span>
                <hr class="flex-grow border-t border-gray-400" />
            </div>
            
          
            <a href="{{ route('auth.google.redirect') }}" class="w-full py-3 px-6 bg-white text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-100 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300 flex items-center justify-center space-x-4">
                <img src="https://i.ibb.co/TBWZHXPv/google.png" alt="Google logo" class="h-5 w-5" />
                <span>Sign in with Google</span>
            </a> --}}

                <p class="text-center text-sm text-gray-200">
                    Don't have an account?
                    <a href="{{ route('RegisterPage') }}"
                        class="text-blue-200 hover:text-blue-100 font-semibold hover:underline transition-colors duration-200">Sign
                        up here</a>
                </p>

            </form>
        </div>
    </div>
    @if (session('show_verification_modal') && session('pending_verification_email'))
        <dialog id="verifyModal"
            class="modal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" open>
            <form method="POST" action="{{ route('NotVerified') }}"
                class="modal-box bg-white rounded-lg shadow-xl max-w-md w-full p-6 text-center animate-slide-down">
                @csrf

                <h3 class="text-xl font-bold text-gray-800 mb-2">Email Not Verified</h3>
                <p class="text-gray-600 mb-4">
                    Your email <strong>{{ session('pending_verification_email') }}</strong> is not yet verified.
                </p>

                <input type="hidden" name="email" value="{{ session('pending_verification_email') }}">

                <div class="flex justify-center gap-3">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Go to Verification Page
                    </button>
                </div>
            </form>
        </dialog>

        <script>
            const modal = document.getElementById('verifyModal');
            if (modal) modal.showModal();
        </script>

        <style>
            @keyframes slide-down {
                from {
                    transform: translateY(-20px);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .animate-slide-down {
                animation: slide-down 0.3s ease-out;
            }
        </style>
    @endif
    {{-- @if (session('success_verified')) --}}
    <div id="emailVerifiedModal" class="fixed inset-0 z-50 flex justify-center px-4">
        <div
            class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 text-center border border-blue-300 animate-slide-down">
            <div class="text-blue-600 text-5xl mb-4">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Email Verified!</h2>
            <p class="text-gray-700 mb-6">
                Your email has been successfully verified.<br>
                You can now log in to your account.
            </p>
        </div>
    </div>

    <script>
        function closeModal() {
            const modal = document.getElementById('emailVerifiedModal');
            if (modal) modal.remove();
        }
        setTimeout(closeModal, 3000);
    </script>

    <style>
        @keyframes slide-down {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slide-down {
            animation: slide-down 0.4s ease-out;
        }
    </style>
    {{-- @endif --}}
</body>

</html>
