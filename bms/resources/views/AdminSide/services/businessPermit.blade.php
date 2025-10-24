<x-admin-layout>
    <div class="w-full p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="space-y-2">
                <h3 class="font-semibold text-3xl text-gray-800">Business Permit Applications</h3>
                <p class="text-gray-500 text-lg">Manage and track all resident requests</p>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white rounded-md border border-gray-300">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Reference Number</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Name Owner</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Type</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Status</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $d)
                        <tr class="border-b border-gray-300 hover:bg-gray-50 text-sm text-gray-800">
                            <td class="py-3 px-6">{{ $d->reference_number }}</td>
                            <td class="py-3 px-6">{{ $d->name_owner }}</td>
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
                                <a href="{{ route('Business.show', $d->id) }}"
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

                                <!-- Approve -->
                                <form id="approveForm{{ $d->id }}"
                                    action="{{ route('approve.business-permit', $d->id) }}" method="POST">
                                    @csrf
                                </form>
                                <button class="text-green-600 hover:text-yellow-800"
                                    onclick="showApprovalConfirmation({{ $d->id }})"><i
                                        class="fa-solid fa-check-circle"></i></button>

                                <!-- Schedule Release -->
                                <button class="text-blue-600 hover:text-blue-800"
                                    onclick="openReleaseModal({{ $d->id }})"><i
                                        class="fa-solid fa-calendar-check"></i></button>
                            </td>
                        </tr>












                        <!-- Release Modal -->
                        <div id="releaseModal"
                            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                <h3 class="text-xl font-semibold mb-4">Schedule Document Release</h3>
                                <form id="releaseForm" action="{{ route('businessPermit.release', $d->id) }}"
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
            <div class="modal-box max-w-3xl bg-white rounded-2xl shadow-xl border border-gray-200">
                <h3 class="font-bold text-2xl mb-6 flex items-center gap-3 text-gray-800">
                    <i class="fa-solid fa-briefcase-pen text-green-600"></i>
                    Edit Business Record
                </h3>

                <form id="editRecordForm" method="POST" action="{{ route('UpdateGeneralForm') }}"
                    class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Owner Name</label>
                        <input type="text" id="edit_name_owner" name="name_owner"
                            class="input input-bordered w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Business Name</label>
                        <input type="text" id="edit_name_business" name="name_business"
                            class="input input-bordered w-full">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Business Address</label>
                        <textarea id="edit_address_business" name="address_business" class="textarea textarea-bordered w-full h-24 resize-none"></textarea>
                    </div>


                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input type="email" id="edit_email" name="email" class="input input-bordered w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Type</label>
                        <input type="text" id="edit_type" name="type" class="input input-bordered w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Amount</label>
                        <input type="number" id="edit_amount" name="amount" class="input input-bordered w-full">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Purpose</label>
                        <input type="text" id="edit_purpose" name="purpose" class="input input-bordered w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Issue Date</label>
                        <input type="date" id="edit_issue_date" name="issue_date"
                            class="input input-bordered w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                        <select id="edit_status" name="status" class="select select-bordered w-full">
                            <option value="">Select status</option>
                            <option value="Pending">Pending</option>
                            <option class="Approved">Approved</option>
                            <option class="To be Release">To be Release</option>
                            <option class="Declined">Declined</option>
                        </select>
                    </div>

                    <div class="modal-action col-span-2">
                        <button type="button" class="btn bg-gray-200 hover:bg-gray-300"
                            onclick="editRecordModal.close()">Cancel</button>
                        <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </dialog>


        <script>
            $(document).ready(function() {
                $('.edit-btn').on('click', function() {
                    const record = $(this).data('record');

                    $('#edit_id').val(record.id);
                    $('#edit_reference_number').val(record.reference_number);
                    $('#edit_name_owner').val(record.name_owner);
                    $('#edit_name_business').val(record.name_business);
                    $('#edit_address_business').val(record.address_business);
                    $('#edit_email').val(record.email);
                    $('#edit_type').val(record.type);
                    $('#edit_amount').val(record.amount);
                    $('#edit_purpose').val(record.purpose);
                    $('#edit_issue_date').val(record.issue_date);
                    $('#edit_status').val(record.status);

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
            document.getElementById('releaseForm').action = '/business-permit/' + id;
            document.getElementById('releaseModal').classList.remove('hidden');
        }

        function closeReleaseModal() {
            document.getElementById('releaseModal').classList.add('hidden');
        }
    </script>

</x-admin-layout>
