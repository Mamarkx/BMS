<x-admin-layout>
    <div class="w-full p-6 bg-gray-50 h-screen">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-3xl text-gray-900 mb-2">Cedula Applications</h3>
            <p class="text-gray-600 text-base">Manage and track all resident requests</p>

            <div class="relative w-full md:w-96">
                <input type="text" id="search" placeholder="Search request..."
                    class="w-full p-3 pl-10 pr-4 rounded-xl bg-white text-gray-700 border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200"
                    onkeyup="searchResidents()">
                <i class="fa-solid fa-search absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-500"></i>
            </div>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            @if ($data->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                <th
                                    class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Reference #</th>
                                <th
                                    class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Type</th>
                                <th
                                    class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200" id="residentTableBody">
                            @foreach ($data as $d)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $d->reference_number }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $d->name }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $d->type }}</td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $d->status === 'Pending' ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $d->status === 'Approved' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                        {{ $d->status === 'Released' ? 'bg-blue-100 text-blue-800' : '' }}">
                                            {{ ucfirst($d->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <!-- View -->
                                            <a href="{{ route('cedula.show', $d->id) }}"
                                                class="flex flex-col items-center justify-center w-16 p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-800 transition duration-200"
                                                title="View Record">
                                                <i class="fa-solid fa-eye text-lg mb-1"></i>
                                                <span class="text-xs font-semibold">View</span>
                                            </a>

                                            <!-- Edit -->
                                            <button type="button"
                                                class="flex flex-col items-center justify-center w-16 p-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 hover:text-green-800 transition duration-200 edit-btn"
                                                data-record='@json($d)' title="Edit Record">
                                                <i class="fa-solid fa-pen-to-square text-lg mb-1"></i>
                                                <span class="text-xs font-semibold">Edit</span>
                                            </button>
                                            <!-- Delete -->
                                            <form id="deleteForm_{{ $d->id }}"
                                                action="{{ route('DeleteCedulaForm', $d->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="flex flex-col items-center justify-center w-16 p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-800 transition duration-200 delete-btn"
                                                    data-id="{{ $d->id }}" title="Delete Record">
                                                    <i class="fa-solid fa-trash text-lg mb-1"></i>
                                                    <span class="text-xs font-semibold">Delete</span>
                                                </button>
                                            </form>
                                            <!-- Approve -->
                                            @if ($d->status === 'Pending')
                                                <form id="approveForm{{ $d->id }}"
                                                    action="{{ route('approve.cedula', $d->id) }}" method="POST"
                                                    class="hidden">
                                                    @csrf
                                                </form>
                                                <button type="button"
                                                    class="flex flex-col items-center justify-center w-16 p-2 rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 hover:text-yellow-700 transition duration-200"
                                                    onclick="showApprovalConfirmation({{ $d->id }})"
                                                    title="Approve Request">
                                                    <i class="fa-solid fa-circle-check text-lg mb-1"></i>
                                                    <span class="text-xs font-semibold">Approve</span>
                                                </button>
                                            @endif

                                            <!-- Schedule Release -->
                                            @if ($d->status === 'Approved')
                                                <button type="button"
                                                    class="flex flex-col items-center justify-center w-16 p-2 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 hover:text-indigo-800 transition duration-200"
                                                    onclick="openReleaseModal({{ $d->id }})"
                                                    title="Schedule Release">
                                                    <i class="fa-solid fa-calendar-check text-lg mb-1"></i>
                                                    <span class="text-xs font-semibold">Schedule</span>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <!-- Release Modal -->
                                <div id="releaseModal"
                                    class="fixed inset-0 bg-black/50  flex items-center justify-center z-50 hidden">
                                    <div
                                        class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md transform transition-all">
                                        <div class="flex items-center justify-between mb-6">
                                            <h3 class="text-2xl font-bold text-gray-900">Schedule Release</h3>
                                            <button onclick="closeReleaseModal()"
                                                class="text-gray-400 hover:text-gray-600 transition-colors">
                                                <i class="fa-solid fa-times text-xl"></i>
                                            </button>
                                        </div>

                                        <form id="releaseForm" action="{{ route('cedula.release', $d->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="mb-6">
                                                <label for="release_date"
                                                    class="block text-sm font-semibold text-gray-700 mb-2">
                                                    Select Release Date
                                                </label>
                                                <input type="date" name="release_date" id="release_date"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                                    required min="{{ date('Y-m-d') }}">
                                            </div>

                                            <div class="flex justify-end gap-3">
                                                <button type="button" onclick="closeReleaseModal()"
                                                    class="px-5 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors">
                                                    Cancel
                                                </button>
                                                <button type="submit"
                                                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors shadow-sm">
                                                    Schedule Release
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="noResults" class="px-6 py-4 text-center text-gray-500 hidden bg-white">
                    <p>No results found for your search.</p>
                </div>
                <!-- Pagination -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $data->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <i class="fa-solid fa-inbox text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg font-medium">No requests available</p>
                    <p class="text-gray-400 text-sm mt-1">Check back later for new applications</p>
                </div>
            @endif
        </div>
        <dialog id="editRecordModal" class="modal">
            <div
                class="modal-box max-w-5xl w-full bg-white rounded-3xl shadow-2xl border border-gray-200 p-6 md:p-8 overflow-y-auto">
                <h3 class="font-bold text-2xl mb-6 flex items-center gap-3 text-gray-800">
                    <i class="fa-solid fa-user-pen text-green-600"></i>
                    Edit Cedula Record
                </h3>

                <!-- Edit Form -->
                <form id="editRecordForm" method="POST" action="{{ route('UpdateCedulaForm') }}"
                    class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <!-- Full Name -->
                    <div class="col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="edit_name" name="name"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3">
                    </div>

                    <!-- TIN -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">TIN</label>
                        <input type="text" id="edit_tin" name="tin"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3">
                    </div>

                    <!-- Citizenship -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Citizenship</label>
                        <input type="text" id="edit_citezenship" name="citezenship"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3">
                    </div>

                    <!-- Civil Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Civil Status</label>
                        <select id="edit_civil_status" name="civil_status"
                            class="select select-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3">
                            <option value="">Select status</option>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                            <option>Separated</option>
                        </select>
                    </div>

                    <!-- DOB -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" id="edit_dob" name="dob"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3">
                    </div>

                    <!-- Place of Birth -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Place of Birth</label>
                        <input type="text" id="edit_place_of_birth" name="place_of_birth"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3">
                    </div>

                    <!-- Height -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Height (cm)</label>
                        <input type="number" id="edit_height" name="height"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3">
                    </div>

                    <!-- Weight -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Weight (kg)</label>
                        <input type="number" id="edit_weight" name="weight"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3">
                    </div>

                    <!-- Business Gross Receipt -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Business Gross Receipt</label>
                        <input type="number" id="edit_total_gross_receipt_fr_business"
                            name="total_gross_receipt_fr_business"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3"
                            step="0.01">
                    </div>

                    <!-- Salary Earnings -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Salary Earnings</label>
                        <input type="number" id="edit_total_earning_fr_salaries" name="total_earning_fr_salaries"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3"
                            step="0.01">
                    </div>

                    <!-- Real Property Income -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Real Property Income</label>
                        <input type="number" id="edit_total_income_fr_realproperty"
                            name="total_income_fr_realproperty"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3"
                            step="0.01">
                    </div>

                    <!-- Address -->
                    <div class="col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
                        <input type="text" id="edit_address" name="address"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3">
                    </div>

                    <!-- Amount Paid -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Amount Paid</label>
                        <input type="number" id="edit_amount" name="amount"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg p-3"
                            step="0.01">
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-action col-span-3 flex justify-end gap-4 mt-4">
                        <button type="button" class="btn bg-gray-200 hover:bg-gray-300 px-6"
                            onclick="editRecordModal.close()">Cancel</button>
                        <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white px-6">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </dialog>


        <script>
            $(document).ready(function() {
                $('.edit-btn').on('click', function() {
                    const record = $(this).data('record');

                    // Fill modal fields
                    $('#edit_id').val(record.id);
                    $('#edit_name').val(record.name);
                    $('#edit_tin').val(record.tin);
                    $('#edit_address').val(record.address);
                    $('#edit_citezenship').val(record.citezenship);
                    $('#edit_civil_status').val(record.civil_status);
                    $('#edit_dob').val(record.dob);
                    $('#edit_place_of_birth').val(record.place_of_birth);
                    $('#edit_height').val(record.height);
                    $('#edit_weight').val(record.weight);
                    $('#edit_total_gross_receipt_fr_business').val(record.total_gross_receipt_fr_business);
                    $('#edit_total_earning_fr_salaries').val(record.total_earning_fr_salaries);
                    $('#edit_total_income_fr_realproperty').val(record.total_income_fr_realproperty);
                    $('#edit_amount').val(record.amount);

                    // Show modal
                    document.getElementById('editRecordModal').showModal();
                });
            });
        </script>

    </div>


    <!-- Scripts -->
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                customClass: {
                    popup: 'colored-toast'
                },
                background: '#ffffff',
                color: '#16a34a', // green text
            });
        </script>

        <style>
            .colored-toast {
                border-left: 6px solid #16a34a !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                padding-left: 12px !important;
            }
        </style>
    @endif

    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This employee record will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel',
                    background: '#fff',
                    color: '#333',
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteForm_' + id).submit();
                    }
                });
            });
        });
    </script>
    <script>
        function showApprovalConfirmation(id) {
            Swal.fire({
                title: 'Approve Document?',
                text: "This will mark the document as approved and ready for release.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Approve',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approveForm' + id).submit();
                }
            });
        }

        function openReleaseModal(id) {
            document.getElementById('releaseForm').action = '/cedula/' + id;
            document.getElementById('releaseModal').classList.remove('hidden');
        }

        function closeReleaseModal() {
            document.getElementById('releaseModal').classList.add('hidden');
            document.getElementById('release_date').value = '';
        }

        function deleteRecord(id) {
            Swal.fire({
                title: 'Delete Record?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add your delete logic here
                    // Example: document.getElementById('deleteForm' + id).submit();
                }
            });
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeReleaseModal();
            }
        });
    </script>
    <script>
        function searchResidents() {
            const input = document.getElementById("search").value.toLowerCase();
            const rows = document.getElementById("residentTableBody").getElementsByTagName("tr");
            const noResults = document.getElementById("noResults");
            let matchFound = false;

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let rowMatch = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().includes(input)) {
                        rowMatch = true;
                        break;
                    }
                }

                rows[i].style.display = rowMatch ? "" : "none";

                if (rowMatch) matchFound = true;
            }

            // Show "No Results Found" if nothing matches
            noResults.style.display = matchFound ? "none" : "block";
        }
    </script>
</x-admin-layout>
