<x-admin-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">

            <!-- Header Section -->
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="space-y-1">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 tracking-tight">
                            Request Details
                        </h1>
                        <p class="text-sm sm:text-base text-gray-600">
                            Manage and verify ID request information
                        </p>
                    </div>
                    <a href="{{ url()->previous() }}"
                        class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-gray-900 to-gray-800 text-white px-5 py-2.5 rounded-xl shadow-lg hover:shadow-xl hover:from-gray-800 hover:to-gray-700 transition-all duration-200 text-sm font-semibold group w-full sm:w-auto">
                        <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform duration-200"></i>
                        <span>Back</span>
                    </a>
                </div>
            </div>

            <!-- Status Card -->
            <div class="mb-6 sm:mb-8">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div
                        class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="space-y-2">
                                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white">
                                    {{ $BrgyID->type }} Request
                                </h2>
                                <div class="flex flex-wrap items-center gap-2 text-xs sm:text-sm text-gray-300">
                                    <span class="font-medium">Reference:</span>
                                    <span class="font-mono bg-white/10 px-3 py-1 rounded-lg">
                                        {{ $BrgyID->reference_number }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold px-4 sm:px-6 py-2.5 sm:py-3 rounded-full shadow-lg
                                    @class([
                                        'bg-amber-400 text-amber-900' => $BrgyID->status === 'Pending',
                                        'bg-emerald-500 text-white' => $BrgyID->status === 'Approved',
                                        'bg-slate-600 text-white' => $BrgyID->status === 'To be Release',
                                        'bg-blue-600 text-white' => $BrgyID->status === 'Released',
                                    ])">
                                    <span
                                        class="h-2 w-2 rounded-full animate-pulse
                                        @class([
                                            'bg-amber-900' => $BrgyID->status === 'Pending',
                                            'bg-white' => $BrgyID->status !== 'Pending',
                                        ])"></span>
                                    <span class="uppercase tracking-wide">{{ ucfirst($BrgyID->status) }}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats Bar -->
                    <div
                        class="bg-gradient-to-r from-gray-50 to-white px-4 sm:px-6 lg:px-8 py-4 border-t border-gray-200">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <div class="text-center sm:text-left">
                                <p class="text-xs text-gray-500 font-medium mb-1">Type</p>
                                <p class="text-sm sm:text-base font-bold text-gray-900">{{ $BrgyID->type }}</p>
                            </div>
                            <div class="text-center sm:text-left">
                                <p class="text-xs text-gray-500 font-medium mb-1">Amount</p>
                                <p class="text-sm sm:text-base font-bold text-emerald-600">
                                    ₱{{ number_format($BrgyID->amount, 2) }}</p>
                            </div>
                            <div class="text-center sm:text-left">
                                <p class="text-xs text-gray-500 font-medium mb-1">Issue Date</p>
                                <p class="text-sm sm:text-base font-bold text-gray-900">
                                    {{ $BrgyID->issue_date ?? 'Pending' }}</p>
                            </div>
                            <div class="text-center sm:text-left">
                                <p class="text-xs text-gray-500 font-medium mb-1">Age</p>
                                <p class="text-sm sm:text-base font-bold text-gray-900">{{ $BrgyID->age }} years</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">

                @foreach ([
        [
            'icon' => 'fas fa-user',
            'title' => 'Personal Information',
            'color' => 'blue',
            'data' => [
                'Full Name' => $BrgyID->name,
                'Date of Birth' => $BrgyID->dob,
                'Age' => $BrgyID->age . ' years old',
                'Place of Birth' => $BrgyID->place_of_birth,
                'Gender' => $BrgyID->gender,
                'Civil Status' => $BrgyID->civil_status,
                'Address' => $BrgyID->address,
            ],
        ],
        [
            'icon' => 'fas fa-file-alt',
            'title' => 'Application Details',
            'color' => 'emerald',
            'data' => [
                'Request Type' => $BrgyID->type,
                'Purpose' => $BrgyID->purpose,
                'Current Status' => $BrgyID->status,
                'Issue Date' => $BrgyID->issue_date ?? 'Not Yet Issued',
                'Application Fee' => '₱' . number_format($BrgyID->amount, 2),
                'Reference Number' => $BrgyID->reference_number,
            ],
        ],
        [
            'icon' => 'fas fa-address-card',
            'title' => 'Additional Information',
            'color' => 'violet',
            'data' => [
                'Religion' => $BrgyID->religion,
                'Citizenship' => $BrgyID->citezenship,
                'Height' => $BrgyID->height,
                'Weight' => $BrgyID->weight,
                'Precinct Number' => $BrgyID->precint_number,
            ],
        ],
    ] as $section)
                    <div
                        class="bg-white rounded-2xl border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                        <div
                            class="bg-gradient-to-r from-{{ $section['color'] }}-600 to-{{ $section['color'] }}-700 px-4 sm:px-6 py-4 overflow-hidden">
                            <h3 class="flex items-center gap-2 sm:gap-3 text-base sm:text-lg font-bold text-white">
                                <div
                                    class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-white/20 rounded-lg backdrop-blur-sm flex-shrink-0">
                                    <i class="{{ $section['icon'] }} text-sm sm:text-base"></i>
                                </div>
                                <span class="truncate">{{ $section['title'] }}</span>
                            </h3>
                        </div>
                        <div class="p-4 sm:p-6 space-y-3">
                            @foreach ($section['data'] as $label => $value)
                                <div
                                    class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-2 pb-3 border-b border-gray-100 last:border-0 last:pb-0">
                                    <dt class="text-xs sm:text-sm text-gray-600 font-semibold flex-shrink-0">
                                        {{ $label }}</dt>
                                    <dd
                                        class="text-xs sm:text-sm text-gray-900 font-bold sm:text-right break-words overflow-hidden">
                                        {{ $value }}</dd>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Emergency Contact Card -->
                <div
                    class="bg-white rounded-2xl border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                    <div class="bg-gradient-to-r from-rose-600 to-rose-700 px-4 sm:px-6 py-4">
                        <h3 class="flex items-center gap-2 sm:gap-3 text-base sm:text-lg font-bold text-white">
                            <div
                                class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-white/20 rounded-lg backdrop-blur-sm flex-shrink-0">
                                <i class="fas fa-phone-alt text-sm sm:text-base"></i>
                            </div>
                            <span class="truncate">Emergency Contact</span>
                        </h3>
                    </div>
                    <div class="p-4 sm:p-6 space-y-3">
                        @foreach ([
        'Contact Name' => $BrgyID->emergency_name,
        'Phone Number' => $BrgyID->cellphone_number,
        'Address' => $BrgyID->emergency_address,
    ] as $label => $value)
                            <div
                                class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-2 pb-3 border-b border-gray-100 last:border-0 last:pb-0">
                                <dt class="text-xs sm:text-sm text-gray-600 font-semibold flex-shrink-0">
                                    {{ $label }}</dt>
                                <dd
                                    class="text-xs sm:text-sm text-gray-900 font-bold sm:text-right break-words overflow-hidden">
                                    {{ $value }}</dd>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- ID Proof Card -->
                <div
                    class="bg-white rounded-2xl border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden group lg:col-span-2">
                    <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-4 sm:px-6 py-4 overflow-hidden">
                        <h3 class="flex items-center gap-2 sm:gap-3 text-base sm:text-lg font-bold text-white">
                            <div
                                class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-white/20 rounded-lg backdrop-blur-sm flex-shrink-0">
                                <i class="fas fa-id-card text-sm sm:text-base"></i>
                            </div>
                            <span class="truncate">ID Proof Document</span>
                        </h3>
                    </div>

                    <div x-data="{ idModal: false }" class="p-4 sm:p-6">
                        @if ($BrgyID->id_proof)
                            <div class="space-y-4">
                                <div
                                    class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl p-4 sm:p-6 border-2 border-dashed border-indigo-200 overflow-hidden">
                                    <div class="flex flex-col sm:flex-row items-center gap-4">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-16 h-16 sm:w-20 sm:h-20 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                                <i class="fas fa-file-image text-2xl sm:text-3xl text-white"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1 text-center sm:text-left min-w-0">
                                            <p class="text-sm sm:text-base font-bold text-gray-900 mb-1">ID Document
                                                Uploaded</p>
                                            <p class="text-xs sm:text-sm text-gray-600">Click the button below to view
                                                the uploaded identification</p>
                                        </div>
                                    </div>
                                </div>

                                <button @click="idModal = true"
                                    class="w-full px-4 sm:px-6 py-3 sm:py-4 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-xl font-bold text-sm sm:text-base hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2 group">
                                    <i class="fas fa-eye group-hover:scale-110 transition-transform duration-200"></i>
                                    <span>View ID Document</span>
                                </button>
                            </div>

                            <div x-show="idModal" x-cloak
                                class="fixed inset-0 bg-black/80 backdrop-blur-sm flex justify-center items-center z-50 p-4"
                                @click="idModal = false" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                <div @click.stop
                                    class="bg-white rounded-2xl overflow-hidden max-w-4xl w-full max-h-[90vh] flex flex-col shadow-2xl"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95">
                                    <div
                                        class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-4 sm:px-6 py-4 flex justify-between items-center">
                                        <h4 class="text-base sm:text-lg font-bold text-white flex items-center gap-2">
                                            <i class="fas fa-id-card"></i>
                                            <span>ID Document Preview</span>
                                        </h4>
                                        <button @click="idModal = false"
                                            class="text-white hover:bg-white/20 rounded-lg w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center transition-colors duration-200 text-xl sm:text-2xl font-bold">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="flex-1 overflow-auto bg-gray-100 p-4">
                                        <img src="{{ asset('storage/' . $BrgyID->id_proof) }}"
                                            class="w-full h-auto rounded-lg shadow-lg" alt="ID Proof">
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8 sm:py-12">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gray-100 rounded-full mb-4">
                                    <i class="fas fa-image-slash text-2xl sm:text-3xl text-gray-400"></i>
                                </div>
                                <p class="text-sm sm:text-base text-gray-500 font-medium">No ID document has been
                                    uploaded yet</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</x-admin-layout>
