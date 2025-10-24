<x-admin-layout>

    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">

            {{-- Profile Header --}}
            <div class="flex items-center gap-6">
                <div
                    class="w-24 h-24 rounded-full bg-indigo-200 flex items-center justify-center text-3xl font-bold text-white">
                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}
                        {{ Auth::user()->suffix }}
                    </h2>
                    <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">

                {{-- Address --}}
                <div>
                    <p class="text-sm text-gray-500 font-medium">Address</p>
                    <p class="mt-1 font-semibold">{{ Auth::user()->address }}</p>
                </div>

                {{-- Role --}}
                <div>
                    <p class="text-sm text-gray-500 font-medium">Role</p>
                    <span
                        class="inline-block mt-1 text-sm font-semibold px-3 py-1 rounded-full
                        @if (Auth::user()->role == 'Super Admin') bg-red-100 text-red-600
                        @elseif(Auth::user()->role == 'Admin')
                            bg-blue-100 text-blue-600
                        @else
                            bg-green-100 text-green-600 @endif
                    ">
                        {{ Auth::user()->role }}
                    </span>
                </div>

            </div>

            <div class="mt-10 flex justify-end gap-4">
                <a href="{{ route('profile.edit') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition">
                    Edit Profile
                </a>
                <a href="{{ route('password.request') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-medium transition">
                    Change Password
                </a>
            </div>

        </div>
    </div>

</x-admin-layout>
