  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay San Agustin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TypewriterJS/2.21.0/core.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Swiper.js CDN -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

      @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
      body {
        font-family: 'Inter', sans-serif;
      }
      .hero-section {
        position: relative;
      }
.hero-overlay-left {
  clip-path: polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%); 
  background-color: transparent; 
}

.hero-overlay-right {
  clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%); 
  background-color: rgba(8, 10, 18, 0.7); 

}

@media (min-width: 1024px) {
  /* lg breakpoint */
  .hero-overlay-left {
    clip-path: polygon(0% 0%, 30% 0%, 70% 100%, 0% 100%); 
    background-color: #c7d7ee; 
  }

  .hero-overlay-right {
    clip-path: polygon(30% 0%, 100% 0%, 100% 100%, 70% 100%); 
  }
}
      .reveal-section {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
      }
      .reveal-section.is-visible {
        opacity: 1;
        transform: translateY(0);
      }
      .hover-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
      }
      .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      }
      .step-number-bg {
            background-image: linear-gradient(to right, #2563eb, #3b82f6);
        }
                .form-container {
            max-width: 900px;
        }
        .step-icon-bg {
            background-color: #e0f2fe; 
        }
        .step-icon-color {
            color: #2563eb; 
        }
        .text-blue-950 {
            color: #0c4a6e;
        }
        .steps-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 3rem;
            color: #d1d5db; 
        }

        .step-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            padding: 0 0.5rem;
        }

        .step-item .line {
            width: 100%;
            height: 2px;
            background-color: #d1d5db;
            position: absolute;
            top: 13px;
            left: 50%;
            z-index: -1;
        }
        
        .step-item:first-child .line {
            left: auto;
            right: 0;
            width: 50%;
        }

        .step-item:last-child .line {
            width: 50%;
        }
        
        .step-item.completed .line {
            background-color: #3b82f6; 
        }

        .step-item .icon-container {
            width: 28px;
            height: 28px;
            border-radius: 9999px; 
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #d1d5db;
            color: #ffffff;
            font-weight: 600;
            z-index: 10;
        }
        .step-item.active .icon-container {
            background-color: #3b82f6;
        }
        
        .step-item.completed .icon-container {
            background-color: #08CB00;
        }

        .step-item .step-label {
            margin-top: 0.5rem;
            font-size: 0.875rem; 
            font-weight: 600; 
            text-align: center;
        }

        .step-item.active .step-label,
        .step-item.completed .step-label {
            color: #1f2937; 
        }
        
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
<main id="main">
@php
  $blueRoutes = ['Services', 'About', 'Contact' , 'applications','service.form'];
@endphp

<div id="header"
     class="fixed top-0 z-50 w-full border-b transition-all duration-300 p-2 backdrop-blur-md
     {{ in_array(Route::currentRouteName(), $blueRoutes) ? 'bg-blue-900 border-blue-800/50' : 'bg-transparent border-transparent' }}">
    <!-- Navbar -->
  <div class="container mx-auto flex h-12 items-center justify-between px-4 md:px-6">
    <div class="logo-side flex items-center gap-2">
      <img src="{{ asset('images/san-agustin.png') }}" class="w-12 h-12" alt="San Agustin Logo" />
      <span class="text-xl font-bold text-white">Brgy. San Agustin</span>
    </div>
   
    <div class="nav-options hidden md:flex items-center gap-1">
      <a href="{{ route('Home') }}" class="nav-link px-4 py-2 text-md font-medium text-[#c7d7ee] hover:text-white hover:bg-blue-800/50 rounded-lg transition-all duration-200">Home</a>
      <a href="{{ route('Services') }}" class="nav-link px-4 py-2 text-md font-medium text-[#c7d7ee] hover:text-white hover:bg-blue-800/50 rounded-lg transition-all duration-200">Services</a>
      <a href="{{ route('About') }}" class="nav-link px-4 py-2 text-md font-medium text-[#c7d7ee] hover:text-white hover:bg-blue-800/50 rounded-lg transition-all duration-200">About</a>
      <a href="{{ route('Contact') }}" class="nav-link px-4 py-2 text-md font-medium text-[#c7d7ee] hover:text-white hover:bg-blue-800/50 rounded-lg transition-all duration-200">Contact</a>
    </div>

