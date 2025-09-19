<x-layout>
<style>
input[type="date"] {
    color: black;
}

</style>
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
            <p class="text-sm text-gray-500">Community Tax Certificate (Cedula) Application</p>
        </div>

        <form id="cedulaForm"
              action="{{ route('submit.cedula', ['service_slug' => $title]) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">

                <!-- Personal Details -->
             <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
    <h3 class="text-lg font-semibold text-blue-950 mb-4">Personal Details</h3>

    <!-- Date of Birth & Civil Status -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="border border-gray-300 rounded-lg p-4 flex flex-col">
    <label class="block mb-2 text-sm font-medium text-gray-700">Date of Birth *</label>
    <input 
        type="date" 
        name="dob" 
        id="dob" 
        class="w-full border border-gray-300 rounded-lg p-2 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
        placeholder="Select your date of birth"
        required
    >
</div>
<script>
    flatpickr("#dob", {
        allowInput: true,
        clickOpens: true,
        onReady: function(selectedDates, dateStr, instance) {
            instance.input.classList.add("text-black"); // ensure text stays black
        }
    });
</script>

        <div class="border border-gray-300 rounded-lg p-4 flex flex-col">
            <label class="block mb-2 text-sm font-medium text-gray-700">Civil Status *</label>
            <select name="civil_status" class="w-full border border-gray-300 rounded-lg p-2" required>
                <option value="">-- Select --</option>
                <option value="Single" {{ auth()->user()->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Married" {{ auth()->user()->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                <option value="Widowed" {{ auth()->user()->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                <option value="Separated" {{ auth()->user()->civil_status == 'Separated' ? 'selected' : '' }}>Separated</option>
            </select>
        </div>
    </div>

    <!-- Citizenship & Birth Place -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div class="border border-gray-300 rounded-lg p-4 flex flex-col">
            <label class="block mb-2 text-sm font-medium text-gray-700">Citizenship *</label>
            <input type="text" name="citizenship" value="{{ auth()->user()->citizenship }}" class="w-full border border-gray-300 rounded-lg p-2" required>
        </div>
        <div class="border border-gray-300 rounded-lg p-4 flex flex-col">
            <label class="block mb-2 text-sm font-medium text-gray-700">Birth Place *</label>
            <input type="text" name="place_of_birth" class="w-full border border-gray-300 rounded-lg p-2" required>
        </div>
    </div>

    <!-- Height & Weight -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div class="border border-gray-300 rounded-lg p-4 flex flex-col">
            <label class="block mb-2 text-sm font-medium text-gray-700">Height (cm)</label>
            <input type="number" name="height" value="{{ auth()->user()->height }}" class="w-full border border-gray-300 rounded-lg p-2">
        </div>
        <div class="border border-gray-300 rounded-lg p-4 flex flex-col">
            <label class="block mb-2 text-sm font-medium text-gray-700">Weight (kg)</label>
            <input type="number" name="weight" value="{{ auth()->user()->weight }}" class="w-full border border-gray-300 rounded-lg p-2">
        </div>
    </div>
</div>


                <!-- Financial Information -->
             <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
    <h3 class="text-lg font-semibold text-blue-950 mb-4">Financial Information</h3>

    <!-- TIN -->
    <div class="border border-gray-300 rounded-lg p-4 mb-4 flex flex-col">
        <label class="block mb-2 text-sm font-medium text-gray-700">TIN</label>
        <input type="text" name="tin" class="w-full border border-gray-300 rounded-lg p-2">
    </div>

    <!-- Gross Receipt & Earnings -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="border border-gray-300 rounded-lg p-4 flex flex-col">
            <label class="block mb-2 text-sm font-medium text-gray-700">Gross Receipt from Business</label>
            <input type="number" step="0.01" name="total_gross_receipt_fr_business" class="w-full border border-gray-300 rounded-lg p-2">
        </div>
        <div class="border border-gray-300 rounded-lg p-4 flex flex-col">
            <label class="block mb-2 text-sm font-medium text-gray-700">Earnings from Salaries</label>
            <input type="number" step="0.01" name="total_earning_fr_salaries" class="w-full border border-gray-300 rounded-lg p-2">
        </div>
    </div>

    <!-- Income from Real Property -->
    <div class="border border-gray-300 rounded-lg p-4 mt-4 flex flex-col">
        <label class="block mb-2 text-sm font-medium text-gray-700">Income from Real Property</label>
        <input type="number" step="0.01" name="total_income_fr_realproperty" class="w-full border border-gray-300 rounded-lg p-2">
    </div>
</div>


                <!-- Uploads -->
            <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
    <h3 class="text-lg font-semibold text-blue-950 mb-4">Upload Documents</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- ID Proof -->
        <div class="border border-gray-300 rounded-lg p-4 flex flex-col">
            <label class="block mb-2 text-sm font-medium text-gray-700">ID Proof *</label>
            <input type="file" name="id_proof" accept="image/*,application/pdf" required
                   class="border border-gray-300 rounded-lg p-2">
        </div>
        <!-- Signature -->
        <div class="border border-gray-300 rounded-lg p-4 flex flex-col">
            <label class="block mb-2 text-sm font-medium text-gray-700">Signature *</label>
            <input type="file" name="e_signature" accept="image/*" required
                   class="border border-gray-300 rounded-lg p-2">
        </div>
    </div>
</div>


                <!-- Buttons -->
                <div class="flex justify-end mt-8 space-x-4">
                    <button type="button" onclick="window.location.href='{{ route('Services') }}'" class="px-6 py-3 bg-gray-200 rounded-lg">Cancel</button>
                    <button type="button" id="previewSummary" class="px-6 py-3 bg-blue-600 text-white rounded-lg">Submit Application</button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Modal -->
<div id="summaryModal" class="fixed inset-0 flex items-center justify-center bg-black/60 hidden z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6">
        <h2 class="text-xl font-bold text-blue-900 mb-4">Review Your Application</h2>
        <div id="summaryContent" class="space-y-3 text-sm text-gray-700 max-h-96 overflow-y-auto"></div>
        <div class="flex justify-end mt-6 gap-3">
            <button type="button" id="closeSummary" class="px-4 py-2 bg-gray-200 rounded-lg">Back</button>
            <button type="button" id="confirmSubmit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Confirm & Submit</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Open modal
    $("#previewSummary").click(function() {
        let summaryHtml = `
            <p><strong>Name:</strong> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
            <p><strong>TIN:</strong> ${$("input[name='tin']").val()}</p>
            <p><strong>Address:</strong> {{ auth()->user()->address }}</p>
            <p><strong>Citizenship:</strong> ${$("input[name='citizenship']").val()}</p>
            <p><strong>Civil Status:</strong> ${$("select[name='civil_status']").val()}</p>
            <p><strong>Date of Birth:</strong> ${$("input[name='dob']").val()}</p>
            <p><strong>Birth Place:</strong> ${$("input[name='place_of_birth']").val()}</p>
            <p><strong>Height:</strong> ${$("input[name='height']").val()} cm</p>
            <p><strong>Weight:</strong> ${$("input[name='weight']").val()} kg</p>
            <hr>
            <p><strong>Gross Receipt from Business:</strong> ${$("input[name='total_gross_receipt_fr_business']").val()}</p>
            <p><strong>Earnings from Salaries:</strong> ${$("input[name='total_earning_fr_salaries']").val()}</p>
            <p><strong>Income from Real Property:</strong> ${$("input[name='total_income_fr_realproperty']").val()}</p>
            <hr>
            <p><strong>ID Proof:</strong> ${$("input[name='id_proof']")[0].files.length > 0 ? $("input[name='id_proof']")[0].files[0].name : 'No file selected'}</p>
            <p><strong>e-Signature:</strong> ${$("input[name='e_signature']")[0].files.length > 0 ? $("input[name='e_signature']")[0].files[0].name : 'No file selected'}</p>
        `;
        $("#summaryContent").html(summaryHtml);
        $("#summaryModal").removeClass("hidden");
    });

    // Close modal
    $("#closeSummary").click(function() {
        $("#summaryModal").addClass("hidden");
    });

    // Confirm submit
    $("#confirmSubmit").click(function() {
        $("#cedulaForm").submit();
    });
});
</script>
</x-layout>
