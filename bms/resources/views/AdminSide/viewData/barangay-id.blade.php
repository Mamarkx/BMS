<x-admin-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-8">

        <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
                <h3 class="font-bold text-3xl text-gray-900">Request Details</h3>
                <p class="text-gray-500 text-sm">Manage and verify ID request information</p>
            </div>
            <a href="{{ url()->previous() }}"
                class="bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition text-sm font-semibold">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-lg overflow-hidden">

            <!-- Top Header Section -->
            <div class="bg-gray-900 text-white px-6 py-6 flex flex-wrap justify-between items-center gap-4">
                <div>
                    <h4 class="text-xl font-bold">{{ $BrgyID->type }} Request</h4>
                    <p class="text-sm opacity-90">
                        Reference: <span class="font-normal">{{ $BrgyID->reference_number }}</span>
                    </p>
                </div>
                <span
                    class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-full
                {{ $BrgyID->status === 'Pending' ? 'bg-yellow-400 text-yellow-900' : '' }}
                {{ $BrgyID->status === 'Approved' ? 'bg-green-600 text-white' : '' }}
                {{ $BrgyID->status === 'To be Release' ? 'bg-gray-600 text-white' : '' }}
                {{ $BrgyID->status === 'Released' ? 'bg-blue-700 text-white' : '' }}">
                    <span
                        class="h-2 w-2 rounded-full
                {{ $BrgyID->status === 'Pending' ? 'bg-yellow-900' : 'bg-white' }}"></span>
                    {{ ucfirst($BrgyID->status) }}
                </span>
            </div>


            <!-- Information Grid -->
            <div class="px-6 py-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Personal Info Card -->
                <div class="rounded-xl border border-gray-100 shadow-sm p-6">
                    <h5 class="flex items-center text-gray-900 text-lg font-semibold mb-4 gap-2">
                        <i class="fas fa-user text-blue-600"></i> Personal Information
                    </h5>

                    <dl class="space-y-3 text-sm">
                        @foreach ([
        'Reference No:' => $BrgyID->reference_number,
        'Full Name:' => $BrgyID->name,
        'Address:' => $BrgyID->address,
        'Date of Birth:' => $BrgyID->dob,
        'Age:' => $BrgyID->age,
        'Place of Birth:' => $BrgyID->place_of_birth,
        'Civil Status:' => $BrgyID->civil_status,
        'Gender:' => $BrgyID->gender,
    ] as $label => $value)
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">{{ $label }}</dt>
                                <dd class="text-gray-800 font-medium text-right">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <!-- Application Info -->
                <div class="rounded-xl border border-gray-100 shadow-sm p-6">
                    <h5 class="flex items-center text-gray-900 text-lg font-semibold mb-4 gap-2">
                        <i class="fas fa-file-alt text-blue-600"></i> Application Details
                    </h5>

                    <dl class="space-y-3 text-sm">
                        @foreach ([
        'Type:' => $BrgyID->type,
        'Purpose:' => $BrgyID->purpose,
        'Status:' => $BrgyID->status,
        'Issue Date:' => $BrgyID->issue_date ?? 'Not Issued',
        'Amount:' => '₱' . number_format($BrgyID->amount, 2),
    ] as $label => $value)
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">{{ $label }}</dt>
                                <dd class="font-medium text-gray-800 text-right">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <!-- Additional Info -->
                <div class="rounded-xl border border-gray-100 shadow-sm p-6">
                    <h5 class="flex items-center text-gray-900 text-lg font-semibold mb-4 gap-2">
                        <i class="fas fa-address-card text-blue-600"></i> Additional Information
                    </h5>

                    <dl class="space-y-3 text-sm">
                        @foreach ([
        'Religion:' => $BrgyID->religion,
        'Citizenship:' => $BrgyID->citezenship,
        'Height:' => $BrgyID->height,
        'Weight:' => $BrgyID->weight,
        'Precinct No:' => $BrgyID->precint_number,
        'Emergency Name:' => $BrgyID->emergency_name,
        'Emergency Phone:' => $BrgyID->cellphone_number,
        'Emergency Address:' => $BrgyID->emergency_address,
    ] as $label => $value)
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">{{ $label }}</dt>
                                <dd class="text-gray-800 text-right">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <!-- ID Proof -->
                <div class="rounded-xl border border-gray-100 shadow-sm p-6">
                    <h5 class="flex items-center text-gray-900 text-lg font-semibold mb-4 gap-2">
                        <i class="fas fa-id-card text-blue-600"></i> ID Proof
                    </h5>

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
                                        <h3 class="text-lg font-medium">ID Preview</h3>
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
