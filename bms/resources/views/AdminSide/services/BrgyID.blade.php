<x-admin-layout>
    <div class="w-full p-4 sm:p-6 max-h-[calc(100vh-4rem)] overflow-y-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
            <div class="space-y-2">
                <h3 class="font-semibold text-2xl sm:text-3xl text-gray-800">Barangay ID Applications</h3>
                <p class="text-gray-500 text-base sm:text-lg">Manage and track all resident requests</p>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white rounded-md border border-gray-300">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-700">Reference Number</th>
                        <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-700">Name</th>
                        <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-700">Type</th>
                        <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-700">Status</th>
                        <th class="py-3 px-4 sm:px-6 text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $d)
                        <tr class="border-b border-gray-300 hover:bg-gray-50 text-sm text-gray-800">
                            <td class="py-3 px-4 sm:px-6">{{ $d->reference_number }}</td>
                            <td class="py-3 px-4 sm:px-6">{{ $d->name }}</td>
                            <td class="py-3 px-4 sm:px-6">{{ $d->type }}</td>
                            <td class="py-3 px-4 sm:px-6">
                                <span
                                    class="inline-block px-3 py-1 rounded-full font-medium
                                    {{ $d->status === 'Pending' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $d->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $d->status === 'Released' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    {{ ucfirst($d->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4 sm:px-6 text-lg flex flex-wrap items-center gap-2">
                                <a href="{{ route('barangayID.show', $d->id) }}"
                                    class="flex flex-col items-center justify-center w-16 p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-800 transition duration-200"
                                    title="View Record">
                                    <i class="fa-solid fa-eye text-lg mb-1"></i>
                                    <span class="text-xs font-semibold">View</span>
                                </a>
                                <button type="button"
                                    class="flex flex-col items-center justify-center w-16 p-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 hover:text-green-800 transition duration-200 edit-btn"
                                    data-record='@json($d)' title="Edit Record">
                                    <i class="fa-solid fa-pen-to-square text-lg mb-1"></i>
                                    <span class="text-xs font-semibold">Edit</span>
                                </button>
                                <button class="text-red-600 hover:text-red-800"
                                    onclick="deleteRecord({{ $d->id }})"><i
                                        class="fa-solid fa-trash"></i></button>

                                <form id="approveForm{{ $d->id }}"
                                    action="{{ route('approve.formID', $d->id) }}" method="POST">@csrf</form>
                                <button class="text-green-600 hover:text-yellow-800"
                                    onclick="showApprovalConfirmation({{ $d->id }})"><i
                                        class="fa-solid fa-check-circle"></i></button>

                                <button class="text-blue-600 hover:text-blue-800"
                                    onclick="openReleaseModal({{ $d->id }})"><i
                                        class="fa-solid fa-calendar-check"></i></button>
                            </td>
                        </tr>

                        <!-- Release Modal -->
                        <div id="releaseModal"
                            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden overflow-y-auto p-4">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                                <h3 class="text-xl font-semibold mb-4">Schedule Document Release</h3>
                                <form id="releaseForm" action="{{ route('schedule.releaseID', $d->id) }}"
                                    method="POST">
                                    @csrf
                                    <label for="release_date" class="block text-sm font-medium text-gray-700">Select
                                        Release Date:</label>
                                    <input type="date" name="release_date" id="release_date"
                                        class="w-full p-2 border border-gray-300 rounded-md mt-2" required>
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
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-2 text-gray-500 text-lg">No requests available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $data->links() }}
        </div>
        <dialog id="editRecordModal" class="modal">
            <div class="modal-box max-w-7xl w-full bg-white rounded-2xl shadow-xl border border-gray-200">
                <h3 class="font-bold text-2xl mb-6 flex items-center gap-3 text-gray-800">
                    <i class="fa-solid fa-user-pen text-green-600"></i>
                    Edit Request Record
                </h3>

                <form id="editRecordForm" method="POST" action="#" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="col-span-2">
                        <label class="text-sm font-semibold text-gray-700">Full Name</label>
                        <input type="text" name="name" id="edit_name"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Date of Birth</label>
                        <input type="date" name="dob" id="edit_dob"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Age</label>
                        <input type="number" name="age" id="edit_age"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Gender</label>
                        <select name="gender" id="edit_gender"
                            class="select select-bordered w-full border-gray-300 focus:border-green-500">
                            <option value="">Select</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Civil Status</label>
                        <select name="civil_status" id="edit_civil_status"
                            class="select select-bordered w-full border-gray-300 focus:border-green-500">
                            <option value="">Select</option>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                            <option>Separated</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="text-sm font-semibold text-gray-700">Address</label>
                        <input type="text" name="address" id="edit_address"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div class="col-span-2">
                        <label class="text-sm font-semibold text-gray-700">Place of Birth</label>
                        <input type="text" name="place_of_birth" id="edit_place_of_birth"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="edit_email"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Religion</label>
                        <input type="text" name="religion" id="edit_religion"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Citizenship</label>
                        <input type="text" name="citezenship" id="edit_citezenship"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Height</label>
                        <input type="text" name="height" id="edit_height"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Weight</label>
                        <input type="text" name="weight" id="edit_weight"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Precinct Number</label>
                        <input type="text" name="precint_number" id="edit_precint_number"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Amount</label>
                        <input type="number" name="amount" id="edit_amount"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <!-- Emergency Contact -->
                    <div class="col-span-2 font-semibold text-gray-800 mt-2">Emergency Contact</div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Contact Name</label>
                        <input type="text" name="emergency_name" id="edit_emergency_name"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Phone Number</label>
                        <input type="text" name="cellphone_number" id="edit_cellphone_number"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

                    <div class="col-span-2">
                        <label class="text-sm font-semibold text-gray-700">Emergency Address</label>
                        <input type="text" name="emergency_address" id="edit_emergency_address"
                            class="input input-bordered w-full border-gray-300 focus:border-green-500">
                    </div>

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

                    $('#edit_id').val(record.id);
                    $('#edit_name').val(record.name);
                    $('#edit_address').val(record.address);
                    $('#edit_dob').val(record.dob);
                    $('#edit_age').val(record.age);
                    $('#edit_place_of_birth').val(record.place_of_birth);
                    $('#edit_civil_status').val(record.civil_status);
                    $('#edit_email').val(record.email);
                    $('#edit_type').val(record.type);
                    $('#edit_purpose').val(record.purpose);
                    $('#edit_religion').val(record.religion);
                    $('#edit_height').val(record.height);
                    $('#edit_weight').val(record.weight);
                    $('#edit_amount').val(record.amount);
                    $('#edit_gender').val(record.gender);
                    $('#edit_citezenship').val(record.citezenship);
                    $('#edit_precint_number').val(record.precint_number);
                    $('#edit_emergency_name').val(record.emergency_name);
                    $('#edit_cellphone_number').val(record.cellphone_number);
                    $('#edit_emergency_address').val(record.emergency_address);

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
                iconColor: '#ffffff',
                background: '#22c55e',
                color: '#ffffff'
            });
        </script>
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
            document.getElementById('releaseForm').action = '/barangay-id/' + id;
            document.getElementById('releaseModal').classList.remove('hidden');
        }

        function closeReleaseModal() {
            document.getElementById('releaseModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>
