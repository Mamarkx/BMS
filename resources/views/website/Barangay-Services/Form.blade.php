<x-layout> <!-- Main Container -->
   <section  class="py-24 bg-white min-h-screen">
<div class="container mx-auto px-4 md:px-6">
        <!-- Header -->
        @if($service)
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('Services') }}" class="px-4 py-2 text-blue-600 items-center gap-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                Back 
            </a>
            <div class="flex-grow text-center">
                <h1 class="text-xl md:text-2xl font-bold text-blue-950">{{ $service['title'] }}</h1>
                <p class="text-sm text-gray-500">Application Form</p>
            </div>
            <span id="step-counter" class="font-bold text-gray-500">Step 1 of 4</span>
        </div>

                 <!-- Progress Indicator -->
            <div id="steps-indicator" class="flex justify-between items-center">
                <!-- Step 1 -->
                <div data-step="1" class="step-item flex flex-col items-center relative">
                    <span class="icon-container w-12 h-10 flex items-center justify-center bg-gray-300 text-white rounded-full p-6 text-lg font-semibold">
                        1
                    </span>
                    <span class="step-label text-xs mt-2">Service Info</span>
                </div>

                <!-- Connector Line (between Step 1 and Step 2) -->
                <div class="connector-line flex-1 h-1 bg-blue-400"></div>

                <!-- Step 2 -->
                <div data-step="2" class="step-item flex flex-col items-center relative">
                    <span class="icon-container w-10 h-10 flex items-center justify-center bg-gray-300 text-white rounded-full p-6 text-lg font-semibold">
                        2
                    </span>
                    <span class="step-label text-xs mt-2">Personal Details</span>
                </div>

                <!-- Connector Line (between Step 2 and Step 3) -->
                <div class="connector-line flex-1 h-1 bg-blue-400"></div>

                <!-- Step 3 -->
                <div data-step="3" class="step-item flex flex-col items-center relative">
                    <span class="icon-container w-10 h-10 flex items-center justify-center bg-gray-300 text-white rounded-full p-6 text-lg font-semibold">
                        3
                    </span>
                    <span class="step-label text-xs mt-2">Documents</span>
                </div>

                <!-- Connector Line (between Step 3 and Step 4) -->
                <div class="connector-line flex-1 h-1 bg-blue-400"></div>

                <!-- Step 4 -->
                <div data-step="4" class="step-item flex flex-col items-center relative">
                    <span class="icon-container w-10 h-10 flex items-center justify-center bg-gray-300 text-white rounded-full p-6 text-lg font-semibold">
                        4
                    </span>
                    <span class="step-label text-xs mt-2">Review & Submit</span>
                </div>
            </div>


        <!-- Form Steps Container -->
                <form id="form-steps" enctype="multipart/form-data" method="POST" >
                    @csrf
                    <!-- Step 1: Service Info -->
                    <div id="step-1" class="step-content">
                        <div class="text-center mb-8">
                            <div class="mx-auto w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                            <span class="text-2xl">{!! $service['icon'] !!}</span>
        
                            </div>
                            <h2 class="text-2xl font-bold text-blue-950">{{ $service['title']  }}</h2>
                            <p class="text-gray-500">Have documents stamped and verified digitally.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="bg-blue-50 p-6 rounded-2xl text-center shadow">
                                <div class="flex justify-center mb-2">
                                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                </div>
                                <p class="font-semibold text-blue-950">Processing Time</p>
                                <p class="text-sm text-blue-700">{{ $service['processing_time']  }}</p>
                            </div>
                            <div class="bg-blue-50 p-6 rounded-2xl text-center shadow">
                                <div class="flex justify-center mb-2">
                                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                                       <i class="fa-solid fa-money-bill-1"></i>
                                    </div>
                                </div>
                                <p class="font-semibold text-blue-950">Service Fee</p>
                                <p class="text-sm text-blue-700">₱{{ $service['service_fee']  }}</p>
                            </div>
                            <div class="bg-blue-50 p-6 rounded-2xl text-center shadow">
                                <div class="flex justify-center mb-2">
                                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" /></svg>
                                    </div>
                                </div>
                                <p class="font-semibold text-blue-950">Status</p>
                                <p class="text-sm text-blue-700">Available 24/7</p>
                            </div>
                        </div>
        
                        <div class="bg-yellow-50 border border-yellow-200 p-6 rounded-2xl shadow">
                            <h3 class="text-lg font-semibold text-yellow-800 flex items-center gap-2 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Requirements Checklist
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-yellow-800">
                                @foreach ($service['requirements'] as $requirement)
                                <div class="flex items-start gap-2">
                                    <input type="checkbox" checked class="form-checkbox text-yellow-500 w-4 h-4 rounded mt-1" />
                                    <span>{{ $requirement }}</span>
                                </div>
                                @endforeach
        
                            </div>
                            <p class="text-xs mt-4 text-yellow-700">
                                <span class="font-bold">Important:</span> Please ensure all documents are clear, legible, and up-to-date. Incomplete requirements may delay processing.
                            </p>
                        </div>
        
                        <!-- Navigation Buttons -->
                        <div class="flex justify-between mt-8">
                            <a href="{{ route('Services') }}" class="px-4 py-2 text-blue-600 flex items-center gap-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                                Cancel
                            </a>
                            <button class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2" data-action="next">
                                Next Step
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </div>
                    </div>
        
                    <!-- Step 2: Personal Details -->
                    <div id="step-2" class="step-content hidden">
                <div class="text-center mb-8">
                    <div class="mx-auto w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                       <i class="fa-solid fa-user text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-blue-950">Personal Information</h2>
                    <p class="text-gray-500">Please provide your accurate personal details.</p>
                </div>

             
                <div class="space-y-6">
                
                    <!-- Basic Information -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4  gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">First Name *</label>
                                <input type="text" placeholder="Enter your first name" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Last Name *</label>
                                <input type="text" placeholder="Enter your last name" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Middle Name</label>
                                <input type="text" placeholder="Enter your middle name" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Suffix</label>
                                <input type="text" placeholder="Jr, Sr, III, etc." class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                        </div>
                    </div>

                    <!-- Personal Details -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Personal Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Date of Birth *</label>
                                <input type="date" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 bg-white focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Civil Status *</label>
                                <select class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 bg-white focus:border-blue-500" required>
                                    <option disabled selected>Select civil status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Contact Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Phone Number *</label>
                                <input type="tel" placeholder="+63 900 000 0000" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Email Address *</label>
                                <input type="email" placeholder="your.email@example.com" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                            <div class="col-span-1 md:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Complete Address *</label>
                                <input type="text" placeholder="House No., Street, Barangay, City, Province" class="w-full border bg-white border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                            </div>
                        </div>
                    </div>
                    </div>
              

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button class="px-4 py-2 text-blue-600 flex items-center gap-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200" data-action="prev">
                       <i class='bx bx-left-arrow-alt' class="w-5 h-5 text-xl" ></i>
                        Previous
                    </button>
                    <button class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2" data-action="next">
                        Next Step
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                </div>
            </div>
  <div id="step-3" class="step-content hidden">
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                <i class="fa-solid fa-upload text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-blue-950">Document Upload</h2>
            <p class="text-gray-500">Please upload all required documents for the service: {{ $service['title'] }}</p>
        </div>

        <div class="space-y-6">
            <!-- Valid Government ID (Common for all services) -->
            <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold text-blue-950 mb-4">Valid Government ID *</h3>
                <div class="file-dropzone text-center p-8 border-2 border-dashed border-blue-300 rounded-lg cursor-pointer hover:bg-blue-100 transition-colors">
                    <div class="file-prompt">
                        <div class="flex justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12" /></svg>
                        </div>
                        <p class="text-blue-700">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-400">PDF, JPG, PNG (MAX 5MB)</p>
                    </div>
                    <div class="file-display hidden text-blue-900 font-semibold"></div>
                </div>
                <input type="file" name="valid_id" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
            </div>

            <!-- Recent Photo (Common for all services) -->
            <div class="bg-purple-50 border border-purple-200 p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold text-purple-950 mb-4">Recent Photo (2x2) *</h3>
                <div class="file-dropzone text-center p-8 border-2 border-dashed border-purple-300 rounded-lg cursor-pointer hover:bg-purple-100 transition-colors">
                    <div class="file-prompt">
                        <div class="flex justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12" /></svg>
                        </div>
                        <p class="text-purple-700">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-400">JPG, PNG (MAX 2MB)</p>
                    </div>
                    <div class="file-display hidden text-purple-900 font-semibold"></div>
                </div>
                <input type="file" name="recent_photo" class="hidden" accept=".jpg,.jpeg,.png">
            </div>
            <!-- Service-Specific Fields -->
            @if($service['title'] == 'Barangay Clearance')
                  <div class="bg-purple-50 border border-purple-200 p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold text-purple-950 mb-4">Proof of Residency</h3>
                <div class="file-dropzone text-center p-8 border-2 border-dashed border-purple-300 rounded-lg cursor-pointer hover:bg-purple-100 transition-colors">
                    <div class="file-prompt">
                        <div class="flex justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12" /></svg>
                        </div>
                        <p class="text-purple-700">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-400">JPG, PNG (MAX 2MB)</p>
                    </div>
                    <div class="file-display hidden text-purple-900 font-semibold"></div>
                </div>
                <input type="file"id="proof_of_residency" name="proof_of_residency" required class="hidden" accept=".jpg,.jpeg,.png">
            </div>
         
            @elseif($service['title'] == 'Cedula')
                <div>
                    <label for="proof_of_residence">Proof of Residence</label>
                    <input type="file" id="proof_of_residence" name="proof_of_residence" required>
                </div>
                <div>
                    <label for="payment_receipt">Community Tax Payment Receipt</label>
                    <input type="file" id="payment_receipt" name="payment_receipt" required>
                </div>
            @elseif($service['title'] == 'Business Permit Endorsement')
            <div class="bg-purple-50 border border-purple-200 p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold text-purple-950 mb-4">Business Registration Certificate</h3>
                <div class="file-dropzone text-center p-8 border-2 border-dashed border-purple-300 rounded-lg cursor-pointer hover:bg-purple-100 transition-colors">
                    <div class="file-prompt">
                        <div class="flex justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12" /></svg>
                        </div>
                        <p class="text-purple-700">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-400">JPG, PNG (MAX 2MB)</p>
                    </div>
                    <div class="file-display hidden text-purple-900 font-semibold"></div>
                </div>
                <input type="file" id="business_registration" name="business_registration" required class="hidden" accept=".jpg,.jpeg,.png">
            </div>
            <div class="bg-purple-50 border border-purple-200 p-6 rounded-2xl shadow">
                <h3 class="text-lg font-semibold text-purple-950 mb-4">Proof of Business Location</h3>
                <div class="file-dropzone text-center p-8 border-2 border-dashed border-purple-300 rounded-lg cursor-pointer hover:bg-purple-100 transition-colors">
                    <div class="file-prompt">
                        <div class="flex justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12" /></svg>
                        </div>
                        <p class="text-purple-700">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-400">JPG, PNG (MAX 2MB)</p>
                    </div>
                    <div class="file-display hidden text-purple-900 font-semibold"></div>
                </div>
                <input type="file" id="proof_of_business_location" name="proof_of_business_location" required class="hidden" accept=".jpg,.jpeg,.png">
            </div>
            @endif
        </div>

        <!-- Upload Guidelines Section -->
        <div class="bg-yellow-50 border border-yellow-200 p-6 rounded-2xl mt-6 shadow">
            <h3 class="text-lg font-semibold text-yellow-800 flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Upload Guidelines
            </h3>
            <ul class="list-disc list-inside text-sm text-yellow-700 space-y-1">
                <li>All documents must be clear and legible.</li>
                <li>File size should not exceed the specified limits.</li>
                <li>Accepted formats: PDF, JPG, PNG.</li>
                <li>All text should be readable and not blurred.</li>
            </ul>
        </div>

        <div class="flex justify-between mt-8">
            <button class="px-4 py-2 text-blue-600 flex items-center gap-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200" data-action="prev">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                Previous
            </button>
            <button class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2" data-action="next">
                Next Step
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
        </div>
