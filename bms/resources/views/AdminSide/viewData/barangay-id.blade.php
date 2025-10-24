<x-admin-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">

        <!-- Header -->
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Request Details</h1>
                <p class="text-sm text-gray-500">Manage and verify ID request information</p>
            </div>
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition text-sm font-semibold">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Request Card -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-lg overflow-hidden">

            <!-- Request Header -->
            <div class="bg-gray-900 text-white px-6 py-6 flex flex-wrap justify-between items-center gap-4">
                <div>
                    <h2 class="text-xl font-bold">{{ $BrgyID->type }} Request</h2>
                    <p class="text-sm opacity-90">
                        Reference: <span class="font-normal">{{ $BrgyID->reference_number }}</span>
                    </p>
                </div>

                <span
                    class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-full
                    @class([
                        'bg-yellow-400 text-yellow-900' => $BrgyID->status === 'Pending',
                        'bg-green-600 text-white' => $BrgyID->status === 'Approved',
                        'bg-gray-600 text-white' => $BrgyID->status === 'To be Release',
                        'bg-blue-700 text-white' => $BrgyID->status === 'Released',
                    ])">
                    <span class="h-2 w-2 rounded-full
                        @class([
                            'bg-yellow-900' => $BrgyID->status === 'Pending',
                            'bg-white' => $BrgyID->status !== 'Pending',
                        ])"></span>
                    {{ ucfirst($BrgyID->status) }}
                </span>
            </div>

            <!-- Info Grid -->
            <div class="px-6 py-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ([
        [
            'icon' => 'fas fa-user',
            'title' => 'Personal Information',
            'data' => [
                'Reference No:' => $BrgyID->reference_number,
                'Full Name:' => $BrgyID->name,
                'Address:' => $BrgyID->address,
                'Date of Birth:' => $BrgyID->dob,
                'Age:' => $BrgyID->age,
                'Place of Birth:' => $BrgyID->place_of_birth,
                'Civil Status:' => $BrgyID->civil_status,
                'Gender:' => $BrgyID->gender,
            ],
        ],
        [
            'icon' => 'fas fa-file-alt',
            'title' => 'Application Details',
            'data' => [
                'Type:' => $BrgyID->type,
                'Purpose:' => $BrgyID->purpose,
                'Status:' => $BrgyID->status,
                'Issue Date:' => $BrgyID->issue_date ?? 'Not Issued',
                'Amount:' => '₱' . number_format($BrgyID->amount, 2),
            ],
        ],
        [
            'icon' => 'fas fa-address-card',
            'title' => 'Additional Information',
            'data' => [
                'Religion:' => $BrgyID->religion,
                'Citizenship:' => $BrgyID->citezenship,
                'Height:' => $BrgyID->height,
                'Weight:' => $BrgyID->weight,
                'Precinct No:' => $BrgyID->precint_number,
                'Emergency Name:' => $BrgyID->emergency_name,
                'Emergency Phone:' => $BrgyID->cellphone_number,
                'Emergency Address:' => $BrgyID->emergency_address,
            ],
        ],
    ] as $section)
                    <div class="rounded-xl border border-gray-100 shadow-sm p-6 bg-white">
                        <h3 class="flex items-center gap-2 text-lg font-semibold text-gray-900 mb-4">
                            <i class="{{ $section['icon'] }} text-blue-600"></i> {{ $section['title'] }}
                        </h3>
                        <dl class="space-y-3 text-sm">
                            @foreach ($section['data'] as $label => $value)
                                <div class="flex justify-between border-b border-gray-100 pb-2">
                                    <dt class="text-gray-500 font-medium">{{ $label }}</dt>
                                    <dd class="text-gray-800 font-medium text-right">{{ $value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endforeach

                <!-- ID Proof -->
                <div class="rounded-xl border border-gray-100 shadow-sm p-6 bg-white">
                    <h3 class="flex items-center gap-2 text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-id-card text-blue-600"></i> ID Proof
                    </h3>

                    <div x-data="{ idModal: false }">
                        @if ($BrgyID->id_proof)
                            <button @click="idModal = true"
                                class="w-full px-4 py-2 bg-blue-700 text-white rounded-lg font-semibold text-sm hover:bg-blue-800 transition">
                                View Uploaded ID
                            </button>

                            <div x-show="idModal"
                                class="fixed inset-0 bg-black/70 flex justify-center items-center z-50 p-4"
                                @click.away="idModal = false" x-transition>
                                <div class="bg-white rounded-lg overflow-hidden max-w-lg max-h-full">
                                    <div class="bg-gray-900 text-white px-4 py-3 flex justify-between items-center">
                                        <h4 class="text-lg font-medium">ID Preview</h4>
                                        <button @click="idModal = false" class="text-xl">&times;</button>
                                    </div>
                                    <img src="{{ asset('storage/' . $BrgyID->id_proof) }}" class="w-full h-auto">
                                </div>
                            </div>
                        @else
                            <p class="text-center text-gray-500 text-sm italic">No ID Uploaded</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</x-admin-layout>
