<x-admin-layout>


    <div class="max-h-screen  bg-gradient-to-br from-gray-50 to-gray-100 p-6">

        <div class="w-full">

            <!-- Header Section -->
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-1 sm:space-y-0">

                        <!-- Title + Subtitle -->
                        <div class="space-y-1">
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 tracking-tight">
                                Request Details
                            </h1>
                            <p class="text-sm sm:text-base text-gray-600">
                                Manage and verify ID request information
                            </p>
                        </div>

                        <!-- Status Badge -->
                        <span
                            class="inline-flex items-center gap-2 text-sm font-bold px-4 py-2 rounded-full shadow-sm
        @class([
            'bg-yellow-300 text-yellow-900' => $BrgyID->status === 'Pending',
            'bg-green-500 text-white' => $BrgyID->status === 'Approved',
            'bg-indigo-500 text-white' => $BrgyID->status === 'To be Release',
            'bg-blue-600 text-white' => $BrgyID->status === 'Released',
        ])">

                            <span class="h-2 w-2 rounded-full animate-pulse
            @class([
                'bg-yellow-900' => $BrgyID->status === 'Pending',
                'bg-white' => $BrgyID->status !== 'Pending',
            ])">
                            </span>

                            {{ ucfirst($BrgyID->status) }}
                        </span>
                    </div>

                    <a href="{{ url()->previous() }}"
                        class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-gray-900 to-gray-800 text-white px-5 py-2.5 rounded-xl shadow-lg hover:shadow-xl hover:from-gray-800 hover:to-gray-700 transition-all duration-200 text-sm font-semibold group w-full sm:w-auto">
                        <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform duration-200"></i>
                        <span>Back</span>
                    </a>
                </div>
            </div>

            <!-- Main Card -->
            <div
                class="bg-white max-h-[650px] h-full w-full overflow-y-auto  rounded-lg shadow-xl border border-gray-200 overflow-hidden">

                <!-- Status Header -->
                <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
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
                <div class="bg-gradient-to-r from-gray-50 to-white px-4 sm:px-6 lg:px-8 py-4 border-b border-gray-200">
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

                <!-- Information Sections -->
                <div class="px-4 sm:px-6 lg:px-8 py-8 space-y-8">

                    <!-- Personal Information -->
                    <div class="overflow-hidden">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-xl flex-shrink-0">
                                <i class="fas fa-user text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">Personal Information</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ([
        'Full Name' => $BrgyID->name,
        'Date of Birth' => $BrgyID->dob,
        'Place of Birth' => $BrgyID->place_of_birth,
        'Gender' => $BrgyID->gender,
        'Civil Status' => $BrgyID->civil_status,
        'Address' => $BrgyID->address,
    ] as $label => $value)
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-lg p-4 border border-blue-200">
                                    <p class="text-xs font-semibold text-blue-700 mb-1">{{ $label }}</p>
                                    <p class="text-sm font-bold text-gray-900 break-words">{{ $value }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t border-gray-200"></div>

                    <!-- Application Details -->
                    <div class="overflow-hidden">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-emerald-600 rounded-xl flex-shrink-0">
                                <i class="fas fa-file-alt text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">Application Details</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ([
        'Request Type' => $BrgyID->type,
        'Purpose' => $BrgyID->purpose,
        'Current Status' => $BrgyID->status,
        'Issue Date' => $BrgyID->issue_date ?? 'Not Yet Issued',
        'Application Fee' => '₱' . number_format($BrgyID->amount, 2),
        'Reference Number' => $BrgyID->reference_number,
    ] as $label => $value)
                                <div
                                    class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-lg p-4 border border-emerald-200">
                                    <p class="text-xs font-semibold text-emerald-700 mb-1">{{ $label }}</p>
                                    <p class="text-sm font-bold text-gray-900 break-words">{{ $value }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t border-gray-200"></div>

                    <!-- Additional Information -->
                    <div class="overflow-hidden">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-violet-600 rounded-xl flex-shrink-0">
                                <i class="fas fa-address-card text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">Additional Information</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ([
        'Religion' => $BrgyID->religion,
        'Citizenship' => $BrgyID->citezenship,
        'Height' => $BrgyID->height,
        'Weight' => $BrgyID->weight,
        'Precinct Number' => $BrgyID->precint_number,
    ] as $label => $value)
                                <div
                                    class="bg-gradient-to-br from-violet-50 to-violet-100/50 rounded-lg p-4 border border-violet-200">
                                    <p class="text-xs font-semibold text-violet-700 mb-1">{{ $label }}</p>
                                    <p class="text-sm font-bold text-gray-900 break-words">{{ $value }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t border-gray-200"></div>

                    <!-- Emergency Contact -->
                    <div class="overflow-hidden">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-rose-600 rounded-xl flex-shrink-0">
                                <i class="fas fa-phone-alt text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">Emergency Contact</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ([
        'Contact Name' => $BrgyID->emergency_name,
        'Phone Number' => $BrgyID->cellphone_number,
        'Address' => $BrgyID->emergency_address,
    ] as $label => $value)
                                <div
                                    class="bg-gradient-to-br from-rose-50 to-rose-100/50 rounded-lg p-4 border border-rose-200">
                                    <p class="text-xs font-semibold text-rose-700 mb-1">{{ $label }}</p>
                                    <p class="text-sm font-bold text-gray-900 break-words">{{ $value }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t border-gray-200"></div>

                    <!-- ID Proof Document -->
                    <div x-data="{ idModal: false }" class="overflow-hidden">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-indigo-600 rounded-xl flex-shrink-0">
                                <i class="fas fa-id-card text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">ID Proof Document</h3>
                        </div>

                        @if ($BrgyID->id_proof)
                            <div class="space-y-4">
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
                            <div
                                class="text-center py-8 sm:py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
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
