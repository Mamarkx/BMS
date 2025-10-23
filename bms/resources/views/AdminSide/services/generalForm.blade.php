<x-admin-layout>
    <div class="w-full p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="space-y-2">
                <h3 class="font-semibold text-3xl text-gray-800">General Applications</h3>
                <p class="text-gray-500 text-lg">Manage and track all resident requests</p>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white rounded-md border border-gray-300">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Reference Number</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Name</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Type</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Status</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $d)
                        <tr class="border-b border-gray-300 hover:bg-gray-50 text-sm text-gray-800">
                            <td class="py-3 px-6">{{ $d->reference_number }}</td>
                            <td class="py-3 px-6">{{ $d->first_name }} {{ $d->middle_name ?? '' }} {{ $d->last_name }}
                            </td>
                            <td class="py-3 px-6">{{ $d->type }}</td>
                            <td class="py-3 px-6">
                                <span
                                    class="inline-block px-3 py-1 rounded-full font-medium
                                {{ $d->status === 'Pending' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $d->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $d->status === 'Released' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    {{ ucfirst($d->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-lg flex items-center gap-2">
                                <!-- View/Edit/Delete -->
                                <a href="{{ route('generalID.show', $d->id) }}"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <button class="text-gray-600 hover:text-green-800 edit-btn"
                                    data-record='@json($d)'>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form id="deleteForm_{{ $d->id }}"
                                    action="{{ route('DeleteGeneralForm', $d->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-btn text-red-600 hover:text-red-800"
                                        data-id="{{ $d->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                <!-- Approve -->
                                <form id="approveForm{{ $d->id }}"
                                    action="{{ route('general.formID', $d->id) }}" method="POST">
                                    @csrf
                                </form>
                                <button class="text-green-600 hover:text-yellow-800"
                                    onclick="showApprovalConfirmation({{ $d->id }})"><i
                                        class="fa-solid fa-check-circle"></i></button>

                                <!-- Schedule Release -->
                                <button class="text-blue-600 hover:text-blue-800 delete-btn"
                                    onclick="openReleaseModal({{ $d->id }})"><i
                                        class="fa-solid fa-calendar-check"></i></button>
                            </td>
                        </tr>
                        <!-- Release Modal -->
                        <div id="releaseModal"
                            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                <h3 class="text-xl font-semibold mb-4">Schedule Document Release</h3>
                                <form id="releaseForm" action="{{ route('general.release', $d->id) }}" method="POST">
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
</x-admin-layout>
