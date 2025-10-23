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

        <div class="h-screen flex flex-col md:flex-row">
            <div class="h-auto md:h-screen w-full py-10 flex items-center justify-center bg-cover bg-center flex-1"
                style="background-image: url('{{ asset('images/register.jpg') }}');">
            </div>
            <!-- Right Side -->
            <div
                class="w-full
                max-w-xl flex-1 md:flex justify-center items-center bg-white/80 backdrop-blur-sm p-6 md:p-8">

                <!-- Form -->
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
                    @if ($errors->any())
                        <div id="errorModal" class="fixed inset-0 z-50 w-full max-w-md p-4">
                            <div
                                class="bg-red-100 border-l-4 border-red-500 text-red-800 rounded-2xl shadow-lg p-6 animate-slide-down relative">
                                <button type="button" onclick="closeErrorModal()"
                                    class="absolute top-6 right-3 text-red-600 hover:text-red-800 text-xl font-bold transition-colors">
                                    &times;
                                </button>

                                <ul class="space-y-2 text-sm text-red-800">
                                    @foreach ($errors->all() as $error)
                                        <li class="flex items-center gap-2">
                                            <i
                                                class="fa-solid fa-circle-exclamation text-red-700 text-lg font-semibold"></i>
                                            <span class="text-lg font-semibold">{{ $error }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <script>
                            function closeErrorModal() {
                                const modal = document.getElementById('errorModal');
                                if (modal) modal.style.display = 'none';
                            }
                            setTimeout(closeErrorModal, 3000);
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
        <script>
            const tl = gsap.timeline();

            function createParticles() {
                const container = document.getElementById('particles-container');
                for (let i = 0; i < 20; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'floating-particle';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.top = Math.random() * 100 + '%';
                    container.appendChild(particle);

                    gsap.to(particle, {
                        y: -30,
                        x: Math.random() * 100 - 50,
                        duration: 3 + Math.random() * 2,
                        repeat: -1,
                        yoyo: true,
                        ease: "sine.inOut",
                        delay: Math.random() * 2
                    });
                }
            }

            // Initialize particles
            createParticles();

            // Background icons floating animation
            gsap.to("#userIcon", {
                y: -20,
                rotation: 15,
                duration: 3,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut"
            });

            gsap.to("#briefcaseIcon", {
                y: -15,
                rotation: -10,
                duration: 2.5,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: 0.5
            });

            gsap.to("#chartIcon", {
                y: -12,
                rotation: 8,
                duration: 2.8,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: 1
            });

            gsap.to("#moneyIcon", {
                y: -18,
                rotation: -12,
                duration: 3.2,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: 1.5
            });

            gsap.to("#usersIcon", {
                y: -10,
                rotation: 6,
                duration: 2.3,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: 0.8
            });

            // Main content animation sequence
            tl.from("#mainHeading", {
                    y: -100,
                    opacity: 0,
                    scale: 0.8,
                    duration: 1.2,
                    ease: "back.out(1.7)"
                })
                .from("#description", {
                    y: 50,
                    opacity: 0,
                    duration: 0.8,
                    ease: "power3.out"
                }, "-=0.4")

            // Card hover animations
            const cards = ["#card1", "#card2", "#card3"];
            const icons = ["#icon1", "#icon2", "#icon3"];

            cards.forEach((card, index) => {
                const cardElement = document.querySelector(card);
                const iconElement = document.querySelector(icons[index]);

                cardElement.addEventListener("mouseenter", () => {
                    gsap.to(card, {
                        scale: 1.05,
                        y: -10,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                    gsap.to(iconElement, {
                        rotation: 360,
                        scale: 1.1,
                        duration: 0.5,
                        ease: "back.out(1.7)"
                    });
                });

                cardElement.addEventListener("mouseleave", () => {
                    gsap.to(card, {
                        scale: 1,
                        y: 0,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                    gsap.to(iconElement, {
                        rotation: 0,
                        scale: 1,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
            });

            // CTA Button hover animation
            const ctaBtn = document.querySelector("#ctaButton button");
            ctaBtn.addEventListener("mouseenter", () => {
                gsap.to(ctaBtn, {
                    scale: 1.1,
                    y: -2,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });

            ctaBtn.addEventListener("mouseleave", () => {
                gsap.to(ctaBtn, {
                    scale: 1,
                    y: 0,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });
        </script>
        <script>
            function togglePassword() {
                const password = document.getElementById("password");
                const icon = document.getElementById("toggleIcon");
                if (password.type === "password") {
                    password.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    password.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            }
        </script>
    </body>

    </html>
