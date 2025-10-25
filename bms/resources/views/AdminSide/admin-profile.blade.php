<x-admin-layout>
    <div class="w-full h-screen  px-4 sm:px-6 lg:px-2  space-y-8">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-700 to-indigo-700 rounded-xl px-6 py-6 shadow-md text-white">
            <h1 class="text-3xl font-bold">Profile Settings</h1>
            <p class="text-sm text-indigo-100 mt-1">Manage your personal and account details</p>
        </div>

        <!-- Profile Forms -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Personal Info Form -->
            <form action="{{ route('profile.update.personal') }}" method="POST"
                class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
                @csrf
                @method('PUT')

                <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Personal Information</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">First Name</label>
                        <input type="text" name="first_name" value="{{ Auth::user()->first_name }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ Auth::user()->middle_name }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Last Name</label>
                        <input type="text" name="last_name" value="{{ Auth::user()->last_name }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Suffix</label>
                        <input type="text" name="suffix" value="{{ Auth::user()->suffix }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                    <input type="text" name="address" value="{{ Auth::user()->address }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-save"></i> Save Personal Info
                    </button>
                </div>
            </form>

            <!-- Account Info Form -->
            <form action="{{ route('profile.update.account') }}" method="POST"
                class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
                @csrf
                @method('PUT')

                <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Account Settings</h2>
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
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Current Password</label>
                        <input type="password" name="old_password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter current password to change">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">New Password</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:outline-none"
                            placeholder="Leave blank to keep current password">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Role</label>
                        <input type="text" name="role" value="{{ Auth::user()->role }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                            readonly>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
                        <i class="fas fa-user-cog"></i> Update Account
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-admin-layout>
<!-- Scripts -->
@if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            customClass: {
                popup: 'colored-toast'
            },
            background: '#ffffff',
            color: '#16a34a', // green text
        });
    </script>

    <style>
        .colored-toast {
            border-left: 6px solid #16a34a !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding-left: 12px !important;
        }
    </style>
@endif