</div>



        <!-- Step 4: Review & Submit -->
        <div id="step-4" class="step-content hidden">
                <div class="text-center mb-8">
                    <div class="mx-auto w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-blue-950">Review & Submit</h2>
                    <p class="text-gray-500">Please review your information before submitting.</p>
                </div>

                <div class="space-y-6">
                    <!-- Service Summary Card -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Service Summary</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Service</p>
                                <p class="font-semibold text-blue-950">Document Authentication</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Processing Time</p>
                                <p class="font-semibold text-blue-950">1 business day</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Fee</p>
                                <p class="font-semibold text-blue-950">₱25.00 per document</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Application Date</p>
                                <p class="font-semibold text-blue-950">8/14/2025</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Personal Information Card -->
                    <div class="bg-purple-50 border border-purple-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-purple-950 mb-4">Personal Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Name</p>
                                <p class="font-semibold text-purple-950">[Name from form]</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-semibold text-purple-950">[Email from form]</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Phone</p>
                                <p class="font-semibold text-purple-950">[Phone from form]</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Civil Status</p>
                                <p class="font-semibold text-purple-950">[Civil Status from form]</p>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="bg-green-50 border border-green-200 p-6 rounded-2xl shadow">
                        <div class="flex items-start gap-2">
                            <input type="checkbox" checked class="form-checkbox text-green-500 w-4 h-4 rounded mt-1" />
                            <span class="text-green-950 font-semibold">Terms and Conditions</span>
                        </div>
                        <p class="text-xs text-green-700 mt-2">I certify that the information provided is true and correct. I understand that any false information may result in the denial of my application. I agree to the processing of my personal data in accordance with the Data Privacy Act.</p>
                    </div>

                    <!-- Ready to Submit -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl text-center shadow">
                        <div class="flex justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.27a11.971 11.971 0 00-6.19-2.074A12.016 12.016 0 0012 2c-3.328 0-6.425 1.258-8.775 3.51a11.986 11.986 0 00-.775 16.94A12 12 0 0012 22a12 12 0 008.775-3.51A11.986 11.986 0 0021.225 5.73z" /></svg>
                        </div>
                        <p class="font-semibold text-blue-950">Ready to Submit?</p>
                        <p class="text-sm text-gray-500">Once submitted, you'll receive a reference number for tracking your application. You'll also get email updates on your application status.</p>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button class="px-4 py-2 text-blue-600 flex items-center gap-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200" data-action="prev">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                        Previous
                    </button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2" data-action="submit">
                        Submit Application
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    </button>
                </div>
            </div>
        </form>
        </div>
        @endif
