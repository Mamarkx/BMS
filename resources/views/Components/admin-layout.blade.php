<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #sidebar, #main-content {
            transition: all 0.3s ease;
        }
    </style>
</head>
 
<body data-theme="light">

    <div class="flex h-screen w-full">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed md:static h-screen bg-[#15399b] text-white w-72 -ml-72 lg:ml-0 flex flex-col justify-between z-50">
            <div>
                <!-- Brand and Close Button -->
            <div class="flex items-center justify-between mb-2 px-6 border-b border-white/40">
                <div class="flex items-center py-2">              
                        <img src="{{ asset('images/san-agustin.png') }}" class="h-16 w-16 rounded-full" alt="Barangay Logo" />                 
                    <h1 class="text-xl font-semibold text-white ml-4 tracking-wide">San Agustin</h1>
                </div>
                {{-- <i class="fa-solid fa-angle-left hidden md:flex"></i> --}}
             {{-- <i id="close-btn" class="fa-solid fa-xmark text-white cursor-pointer p-3 rounded-md transition-all duration-300 hover:rotate-90 hidden"></i> --}}
            </div>
                <!-- Navigation -->
                <div class="p-5">
                    <nav>
                    <ul class="space-y-4">
                            <li>
                                <a href="{{ route('dash') }}" class="sidebar-link flex items-center font-medium text-white space-x-4 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <i class="fas fa-home text-xl"></i><span class="ml-2">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ShowEmployee') }}" class="sidebar-link flex items-center font-medium text-white space-x-4 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <i class="fa-solid fa-book text-xl"></i><span class="ml-2">Employee Management</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ShowRes') }}" class="sidebar-link flex items-center font-medium text-white space-x-4 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <i class="fa-solid fa-users text-xl"></i><span class="ml-2">Resident Information</span>
                                </a>
                            </li>
                           <li class="relative">
    <!-- Parent Link -->
<li class="relative">
      <button id="requestDropdownButton" 
            class="flex items-center font-medium text-white space-x-2 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200 w-full"
            onclick="toggleDropdownSmooth('requestDropdown', this)">
        <i class="fa-solid fa-address-book text-xl"></i>
        <span class="ml-3">E-Services</span>
        <i class="fa-solid fa-chevron-down ml-auto transition-transform duration-300" id="chevronIcon"></i>
    </button>

    <!-- Dropdown Menu -->
    <ul id="requestDropdown" 
        class="max-h-0 overflow-hidden bg-indigo-700 rounded-lg transition-all duration-500"
        style="transition-property: max-height;">
        <li>
            <a href="{{ route('general.form') }}" class="block px-4 py-2 text-white hover:bg-indigo-50 hover:text-indigo-600 rounded-t-lg transition-colors duration-200">
                General Form
            </a>
        </li>
        <li>
            <a href="{{ route('business.permit') }}" class="block px-4 py-2 text-white hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                Business Permit
            </a>
        </li>
        <li>
            <a href="{{ route('barangay.id') }}" class="block px-4 py-2 text-white hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                Barangay ID
            </a>
        </li>
        <li>
            <a href="{{ route('cedula') }}" class="block px-4 py-2 text-white hover:bg-indigo-50 hover:text-indigo-600 rounded-b-lg transition-colors duration-200">
                Cedula
            </a>
        </li>
    </ul>
</li>

<script>
function toggleDropdownSmooth(id) {
    const dropdown = document.getElementById(id);
    const chevron = document.getElementById('chevronIcon');

    if (dropdown.style.maxHeight && dropdown.style.maxHeight !== "0px") {
        // Close
        dropdown.style.maxHeight = "0";
        chevron.style.transform = "rotate(0deg)";
    } else {
        // Open: set max-height to scrollHeight for smooth animation
        dropdown.style.maxHeight = dropdown.scrollHeight + "px";
        chevron.style.transform = "rotate(180deg)";
    }
}

// Close dropdown if clicked outside
window.addEventListener('click', function(e) {
    const dropdown = document.getElementById('requestDropdown');
    const button = document.getElementById('requestDropdownButton');
    const chevron = document.getElementById('chevronIcon');

    if (!button.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.maxHeight = "0";
        chevron.style.transform = "rotate(0deg)";
    }
});
</script>

                            {{-- <li>
                                <a href="#" class="sidebar-link flex items-center font-medium text-white space-x-4 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <i class="fa-solid fa-tasks text-xl"></i><span class="ml-2">Task Management</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="sidebar-link flex items-center font-medium text-white space-x-4 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <i class="fa-solid fa-users-cog text-xl"></i><span class="ml-2">User Management</span>
                                </a>
                            </li> --}}
                        </ul>


                    </nav>
                </div>
            </div>

            <!-- Profile and Logout Section -->
            <div class="">
                <div class="flex items-center justify-between p-4 shadow-sm transition-colors duration-200 border-white/40 border-t">
                    <div class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name=John+Mark&background=7E22CE&color=fff&size=64" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="text-white font-medium">Shin Ryujin</p>
                            <p class="text-[#93C5FD] text-sm">Admin</p>
                        </div>
                    </div>
                    <form method="POST" action="" class="logoutacc">
                        @csrf
                        <button type="submit" class="text-[#93C5FD] hover:text-red-500 transition ">
                            <i class="fa-solid fa-right-from-bracket text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 w-full bg-[#F4F4F4]">
            <nav class="h-16 bg-white border-b px-4 flex items-center justify-between border-gray-200">
                <button id="toggle-btn" class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="fa-solid fa-bars text-xl text-stone-900"></i>
                </button>
                <div class="flex items-center gap-4">
                    <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                        <a href='#'><i class="fa-solid fa-user-gear text-xl text-stone-900"></i></a>
                    </button>
                </div>
            </nav>
            <div class="p-6">
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
    $('.sidebar-link').on('click', function () {      
        $('.sidebar-link').removeClass('bg-indigo-50 text-indigo-600');
        $(this).addClass('bg-indigo-50 text-indigo-600');
    });
            $('#toggle-btn').on('click', function () {
                $('#sidebar').toggleClass('-ml-72 ml-0');
            });

            $('.logoutacc').on('submit', function (e) {
                e.preventDefault(); 
                let form = this; 
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to Logout?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, Pls!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    }
                });
            });
        });
    </script>
  
</body>
</html>
