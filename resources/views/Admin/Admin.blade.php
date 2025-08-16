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
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #sidebar, #main-content {
            transition: all 0.3s ease;
        }
    </style>
</head>
 
<body>

    <div class="flex h-screen w-full">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed md:static h-screen bg-[#1E3A8A] text-white w-72 -ml-72 lg:ml-0 flex flex-col justify-between z-50">
            <div>
                <!-- Brand and Close Button -->
            <div class="flex items-center justify-between mb-2  px-6 bg-[#1E40AF] ">
                <div class="flex items-center py-2">              
                        <img src="{{ asset('images/san-agustin.png') }}" class="h-16 w-16 rounded-full" alt="Barangay Logo" />                 
                    <h1 class="text-xl font-semibold text-white ml-4 tracking-wide">San Agustin</h1>
                </div>
                <i class="fa-solid fa-angle-left hidden md:flex"></i>
                <i id="close-btn" class="fa-solid fa-xmark text-white cursor-pointer  p-3 rounded-md transition-all duration-300 hover:rotate-90 md:hidden"></i>
            </div>
                <!-- Navigation -->
                <div class="p-5">
                    <nav>
                        <ul class="space-y-4">
                            <li>
                                <a href="#" class="sidebar-link flex items-center font-medium text-white space-x-2 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <span><i class="fas fa-home w-5"></i></span> <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="sidebar-link flex items-center font-medium text-white space-x-2 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <span><i class="fa-solid fa-book w-5"></i></span> <span>Books Management</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="sidebar-link flex items-center font-medium text-white space-x-2 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <span><i class="fa-solid fa-users w-5"></i></span> <span>User Management</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="sidebar-link flex items-center font-medium text-white space-x-2 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <span><i class="fa-solid fa-address-book w-5"></i></span> <span>Borrowing Transactions</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Profile and Logout Section -->
            <div class="">
                <div class="flex items-center justify-between p-4  bg-[#1E40AF] shadow-sm transition-colors duration-200">
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
        <div id="main-content" class="flex-1 w-full bg-[#F3F4F6]">
            <nav class="h-16 bg-white border-b px-4 flex items-center justify-between">
                <button id="toggle-btn" class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div class="flex items-center gap-4">
                    <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                        <a href='#'><i class="fa-solid fa-user-gear text-xl"></i></a>
                    </button>
                </div>
            </nav>
            <div class="p-6">
                <main >
                    <!-- Main content goes here -->
                </main>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
    // Sidebar item click event to set active state
    $('.sidebar-link').on('click', function () {
        // Remove the 'active' class from all sidebar links
        $('.sidebar-link').removeClass('bg-indigo-50 text-indigo-600');

        // Add 'active' class to the clicked link
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
