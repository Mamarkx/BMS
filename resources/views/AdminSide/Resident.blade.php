<x-admin-layout>
    <div class="w-full p-6">
        <!-- Upper Section -->
        <div class="flex justify-between items-center mb-6">
            <!-- Title -->
            <div class="title space-y-2">
                <h3 class="font-semibold text-3xl text-gray-800">Resident Information</h3>
                <p class="text-[#6B7280] text-lg">Manage and track all Resident Info</p>
            </div>

            <!-- Add Employee Button -->
            <div class="button">
                <button id="open-modal-btn" onclick="my_modal_1.showModal()" class=" bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-plus text-lg"></i>
                    <span class="text-lg">Add Resident</span>
                </button>
            </div>
        </div>

<!-- Resident Table -->
<div class="overflow-x-auto bg-white rounded-md border-gray-300 border">
    <table class="min-w-full table-auto text-left">
        <thead>
            <tr class="bg-gray-300">
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Resident ID</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Name</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Gender</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Civil Status</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Birthday</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Status</th>
                <th class="py-3 px-6 text-sm font-medium text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through the residents --}}
            @foreach ($residents as $resident)
            <tr class="border-b border-gray-300 hover:bg-gray-50">
                <td class="py-3 px-6 text-sm text-gray-800">{{ $resident->resident_id }}</td>
                <td class="py-3 px-6 text-sm text-gray-800">{{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }}</td>
                <td class="py-3 px-6 text-sm text-gray-800">{{ $resident->sex }}</td>
                <td class="py-3 px-6 text-sm text-gray-800">{{ $resident->civil_status }}</td>
               <td class="py-3 px-6 text-sm text-gray-800">{{ \Carbon\Carbon::parse($resident->birth_date)->format('F j, Y') }}</td>
                <td class="py-3 px-6 text-sm text-green-500">{{ $resident->status }}</td>
                <td class="py-3 px-6 text-sm text-blue-500">
                    <button class="text-blue-500 hover:text-blue-700 transition-colors "   data-id="{{ $resident->resident_id }}">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    
                            <button class="EditResidentInfo" data-id="{{ $resident->resident_id }}">
                            <i class="fa-solid fa-pencil-alt"></i> Edit
                        </button>

                    <button class="text-red-500 hover:text-red-700 transition-colors ml-2" onclick="deleteRecord({{ $resident->resident_id }})">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


                <!-- Pagination -->
              <div class="mt-4">
                {{ $residents->links() }}
            </div>
    </div>
    <div id="edit-modal-container"></div>
<dialog id="my_modal_1" class="modal">
    <div class="modal-box bg-white rounded-xl shadow-2xl w-full max-w-4xl p-10">
        <h3 class="text-4xl font-extrabold text-gray-900 mb-2 text-center">Add New Resident</h3>
        <p class="text-center text-gray-500 mb-8">Please fill out the form to add a new resident to the system.</p>

        <form action="{{ route('addResident') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf

            <!-- Personal Information -->
            <div class="space-y-6">
                <h4 class="text-2xl font-bold text-gray-800 border-b pb-2">Personal Information</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- First Name -->
                    <div class="mb-4">
                        <label for="fname" class="block text-lg font-medium text-gray-700">First Name</label>
                        <input type="text" id="fname" name="fname" class="input input-bordered w-full mt-2 p-4 rounded-lg shadow-sm border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="Enter first name" required>
                    </div>

                    <!-- Middle Name -->
                    <div class="mb-4">
                        <label for="mname" class="block text-lg font-medium text-gray-700">Middle Name (optional)</label>
                        <input type="text" id="mname" name="mname" class="input input-bordered w-full mt-2 p-4 rounded-lg shadow-sm border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="Enter middle name">
                    </div>

                    <!-- Last Name -->
                    <div class="mb-4">
                        <label for="lname" class="block text-lg font-medium text-gray-700">Last Name</label>
                        <input type="text" id="lname" name="lname" class="input input-bordered w-full mt-2 p-4 rounded-lg shadow-sm border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="Enter last name" required>
                    </div>

                    <!-- Gender -->
                    <div class="mb-4">
                        <label for="sex" class="block text-lg font-medium text-gray-700">Gender</label>
                        <select id="sex" name="sex" class="select select-bordered w-full mt-2" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <!-- Birthdate -->
                    <div class="mb-4">
                        <label for="birth_date" class="block text-lg font-medium text-gray-700">Birthdate</label>
                        <input type="date" id="birth_date" name="birth_date" class="input input-bordered w-full mt-2 p-4 rounded-lg shadow-sm border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Civil Status -->
                    <div class="mb-4">
                        <label for="civil_status" class="block text-lg font-medium text-gray-700">Civil Status</label>
                        <select id="civil_status" name="civil_status" class="select select-bordered w-full mt-2" required>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- Contact & Residence -->
            <div class="space-y-6">
                <h4 class="text-2xl font-bold text-gray-800 border-b pb-2">Contact & Residence</h4>
                <div class="mb-4">
                    <label for="address" class="block text-lg font-medium text-gray-700">Address</label>
                    <textarea id="address" name="address" class="input input-bordered w-full mt-2 p-4 rounded-lg shadow-sm border-gray-300 focus:ring-2 focus:ring-blue-500" placeholder="Enter address" required></textarea>
                </div>
            </div>

            <!-- Profile Photo -->
            <div class="space-y-6">
                <h4 class="text-2xl font-bold text-gray-800 border-b pb-2">Profile Photo</h4>
                <div class="mb-4">
                    <label for="photo_path" class="block text-lg font-medium text-gray-700">Upload Profile Photo</label>
                    <input type="file" id="photo_path" name="photo_path" class="input input-bordered w-full mt-2 p-4 rounded-lg shadow-sm border-gray-300 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-lg font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="select select-bordered w-full mt-2" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end space-x-4">
                <button type="submit" class="btn bg-blue-600 text-white py-3 px-8 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">Add Resident</button>
                 <!-- Close Button -->
        <button type="button" class="btn" onclick="document.getElementById('my_modal_1').close()">Close</button>
            </div>
        </form>
    </div>
</dialog>


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
</script>
