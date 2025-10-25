<x-admin-layout>
    <div class="h-screen w-full p-8">
        <!-- Header Section with Search Bar -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-2">
                <h1 class="text-4xl font-extrabold text-gray-900">Resident Management</h1>
                <p class="text-lg text-gray-600">Manage and track resident information efficiently</p>
            </div>

            <!-- Search Bar & Add Resident Button -->
            <div class="flex items-center gap-4">
                <!-- Search Bar -->
                <div class="relative w-full md:w-96">
                    <input type="text" id="search" placeholder="Search residents..."
                        class="w-full p-3 pl-10 pr-4 rounded-xl bg-white text-gray-700 border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200"
                        onkeyup="searchResidents()">
                    <i class="fa-solid fa-search absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-500"></i>
                </div>

                <!-- Add New Resident Button -->
                <button id="open-modal-btn" onclick="my_modal_1.showModal()"
                    class="group relative px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-3">
                    <i class="fa-solid fa-user-plus text-lg"></i>
                    <span class="font-medium">Add New Resident</span>
                </button>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Full Name</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Gender</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Civil Status</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Birthday</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 text-center text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="residentTableBody">
                        @forelse ($residents as $resident)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    {{ $resident->resident_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $resident->first_name }} {{ $resident->middle_name }}
                                    {{ $resident->last_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $resident->sex }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $resident->civil_status }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($resident->birth_date)->format('F j, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $resident->status == 'Active' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $resident->status }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-4">
                                        <!-- View Button -->
                                        <button onclick='viewRecord(@json($resident))'
                                            class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none transition-all duration-200"
                                            title="View Details">
                                            <i class="fa-solid fa-eye text-base"></i>
                                            <span class="text-sm font-medium">View</span>
                                        </button>

                                        <!-- Edit Button -->
                                        <button
                                            class="EditResidentInfo flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none transition-all duration-200"
                                            data-id="{{ $resident->resident_id }}" title="Edit Information">
                                            <i class="fa-solid fa-pen-to-square text-base"></i>
                                            <span class="text-sm font-medium">Edit</span>
                                        </button>

                                        <!-- Delete Button -->
                                        <form id="deleteForm_{{ $resident->resident_id }}"
                                            action="{{ route('DeleteResident', $resident->resident_id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="delete-btn flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none transition-all duration-200"
                                                title="Delete Resident" data-id="{{ $resident->resident_id }}">
                                                <i class="fa-solid fa-trash text-base"></i>
                                                <span class="text-sm font-medium">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-6 text-center text-gray-500 text-sm">
                                    No Resident Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            <!-- No Results Found Message -->
            <div id="noResults" class="px-6 py-4 text-center text-gray-500 hidden">
                <p>No results found for your search.</p>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $residents->links() }}
            </div>
        </div>
    </div>


    <!-- Edit Modal Container -->
    <div id="edit-modal-container"></div>

    <!-- Add Resident Modal -->
    <dialog id="my_modal_1" class="modal">
        <div class="modal-box bg-white rounded-2xl shadow-2xl w-full max-w-5xl p-0 max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="sticky top-0 z-10 bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <h3 class="text-3xl font-bold text-white mb-1">Add New Resident</h3>
                <p class="text-blue-100 text-sm">Fill in the details to register a new resident</p>
            </div>

            <!-- Modal Body -->
            <div class="overflow-y-auto max-h-[calc(90vh-140px)] px-8 py-6">
                <form action="{{ route('addResident') }}" method="POST" id="addResidentForm" class="space-y-8"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="space-y-5">
                        <div class="flex items-center gap-3 pb-3 border-b-2 border-blue-100">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-user text-blue-600"></i>
                            </div>
                            <h4 class="text-xl font-bold text-slate-800">Personal Information</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="space-y-2">
                                <label for="fname" class="block text-sm font-semibold text-slate-700">First Name
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="fname" name="fname"
                                    class="w-full placeholder:text-gray-400 px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Juan" required>
                            </div>

                            <div class="space-y-2">
                                <label for="mname" class="block text-sm font-semibold text-slate-700">Middle
                                    Name</label>
                                <input type="text" id="mname" name="mname"
                                    class="w-full px-4 placeholder:text-gray-400 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Santos">
                            </div>

                            <div class="space-y-2">
                                <label for="lname" class="block text-sm font-semibold text-slate-700">Last Name
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="lname" name="lname"
                                    class="w-full placeholder:text-gray-400 px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Dela Cruz" required>
                            </div>

                            <div class="space-y-2">
                                <label for="sex" class="block text-sm font-semibold text-slate-700">Gender <span
                                        class="text-red-500">*</span></label>
                                <select id="sex" name="sex"
                                    class="w-full placeholder:text-gray-400 px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label for="birth_date" class="block text-sm font-semibold text-slate-700">Birthdate
                                    <span class="text-red-500">*</span></label>
                                <input type="date" id="birth_date" name="birth_date"
                                    class="w-full placeholder:text-gray-400 px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    required>
                            </div>

                            <div class="space-y-2">
                                <label for="civil_status" class="block text-sm font-semibold text-slate-700">Civil
                                    Status <span class="text-red-500">*</span></label>
                                <select id="civil_status" name="civil_status"
                                    class="w-full placeholder:text-gray-400 px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    required>
                                    <option value="">Select Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Residence Section -->
                    <div class="space-y-5">
                        <div class="flex items-center gap-3 pb-3 border-b-2 border-emerald-100">
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-location-dot text-emerald-600"></i>
                            </div>
                            <h4 class="text-xl font-bold text-slate-800">Contact & Residence</h4>
                        </div>
                        <div class="space-y-2">
                            <label for="contact_number" class="block text-sm font-semibold text-slate-700">
                                Contact Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="contact_number" name="contact_number"
                                class="w-full placeholder:text-gray-400 px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                placeholder="091232190" required>
                        </div>

                        <script>
                            document.getElementById('contact_number').addEventListener('input', function(e) {
                                this.value = this.value.replace(/[^0-9]/g, '');
                            });
                        </script>

                        <div class="space-y-2">
                            <label for="address" class="block text-sm font-semibold text-slate-700">Complete Address
                                <span class="text-red-500">*</span></label>
                            <textarea id="address" name="address" rows="4"
                                class="w-full placeholder:text-gray-400 px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                placeholder="Street, Barangay, City, Province" required></textarea>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class=" px-8 py-5 border-t border-slate-200 flex justify-end gap-3">
                        <button type="button"
                            class="px-6 py-3 bg-white border-2 border-slate-300 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 transition-all duration-200"
                            onclick="document.getElementById('my_modal_1').close()">
                            Cancel
                        </button>

                        <button type="submit" form="addResidentForm"
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="fa-solid fa-check mr-2"></i>
                            Add Resident
                        </button>
                    </div>
                </form>
            </div>


        </div>
    </dialog>

    <dialog id="viewModal" class="modal backdrop:bg-black/80 backdrop:backdrop-blur-sm">
        <div
            class="modal-box max-w-4xl bg-white rounded-xl shadow-2xl p-0 overflow-hidden transform transition-all duration-300">

            <!-- Header -->
            <div class="bg-indigo-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-address-card text-white text-2xl"></i>
                    <div>
                        <h3 class="text-xl font-bold text-white leading-tight">Resident Profile</h3>
                        <p class="text-indigo-200 text-sm">Detailed record overview</p>
                    </div>
                </div>
                <button onclick="$('#viewModal')[0].close()" class="text-white/80 hover:text-white transition p-1">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="px-6 py-6 bg-gray-50 max-h-[70vh] overflow-y-auto space-y-6">

                <div
                    class="bg-white rounded-lg shadow-sm p-6 flex flex-col sm:flex-row gap-6 items-center border border-gray-100">

                    <div
                        class="w-24 h-24 flex-shrink-0 bg-indigo-50 rounded-full flex items-center justify-center border-4 border-white shadow-md overflow-hidden">
                        <i class="fa-solid fa-user text-indigo-500 text-4xl"></i>
                    </div>

                    <div class="flex-grow text-center sm:text-left">
                        <h2 id="v_full_name_header" class="text-3xl font-extrabold text-gray-800 tracking-tight mb-1">
                        </h2>
                        <p class="text-gray-500 font-mono text-sm mb-2">Resident ID: <span
                                id="v_resident_id">N/A</span>
                        </p>

                        <p id="v_status_badge"
                            class="inline-flex items-center px-4 py-1 text-sm font-semibold rounded-full transition">
                        </p>
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-6">

                    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
                        <div class="px-5 py-3 border-b border-gray-100 bg-white flex items-center gap-3">
                            <i class="fa-solid fa-id-card-clip text-indigo-600"></i>
                            <h4 class="text-lg font-bold text-gray-700">Identity & Personal Details</h4>
                        </div>
                        <div class="p-5 space-y-4">

                            @php
                                $detailClass = 'flex justify-between items-start pb-2 border-b border-gray-50/50';
                                $labelClass = 'text-sm font-medium text-gray-500 flex-shrink-0 mr-4';
                                $valueClass = 'text-sm font-semibold text-gray-800 text-right leading-relaxed';
                            @endphp

                            <div class="{{ $detailClass }}">
                                <span class="{{ $labelClass }}">First Name</span>
                                <span id="v_first_name" class="{{ $valueClass }}"></span>
                            </div>
                            <div class="{{ $detailClass }}">
                                <span class="{{ $labelClass }}">Middle Name</span>
                                <span id="v_middle_name" class="{{ $valueClass }}"></span>
                            </div>
                            <div class="{{ $detailClass }}">
                                <span class="{{ $labelClass }}">Last Name</span>
                                <span id="v_last_name" class="{{ $valueClass }}"></span>
                            </div>
                            <div class="{{ $detailClass }}">
                                <span class="{{ $labelClass }}">Gender</span>
                                <span id="v_sex" class="{{ $valueClass }}"></span>
                            </div>
                            <div class="{{ $detailClass }}">
                                <span class="{{ $labelClass }}">Birthdate</span>
                                <span id="v_birth_date" class="{{ $valueClass }}"></span>
                            </div>
                            <div class="{{ $detailClass }}">
                                <span class="{{ $labelClass }}">Civil Status</span>
                                <span id="v_civil_status" class="{{ $valueClass }}"></span>
                            </div>
                            <div class="{{ $detailClass }}">
                                <span class="{{ $labelClass }}">Contact Number</span>
                                <span id="v_contact_number" class="{{ $valueClass }}">N/A</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
                        <div class="px-5 py-3 border-b border-gray-100 bg-white flex items-center gap-3">
                            <i class="fa-solid fa-location-dot text-indigo-600"></i>
                            <h4 class="text-lg font-bold text-gray-700">Residential Address</h4>
                        </div>
                        <div class="p-5 space-y-4">
                            <div class="{{ $detailClass }} flex-col items-start border-b-0">
                                <span class="{{ $labelClass }} mb-1">Full Address</span>
                                <p id="v_address" class="text-base font-medium text-gray-800 pt-1 leading-snug"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white px-6 py-4 flex justify-end border-t border-gray-100">
                <button onclick="$('#viewModal')[0].close()"
                    class="px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition">
                    <i class="fa-solid fa-circle-check mr-2"></i>Close
                </button>
            </div>

        </div>
    </dialog>



