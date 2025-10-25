<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/daisyui.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        #sidebar,
        #main-content {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body data-theme="light">

    <div class="flex h-auto w-full">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed md:static h-auto bg-[#15399b] text-white w-72 -ml-72 lg:ml-0 flex flex-col justify-between z-50">
            <div>
                <!-- Brand and Close Button -->
                <div class="flex items-center justify-between mb-2 px-6 border-b border-white/40">
                    <div class="flex items-center py-2">
                        <img src="{{ asset('images/san-agustin.png') }}" class="h-16 w-16 rounded-full"
                            alt="Barangay Logo" />
                        <h1 class="text-xl font-semibold text-white ml-2 tracking-wide">San Agustin</h1>
                    </div>
                    {{-- <i class="fa-solid fa-angle-left hidden md:flex"></i> --}}
                    {{-- <i id="close-btn" class="fa-solid fa-xmark text-white cursor-pointer p-3 rounded-md transition-all duration-300 hover:rotate-90 hidden"></i> --}}
                </div>
                <!-- Navigation -->
                <div class="p-5">
                    <nav>
                        <ul class="space-y-4">
                            <li>
                                <a href="{{ route('dash') }}"
                                    class="sidebar-link flex items-center font-medium text-white space-x-4 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <i class="fas fa-home text-xl"></i><span class="ml-2">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('Announce') }}"
                                    class="sidebar-link flex items-center font-medium text-white space-x-4 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <i class="fa-solid fa-bullhorn text-xl"></i>
                                    <span class="ml-2">Announcement Management</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('ShowEmployee') }}"
                                    class="sidebar-link flex items-center font-medium text-white space-x-4 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <i class="fa-solid fa-book text-xl"></i><span class="ml-2">Employee
                                        Management</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ShowRes') }}"
                                    class="sidebar-link flex items-center font-medium text-white space-x-4 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                    <i class="fa-solid fa-users text-xl"></i><span class="ml-2">Resident
                                        Information</span>
                                </a>
                            </li>
                            <!-- Parent Link -->
                            <li class="relative">
                                <button id="requestDropdownButton"
                                    class="flex items-center font-medium text-white space-x-2 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200 w-full"
                                    onclick="toggleDropdownSmooth('requestDropdown', this)">
                                    <i class="fa-solid fa-address-book text-xl"></i>
                                    <span class="">E-Services Management</span>
                                    <i class="fa-solid fa-chevron-down ml-auto transition-transform duration-300"
                                        id="chevronIcon"></i>
                                </button>

                                <!-- Dropdown Menu -->
                                <ul id="requestDropdown"
                                    class="max-h-0 overflow-hidden bg-indigo-700 rounded-lg transition-all duration-500"
                                    style="transition-property: max-height;">
                                    <li>
                                        <a href="{{ route('general.form') }}"
                                            class="block px-4 py-2 text-white hover:bg-indigo-50 hover:text-indigo-600 rounded-t-lg transition-colors duration-200">
                                            General Form
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('business.permit') }}"
                                            class="block px-4 py-2 text-white hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                            Business Permit
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('barangay.id') }}"
                                            class="block px-4 py-2 text-white hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                            Barangay ID
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('cedula') }}"
                                            class="block px-4 py-2 text-white hover:bg-indigo-50 hover:text-indigo-600 rounded-b-lg transition-colors duration-200">
                                            Cedula
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @auth
                                @if (Auth::user()->role === 'Super Admin')
                                    <li>
                                        <a href="{{ route('UserManage') }}"
                                            class="sidebar-link flex items-center font-medium text-white space-x-4 p-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-200">
                                            <i class="fa-solid fa-users-gear text-xl"></i>
                                            <span class="ml-2">User Management</span>
                                        </a>
                                    </li>
                                @endif
                            @endauth

                        </ul>
                    </nav>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 w-full h-auto bg-[#F4F4F4]">
            <nav class="h-16 bg-white border-b px-4 flex items-center justify-between border-gray-200">
                <button id="toggle-btn" class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="fa-solid fa-bars text-xl text-stone-900"></i>
                </button>
                <!-- Profile Button -->
                <div class="flex items-center gap-4">
                    <button id="profileBtn" class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                        <i class="fa-solid fa-user-gear text-xl text-stone-900"></i>
                    </button>
                </div>

                <!-- Profile Modal -->
                <div id="profileModal" class="fixed top-17 right-6 hidden z-50">
                    <div
                        class="bg-white w-72 rounded-xl shadow-lg border border-gray-200 overflow-hidden animate-fade-in-down">

                        <!-- Header -->
                        <div class="flex items-center gap-3 p-4 border-b border-gray-100">
                            <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full">
                                <i class="fa-solid fa-user text-2xl text-gray-700"></i>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-gray-800">{{ Auth::user()->first_name }}
                                    {{ Auth::user()->last_name }}</h2>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="p-4 space-y-2">
                            <a href="{{ route('admin.profile') }}"
                                class="block w-full btn text-sm font-medium text-gray-700 py-2 px-3 rounded-lg hover:bg-gray-100 transition">
                                <i class="fa-solid fa-id-card mr-2 text-gray-500"></i> View Profile
                            </a>

                            <form method="POST" action="{{ route('admin.logout') }}" class="logoutacc"
                                id="logoutForm">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 py-2 text-sm font-medium rounded-lg text-white bg-red-500 hover:bg-red-600 transition">
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Animation -->
                <style>
                    @keyframes fade-in-down {
                        0% {
                            opacity: 0;
                            transform: translateY(-10px);
                        }

                        100% {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    .animate-fade-in-down {
                        animation: fade-in-down 0.2s ease-out;
                    }
                </style>


            </nav>
            <main class="h-screen md:h-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.sidebar-link').on('click', function() {
                $('.sidebar-link').removeClass('bg-indigo-50 text-indigo-600');
                $(this).addClass('bg-indigo-50 text-indigo-600');
            });
            $('#toggle-btn').on('click', function() {
                $('#sidebar').toggleClass('-ml-72 ml-0');
            });

            $('.logoutacc').on('submit', function(e) {
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
    <script>
        const profileBtn = document.getElementById('profileBtn');
        const profileModal = document.getElementById('profileModal');
        const closeModal = document.getElementById('closeModal');

        profileBtn.addEventListener('click', () => {
            profileModal.classList.toggle('hidden');
        });

        closeModal.addEventListener('click', () => {
            profileModal.classList.add('hidden');
            profileModal.classList.remove('flex');
        });

        // Close modal when clicking outside the box
        window.addEventListener('click', (e) => {
            if (e.target === profileModal) {
                profileModal.classList.add('hidden');
                profileModal.classList.remove('flex');
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.getElementById("main-content");
            const toggleBtn = document.getElementById("toggle-btn");
            const closeAdmin = document.getElementById("close-btn");

            function toggleSidebar() {
                if (window.innerWidth >= 768) {
                    if (sidebar.classList.contains("lg:ml-0")) {
                        sidebar.classList.remove("lg:ml-0");
                        sidebar.classList.add("lg:-ml-72");
                        mainContent.classList.add("lg:ml-0");
                    } else {
                        sidebar.classList.add("lg:ml-0");
                        sidebar.classList.remove("lg:-ml-72");
                        mainContent.classList.remove("lg:ml-0");
                    }
                } else {
                    sidebar.classList.toggle("ml-0");
                }
            }

            function closeSidebar() {
                if (window.innerWidth < 768) {
                    sidebar.classList.remove("ml-0");
                    overlay.classList.add("hidden");
                }
            }

            toggleBtn.addEventListener("click", toggleSidebar);

            closeAdmin.addEventListener("click", closeSidebar);

            window.addEventListener("resize", () => {
                if (window.innerWidth >= 768) {
                    overlay.classList.add("hidden");
                    sidebar.classList.remove("ml-0");
                    if (!sidebar.classList.contains("lg:-ml-72")) {
                        mainContent.classList.remove("lg:ml-0");
                    }
                } else {
                    sidebar.classList.remove("lg:-ml-72");
                    sidebar.classList.add("lg:ml-0");
                    mainContent.classList.remove("lg:ml-0");
                    if (!sidebar.classList.contains("ml-0")) {
                        overlay.classList.add("hidden");
                    }
                }
            });
        });
    </script>

    <script>
        let idleTime = 0;
        const maxIdleTime = 600; // seconds before showing warning
        const countdownSeconds = 5; // countdown before actual logout
        let warningShown = false;
        let countdownInterval = null;

        // Reset idle timer on user activity
        function resetIdleTime() {
            idleTime = 0;
            if (warningShown) {
                clearInterval(countdownInterval);
                Swal.close();
                warningShown = false;
            }
        }

        // Track user activity
        ['mousemove', 'keypress', 'click', 'scroll', 'touchstart'].forEach(evt =>
            document.addEventListener(evt, resetIdleTime)
        );

        // Check idle time every second
        setInterval(() => {
            idleTime++;

            if (!warningShown && idleTime >= maxIdleTime) {
                warningShown = true;
                let remaining = countdownSeconds;

                Swal.fire({
                    title: 'Session Timeout!',
                    html: `
                    <div style="font-size: 24px; font-weight: bold;">
                        You will be logged out in <strong id="swal-timer">${remaining}</strong> seconds
                    </div>
                    <p style="font-size: 16px; color: #333;">Please take action to avoid losing your progress.</p>
                `,
                    icon: 'warning',
                    background: '#ffffff',
                    iconColor: '#ff9800',
                    showCancelButton: false,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        const timerEl = Swal.getHtmlContainer().querySelector('#swal-timer');
                        countdownInterval = setInterval(() => {
                            remaining--;
                            if (timerEl) timerEl.textContent = remaining;

                            if (remaining <= 0) {
                                clearInterval(countdownInterval);

                                // Submit the existing logout form
                                const logoutForm = document.getElementById('logoutForm');
                                if (logoutForm) {
                                    logoutForm.submit();
                                } else {
                                    // Fallback redirect if form not found
                                    window.location.href = "{{ route('admin.login') }}";
                                }
                            }
                        }, 1000);
                    }
                });
            }
        }, 1000);
    </script>

</body>

</html>
