<x-layout> <!-- Main Container -->
<!-- Main Form Container -->
<section class="py-24 bg-white min-h-screen">
    <div class="container mx-auto px-4 md:px-6">
        
        <!-- Back Button -->
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('Services') }}" class="px-4 py-2 text-blue-600 items-center gap-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-blue-950">{{ $service['title'] }}</h1>
            <p class="text-sm text-gray-500">Application Form</p>
        </div>
        <form action="{{ route('submit.application') }}" method="POST" enctype="multipart/form-data">
    @csrf  
    <div class="space-y-6">
        <!-- Basic Information Section -->
        <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
            <h3 class="text-lg font-semibold text-blue-950 mb-4">Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">First Name *</label>
                    <input type="text" name="first_name" placeholder="Enter your first name" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Last Name *</label>
                    <input type="text" name="last_name" placeholder="Enter your last name" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Middle Name</label>
                    <input type="text" name="middle_name" placeholder="Enter your middle name" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Suffix</label>
                    <input type="text" name="suffix" placeholder="Jr, Sr, III, etc." class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                </div>
            </div>
        </div>

        <!-- Personal Details Section -->
        <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
            <h3 class="text-lg font-semibold text-blue-950 mb-4">Personal Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Date of Birth *</label>
                    <input type="date" name="dob" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 bg-white focus:ring-blue-500 focus:border-blue-500" required />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Civil Status *</label>
                    <select name="civil_status" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 bg-white focus:border-blue-500" required>
                        <option disabled selected>Select civil status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
            <h3 class="text-lg font-semibold text-blue-950 mb-4">Contact Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Phone Number *</label>
                    <input type="tel" name="phone" placeholder="+63 900 000 0000" class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Email Address *</label>
                    <input type="email" name="email" placeholder="your.email@example.com" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Complete Address *</label>
                    <input type="text" name="address" placeholder="House No., Street, Barangay, City, Province" class="w-full border bg-white border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                </div>
            </div>
        </div>

        <!-- Service Type and Purpose -->
        <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
            <h3 class="text-lg font-semibold text-blue-950 mb-4">Service Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Service Type (Dynamic) -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Certificate Type *</label>
                    <input type="text" name="type" value="{{ $service['title'] }}" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" readonly required />
                </div>
                <!-- Purpose of Service -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Purpose *</label>
                    <input type="text" name="purpose" placeholder="Intended purpose of the certificate" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                </div>
            </div>
        </div>

        <!-- Document Upload Section -->
        <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
            <h3 class="text-lg font-semibold text-blue-950 mb-4">Upload Documents</h3>
            <p class="text-sm text-gray-500 mb-4">Please upload the required documents for your application. You can select multiple files.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Upload ID Proof *</label>
                    <input type="file" name="id_proof" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" accept="image/*,application/pdf" required />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Upload Address Proof *</label>
                    <input type="file" name="address_proof" class="w-full border border-gray-300 bg-white rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" accept="image/*,application/pdf" required />
                </div>
            </div>
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="flex justify-end mt-8 space-x-4">
            <!-- Cancel Button -->
            <button type="button" onclick="window.location.href='{{ route('Services') }}'" class="px-6 py-3 text-gray-600 bg-gray-200 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200">
                Cancel
            </button>
            
            <!-- Submit Button -->
            <button type="submit" class="px-6 py-3 text-white bg-blue-600 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200">
                Submit Application
            </button>
        </div>
    </div>
</form>

    </div>
</section>


</x-layout>
  