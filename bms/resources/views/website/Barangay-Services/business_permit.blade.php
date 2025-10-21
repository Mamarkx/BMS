<x-layout>
    <section class="py-24 bg-white min-h-screen">
        <div class="container mx-auto px-4 md:px-6">

            <!-- Back button -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('Services') }}" 
                   class="px-4 py-2 text-blue-600 flex items-center gap-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-blue-950">{{ $title }}</h1>
                <p class="text-sm text-gray-500">Business Permit Application</p>
            </div>

            <form id="businessPermitForm"
                  action="{{ route('submit.permit', ['service_slug' => $title]) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">

                    <!-- Business Details -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Business Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    <i class="fa-solid fa-user-tie text-blue-600 mr-1"></i> Owner’s Name *
                                </label>
                                <input type="text" name="owner_name" 
                                       class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    <i class="fa-solid fa-location-dot text-blue-600 mr-1"></i> Address *
                                </label>
                                <input type="text" name="address" 
                                       class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-700">
                                <i class="fa-solid fa-building text-blue-600 mr-1"></i> Business Name *
                            </label>
                            <input type="text" name="business_name"
                                   class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>

                    <!-- Uploads -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Upload Documents</h3>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Upload ID Proof *</label>
                        <input type="file" name="id_proof" accept="image/*,application/pdf" 
                               class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end mt-8 space-x-4">
                        <button type="button" onclick="window.location.href='{{ route('Services') }}'" 
                                class="px-6 py-3 text-gray-600 bg-gray-200 rounded-lg font-semibold hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 text-white bg-blue-600 rounded-lg font-semibold hover:bg-blue-700">
                            Submit Application
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 bg-black/60 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl w-11/12 md:w-1/2 p-6 relative">
            <h2 class="text-xl font-bold mb-4">Review Your Application</h2>
            <div id="reviewContent" class="space-y-2 text-gray-700">
            </div>
            <div class="flex justify-end mt-6 space-x-4">
                <button id="cancelReview" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 font-semibold">Cancel</button>
                <button id="confirmSubmit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">Submit</button>
            </div>
            <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
        // Intercept form submission
        $('#businessPermitForm').on('submit', function(e) {
            e.preventDefault(); // prevent default submission

            // Gather form data
            let ownerName = $('input[name="owner_name"]').val();
            let address = $('input[name="address"]').val();
            let businessName = $('input[name="business_name"]').val();
            let idProof = $('input[name="id_proof"]').val().split('\\').pop();

            // Inject data into modal
            $('#reviewContent').html(`
                <p><strong>Owner's Name:</strong> ${ownerName}</p>
                <p><strong>Address:</strong> ${address}</p>
                <p><strong>Business Name:</strong> ${businessName}</p>
                <p><strong>ID Proof:</strong> ${idProof}</p>
            `);

            // Show modal
            $('#reviewModal').removeClass('hidden');
        });

        // Close modal buttons
        $('#cancelReview, #closeModal').on('click', function() {
            $('#reviewModal').addClass('hidden');
        });

        // Confirm and submit
        $('#confirmSubmit').on('click', function() {
            $('#businessPermitForm')[0].submit(); // submit original form
        });
    });
    </script>
</x-layout>
