<x-layout>
    <style>
        input[type="date"] {
            color: black;
        }
    </style>

    <section class="py-24 bg-white min-h-screen">
        <div class="container mx-auto px-4 md:px-6">

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

            <form id="cedulaForm" action="{{ route('submit.cedula', ['service_slug' => $title]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">

                    <!-- Personal Details -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Personal Details</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="rounded-lg p-4 flex flex-col">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Date of Birth *</label>
                                <input type="date" name="dob" id="dob"
                                    class="w-full border border-gray-300 rounded-lg p-2 bg-white text-black focus:ring-2 focus:ring-blue-500"
                                    required>
                            </div>

                            <div class="rounded-lg p-4 flex flex-col">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Civil Status *</label>
                                <select name="civil_status"
                                    class="w-full border border-gray-300 bg-white text-black rounded-lg p-2" required>
                                    <option value="">-- Select --</option>
                                    <option value="Single"
                                        {{ auth()->user()->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Married"
                                        {{ auth()->user()->civil_status == 'Married' ? 'selected' : '' }}>Married
                                    </option>
                                    <option value="Widowed"
                                        {{ auth()->user()->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed
                                    </option>
                                    <option value="Separated"
                                        {{ auth()->user()->civil_status == 'Separated' ? 'selected' : '' }}>Separated
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div class="rounded-lg p-4 flex flex-col">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Citizenship *</label>
                                <input type="text" name="citizenship" value="{{ auth()->user()->citizenship }}"
                                    class="w-full border bg-white text-black border-gray-300 rounded-lg p-2" required>
                            </div>
                            <div class="rounded-lg p-4 flex flex-col">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Birth Place *</label>
                                <input type="text" name="place_of_birth"
                                    class="w-full border bg-white text-black border-gray-300 rounded-lg p-2" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div class="rounded-lg p-4 flex flex-col">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Height (cm)</label>
                                <input type="number" name="height" value="{{ auth()->user()->height }}"
                                    class="w-full border bg-white text-black border-gray-300 rounded-lg p-2">
                            </div>
                            <div class="rounded-lg p-4 flex flex-col">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Weight (kg)</label>
                                <input type="number" name="weight" value="{{ auth()->user()->weight }}"
                                    class="w-full border bg-white text-black border-gray-300 rounded-lg p-2">
                            </div>
                        </div>
                    </div>

                    <!-- Financial Information -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Financial Information</h3>

                        <div class="rounded-lg p-4 mb-4 flex flex-col">
                            <label class="block mb-2 text-sm font-medium text-gray-700">TIN</label>
                            <input type="text" name="tin"
                                class="bg-white text-black w-full border border-gray-300 rounded-lg p-2">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="rounded-lg p-4 flex flex-col">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Gross Receipt from
                                    Business</label>
                                <input type="number" step="0.01" name="total_gross_receipt_fr_business"
                                    class="bg-white text-black w-full border border-gray-300 rounded-lg p-2">
                            </div>
                            <div class="rounded-lg p-4 flex flex-col">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Earnings from
                                    Salaries</label>
                                <input type="number" step="0.01" name="total_earning_fr_salaries"
                                    class="bg-white text-black w-full border border-gray-300 rounded-lg p-2">
                            </div>
                        </div>

                        <div class="rounded-lg p-4 mt-4 flex flex-col">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Income from Real
                                Property</label>
                            <input type="number" step="0.01" name="total_income_fr_realproperty"
                                class="bg-white text-black w-full border border-gray-300 rounded-lg p-2">
                        </div>
                    </div>

                    <!-- Uploads -->
                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow">
                        <h3 class="text-lg font-semibold text-blue-950 mb-4">Upload Documents</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="rounded-lg p-4 flex flex-col">
                                <label class="block mb-2 text-sm font-medium text-gray-700">ID Proof *</label>
                                <input type="file" name="id_proof" accept="image/*,application/pdf" required
                                    class="bg-white text-black border border-gray-300 rounded-lg p-2">
                            </div>

                            <!-- Signature -->
                            <div class="border border-gray-300 rounded-lg p-4 flex flex-col space-y-3">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Signature *</label>
                                <p class="text-center text-sm text-gray-500">draw your signature below</p>

                                <div id="signature-root" class="w-full h-60 bg-white border border-gray-300 rounded-lg">
                                </div>

                                <div class="flex justify-end space-x-2 mt-2">
                                    <button type="button" id="reset-signature"
                                        class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm">Clear</button>
                                    <button type="button" id="save-signature"
                                        class="px-3 py-1 bg-blue-500 text-white rounded-lg text-sm">Save</button>
                                </div>

                                <input type="hidden" name="e_signature" id="signature_data">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8 space-x-4">
                        <button type="button" onclick="window.location.href='{{ route('Services') }}'"
                            class="px-6 py-3 bg-gray-200 rounded-lg">Cancel</button>
                        <button type="button" id="previewSummary"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg">Submit Application</button>
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
                <button type="button" id="confirmSubmit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Confirm
                    & Submit</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/lemonadejs/dist/lemonade.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@lemonadejs/signature/dist/index.min.js"></script>

    <script>
        flatpickr("#dob", {
            allowInput: true
        });

        const signaturePad = Signature(document.getElementById('signature-root'), {
            width: document.getElementById('signature-root').offsetWidth,
            height: 260,
        });

        document.getElementById('save-signature').addEventListener('click', () => {
            const imageData = signaturePad.getImage();

            if (!imageData) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Signature Found!',
                    text: 'Please draw your signature first.',
                    confirmButtonColor: '#3085d6'
                });
                return;
            }

            document.getElementById('signature_data').value = imageData;
            document.getElementById('upload_signature').value = '';

            Swal.fire({
                icon: 'success',
                title: 'Signature Saved!',
                text: 'Your signature has been captured successfully.',
                showConfirmButton: false,
                timer: 2000
            });
        });


        document.getElementById('upload_signature').addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                signaturePad.value = [];
                document.getElementById('signature_data').value = '';
            }
        });

        document.getElementById('reset-signature').addEventListener('click', () => {
            signaturePad.value = [];
            document.getElementById('signature_data').value = '';
        });

        $(document).ready(function() {
            $("#previewSummary").click(function() {
                let sigText = $("#signature_data").val() ? 'Signature drawn' : ($("#upload_signature")[0]
                    .files.length ? $("#upload_signature")[0].files[0].name : 'No signature provided');
                let summaryHtml = `
            <p><strong>Name:</strong> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
            <p><strong>TIN:</strong> ${$("input[name='tin']").val()}</p>
            <p><strong>Address:</strong> {{ auth()->user()->address }}</p>
            <p><strong>Citizenship:</strong> ${$("input[name='citizenship']").val()}</p>
            <p><strong>Civil Status:</strong> ${$("select[name='civil_status']").val()}</p>
            <p><strong>Date of Birth:</strong> ${$("input[name='dob']").val()}</p>
            <p><strong>Birth Place:</strong> ${$("input[name='place_of_birth']").val()}</p>
            <hr>
            <p><strong>Signature:</strong> ${sigText}</p>
        `;
                $("#summaryContent").html(summaryHtml);
                $("#summaryModal").removeClass("hidden");
            });

            $("#closeSummary").click(function() {
                $("#summaryModal").addClass("hidden");
            });

            $("#confirmSubmit").click(function() {
                $("#cedulaForm").submit();
            });
        });
    </script>
</x-layout>