</div>
    </section>
 
    </div>

</x-layout>
  <script>
    $(function() {
        // Retrieve the last saved step from local storage, or default to 1
        let currentStep = localStorage.getItem('applicationStep') ? parseInt(localStorage.getItem('applicationStep')) : 1;
        const totalSteps = 4;
        
        // Cache the DOM elements
        const $stepsContainer = $('#form-steps');
        const $stepCounter = $('#step-counter');
        const $stepsIndicator = $('#steps-indicator');
        const $allStepContents = $stepsContainer.find('.step-content');
        const $navButtons = $('button[data-action]');
        const $successModal = $('#success_modal');
        const $closeModalButton = $('#close_modal');

        // Show the current step and update progress
        function showStep(step) {
            $allStepContents.addClass('hidden').filter(`#step-${step}`).removeClass('hidden');
            $stepCounter.text(`Step ${step} of ${totalSteps}`);
            
            $stepsIndicator.find('.step-item').each((index, item) => {
                const $item = $(item);
                $item.removeClass('active completed');
                if (index + 1 < step) $item.addClass('completed');
                else if (index + 1 === step) $item.addClass('active');
            });

            // Save the current step to local storage
            localStorage.setItem('applicationStep', step);
        }

        // Navigation & form submission logic
        $navButtons.on('click', function() {
            const action = $(this).data('action');
            if (action === 'next' && currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            } else if (action === 'prev' && currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            } else if (action === 'submit') {
                $successModal.removeClass('hidden');
                // Clear the saved step upon successful submission
                localStorage.removeItem('applicationStep');
            }
        });

        // Close the modal
        $closeModalButton.on('click', () => $successModal.addClass('hidden'));

        // Initial setup - show the last saved step or the first step
        showStep(currentStep);
    });
