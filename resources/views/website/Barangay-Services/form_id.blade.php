<x-layout>
    <section class="py-24 bg-white min-h-screen">
        <div class="container mx-auto px-4 md:px-6">
            
            <!-- Back button -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('Services') }}" class="px-4 py-2 text-blue-600 flex items-center gap-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-blue-950">{{ $title }}</h1>
                <p class="text-sm text-gray-500">Barangay ID Application Form</p>
            </div>

            <form id="applicationForm" 
                  action="{{ route('submit.form_id', ['service_slug' => $title]) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    
                    <!-- Personal Details -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Personal Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                          <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Date of Birth *</label>
                                <input type="date" name="dob" value="{{ auth()->user()->dob }}" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Gender *</label>
                                <select name="gender" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                                    <option value="Male" {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                             <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Civil Status *</label>
                                <select name="civil_status" 
                                        class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" 
                                        required>
                                    <option value="">-- Select --</option>
                                    <option value="Single" {{ auth()->user()->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Married" {{ auth()->user()->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                                    <option value="Widowed" {{ auth()->user()->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    <option value="Separated" {{ auth()->user()->civil_status == 'Separated' ? 'selected' : '' }}>Separated</option>
                                </select>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Age *</label>
                                <input type="number" name="age" value="{{ auth()->user()->age }}" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                          
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Religion *</label>
                                <input type="text" name="religion" value="{{ auth()->user()->religion }}" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Citizenship *</label>
                                <input type="text" name="citizenship" value="{{ auth()->user()->citizenship }}" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Height (cm)</label>
                                <input type="number" name="height" value="{{ auth()->user()->height }}" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Weight (kg)</label>
                                <input type="number" name="weight" value="{{ auth()->user()->weight }}" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Residency & Service -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Residency & Service Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                       
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Birth Place *</label>
                                <input type="text" name="place_of_birth"  class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                            </div>
                              <div class="">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Precinct Number</label>
                            <input type="text" name="precint_number" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500">
                        </div>
                        </div>

                      
                    </div>

                    <!-- Emergency Contact -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Emergency Contact</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Name *</label>
                                <input type="text" name="emergency_name" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Cellphone Number *</label>
                                <input type="text" name="cellphone_number" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Emergency Address *</label>
                            <input type="text" name="emergency_address" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>

                    <!-- Upload -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Upload Documents</h3>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Upload ID Proof *</label>
                        <input type="file" name="id_proof" accept="image/*,application/pdf" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end mt-8 space-x-4">
                        <button type="button" onclick="window.location.href='{{ route('Services') }}'" class="px-6 py-3 text-gray-600 bg-gray-200 rounded-lg font-semibold hover:bg-gray-300">Cancel</button>
                        <button type="button" id="reviewBtn" class="px-6 py-3 text-white bg-blue-600 rounded-lg font-semibold hover:bg-blue-700">Review & Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 flex items-center justify-center bg-black/60 hidden z-50">
        <div class="bg-white p-8 rounded-xl shadow-2xl max-w-4xl w-full transform transition-all duration-300 scale-95">
            <div class="flex justify-between items-center mb-6 border-b pb-3">
                <h2 class="text-2xl font-bold text-blue-700 flex items-center gap-2">
                    <i class="fa-solid fa-file-circle-check text-blue-600"></i>
                    Review Your Application
                </h2>
                <button id="closeModalBtn" class="text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</button>
            </div>

            <div id="summaryContent" class="space-y-6 text-gray-700 text-sm"></div>

            <div class="flex justify-end mt-8 space-x-4 border-t pt-4">
                <button id="editBtn" class="px-5 py-2 text-gray-600 bg-gray-200 rounded-lg font-medium hover:bg-gray-300"><i class="fa-solid fa-pen-to-square mr-1"></i> Edit</button>
                <button id="confirmSubmitBtn" class="px-5 py-2 text-white bg-blue-600 rounded-lg font-medium hover:bg-blue-700 shadow"><i class="fa-solid fa-paper-plane mr-1"></i> Confirm & Submit</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#reviewBtn').on('click', function (e) {
                e.preventDefault();
                if ($('#applicationForm')[0].checkValidity()) {
                    let summaryHtml = `
                        <h3 class="font-semibold text-blue-700 mb-2">Personal Details</h3>
              <p><strong>Full Name:</strong> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>

                        <p><strong>Gender:</strong> ${$('select[name="gender"]').val()}</p>
                        <p><strong>DOB:</strong> ${$('input[name="dob"]').val()}</p>
                        <p><strong>Age:</strong> ${$('input[name="age"]').val()}</p>
                       <p><strong>Civil Status:</strong> ${$('select[name="civil_status"]').val()}</p>
                        <p><strong>Religion:</strong> ${$('input[name="religion"]').val()}</p>
                        <p><strong>Citizenship:</strong> ${$('input[name="citizenship"]').val()}</p>
                        <p><strong>Height:</strong> ${$('input[name="height"]').val()} cm</p>
                        <p><strong>Weight:</strong> ${$('input[name="weight"]').val()} kg</p>

                        <h3 class="font-semibold text-blue-700 mt-4 mb-2">Residency</h3>
                        <p><strong>Full Name:</strong> {{ auth()->user()->address}}</p>
                        <p><strong>Place of Birth:</strong> ${$('input[name="place_of_birth"]').val()}</p>
                        <p><strong>Precinct Number:</strong> ${$('input[name="precint_number"]').val()}</p>

                        <h3 class="font-semibold text-blue-700 mt-4 mb-2">Emergency Contact</h3>
                        <p><strong>Name:</strong> ${$('input[name="emergency_name"]').val()}</p>
                        <p><strong>Cellphone:</strong> ${$('input[name="cellphone_number"]').val()}</p>
                        <p><strong>Address:</strong> ${$('input[name="emergency_address"]').val()}</p>
                    `;
                    $('#summaryContent').html(summaryHtml);
                    $('#reviewModal').removeClass('hidden').find('> div').addClass('scale-100');
                } else {
                    $('#applicationForm')[0].reportValidity();
                }
            });

            $('#closeModalBtn, #editBtn').on('click', function () {
                $('#reviewModal').addClass('hidden');
            });

            $('#confirmSubmitBtn').on('click', function () {
                $('#applicationForm').submit();
            });
        });
    </script>
</x-layout>
