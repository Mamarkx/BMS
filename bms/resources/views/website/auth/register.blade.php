    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Login Page</title>
        <link rel="icon" href="{{ asset('icons.svg') }}" type="image/x-icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    </head>

    <body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">

        <div class="h-screen flex flex-col md:flex-row relative">
            <div class="h-auto   md:h-screen w-full py-10 hidden md:flex items-center justify-center relative bg-cover bg-center flex-1"
                style="background-image: url('{{ asset('images/register.jpg') }}');">
                <div class="absolute inset-0 bg-black opacity-70 "></div>
            </div>
            @if ($errors->any())
                <div id="errorModal"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm">
                    <div
                        class="bg-white border-t-4 border-red-500 text-gray-800 rounded-2xl shadow-2xl max-w-md w-full p-6 animate-modal-slide relative">

                        <!-- Close Button -->
                        <button type="button" onclick="closeErrorModal()"
                            class="absolute top-4 right-4 text-gray-400 hover:text-red-600 text-2xl transition-colors">
                            <i class="fa-solid fa-xmark"></i>
                        </button>

                        <!-- Header -->
                        <div class="flex items-center gap-3 mb-4">
                            <div class="text-red-600 text-3xl">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Validation Error</h2>
                        </div>

                        <!-- Error List -->
                        <ul class="space-y-2">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-start gap-3 bg-red-50 border border-red-200 p-3 rounded-lg">
                                    <i class="fa-solid fa-triangle-exclamation text-red-600 mt-0.5"></i>
                                    <span class="text-sm font-medium text-gray-700">{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Button -->
                        <div class="mt-6 text-right">
                            <button type="button" onclick="closeErrorModal()"
                                class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition duration-200">
                                Close
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    function closeErrorModal() {
                        const modal = document.getElementById('errorModal');
                        if (modal) {
                            modal.classList.add('opacity-0', 'pointer-events-none');
                            setTimeout(() => modal.remove(), 300);
                        }
                    }
                    setTimeout(closeErrorModal, 4000);
                </script>

                <style>
                    @keyframes modal-slide {
                        from {
                            transform: translateY(-20px);
                            opacity: 0;
                        }

                        to {
                            transform: translateY(0);
                            opacity: 1;
                        }
                    }

                    .animate-modal-slide {
                        animation: modal-slide 0.35s ease-out;
                    }
                </style>
            @endif
            <!-- Right Side -->
            <div class="w-full  flex-1 md:flex justify-center items-center bg-white/80 backdrop-blur-sm p-6 md:p-8">

                <!-- Form -->
                <form method="POST" action="{{ route('RegisterAcc') }}" class="space-y-6 w-full max-w-2xl p-6">

                    @csrf
                    <div role="alert" id="password-error"
                        class="alert alert-error hidden flex items-center space-x-3 bg-red-100 text-red-800 border-l-4 border-red-500 p-4 rounded-md shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium">Passwords do not match!</span>
                    </div>
                    <div class="mb-8">
                        <img src="{{ asset('images/san-agustin.png') }}" class="mx-auto h-36 w-36 drop-shadow-2xl"
                            alt="Barangay Logo" />
                    </div>
                    <div class="text-center mb-8">
                        <h1 class="text-3xl md:text-4xl font-bold text-black mb-2 drop-shadow">
                            Create an Account
                        </h1>
                        <p class="text-gray-700 text-lg">Sign up to access barangay e-services</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">First Name
                                *</label>
                            <div class="relative">
                                <input type="text" id="first_name" name="first_name"
                                    class="w-full pl-2 pr-4 py-3 bg-white/20 text-gray-700 placeholder-gray-300 border border-gray-400 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                    placeholder="Enter your first name">
                            </div>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">Last
                                Name*</label>
                            <div class="relative">
                                <input type="text" id="last_name" name="last_name"
                                    class="w-full pl-2 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-gray-400 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                    placeholder="Enter your last name">
                            </div>
                        </div>
                        <div>
                            <label for="middle_name" class="block text-sm font-semibold text-gray-700 mb-2">Middle Name
                                (Optional)</label>
                            <div class="relative">
                                <input type="text" id="middle_name" name="middle_name"
                                    class="w-full pl-2 pr-4 py-3 bg-white/20 text-gray-700 placeholder-gray-300 border border-gray-400 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                    placeholder="Enter your middle name">
                            </div>
                        </div>
                        <div>
                            <label for="suffix" class="block text-sm font-semibold text-gray-700 mb-2">Suffix
                                (Optional)</label>
                            <div class="relative">
                                <input type="text" id="suffix" name="suffix"
                                    class="w-full pl-2 pr-4 py-3 bg-white/20 text-gray-700 placeholder-gray-300 border border-gray-400 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                    placeholder="Enter your suffix">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                            <div class="relative">
                                <input type="text" id="address" name="address"
                                    class="w-full pl-2 pr-4 py-3 bg-white/20 text-gray-700 placeholder-gray-300 border border-gray-400 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                    placeholder="Enter your address">
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email
                                Address</label>
                            <div class="relative">
                                <input type="email" id="email" name="email"
                                    class="w-full pl-2 pr-4 py-3 bg-white/20 text-gray-700 placeholder-gray-300 border border-gray-400 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                    placeholder="Enter your email address">
                            </div>
                        </div>
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div>
                            <label for="password"
                                class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="w-full pl-2 pr-4 py-3 bg-white/20 text-gray-700 placeholder-gray-300 border border-gray-400 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                    placeholder="Create a password">
                            </div>
                        </div>


                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="w-full pl-2 pr-4 py-3 bg-white/20 text-gray-700 placeholder-gray-300 border border-gray-400 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                    placeholder="Confirm your password">
                            </div>
                        </div>
                    </div>


                    <div class="flex items-center mt-4">

                        <input type="checkbox" id="terms" name="terms" required
                            class="h-4 w-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 cursor-pointer" />

                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            I agree to the
                            <a class="text-blue-400 hover:text-blue-500 font-semibold hover:underline cursor-pointer"
                                onclick="my_modal_3.showModal()">
                                Terms of Service and Data Privacy
                            </a>
                        </label>
                    </div>
                    <div class="pt-2">
                        <button type="submit" id="submit-btn"
                            class="w-full py-3 px-6 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-lg shadow-lg 
                    hover:shadow-xl hover:from-indigo-600 hover:to-blue-600 transform hover:-translate-y-0.5 
                    transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-indigo-300"
                            aria-label="Create your account">
                            <i class="fa-solid fa-user-plus mr-2"></i>Sign Up
                        </button>
                    </div>


                    <div class="flex items-center justify-center py-4">
                        <hr class="flex-grow border-t border-gray-400" />
                        <span class="mx-4 text-gray-300 text-sm font-medium">or</span>
                        <hr class="flex-grow border-t border-gray-400" />
                    </div>


                    <p class="text-center text-sm text-gray-700">
                        Already have an account?
                        <a href="{{ route('loginPage') }}"
                            class="text-blue-500 hover:text-blue-100 font-semibold hover:underline transition-colors duration-200">Sign
                            in here</a>
                    </p>

                </form>

            </div>
        </div>

    </body>

    </html>
