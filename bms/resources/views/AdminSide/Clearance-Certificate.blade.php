<x-admin-layout>
    <div class="w-full p-6">
        <!-- Upper Section -->
        <div class="flex justify-between items-center mb-6">
            <!-- Title -->
            <div class="title space-y-2">
                <h3 class="font-semibold text-3xl text-gray-800">Request Reviewing And Approval</h3>
                <p class="text-[#6B7280] text-lg">Manage and track all Resident Info</p>
            </div>

        </div>

<!-- Resident Table -->
<div class="overflow-x-auto bg-white rounded-md border-gray-300 border">
    <table class="min-w-full table-auto text-left">
        <thead>
            <tr class="bg-gray-300">
                <th class="py-3 px-6 text-sm font-medium text-gray-700">ID</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Name</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Phone</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Request</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Email</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Request Date</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Status</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Actions</th>
            </tr>
        </thead>
      <tbody>
    @forelse ($data as $d)
    <tr class="border-b border-gray-300 hover:bg-gray-50">
        <td class="py-3 px-6 text-sm text-gray-800">{{ $d->id }}</td>
        <td class="py-3 px-6 text-sm text-gray-800">{{ $d->first_name }} {{ $d->middle_name }} {{ $d->last_name }}</td>
        <td class="py-3 px-6 text-sm text-gray-800">{{ $d->phone }}</td>
        <td class="py-3 px-6 text-sm text-gray-800">{{ $d->type }}</td>
        <td class="py-3 px-6 text-sm text-gray-800">{{ $d->email }}</td>
        <td class="py-3 px-6 text-sm text-gray-800">{{ \Carbon\Carbon::parse($d->issued_date)->format('F j, Y') }}</td>
        <td class="py-3 px-6 text-sm">
            <span class="
                inline-block px-3 py-1 rounded-full font-medium 
                {{ $d->status === 'Pending' ? 'bg-red-100 text-red-700' : '' }}
                {{ $d->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                {{ $d->status === 'Released' ? 'bg-blue-100 text-blue-700' : '' }}
                {{ $d->status === 'Other' ? 'bg-gray-100 text-gray-700' : '' }}
            ">
                {{ $d->status }}
            </span>
        </td>
        <td class="py-4 px-6 text-lg">
            <div class="flex items-center gap-4">
                <button class="text-blue-600 hover:text-blue-800 transition-colors duration-200" data-id="{{ $d->id }}" title="View">
                    <i class="fa-solid fa-eye"></i>
                </button>
                <button class="EditResidentInfo text-gray-600 hover:text-green-800 transition-colors duration-200" data-id="{{ $d->id }}" title="Edit">
                    <i class="fa-solid fa-pen-to-square cursor-pointer"></i>
                </button>
                <button class="text-red-600 hover:text-red-800 transition-colors duration-200" onclick="deleteRecord({{ $d->id }})" title="Delete">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <form id="approveForm{{ $d->id }}" action="{{ route('approve.document', $d->id) }}" method="POST">
                    @csrf
                    <button 
                        type="button"
                        class="text-green-600 hover:text-yellow-800 transition-colors duration-200"
                        data-id="{{ $d->id }}" 
                        title="Approve" 
                        onclick="showApprovalConfirmation({{ $d->id }})"
                    >
                        <i class="fa-solid fa-check-circle"></i>
                    </button>
                </form>
                <button 
                    class="text-blue-600 hover:text-blue-800 transition-colors duration-200"
                    data-id="{{ $d->id }}" 
                    title="Schedule Release" 
                    onclick="openReleaseModal({{ $d->id }})"
                >
                    <i class="fa-solid fa-calendar-check"></i>
                </button>
            </div>
            
                <div id="releaseModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                        <h3 class="text-xl font-semibold mb-4">Schedule Document Release</h3>
                        <form id="releaseForm" action="{{ route('schedule.release', $d->id) }}" method="POST">
                            @csrf
                            <label for="release_date" class="block text-sm font-medium text-gray-700">Select Release Date:</label>
                            <input 
                                type="date" 
                                id="release_date" 
                                name="release_date" 
                                class="w-full p-2 border border-gray-300 rounded-md mt-2" 
                                required
                            />
                            <div class="flex justify-end gap-4 mt-4">
                                <button type="button" class="text-gray-500" onclick="closeReleaseModal()">Cancel</button>
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Schedule Release</button>
                            </div>
                        </form>
                    </div>
                </div>

        </td>
    </tr>
    @empty
    <tr>
        <td colspan="8" class="text-center py-6 text-gray-500 text-lg">
            No data available.
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
    </div>


 <div id="edit-modal-container"></div>


</x-admin-layout>
 @if(session('success'))
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
{{-- 
  <script>
    $(document).ready(function () {
        // When the Edit button is clicked
        $('.EditResidentInfo').click(function () {
            let residentId = $(this).data('id'); // Get the resident's id

            $.ajax({
                url: `/residents/${residentId}/edit`, // Send a GET request to the edit route
                type: 'GET',
                success: function (response) {
                    $('#edit-modal-container').html(response); // Inject the modal content into the container
                    $('#edit-resident-modal').removeClass('hidden'); // Show the modal
                }
            });
        });

        // Close modal functionality
        $(document).on('click', '.closeModal', function () {
            $('#edit-resident-modal').addClass('hidden'); // Hide the modal
            $('#edit-modal-container').empty(); // Clear the modal content
        });

        // Form submission via Ajax
        $(document).on('submit', '#editResidentForm', function (e) {
            e.preventDefault();
            let form = $(this);
            let formData = form.serialize(); // Serialize the form data

            $.ajax({
                url: form.attr('action'), // The form's action URL
                method: 'POST',
                data: formData,
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire('Updated!', response.message, 'success').then(() => {
                            location.reload(); // Reload the page after success
                        });
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function (xhr) {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            });
        });
    });
</script> --}}
<script>
    // Show SweetAlert confirmation when "Approve" button is clicked
    function showApprovalConfirmation(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to approve this document?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Approve',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                // Once confirmed, submit the form
                document.getElementById('approveForm' + id).submit();
            }
        });
    }

</script>
<script>
    // Open the Schedule Release Modal
    function openReleaseModal(id) {
        // Set the form action with the document id
        document.getElementById('releaseForm').action = '/schedule-release/' + id;
        
        // Show the modal
        document.getElementById('releaseModal').classList.remove('hidden');
    }

    // Close the Schedule Release Modal
    function closeReleaseModal() {
        document.getElementById('releaseModal').classList.add('hidden');
    }
</script>