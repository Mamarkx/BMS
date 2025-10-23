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
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

        <script src="https://cdn.tailwindcss.com"></script>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <style>
            .gradient-text {
                background: linear-gradient(135deg, #f0f9ff, #e0e7ff, #c7d2fe);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .icon-card {
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .icon-glow {
                filter: drop-shadow(0 0 8px currentColor);
            }

            .floating-particle {
                position: absolute;
                width: 4px;
                height: 4px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
            }

            input::-ms-reveal,
            input::-ms-clear {
                display: none;
            }


            input::-webkit-credentials-auto-fill-button,
            input::-webkit-password-toggle-button,
            input::-webkit-clear-button {
                display: none !important;
                -webkit-appearance: none;
            }
        </style>
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
                <form method="POST" action="{{ route('RegisterAcc') }}" class="w-full max-w-xl space-y-5">
                    @csrf
                    <div class="text-center mb-10">
                        <div class="mb-4 flex justify-center">
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center">
                                <i class="fas fa-users-cog text-white text-3xl"></i>
                            </div>
                        </div>
                        <h2 class="text-4xl font-extrabold mb-3 text-slate-900">Welcome to HR-IV</h2>
                        <p class="text-lg text-gray-600">Please log in with your Credentials Continue</p>
                    </div>

                    @error('failed')
                        <div
                            class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg text-sm font-medium flex items-center space-x-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror

                    @if (session('success'))
                        <div
                            class="bg-green-50 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg text-sm font-medium flex items-center space-x-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                        <div class="relative">
                            <input type="email" required id="email" name="email" value="{{ old('email') }}"
                                class="w-full px-11 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-200 @error('email') border-red-400 bg-red-50 @enderror"
                                placeholder="Enter Your Email">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 px-4 ">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                        </div>

                        @error('email')
                            <p class="text-red-500 text-sm mt-2 flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full px-11 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white transition-all duration-200 @error('password') border-red-400 bg-red-50 @enderror"
                                placeholder="Enter Your Password">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pr-3">
                                <i class="fas fa-key text-gray-400"></i>
                            </div>
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 flex items-center pr-5 text-gray-400 hover:text-gray-600">
                                <i id="toggleIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-2 flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-1">
                        <button type="submit"
                            class="w-full py-3 px-6 bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-800 transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            Sign In
                        </button>
                    </div>
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
