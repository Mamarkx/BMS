<x-admin-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-white">Profile Settings</h2>
                <p class="text-sm text-indigo-100 mt-1">Update your personal and account information</p>
            </div>

            <!-- Forms -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">

                <!-- Personal Info -->
                <form action="#" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Personal Information</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">First Name</label>
                        <input type="text" name="first_name" value="{{ Auth::user()->first_name }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ Auth::user()->middle_name }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Last Name</label>
                        <input type="text" name="last_name" value="{{ Auth::user()->last_name }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Suffix</label>
                        <input type="text" name="suffix" value="{{ Auth::user()->suffix }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                        <input type="text" name="address" value="{{ Auth::user()->address }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                            <i class="fas fa-save"></i> Save Personal Info
                        </button>
                    </div>
                </form>

                <!-- Account Info -->
                <form action="#" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Account Settings</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">New Password</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none"
                            placeholder="Leave blank to keep current password">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Role</label>
                        <input type="text" name="role" value="{{ Auth::user()->role }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                            readonly>
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
    </div>
</x-admin-layout>