<div class="hidden md:flex items-center gap-3">
  @auth

<div class="relative">
    <a href="#" class="group flex items-center gap-1 text-white hover:text-white/80 focus:outline-none transition-colors duration-200" id="avatarDropdownBtn">
        <i class="fa-solid fa-circle-user fa-2x text-gray-300 group-hover:text-white transition-all duration-300 transform"></i>
        <span class="hidden lg:block text-sm font-normal">{{ Auth::user()->first_name }}</span>
        <svg class="w-3 h-3 ml-1 text-white group-hover:text-white/80 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </a>

    <div id="avatarDropdown" class="absolute right-0 hidden mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-xl ring-1 ring-gray-200 focus:outline-none animate-fade-in-up transform origin-top-right">
        <div class="py-1">
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-md mx-1 my-0.5 transition-colors duration-200 group">
                <i class="fa-solid fa-user-circle w-4 text-center mr-2 text-gray-500 group-hover:text-indigo-600 transition-colors"></i>Profile
            </a>
            <a href="{{ route('applications') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-md mx-1 my-0.5 transition-colors duration-200 group">
                <i class="fa-solid fa-list-check w-4 text-center mr-2 text-gray-500 group-hover:text-indigo-600 transition-colors"></i>Applications
            </a>
        </div>
        <div class="border-t border-gray-100 py-1">
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <button type="submit" class="w-full text-left flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 rounded-md mx-1 my-0.5 transition-colors duration-200 group">
                    <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center mr-2 text-red-500 group-hover:text-red-700 transition-colors"></i>Logout
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(10px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}
.animate-fade-in-up {
  animation: fade-in-up 0.25s ease-out forwards;
}
</style>

  @else
    <a href="{{ route('loginPage') }}" class="text-blue-200 hover:text-white hover:bg-blue-800/50 px-3 py-2 rounded-lg transition-all duration-200">
      Login
    </a>
    <a href="{{ route('RegisterPage')}}" class="bg-white text-blue-800 hover:bg-blue-100 font-semibold rounded-lg px-3 py-2 transition-all duration-200">
      Sign Up
    </a>
  @endauth
</div>

    <div class="md:hidden">
      <input id="my-drawer" type="checkbox" class="drawer-toggle hidden" />
      <div class="drawer-content">
        <label for="my-drawer" class="hover:bg-white p-2 hover:text-black rounded-lg cursor-pointer text-white">
          <i class="fa-solid fa-bars text-xl"></i>
        </label>
      </div>
      <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-blue-900 text-white min-h-full w-80 p-4">
          <li class="mb-4 border-white border-b">
            <div class="logo-side flex items-center gap-3">
              <img src="{{ asset('images/san-agustin.png') }}" class="w-12 h-12" alt="San Agustin Logo" />
              <span class="text-xl font-bold text-white">Brgy San Agustin</span>
            </div>
          </li>
          <li>
            <a href="{{ route('Home') }}" class="px-4 py-5 hover:bg-blue-800/50 rounded-lg transition-all duration-200">Home</a>
          </li>
          <li>
            <a href="{{ route('Services') }}" class="px-4 py-5 hover:bg-blue-800/50 rounded-lg transition-all duration-200">Services</a>
          </li>
          <li>
            <a href="{{ route('About') }}" class="px-4 py-5 hover:bg-blue-800/50 rounded-lg transition-all duration-200">About</a>
          </li>
          <li>
            <a href="{{ route('Contact') }}" class="px-4 py-5 hover:bg-blue-800/50 rounded-lg transition-all duration-200">Contact</a>
          </li>
          <li class="mt-4">
            <a href="{{ route('loginPage')  }}" class="text-white hover:bg-blue-800/50 px-3 py-5 rounded-lg transition-all duration-200 w-full text-left">
              Login
            </a>
          </li>
          <li>
            <a href="{{ route('RegisterPage')}}" class="bg-white text-blue-800 hover:bg-blue-100 font-semibold rounded-lg px-3 py-5 transition-all duration-200 w-full text-left mt-2">
              Sign Up
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

   <div class="div">
   
    {{ $slot }}
   
   </div>

