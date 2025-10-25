<x-admin-layout>
    <div class="w-full h-screen p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="space-y-2">
                <h3 class="font-semibold text-3xl text-gray-800">General Applications</h3>
                <p class="text-gray-500 text-lg">Manage and track all resident requests</p>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-folder-open text-blue-600"></i>
                    General Form Requests
                </h2>

                <div class="relative w-full md:w-96">
                    <input type="text" id="search" placeholder="Search residents..."
                        class="w-full p-3 pl-10 pr-4 rounded-xl bg-white text-gray-700 border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200"
                        onkeyup="searchResidents()">
                    <i class="fa-solid fa-search absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-500"></i>
                </div>
            </div>


            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-100">
                        <tr>
                            <th class="py-3 px-6 font-semibold text-gray-800 uppercase tracking-wider text-left">
                                Reference #</th>
                            <th class="py-3 px-6 font-semibold text-gray-800 uppercase tracking-wider text-left">Full
                                Name</th>
                            <th class="py-3 px-6 font-semibold text-gray-800 uppercase tracking-wider text-left">Type
                            </th>
                            <th class="py-3 px-6 font-semibold text-gray-800 uppercase tracking-wider text-left">
                                Status</th>
                            <th class="py-3 px-6 font-semibold text-gray-800 uppercase tracking-wider text-center">
                                Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($data as $d)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-6 font-medium text-gray-800">{{ $d->reference_number }}</td>

                                <td class="py-3 px-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">
                                            {{ strtoupper(substr($d->first_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $d->first_name }} {{ $d->middle_name ?? '' }}
                                                {{ $d->last_name }}</p>
                                            <p class="text-xs text-gray-500">{{ $d->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-3 px-6 capitalize text-gray-700">{{ $d->type }}</td>

                                <td class="py-3 px-6">
                                    @php
                                        $statusClasses = [
                                            'Pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-300',
                                            'Approved' => 'bg-green-100 text-green-800 border border-green-300',
                                            'Released' => 'bg-blue-100 text-blue-800 border border-blue-300',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClasses[$d->status] ?? 'bg-gray-100 text-gray-700 border border-gray-300' }}">
                                        {{ ucfirst($d->status) }}
                                    </span>
                                </td>

                                <td class="py-3 px-6 text-center">
                                    <div class="flex justify-center items-center gap-3 text-sm font-medium">

                                        <!-- View -->
                                        <a href="{{ route('generalID.show', $d->id) }}"
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
                                            action="{{ route('DeleteGeneralForm', $d->id) }}" method="POST"
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

                                        @if ($d->status === 'Pending')
                                            <form id="approveForm{{ $d->id }}"
                                                action="{{ route('general.formID', $d->id) }}" method="POST"
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

                                        <!-- Approve -->

                                    </div>
                                </td>

                                <div id="releaseModal"
                                    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                        <h3 class="text-xl font-semibold mb-4">Schedule Document Release</h3>
                                        <form id="releaseForm" action="{{ route('general.release', $d->id) }}"
                                            method="POST">
                                            @csrf
                                            <label for="release_date"
                                                class="block text-sm font-medium text-gray-700">Select
                                                Release Date:</label>
                                            <input type="date" name="release_date" id="release_date"
                                                class="w-full p-2 border border-gray-300 rounded-md mt-2" required
                                                min="{{ date('Y-m-d') }}">
                                            <div class="flex justify-end gap-4 mt-4">
                                                <button type="button" class="text-gray-500"
                                                    onclick="closeReleaseModal()">Cancel</button>
                                                <button type="submit"
                                                    class="bg-blue-600 text-white px-4 py-2 rounded-md">Schedule
                                                    Release</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500 font-medium">
                                    No requests found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div id="noResults" class="px-6 py-4 text-center text-gray-500 hidden">
                <p>No results found for your search.</p>
            </div>
        </div>


        <!-- Pagination -->
        <div class="mt-4">
            {{ $data->links() }}
        </div>

        <dialog id="editRecordModal" class="modal">
            <div class="modal-box max-w-3xl bg-white rounded-2xl shadow-xl border border-gray-200">
                <h3 class="font-bold text-2xl mb-6 flex items-center gap-3 text-gray-800">
                    <i class="fa-solid fa-user-pen text-green-600"></i>
                    Edit Record
                </h3>

                <!-- Edit Form -->
                <form id="editRecordForm" method="POST" action="{{ route('UpdateGeneralForm') }}"
                    class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
                        <input type="text" id="edit_first_name" name="first_name"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
                        <input type="text" id="edit_last_name" name="last_name"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Middle Name</label>
                        <input type="text" id="edit_middle_name" name="middle_name"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Suffix</label>
                        <input type="text" id="edit_suffix" name="suffix"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" id="edit_dob" name="dob"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Age</label>
                        <input type="number" id="edit_age" name="age"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Civil Status</label>
                        <select id="edit_civil_status" name="civil_status"
                            class="select select-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">Select status</option>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                            <option>Separated</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Year of Residency</label>
                        <input type="number" id="edit_year_of_residency" name="year_of_residency"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
                        <input type="text" id="edit_address" name="address"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Place of Birth</label>
                        <input type="text" id="edit_place_of_birth" name="place_of_birth"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input type="email" id="edit_email" name="email"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-action col-span-2">
                        <button type="button" class="btn bg-gray-200 hover:bg-gray-300"
                            onclick="editRecordModal.close()">Cancel</button>
                        <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </dialog>


        <script>
            $(document).ready(function() {
                $('.edit-btn').on('click', function() {
                    const record = $(this).data('record');

                    // Fill all modal fields
                    $('#edit_id').val(record.id);
                    $('#edit_first_name').val(record.first_name);
                    $('#edit_last_name').val(record.last_name);
                    $('#edit_middle_name').val(record.middle_name);
                    $('#edit_suffix').val(record.suffix);
                    $('#edit_dob').val(record.dob);
                    $('#edit_civil_status').val(record.civil_status);
                    $('#edit_year_of_residency').val(record.year_of_residency);
                    $('#edit_email').val(record.email);
                    $('#edit_place_of_birth').val(record.place_of_birth);
                    $('#edit_age').val(record.age);
                    $('#edit_address').val(record.address);

                    // Show the modal
                    document.getElementById('editRecordModal').showModal();
                });
            });
        </script>

    </div>

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
        function showApprovalConfirmation(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to approve this document?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Approve',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    document.getElementById('approveForm' + id).submit();
                }
            });
        }

        function openReleaseModal(id) {
            document.getElementById('releaseForm').action = '/general-form/' + id;
            document.getElementById('releaseModal').classList.remove('hidden');
        }

        function closeReleaseModal() {
            document.getElementById('releaseModal').classList.add('hidden');
        }
    </script>
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
        // Function to filter residents based on the search input
        function searchResidents() {
            let input = document.getElementById("search").value.toLowerCase();
            let rows = document.getElementById("residentTableBody").getElementsByTagName("tr");
            let noResults = document.getElementById("noResults");
            let matchFound = false;

            for (let i = 0; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let rowMatch = false;

                // Loop through each cell in the row and check if the input matches any of the columns
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().includes(input)) {
                        rowMatch = true;
                        break;
                    }
                }

                rows[i].style.display = rowMatch ? "" : "none"; // Show or hide based on the match

                if (rowMatch) {
                    matchFound = true;
                }
            }

            // Show "No Results Found" message if no matches
            if (!matchFound) {
                noResults.classList.remove("hidden");
            } else {
                noResults.classList.add("hidden");
            }
        }
    </script>

</x-admin-layout>
