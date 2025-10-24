<x-admin-layout>
    <div class="max-h-screen w-full overflow-y-hidden bg-gradient-to-br from-gray-50 to-gray-100">

        <!-- Card Wrapper -->
        <div class="px-4 py-2">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">

                <!-- Header -->
                <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 px-6 py-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-2xl lg:text-3xl font-bold text-white">{{ $BrgyID->type }} Request</h2>
                            <div class="flex items-center gap-2 text-sm text-gray-300 mt-1">
                                <span>Reference:</span>
                                <span class="font-mono bg-white/10 px-3 py-1 rounded-lg">
                                    {{ $BrgyID->reference_number }}
                                </span>
                            </div>
                        </div>

                        <span
                            class="inline-flex items-center gap-2 text-sm font-bold px-6 py-3 rounded-full shadow-lg
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
                                ])">
                            </span>
                            {{ ucfirst($BrgyID->status) }}
                        </span>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="px-6 py-5 border-b bg-gradient-to-r from-gray-50 to-white">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div>
                            <p class="text-xs text-gray-500">Type</p>
                            <p class="font-bold">{{ $BrgyID->type }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Amount</p>
                            <p class="font-bold text-emerald-600">₱{{ number_format($BrgyID->amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Issue Date</p>
                            <p class="font-bold">{{ $BrgyID->issue_date ?? 'Pending' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Age</p>
                            <p class="font-bold">{{ $BrgyID->age }} years</p>
                        </div>
                    </div>
                </div>

                <!-- Sections Grid -->
                <div class="px-6 py-10 grid grid-cols-1 md:grid-cols-2 gap-10">

                    <!-- Personal Info -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <h3 class="font-bold text-lg">Personal Information</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ([
        'Full Name' => $BrgyID->name,
        'Date of Birth' => $BrgyID->dob,
        'Age' => $BrgyID->age . ' years old',
        'Place of Birth' => $BrgyID->place_of_birth,
        'Gender' => $BrgyID->gender,
        'Civil Status' => $BrgyID->civil_status,
        'Address' => $BrgyID->address,
    ] as $label => $value)
                                <div class="p-4 bg-blue-50 rounded-lg border">
                                    <p class="text-xs font-semibold text-blue-700">{{ $label }}</p>
                                    <p class="font-bold text-gray-900 break-all">{{ $value }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Application Info -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                            <h3 class="font-bold text-lg">Application Details</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ([
        'Request Type' => $BrgyID->type,
        'Purpose' => $BrgyID->purpose,
        'Current Status' => $BrgyID->status,
        'Issue Date' => $BrgyID->issue_date ?? 'Not Yet Issued',
        'Application Fee' => '₱' . number_format($BrgyID->amount, 2),
        'Reference Number' => $BrgyID->reference_number,
    ] as $label => $value)
                                <div class="p-4 bg-emerald-50 rounded-lg border">
                                    <p class="text-xs font-semibold text-emerald-700">{{ $label }}</p>
                                    <p class="font-bold break-all">{{ $value }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-12 h-12 bg-violet-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-address-card text-white"></i>
                            </div>
                            <h3 class="font-bold text-lg">Additional Information</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ([
        'Religion' => $BrgyID->religion,
        'Citizenship' => $BrgyID->citezenship,
        'Height' => $BrgyID->height,
        'Weight' => $BrgyID->weight,
        'Precinct Number' => $BrgyID->precint_number,
    ] as $label => $value)
                                <div class="p-4 bg-violet-50 rounded-lg border">
                                    <p class="text-xs font-semibold text-violet-700">{{ $label }}</p>
                                    <p class="font-bold">{{ $value }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Emergency Info -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-12 h-12 bg-rose-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-phone-alt text-white"></i>
                            </div>
                            <h3 class="font-bold text-lg">Emergency Contact</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ([
        'Contact Name' => $BrgyID->emergency_name,
        'Phone Number' => $BrgyID->cellphone_number,
        'Address' => $BrgyID->emergency_address,
    ] as $label => $value)
                                <div class="p-4 bg-rose-50 rounded-lg border">
                                    <p class="text-xs font-semibold text-rose-700">{{ $label }}</p>
                                    <p class="font-bold break-all">{{ $value }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- ID Proof -->
                    <div x-data="{ open: false }" class="bg-white rounded-xl shadow-sm p-6 border">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-id-card text-white"></i>
                            </div>
                            <h3 class="font-bold text-lg">ID Proof Document</h3>
                        </div>

                        @if ($BrgyID->id_proof)
                            <button @click="open = true"
                                class="w-full bg-indigo-600 text-white py-3 rounded-lg shadow hover:bg-indigo-700">
                                View ID Document
                            </button>

                            <div x-show="open" x-transition x-cloak
                                class="fixed inset-0 flex items-center justify-center bg-black/70 p-4 z-50"
                                @click="open = false">
                                <div @click.stop class="bg-white rounded-xl p-4 max-w-3xl w-full shadow-xl">
                                    <div class="flex justify-end">
                                        <button @click="open = false"
                                            class="text-gray-700 font-bold text-xl">&times;</button>
                                    </div>
                                    <img src="{{ asset('storage/' . $BrgyID->id_proof) }}"
                                        class="w-full rounded-lg shadow">
                                </div>
                            </div>
                        @else
                            <p class="text-center py-10 border-dashed border-2 rounded-xl text-gray-500">
                                No ID Uploaded
                            </p>
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
