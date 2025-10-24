<x-admin-layout>
    <div class="max-w-8xl h-screen mx-auto px-4 sm:px-6 lg:px-8 space-y-8 overflow-y-auto">

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
                    <h4 class="text-2xl font-bold">{{ $business->type }} Request</h4>
                    <p class="text-sm opacity-90 font-medium mt-1">Reference No: <span
                            class="font-light">{{ $business->reference_number }}</span></p>
                </div>
                <div class="flex items-center gap-4 mt-2 sm:mt-0">
                    <span
                        class="inline-flex items-center rounded-full px-4 py-1 text-sm font-semibold shadow-sm
                        {{ $business->status === 'Pending' ? 'bg-yellow-300 text-yellow-900' : '' }}
                        {{ $business->status === 'Approved' ? 'bg-green-500 text-white' : '' }}
                        {{ $business->status === 'To be Release' ? 'bg-gray-600 text-white' : '' }}
                        {{ $business->status === 'Released' ? 'bg-blue-600 text-white' : '' }}">
                        <span
                            class="h-1.5 w-1.5 rounded-full mr-2
                            {{ $business->status === 'Pending' ? 'bg-yellow-900' : 'bg-white' }}"></span>
                        {{ ucfirst($business->status) }}
                    </span>
                </div>
            </div>

            <div class="px-6 py-8 grid grid-cols-1 lg:grid-cols-3 gap-8 text-gray-700">

                <div class="lg:col-span-1 space-y-6">
                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                        <h5 class="font-semibold text-gray-900 mb-4 text-lg flex items-center gap-2">
                            <i class="fas fa-user text-indigo-600"></i>
                            Personal Information
                        </h5>
                        <dl class="space-y-3 text-sm">
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Owner Name:</dt>
                                <dd class="text-right font-medium text-gray-800">{{ $business->name_owner }} </dd>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Business Name:</dt>
                                <dd class="text-right font-medium text-gray-800">{{ $business->name_business }} </dd>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Business Address :</dt>
                                <dd class="text-right">{{ $business->address_business }}</dd>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Email :</dt>
                                <dd class="text-right">{{ $business->email }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                        <h5 class="font-semibold text-gray-900 mb-4 text-lg flex items-center gap-2">
                            <i class="fas fa-file-alt text-indigo-600"></i>
                            Application & Contact
                        </h5>
                        <dl class="space-y-3 text-sm">
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Purpose:</dt>
                                <dd class="text-right font-medium text-gray-800">{{ $business->purpose }}</dd>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <dt class="font-medium text-gray-500">Amount:</dt>
                                <dd class="text-right">₱{{ number_format($business->amount, 2) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-500">Issue Date:</dt>
                                <dd class="text-right">{{ $business->issue_date ?? 'Not Issued' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                        <h5 class="font-semibold text-gray-900 mb-4 text-lg flex items-center gap-2">
                            <i class="fas fa-id-card text-indigo-600"></i>
                            ID Proof
                        </h5>
                        <div x-data="{ open: false }">
                            @if ($business->id_proof)
                                <button @click="open = true"
                                    class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition font-semibold text-sm">
                                    View Uploaded ID
                                </button>

                                <div x-show="open" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4"
                                    @click.away="open = false" @keydown.escape.window="open = false">

                                    <div class="relative max-w-full max-h-full">
                                        <!-- Redesigned Header -->
                                        <div
                                            class="bg-white w-full px-6 py-4 rounded-t-lg flex items-center justify-between shadow-md">
                                            <h2 class="text-lg font-semibold text-gray-800">ID Proof Preview</h2>
                                            <button @click="open = false"
                                                class="text-gray-500 hover:text-gray-900 transition text-3xl leading-none">
                                                &times;
                                            </button>
                                        </div>

                                        <!-- Image -->
                                        <img src="{{ asset('storage/' . $business->id_proof) }}"
                                            alt="Full Size ID Proof"
                                            class="max-h-[50vh] max-w-full rounded-b-lg shadow-2xl border-2 border-white cursor-pointer"
                                            onclick="this.classList.toggle('object-contain'); this.classList.toggle('object-cover');">
                                    </div>
                                </div>
                            @else
                                <div class="text-center p-6 border-dashed border-2 border-gray-300 rounded-lg">
                                    <p class="text-sm text-gray-500">No ID proof uploaded for this request.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
</x-admin-layout>