</x-admin-layout>
<script>
    // Function to open the modal and populate data
    function viewRecord(resident) {
        // Populate modal fields with resident data
        $('#v_full_name_header').text(resident.first_name + ' ' + (resident.middle_name ? resident.middle_name : '') +
            ' ' + resident.last_name);

        $('#v_first_name').text(resident.first_name);
        $('#v_middle_name').text(resident.middle_name);
        $('#v_last_name').text(resident.last_name);
        $('#v_resident_id').text(resident.resident_id);
        $('#v_sex').text(resident.sex);
        $('#v_birth_date').text(resident.birth_date);
        $('#v_civil_status').text(resident.civil_status);
        $('#v_address').text(resident.address);
        $('#v_contact_number').text(resident.contact_number || 'N/A');
        $('#v_status_badge').text(resident.status);

        // Set status badge color based on resident's status
        if (resident.status === 'Active') {
            $('#v_status_badge').addClass('bg-green-100 text-green-700');
        } else {
            $('#v_status_badge').addClass('bg-red-100 text-red-700');
        }

        // Show the modal
        $('#viewModal')[0].showModal();
    }

    // Function to close the modal
    function closeModal() {
        $('#viewModal')[0].close();
    }
</script>
<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id'); // Now it gets the correct id from data-id attribute
            Swal.fire({
                title: 'Are you sure?',
                text: "This resident's record will be permanently deleted!",
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
                    $('#deleteForm_' + id)
                        .submit(); // Submitting the correct form based on the resident's id
                }
            });
        });
    });
</script>

@if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            iconColor: '#ffffff',
            background: '#10b981',
            color: '#ffffff',
            customClass: {
                popup: 'rounded-xl shadow-2xl'
            }
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        $('.EditResidentInfo').click(function() {
            let residentId = $(this).data('id');

            $.ajax({
                url: `/residents/${residentId}/edit`,
                type: 'GET',
                success: function(response) {
                    $('#edit-modal-container').html(response);
                    $('#edit-resident-modal').removeClass('hidden');
                }
            });
        });

        $(document).on('click', '.closeModal', function() {
            $('#edit-resident-modal').addClass('hidden');
            $('#edit-modal-container').empty();
        });

        $(document).on('submit', '#editResidentForm', function(e) {
            e.preventDefault();
            let form = $(this);
            let formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: response.message,
                            confirmButtonColor: '#2563eb',
                            customClass: {
                                popup: 'rounded-xl'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                            confirmButtonColor: '#dc2626',
                            customClass: {
                                popup: 'rounded-xl'
                            }
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong.',
                        confirmButtonColor: '#dc2626',
                        customClass: {
                            popup: 'rounded-xl'
                        }
                    });
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
