<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barangay e-Services Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5/s6gTjN1jW6C9I/52Mh35Q3x/C6y7pWz8B6pGf3vK2eQ9pLqg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased">

    <div class="h-auto md:h-screen w-full py-10 flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset('images/register.jpg') }}');">

        <div class="absolute inset-0 bg-black opacity-50"></div>

        @if ($errors->any())
            <div id="errorModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
                <div class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full p-6 animate-slide-down">

                    <!-- Close Button -->
                    <button type="button" onclick="closeErrorModal()"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl font-bold transition-colors">
                        &times;
                    </button>

                    <!-- Heading -->
                    <h3 class="text-xl font-bold text-red-600 mb-4 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-circle-exclamation text-red-600"></i>
                        Validation Errors
                    </h3>

                    <!-- Errors List -->
                    <ul class="space-y-2 text-sm text-gray-700 text-left">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center gap-3">
                                <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                                <span class="font-medium">{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Close Button at Bottom -->
                    <div class="mt-6 flex justify-center">
                        <button type="button" onclick="closeErrorModal()"
                            class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl shadow-md transition-all">
                            Close
                        </button>
                    </div>
                </div>
            </div>

            <script>
                function closeErrorModal() {
                    const modal = document.getElementById('errorModal');
                    if (modal) modal.style.display = 'none';
                }
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

        <div
            class="relative z-10 w-full max-w-6xl p-8 mx-4 bg-white/10 backdrop-blur-sm rounded-xl shadow-2xl border border-white/20">


            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow">
                    Create an Account
                </h1>
                <p class="text-gray-200 text-lg">Sign up to access barangay e-services</p>
            </div>

            <form method="POST" action="{{ route('RegisterAcc') }}" class="space-y-6">
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

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-2">
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-gray-200 mb-2">First Name
                            *</label>
                        <div class="relative">
                            <input type="text" id="first_name" name="first_name"
                                class="w-full pl-2 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-white/30 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                placeholder="Enter your first name">
                        </div>
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-gray-200 mb-2">Last Name*</label>
                        <div class="relative">
                            <input type="text" id="last_name" name="last_name"
                                class="w-full pl-2 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-white/30 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                placeholder="Enter your last name">
                        </div>
                    </div>
                    <div>
                        <label for="middle_name" class="block text-sm font-semibold text-gray-200 mb-2">Middle Name
                            (Optional)</label>
                        <div class="relative">
                            <input type="text" id="middle_name" name="middle_name"
                                class="w-full pl-2 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-white/30 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                placeholder="Enter your middle name">
                        </div>
                    </div>
                    <div>
                        <label for="suffix" class="block text-sm font-semibold text-gray-200 mb-2">Suffix
                            (Optional)</label>
                        <div class="relative">
                            <input type="text" id="suffix" name="suffix"
                                class="w-full pl-2 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-white/30 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                placeholder="Enter your suffix">
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-200 mb-2">Address</label>
                        <div class="relative">
                            <input type="text" id="address" name="address"
                                class="w-full pl-2 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-white/30 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                placeholder="Enter your address">
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-200 mb-2">Email
                            Address</label>
                        <div class="relative">
                            <input type="email" id="email" name="email"
                                class="w-full pl-2 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-white/30 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                placeholder="Enter your email address">
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-200 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full pl-2 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-white/30 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                placeholder="Create a password">
                        </div>
                    </div>


                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-semibold text-gray-200 mb-2">Confirm Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full pl-2 pr-4 py-3 bg-white/20 text-white placeholder-gray-300 border border-white/30 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all duration-200"
                                placeholder="Confirm your password">
                        </div>
                    </div>
                </div>


                <div class="flex items-center mt-4">

                    <input type="checkbox" id="terms" name="terms" required
                        class="h-4 w-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 cursor-pointer" />

                    <label for="terms" class="ml-2 block text-sm text-gray-200">
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


                <p class="text-center text-sm text-gray-200">
                    Already have an account?
                    <a href="{{ route('loginPage') }}"
                        class="text-blue-200 hover:text-blue-100 font-semibold hover:underline transition-colors duration-200">Sign
                        in here</a>
                </p>

            </form>
        </div>
    </div>

    <dialog id="my_modal_3" class="modal rounded-2xl shadow-xl backdrop:bg-black/40">
        <div class="modal-box p-8 bg-white text-gray-800 rounded-2xl max-w-2xl w-full">
            <form method="dialog">

                <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </form>

            <h3 class="text-3xl font-bold text-center text-blue-800 mb-2">Terms of Service & Privacy Policy</h3>
            <p class="text-center text-gray-500 mb-8">Please review the following before creating your account.</p>


            <div class="space-y-6">
                <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                    <h4 class="text-xl font-semibold text-gray-700">1. Terms of Service</h4>
                    <p class="mt-2 text-gray-600 text-sm">
                        By creating an account, you agree to the following terms and conditions governing the use of
                        Barangay San Agustin's e-Services.
                    </p>
                    <ul class="list-inside list-disc pl-4 mt-4 text-gray-600 space-y-2 text-sm">
                        <li>You agree to provide accurate, current, and complete information during registration.</li>
                        <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
                        <li>The use of this service is subject to all applicable laws and ordinances of the Philippines.
                        </li>
                        <li>Barangay San Agustin reserves the right to suspend or terminate your account for any
                            violation of these terms.</li>
                    </ul>
                </div>


                <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
                    <h4 class="text-xl font-semibold text-gray-700">2. Data Privacy Policy</h4>
                    <p class="mt-2 text-gray-600 text-sm">
                        We are committed to protecting your personal information in compliance with the Data Privacy Act
                        of 2012 (Republic Act No. 10173).
                    </p>
                    <ul class="list-inside list-disc pl-4 mt-4 text-gray-600 space-y-2 text-sm">
                        <li><strong>Information We Collect:</strong> We collect personal data such as your name, contact
                            details, and address for the purpose of providing e-services.</li>
                        <li><strong>Purpose of Collection:</strong> Your data is collected to process service requests,
                            improve our services, and communicate with you about your transactions.</li>
                        <li><strong>Data Protection:</strong> We implement security measures to ensure your data is
                            protected from unauthorized access, alteration, or disclosure.</li>
                        <li><strong>Third-Party Disclosure:</strong> Your data will not be shared with third parties
                            without your explicit consent, except when required by law.</li>
                    </ul>
                </div>
            </div>


            <div class="mt-8 flex items-center">
                <input type="checkbox" id="agree" name="agree"
                    class="h-5 w-5 rounded-md text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer"
                    required>
                <label for="agree" class="ml-3 block text-base text-gray-700">
                    I have read and agree to the <a href="#"
                        class="text-blue-600 hover:text-blue-700 font-semibold transition-colors">Terms of Service</a>
                    and <a href="#"
                        class="text-blue-600 hover:text-blue-700 font-semibold transition-colors">Privacy Policy</a>.
                </label>
            </div>


            <div class="mt-6 flex justify-end">
                <button id="submit-button"
                    class="px-6 py-3 w-full sm:w-auto bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition-all"
                    disabled>
                    Proceed
                </button>
            </div>

            <p class="mt-4 text-center text-xs text-gray-400">
                By clicking 'Proceed', you confirm that you are a resident of Barangay San Agustin.
            </p>

        </div>
    </dialog>

    <script>
        $(document).ready(function() {
            function validatePasswords() {
                var password = $('#password').val();
                var confirmPassword = $('#password_confirmation').val();

                if (password.length > 0 && confirmPassword.length > 0) {
                    if (password !== confirmPassword) {
                        $('#password-error').removeClass('hidden');
                        $('#submit-btn').prop('disabled', true);
                    } else {
                        $('#password-error').addClass('hidden');
                        $('#submit-btn').prop('disabled', false);
                    }
                } else {
                    $('#password-error').addClass('hidden');
                    $('#submit-btn').prop('disabled', true);
                }
            }

            $('#password, #password_confirmation').on('keyup', validatePasswords);

            $('#submit-btn').prop('disabled', true);
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#agree').on('change', function() {
                var isChecked = $(this).prop('checked');
                $('#terms').prop('checked', isChecked);
                $('#submit-button').prop('disabled', !isChecked);
            });

            $('#terms').on('change', function() {
                var isChecked = $(this).prop('checked');
                $('#agree').prop('checked', isChecked);
                $('#submit-button').prop('disabled', !isChecked);
            });

            $('#submit-button').on('click', function() {
                $('#my_modal_3')[0].close();
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#agree').on('change', function() {
                let isChecked = $(this).prop('checked');
                $('#terms').prop('checked', isChecked);
                $('#submit-button').prop('disabled', !isChecked);
            });


            $('#terms').on('change', function() {
                let isChecked = $(this).prop('checked');
                $('#agree').prop('checked', isChecked);
                $('#submit-button').prop('disabled', !isChecked);
            });


            $('#submit-button').on('click', function() {
                $('#my_modal_3')[0].close();
            });
        });
    </script>

</body>

</html>
