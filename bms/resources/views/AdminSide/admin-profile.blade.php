<x-admin-layout>

    <div class="max-w-5xl mx-auto mt-10">
        <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-200">

            <h2 class="text-2xl font-bold text-gray-800 mb-6">Profile Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                {{-- Left Form: Personal Info --}}
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="text-sm font-medium text-gray-600">First Name</label>
                        <input type="text" name="first_name" value="{{ Auth::user()->first_name }}"
                            class="w-full p-3 border rounded-lg focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ Auth::user()->middle_name }}"
                            class="w-full p-3 border rounded-lg focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Last Name</label>
                        <input type="text" name="last_name" value="{{ Auth::user()->last_name }}"
                            class="w-full p-3 border rounded-lg focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Suffix</label>
                        <input type="text" name="suffix" value="{{ Auth::user()->suffix }}"
                            class="w-full p-3 border rounded-lg focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Address</label>
                        <input type="text" name="address" value="{{ Auth::user()->address }}"
                            class="w-full p-3 border rounded-lg focus:ring-blue-500">
                    </div>

                    <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 mt-2 rounded-lg hover:bg-blue-700 transition">
                        Update Personal Info
                    </button>
                </form>


                {{-- Right Form: Account & Role --}}
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="text-sm font-medium text-gray-600">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}"
                            class="w-full p-3 border rounded-lg focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Role</label>
                        <select name="role" class="w-full p-3 border rounded-lg focus:ring-blue-500">
                            <option value="Super Admin" {{ Auth::user()->role == 'Super Admin' ? 'selected' : '' }}>
                                Super Admin</option>
                            <option value="Admin" {{ Auth::user()->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Resident" {{ Auth::user()->role == 'Resident' ? 'selected' : '' }}>Resident
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">New Password</label>
                        <input type="password" name="password" class="w-full p-3 border rounded-lg focus:ring-blue-500"
                            placeholder="Leave empty if unchanged">
                    </div>

                    <button type="submit"
                        class="bg-green-600 text-white px-5 py-2 mt-2 rounded-lg hover:bg-green-700 transition">
                        Update Account
                    </button>
                </form>

            </div>
        </div>
    </div>

</x-admin-layout>
