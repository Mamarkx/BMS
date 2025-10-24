<x-admin-layout>
    <div class="w-full min-h-screen bg-gray-50 px-4 py-10">

        <div class="max-w-5xl mx-auto space-y-10">

            {{-- Header --}}
            <div class="flex flex-col gap-2">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Account Settings
                </h1>
                <p class="text-gray-600 text-sm sm:text-base">
                    Update your personal and contact information below.
                </p>
            </div>

            <form action="#" method="POST" class="space-y-10">
                @csrf
                @method('PUT')

                {{-- Personal Information --}}
                <div class="bg-white rounded-3xl shadow-md hover:shadow-lg transition border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                            <i class="fa-solid fa-user text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Personal Information</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        @php
                            $fields = [
                                ['first_name', 'First Name', true],
                                ['middle_name', 'Middle Name', false],
                                ['last_name', 'Last Name', true],
                                ['suffix', 'Suffix', false, 'Jr., Sr., III'],
                            ];
                        @endphp

                        @foreach ($fields as [$field, $label, $required, $ph ?? null])
                            <div>
                                <label class="text-xs font-semibold text-gray-700 mb-1 block">
                                    {{ $label }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
                                </label>
                                <input type="text" name="{{ $field }}" placeholder="{{ $ph ?? '' }}"
                                    value="{{ Auth::user()->$field }}"
                                    class="w-full px-4 py-3 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- Contact --}}
                <div class="bg-white rounded-3xl shadow-md hover:shadow-lg transition border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                            <i class="fa-solid fa-envelope text-emerald-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Contact Information</h3>
                    </div>

                    <div class="space-y-6">

                        <div>
                            <label class="text-xs font-semibold text-gray-700 mb-1 block">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                class="w-full px-4 py-3 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-700 mb-1 block">
                                Current Address <span class="text-red-500">*</span>
                            </label>
                            <textarea name="address" rows="4"
                                class="w-full px-4 py-3 border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 resize-none">{{ Auth::user()->address }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-4">

                    <button type="submit"
                        class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-6 rounded-2xl font-semibold shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        Save Changes
                    </button>

                    <a href="#"
                        class="flex-1 bg-gray-800 hover:bg-black text-white py-3 px-6 rounded-2xl font-semibold shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-lock"></i>
                        Change Password
                    </a>

                    <button type="button" onclick="window.location.reload()"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-6 rounded-2xl font-semibold flex items-center justify-center gap-2 shadow-sm transition">
                        <i class="fa-solid fa-xmark"></i>
                        Cancel
                    </button>

                </div>

            </form>
        </div>

    </div>
</x-admin-layout>