</script>
<script>
// The $(function() { ... }) is the jQuery shorthand for "run this code when the document is ready".
$(function() {
    // Find all the file dropzone elements
    $('.file-dropzone').each(function() {
        // Use jQuery's traversal methods to find related elements
        const $dropzone = $(this);
        const $input = $dropzone.next('input[type="file"]');
        const $prompt = $dropzone.find('.file-prompt');
        const $display = $dropzone.find('.file-display');

        // 1. Click to Upload
        $dropzone.on('click', function() {
            $input.click(); // Trigger the click on the hidden file input
        });

        // 2. Update display when a file is selected
        $input.on('change', function() {
            // 'this.files' refers to the files of the input that changed
            if (this.files.length > 0) {
                const fileName = this.files[0].name;

                // Use jQuery's methods to hide the prompt and show the file name
                $prompt.hide();
                $display.html(`<i class="fa-solid fa-check-circle text-green-500 mr-2"></i> ${fileName}`).show();
            }
        });

        // 3. Drag and Drop functionality
        $dropzone.on('dragover', function(e) {
            e.preventDefault();
            $dropzone.addClass('border-blue-500 bg-blue-100'); // Add highlight
        });

        $dropzone.on('dragleave', function() {
            $dropzone.removeClass('border-blue-500 bg-blue-100'); // Remove highlight
        });

        $dropzone.on('drop', function(e) {
            e.preventDefault();
            $dropzone.removeClass('border-blue-500 bg-blue-100');
            
 
            if (e.originalEvent.dataTransfer.files.length > 0) {
                // Set the input's files and trigger the 'change' event
                $input.prop('files', e.originalEvent.dataTransfer.files);
                $input.trigger('change');
            }
        });
    });
});
</script>