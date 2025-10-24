<x-admin-layout>
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 overflow-y-auto">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="font-bold text-3xl text-gray-800">Request Details</h3>
                <p class="text-gray-500">View and manage the full details of this request.</p>
            </div>
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2 bg-white text-gray-700 font-semibold px-4 py-2 rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">

            <div
                class="bg-gradient-to-br from-indigo-500 to-blue-600 text-white px-6 py-6 sm:py-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex-1">
                    <h4 class="text-2xl font-bold">{{ $cedula->type }} Request</h4>
                    <p class="text-sm opacity-90 font-medium mt-1">Reference No: <span
                            class="font-light">{{ $cedula->reference_number }}</span></p>
                </div>
                <div class="flex items-center gap-4 mt-2 sm:mt-0">
                    <span
                        class="inline-flex items-center rounded-full px-4 py-1 text-sm font-semibold shadow-sm
                        {{ $cedula->status === 'Pending' ? 'bg-yellow-300 text-yellow-900' : '' }}
                        {{ $cedula->status === 'Approved' ? 'bg-green-500 text-white' : '' }}
                        {{ $cedula->status === 'Released' ? 'bg-blue-600 text-white' : '' }}">
                        <span
                            class="h-1.5 w-1.5 rounded-full mr-2
                            {{ $cedula->status === 'Pending' ? 'bg-yellow-900' : 'bg-white' }}"></span>
                        {{ ucfirst($cedula->status) }}
                    </span>
                </div>
            </div>

            <div class="px-6 py-8 grid grid-cols-1 lg:grid-cols-3 gap-8 text-gray-700">

                <!-- Personal Information -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                        <h5 class="font-semibold text-gray-900 mb-4 text-lg flex items-center gap-2">
                            <i class="fas fa-user text-indigo-600"></i>
                            Personal Information
                        </h5>
                        <dl class="space-y-3 text-sm">

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Full Name:</dt>
                                <dd class="text-right font-medium text-gray-800">{{ $cedula->name }}</dd>
                            </div>

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">TIN:</dt>
                                <dd class="text-right font-medium text-gray-800">
                                    {{ $cedula->tin ?? 'No Data' }}
                                </dd>
                            </div>

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Civil Status:</dt>
                                <dd class="text-right font-medium text-gray-800">{{ $cedula->civil_status }}</dd>
                            </div>

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Date of Birth:</dt>
                                <dd class="text-right font-medium text-gray-800"> {{ $cedula->dob }}</dd>
                            </div>

                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-500">Place of Birth:</dt>
                                <dd class="text-right font-medium text-gray-800">{{ $cedula->place_of_birth }}</dd>
                            </div>

                        </dl>
                    </div>
                </div>

                <!-- Economic & Income Information -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                        <h5 class="font-semibold text-gray-900 mb-4 text-lg flex items-center gap-2">
                            <i class="fas fa-chart-line text-indigo-600"></i>
                            Economic & Income
                        </h5>
                        <dl class="space-y-3 text-sm">

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Height (cm):</dt>
                                <dd class="text-right font-medium">{{ $cedula->height ?? 'N/A' }}</dd>
                            </div>

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Weight (kg):</dt>
                                <dd class="text-right font-medium">{{ $cedula->weight ?? 'N/A' }}</dd>
                            </div>

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Business Gross Receipt:</dt>
                                <dd class="text-right font-medium">
                                    ₱{{ number_format($cedula->total_gross_receipt_fr_business, 2) }}
                                </dd>
                            </div>

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Salary Earnings:</dt>
                                <dd class="text-right">
                                    ₱{{ number_format($cedula->total_earning_fr_salaries, 2) }}
                                </dd>
                            </div>

                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-500">Real Property Income:</dt>
                                <dd class="text-right">
                                    ₱{{ number_format($cedula->total_income_fr_realproperty, 2) }}
                                </dd>
                            </div>

                        </dl>
                    </div>
                </div>

                <!-- Contact, Billing, and ID Proof -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                        <h5 class="font-semibold text-gray-900 mb-4 text-lg flex items-center gap-2">
                            <i class="fas fa-envelope-open text-indigo-600"></i>
                            Application & Contact
                        </h5>
                        <dl class="space-y-3 text-sm">

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Email:</dt>
                                <dd class="text-right font-medium">{{ $cedula->email }}</dd>
                            </div>

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Citizenship:</dt>
                                <dd class="text-right font-medium">{{ $cedula->citezenship }}</dd>
                            </div>

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Purpose:</dt>
                                <dd class="text-right font-medium">{{ $cedula->purpose }}</dd>
                            </div>

                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Amount Paid:</dt>
                                <dd class="text-right font-bold text-green-700">
                                    ₱{{ number_format($cedula->amount, 2) }}
                                </dd>
                            </div>

                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-500">Issue Date:</dt>
                                <dd class="text-right font-medium">{{ $cedula->issue_date ?? 'Not Issued' }}</dd>
                            </div>

                        </dl>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                            <h5 class="font-semibold text-gray-900 mb-4 text-lg flex items-center gap-2">
                                <i class="fas fa-id-card text-indigo-600"></i>
                                Upload Proofs
                            </h5>

                            <!-- ID Proof -->
                            <div class="mb-6" x-data="{ openID: false }">
                                <h6 class="font-medium text-gray-800 mb-2">ID Proof</h6>
                                @if ($cedula->id_proof)
                                    <button @click="openID = true"
                                        class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition font-semibold text-sm">
                                        View Uploaded ID
                                    </button>

                                    <!-- Modal for ID -->
                                    <div x-show="openID" x-transition
                                        class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4"
                                        @click.away="openID = false" @keydown.escape.window="openID = false">

                                        <div class="relative max-w-full max-h-full">
                                            <div
                                                class="bg-white w-full px-6 py-4 rounded-t-lg flex items-center justify-between shadow-md">
                                                <h2 class="text-lg font-semibold text-gray-800">ID Proof Preview</h2>
                                                <button @click="openID = false"
                                                    class="text-gray-500 hover:text-gray-900 transition text-3xl leading-none">
                                                    &times;
                                                </button>
                                            </div>

                                            <img src="{{ asset('storage/' . $cedula->id_proof) }}"
                                                alt="Full Size ID Proof"
                                                class="max-h-[50vh] max-w-full rounded-b-lg shadow-2xl border-2 border-white cursor-pointer"
                                                onclick="this.classList.toggle('object-contain'); this.classList.toggle('object-cover');">
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center p-4 border-dashed border-2 border-gray-300 rounded-lg">
                                        <p class="text-sm text-gray-500">No ID proof uploaded.</p>
                                    </div>
                                @endif
                            </div>

                            <hr class="my-4">

                            <!-- Signature Proof -->
                            <div x-data="{ openSign: false }">
                                <h6 class="font-medium text-gray-800 mb-2">Signature Proof</h6>
                                @if ($cedula->e_signature)
                                    <button @click="openSign = true"
                                        class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition font-semibold text-sm">
                                        View Uploaded Signature
                                    </button>

                                    <!-- Modal for Signature -->
                                    <div x-show="openSign" x-transition
                                        class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4"
                                        @click.away="openSign = false" @keydown.escape.window="openSign = false">

                                        <div class="relative max-w-full max-h-full">
                                            <div
                                                class="bg-white w-full px-6 py-4 rounded-t-lg flex items-center justify-between shadow-md">
                                                <h2 class="text-lg font-semibold text-gray-800">Signature Preview</h2>
                                                <button @click="openSign = false"
                                                    class="text-gray-500 hover:text-gray-900 transition text-3xl leading-none">
                                                    &times;
                                                </button>
                                            </div>

                                            <img src="{{ asset('storage/' . $cedula->e_signature) }}"
                                                alt="Full Size Signature Proof"
                                                class="max-h-[50vh] max-w-full rounded-b-lg shadow-2xl border-2 border-white cursor-pointer"
                                                onclick="this.classList.toggle('object-contain'); this.classList.toggle('object-cover');">
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center p-4 border-dashed border-2 border-gray-300 rounded-lg">
                                        <p class="text-sm text-gray-500">No signature uploaded.</p>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
</x-admin-layout>
