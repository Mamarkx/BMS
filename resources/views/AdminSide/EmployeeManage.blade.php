<x-admin-layout>
    <div class="w-full p-6">
        <!-- Upper Section -->
        <div class="flex justify-between items-center mb-6">
            <!-- Title -->
            <div class="title space-y-2">
                <h3 class="font-semibold text-3xl text-gray-800">Employee Management</h3>
                <p class="text-[#6B7280] text-lg">Manage and track all barangay employees</p>
            </div>

            <!-- Add Employee Button -->
            <div class="button">
                <button id="open-modal-btn" onclick="my_modal_1.showModal()" class=" bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                    <i class="fa-solid fa-plus text-lg"></i>
                    <span class="text-lg">Add Employee</span>
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7 mb-6">
            <div class="bg-white px-6 py-10 border border-gray-300 rounded-md flex items-center justify-between space-x-4">
                <div>
                    <h3 class="text-xl font-medium text-gray-700">Total Employees</h3>
                    <p class="text-3xl font-semibold text-gray-900">{{ $countEmp }}</p>
                </div>
                <i class="fa-solid fa-users text-4xl text-gray-400"></i>
            </div>
            <div class="bg-white  px-6 py-10 border border-gray-300 rounded-md flex items-center justify-between space-x-4">
                <div>
                    <h3 class="text-xl font-medium text-gray-700">Active Employees</h3>
                    <p class="text-3xl font-semibold text-gray-900">{{ $countActive }}</p>
                </div>
                <i class="fa-solid fa-user-check text-4xl text-green-600"></i>
            </div>
            <div class="bg-white  px-6 py-10 border border-gray-300 rounded-md flex items-center justify-between space-x-4">
                <div>
                    <h3 class="text-xl font-medium text-gray-700">On Leave Employees</h3>
                    <p class="text-3xl font-semibold text-gray-900">{{ $countLeaveEmp }}</p>
                </div>
                <i class="fa-solid fa-user-times text-4xl text-yellow-500"></i>
            </div>
        
        </div>

        <!-- Employee Table -->
        <div class="overflow-x-auto bg-white rounded-md border-gray-300 border">
            <table class="min-w-full table-auto text-left">
                <thead>
                    <tr class="bg-gray-300 ">
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Employee ID</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Name</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Position</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Department</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Status</th>
                        <th class="py-3 px-6 text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
               <tbody>
                @foreach ($personnel as $p) 
                <tr class="border-b border-gray-300 hover:bg-gray-50">
                    <td class="py-3 px-6 text-sm text-gray-800">{{ $p->personnel_id }}</td>
                    <td class="py-3 px-6 text-sm text-gray-800">{{ $p->first_name }} {{ $p->last_name }}</td>
                    <td class="py-3 px-6 text-sm text-gray-800">{{ $p->position_title }}</td>
                    <td class="py-3 px-6 text-sm text-gray-800">{{ $p->department }}</td>
                    <td class="py-3 px-6 text-sm text-green-500">{{ $p->status }}</td>
                    <td class="py-3 px-6 text-sm text-blue-500">
                        <button class="text-blue-500 hover:text-blue-700 transition-colors" onclick="viewRecord({{ $p->personnel_id }})">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="text-green-500 hover:text-yellow-700 transition-colors ml-2" onclick="editRecord({{ $p->personnel_id }})">
                            <i class="fa-solid fa-pencil-alt"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-700 transition-colors ml-2" onclick="deleteRecord({{ $p->personnel_id }})">
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
                {{ $personnel->links() }}
            </div>
    </div>






