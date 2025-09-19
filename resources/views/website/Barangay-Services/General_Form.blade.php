<x-layout>
    <section class="py-24 bg-white min-h-screen">
        <div class="container mx-auto px-4 md:px-6">

            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('Services') }}" class="px-4 py-2 text-blue-600 items-center gap-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>
            </div>
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-blue-950">{{ $title }}</h1>
                <p class="text-sm text-gray-500">Application Form</p>
            </div>

            <form id="applicationForm" 
      action="{{ route('submit.general_form', ['service_slug' => $title]) }}" 
      method="POST" 
      enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
  
                    <!-- Personal Details Section -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Personal Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
  <label class="block mb-2 text-sm font-medium text-gray-700">Date of Birth *</label>
  <input type="date" 
         name="dob" 
         class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 bg-white focus:ring-blue-500 focus:border-blue-500" 
         required />
</div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Civil Status *</label>
                                <select name="civil_status" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 bg-white focus:border-blue-500" required>
                                    <option value="Single" {{ auth()->user()->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Married" {{ auth()->user()->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                                    <option value="Widowed" {{ auth()->user()->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    <option value="Divorced" {{ auth()->user()->civil_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Age *</label>
                                <input type="number" name="age" value="{{ auth()->user()->age }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 bg-white focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Years of Residency *</label>
                                <input type="number" name="year_of_residency" value="{{ auth()->user()->year_of_residency }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 bg-white focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Place of Birth *</label>
                                <input type="text" name="place_of_birth" value="{{ auth()->user()->place_of_birth }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 bg-white focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                        </div>
                    </div>

                    <!-- Service Information Section -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Service Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Certificate Type *</label>
                                <input type="text" name="type" value="{{ $title }}" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Purpose *</label>
                                <input type="text" name="purpose" placeholder="Intended purpose of the certificate" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                        </div>
                    </div>

                    <!-- Upload Documents Section -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Upload Documents</h3>
                        <p class="text-sm text-gray-500 mb-4">Please upload the required documents for your application. You can select multiple files.</p>
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Upload ID Proof *</label>
                                <input type="file" name="id_proof" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" accept="image/*,application/pdf" required />
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end mt-8 space-x-4">
                        <button type="button" onclick="window.location.href='{{ route('Services') }}'" class="px-6 py-3 text-gray-600 bg-gray-200 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200">
                            Cancel
                        </button>
                        
                        <button type="button" id="reviewBtn" class="px-6 py-3 text-white bg-blue-600 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200">
                            Review & Submit
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 flex items-center justify-center bg-black/60 bg-opacity-50 hidden z-50">
        <div class="bg-white p-8 rounded-xl shadow-2xl max-w-3xl w-full transform transition-all duration-300 scale-95">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6 border-b pb-3">
                <h2 class="text-2xl font-bold text-blue-700 flex items-center gap-2">
                    <i class="fa-solid fa-file-circle-check text-blue-600"></i>
                    Review Your Application
                </h2>
                <button id="closeModalBtn" class="text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</button>
            </div>

            <!-- Summary Content -->
            <div id="summaryContent" class="space-y-6 text-gray-700 text-sm"></div>

            <!-- Footer -->
            <div class="flex justify-end mt-8 space-x-4 border-t pt-4">
                <button id="editBtn" class="px-5 py-2 text-gray-600 bg-gray-200 rounded-lg font-medium hover:bg-gray-300">
                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                </button>
                <button id="confirmSubmitBtn" class="px-5 py-2 text-white bg-blue-600 rounded-lg font-medium hover:bg-blue-700 shadow">
                    <i class="fa-solid fa-paper-plane mr-1"></i> Confirm & Submit
                </button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#reviewBtn').on('click', function(e) {
                e.preventDefault();

                if ($('#applicationForm')[0].checkValidity()) {
                    let summaryHtml = '';

                    // Reusable section builder
                    function section(title, icon, content) {
                        return `
                            <div class="bg-gray-50 rounded-lg p-4 border shadow-sm">
                                <h3 class="text-lg font-semibold text-blue-700 flex items-center gap-2 mb-3">
                                    <i class="fa-solid ${icon} text-blue-600"></i> ${title}
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-gray-700 text-sm">
                                    ${content}
                                </div>
                            </div>
                        `;
                    }

                    // Personal Information Summary
                    summaryHtml += section("Personal Details", "fa-user", `
                        <p><strong>First Name:</strong> ${'{{ auth()->user()->first_name }}'}</p>
                        <p><strong>Middle Name:</strong> ${'{{ auth()->user()->middle_name }}' || 'N/A'}</p>
                        <p><strong>Last Name:</strong> ${'{{ auth()->user()->last_name }}'}</p>
                        <p><strong>Age:</strong> ${$('input[name="age"]').val()}</p>
                        <p><strong>Place of Birth:</strong> ${$('input[name="place_of_birth"]').val()}</p>
                        <p><strong>Civil Status:</strong> ${$('select[name="civil_status"]').val()}</p>
                        <p><strong>Years of Residency:</strong> ${$('input[name="year_of_residency"]').val()}</p>
                        <p><strong>Date of Birth:</strong> ${$('input[name="dob"]').val()}</p>
                    `);

                    // Service Information Summary
                    summaryHtml += section("Service Information", "fa-file-lines", `
                        <p><strong>Certificate Type:</strong> ${$('input[name="type"]').val()}</p>
                        <p><strong>Purpose:</strong> ${$('input[name="purpose"]').val()}</p>
                    `);

                    $('#summaryContent').html(summaryHtml);
                    $('#reviewModal').removeClass('hidden').find('> div').addClass('scale-100');
                } else {
                    $('#applicationForm')[0].reportValidity();
                }
            });

            $('#closeModalBtn, #editBtn').on('click', function() {
                $('#reviewModal').addClass('hidden');
            });

            $('#confirmSubmitBtn').on('click', function() {
                $('#applicationForm').submit();
            });
        });
    </script>
</x-layout>