</main>

    <footer class="bg-blue-950 text-white py-12">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid md:grid-cols-3 gap-8">
           <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('images/san-agustin.png') }}" class="w-12 h-12" alt="San Agustin Logo" />
                    </div>
                    <span class="text-xl font-bold">San Agustin</span>
                </div>
                <p class="text-blue-200">Providing efficient digital services to our community members.</p>
                <div class="mt-4">
                    <a href="https://www.facebook.com/share/1K148thiPR/" target="_blank" class="text-blue-600 hover:text-blue-800 mr-4">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                  <a href="mailto:brgysanagustin13@gmail.com" target="_blank" class="text-blue-600 hover:text-blue-800 mr-4">
                      <i class="fa-solid fa-envelope fa-lg"></i>
                  </a>
                </div>
            </div>

                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-blue-200">
                        <li>
                            <a href="#services" class="hover:text-white hover:underline transition-colors">
                               Home
                            </a>
                        </li>
                        <li>
                            <a href="#how" class="hover:text-white hover:underline transition-colors">
                               Services
                            </a>
                        </li>
                        <li>
                            <a href="#track" class="hover:text-white hover:underline transition-colors">
                                About
                            </a>
                        </li>
                             <li>
                            <a href="#track" class="hover:text-white hover:underline transition-colors">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-blue-200">
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            San Agustin, Philippines
                        </li>
                       <ul class="space-y-2 text-blue-200" >
                        <li class="flex items-center gap-2">
                          <i class="fas fa-phone w-4 h-4 "></i>
                          <span>Admin Office: <strong>8936-1295</strong></span>
                        </li>
                        <li class="flex items-center gap-2">
                          <i class="fas fa-shield-alt w-4 h-4 "></i>
                          <span>BPSO: <strong>82876248</strong></span> | <strong>0919-0647-974</strong></span>
                        </li>
                      </ul>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            brgysanagustin13@gmail.com
                        </li>
                    </ul>
                </div>
            </div>

        <div class="border-t border-blue-800 mt-12 pt-8 text-center text-blue-300">
            <div class="max-w-3xl mx-auto">
                <p class="text-lg font-medium">&copy; {{ date('Y') }} Barangay San Agustin. All rights reserved.</p>
                <p class="text-sm mt-2 text-blue-400">Made by TechBit</p>
            </div>
        </div>

        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
</body>
</html>
<script>
document.getElementById('avatarDropdownBtn').addEventListener('click', function(event) {
    event.preventDefault();
    
    const dropdown = document.getElementById('avatarDropdown');
    
    
    dropdown.classList.toggle('hidden');
});


document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('avatarDropdown');
    const avatarBtn = document.getElementById('avatarDropdownBtn');
    

    if (!avatarBtn.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});



</script>
<script>
  const header = document.getElementById("header");
  const isBlueRoute = @json(in_array(Route::currentRouteName(), $blueRoutes));

  if (!isBlueRoute) {
    // Only apply scroll effect on routes that are NOT services/about/contact
    window.addEventListener("scroll", () => {
      const scrolled = window.scrollY > 100;

      header.classList.toggle("bg-blue-900", scrolled);
      header.classList.toggle("border-blue-800/50", scrolled);
      header.classList.toggle("backdrop-blur-md", scrolled);

      header.classList.toggle("bg-transparent", !scrolled);
      header.classList.toggle("border-transparent", !scrolled);
    });
  }
</script>