<!-- Modal (Dialog) -->
<dialog id="my_modal_1" class="modal">
  <div class="modal-box w-full max-w-5xl">
    <h3 class="text-xl font-bold mb-4">Add New Employee</h3>

    <!-- Main Form -->
    <form action="{{ route('AddEmployee') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
  @csrf
      <!-- Personnel ID -->
      <div class="mb-4">
        <label for="personnel_id" class="block text-lg font-medium">Personnel ID</label>
        <input type="text" id="personnel_id" name="personnel_id" class="input input-bordered w-full mt-2 uppercase" placeholder="Enter personnel ID" required>
    </div>


      <!-- First Name -->
      <div class="mb-4">
        <label for="first_name" class="block text-lg font-medium">First Name</label>
        <input type="text" id="first_name" name="first_name" class="input input-bordered w-full mt-2" placeholder="Enter first name" required>
      </div>

      <!-- Last Name -->
      <div class="mb-4">
        <label for="last_name" class="block text-lg font-medium">Last Name</label>
        <input type="text" id="last_name" name="last_name" class="input input-bordered w-full mt-2" placeholder="Enter last name" required>
      </div>

      <!-- Middle Name -->
      <div class="mb-4">
        <label for="middle_name" class="block text-lg font-medium">Middle Name (optional)</label>
        <input type="text" id="middle_name" name="middle_name" class="input input-bordered w-full mt-2" placeholder="Enter middle name">
      </div>

      <!-- Gender -->
      <div class="mb-4">
        <label for="gender" class="block text-lg font-medium">Gender</label>
        <select id="gender" name="gender" class="select select-bordered w-full mt-2" required>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>
      </div>

      <!-- Birthdate -->
      <div class="mb-4">
        <label for="birthdate" class="block text-lg font-medium">Birthdate</label>
        <input type="date" id="birthdate" name="birthdate" class="input input-bordered w-full mt-2" required>
      </div>

      <!-- Contact Number -->
      <div class="mb-4">
        <label for="contact_number" class="block text-lg font-medium">Contact Number</label>
        <input type="text" id="contact_number" name="contact_number" class="input input-bordered w-full mt-2" placeholder="Enter contact number" required>
      </div>

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-lg font-medium">Email</label>
        <input type="email" id="email" name="email" class="input input-bordered w-full mt-2" placeholder="Enter email address" required>
      </div>
   <!-- Hire Date -->
      <div class="mb-4">
        <label for="hire_date" class="block text-lg font-medium">Hire Date</label>
        <input type="date" id="hire_date" name="hire_date" class="input input-bordered w-full mt-2" required>
      </div>

      <!-- Status -->
      <div class="mb-4">
        <label for="status" class="block text-lg font-medium">Status</label>
        <select id="status" name="status" class="select select-bordered w-full mt-2" required>
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
          <option value="Resigned">Resigned</option>
          <option value="Terminated">Terminated</option>
        </select>
      </div>
 

      <!-- Position -->
      <div class="mb-4">
        <label for="position_title" class="block text-lg font-medium">Position</label>
        <select id="position_title" name="position_title" class="select select-bordered w-full mt-2" required>
          <option value="Barangay Captain">Barangay Captain</option>
          <option value="Barangay Treasurer">Barangay Treasurer</option>
          <option value="Barangay Secretary">Barangay Secretary</option>
          <option value="Barangay Health Worker">Barangay Health Worker</option>
          <option value="Barangay Tanod">Barangay Tanod</option>
        </select>
      </div>

      <!-- Department -->
      <div class="mb-4">
        <label for="department" class="block text-lg font-medium">Department</label>
        <select id="department" name="department" class="select select-bordered w-full mt-2" required>
          <option value="Administration">Administration</option>
          <option value="Finance">Finance</option>
          <option value="Health Services">Health Services</option>
          <option value="Public Safety">Public Safety</option>
        </select>
      </div>

         <!-- Address -->
      <div class="mb-4 col-span-2">
        <label for="address" class="block text-lg font-medium">Address</label>
        <textarea id="address" name="address" class="input input-bordered w-full mt-2" placeholder="Enter address" required></textarea>
      </div>

      <!-- Emergency Contact -->
      <div class="mb-4">
        <label for="emergency_contact" class="block text-lg font-medium">Emergency Contact</label>
        <input type="text" id="emergency_contact" name="emergency_contact" class="input input-bordered w-full mt-2" placeholder="Enter emergency contact name">
      </div>

      <!-- Emergency Number -->
      <div class="mb-4">
        <label for="emergency_number" class="block text-lg font-medium">Emergency Number</label>
        <input type="text" id="emergency_number" name="emergency_number" class="input input-bordered w-full mt-2" placeholder="Enter emergency contact number">
      </div>

      <!-- Buttons (Submit and Close) -->
      <div class="mt-4 flex gap-3 items-center w-full">
        <!-- Submit Button -->
        <button type="submit" class="btn bg-blue-500 text-stone-100">Add Employee</button>

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