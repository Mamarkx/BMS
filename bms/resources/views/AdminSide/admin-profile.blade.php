<x-admin-layout>

    <div class="max-w-5xl mx-auto mt-10 px-4">

        {{-- Main Profile Card --}}
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl shadow-2xl overflow-hidden">

            {{-- Header Section with Background --}}
            <div class="h-32 bg-gradient-to-r from-indigo-600 to-purple-700"></div>

            <div class="px-8 pb-8">
                {{-- Profile Avatar & Name --}}
                <div class="flex flex-col md:flex-row md:items-end md:justify-between -mt-16">
                    <div class="flex flex-col md:flex-row items-center md:items-end gap-6">
                        <div
                            class="w-32 h-32 rounded-full bg-white border-4 border-white shadow-xl flex items-center justify-center">
                            <span class="text-5xl font-bold text-indigo-600">
                                {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                            </span>
                        </div>

                        <div class="text-center md:text-left mb-4 md:mb-2">
                            <h2 class="text-3xl font-bold text-white">
                                {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}
                                {{ Auth::user()->last_name }}
                                @if (Auth::user()->suffix)
                                    <span class="text-2xl">{{ Auth::user()->suffix }}</span>
                                @endif
                            </h2>
                            <p
                                class="text-indigo-100 text-lg mt-1 flex items-center justify-center md:justify-start gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>

                    {{-- Role Badge --}}
                    <div class="flex justify-center md:justify-end mb-4 md:mb-2">
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold shadow-lg
                            @if (Auth::user()->role == 'Super Admin') bg-red-500 text-white
                            @elseif(Auth::user()->role == 'Admin') bg-blue-500 text-white
                            @else bg-green-500 text-white @endif">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Information Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

            {{-- Address Card --}}
            <div
                class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Address</p>
                        <p class="mt-2 text-gray-800 font-medium text-lg">{{ Auth::user()->address }}</p>
                    </div>
                </div>
            </div>

            {{-- Account Info Card --}}
            <div
                class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Account Type</p>
                        <p class="mt-2 text-gray-800 font-medium text-lg">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Action Buttons --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 mt-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Account Settings</h3>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#"
                    class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Profile
                </a>
                <a href="#"
                    class="flex-1 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    Change Password
                </a>
            </div>
        </div>

    </div>

</x-admin-layout>
