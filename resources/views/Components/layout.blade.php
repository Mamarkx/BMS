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
  <!-- Add jQuery and Slick CSS/JS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            background-color: #3b82f6; /* blue-500 */
        }

        .step-item .icon-container {
            width: 28px;
            height: 28px;
            border-radius: 9999px; /* full rounded */
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
 <!-- Header -->
<div class="fixed top-0 z-50 w-full bg-blue-900 backdrop-blur-md border-b border-blue-800/50 transition-all duration-300 p-2">
  <div class="container mx-auto flex h-12 items-center justify-between px-4 md:px-6">
    <div class="logo-side flex items-center gap-3">
      <img src="https://i.postimg.cc/bw7zj5ty/logo-san-agustin.png" class="w-12 h-12" alt="San Agustin Logo" />
      <span class="text-xl font-bold text-white">San Agustin</span>
    </div>
    <!-- Desktop View -->
    <div class="nav-options hidden md:flex items-center gap-1">
      <a href="{{ route('Home') }}" class="nav-link px-4 py-2 text-sm font-medium text-[#c7d7ee] hover:text-white hover:bg-blue-800/50 rounded-lg transition-all duration-200">Home</a>
      <a href="{{ route('Services') }}" class="nav-link px-4 py-2 text-sm font-medium text-[#c7d7ee] hover:text-white hover:bg-blue-800/50 rounded-lg transition-all duration-200">Services</a>
      <a href="{{ route('About') }}" class="nav-link px-4 py-2 text-sm font-medium text-[#c7d7ee] hover:text-white hover:bg-blue-800/50 rounded-lg transition-all duration-200">About</a>
      <a href="{{ route('Contact') }}" class="nav-link px-4 py-2 text-sm font-medium text-[#c7d7ee] hover:text-white hover:bg-blue-800/50 rounded-lg transition-all duration-200">Contact</a>
    </div>

<div class="hidden md:flex items-center gap-3">
  @auth
    <!-- If the user is authenticated, show the avatar icon -->
    <a href="#" class="flex items-center gap-2 text-white hover:text-blue-200">
<img src="https://avatar.iran.liara.run/username?username={{ urlencode(Auth::user()->name) }}" alt="Avatar" class="w-8 h-8 rounded-full">

      <span>{{ Auth::user()->name }}</span>
    </a>
  @else
    <!-- If the user is not authenticated, show the Login and Sign Up buttons -->
    <a href="{{ route('loginPage') }}" class="text-blue-200 hover:text-white hover:bg-blue-800/50 px-3 py-2 rounded-lg transition-all duration-200">
      Login
    </a>
    <a href="{{ route('RegisterPage')}}" class="bg-white text-blue-800 hover:bg-blue-100 font-semibold rounded-lg px-3 py-2 transition-all duration-200">
      Sign Up
    </a>
  @endauth
</div>

     <!-- Mobile View -->
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
              <img src="https://i.postimg.cc/bw7zj5ty/logo-san-agustin.png" class="w-12 h-12" alt="San Agustin Logo" />
              <span class="text-xl font-bold text-white">San Agustin</span>
            </div>
          </li>
             <!-- Mobile options View -->
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
    <!-- Landing Section -->
   <div class="div">
   
    {{ $slot }}
   
   </div>

</main>
    <!-- Footer Section -->
    <footer class="bg-blue-950 text-white py-12">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid md:grid-cols-3 gap-8">
           <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="https://i.postimg.cc/bw7zj5ty/logo-san-agustin.png" class="w-12 h-12" alt="San Agustin Logo" />
                    </div>
                    <span class="text-xl font-bold">San Agustin</span>
                </div>
                <p class="text-blue-200">Providing efficient digital services to our community members.</p>
                <div class="mt-4">
                    <a href="https://www.facebook.com" target="_blank" class="text-blue-600 hover:text-blue-800 mr-4">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" class="text-blue-600 hover:text-blue-800 mr-4">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="https://www.twitter.com" target="_blank" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-twitter fa-lg"></i>
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
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2h-7.64a2 2 0 0 1-2.18-2v-3a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2z"></path><path d="M18 16.92a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2z"></path><path d="M12 18v6"></path><path d="M12 18h8"></path></svg>
                            (+63) 900 000 0000
                        </li>
                        <li class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            support@sanagustin.gov.ph
                        </li>
                    </ul>
                </div>
            </div>
         <!-- Copyright Notice -->
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
