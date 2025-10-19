<x-admin-layout>
<div class="w-full p-10  bg-gray-50 ">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                <i class="fa-solid fa-users text-blue-600"></i> Employee Management
            </h2>
            <p class="text-gray-500 text-base">Monitor and manage all barangay personnel efficiently</p>
        </div>
        <button onclick="my_modal_1.showModal()" 
            class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow-md flex items-center gap-2 transition">
            <i class="fa-solid fa-user-plus text-lg"></i>
            <span>Add Employee</span>
        </button>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
       <!-- Controls -->
<div class="px-6 py-5 bg-white/60 backdrop-blur-md  shadow-md border border-gray-200 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
  
  <!-- Left Section: Title + Filter -->
<!-- Professional Filter Section -->
<div class="flex flex-col sm:flex-row sm:items-center gap-4 bg-white border border-gray-200 rounded-xl p-4 shadow-sm">

  <!-- Label -->
  <div class="flex items-center gap-2">
    <div class="h-10 w-10 flex items-center justify-center bg-blue-100 text-blue-600 rounded-lg">
      <i class="fa-solid fa-filter text-lg"></i>
    </div>
    <div>
      <h4 class="text-lg font-semibold text-gray-800 leading-tight">Filter by Department</h4>
      <p class="text-sm text-gray-500">Select a department to refine results</p>
    </div>
  </div>

  <!-- Dropdown -->
  <div class="relative sm:ml-auto w-full sm:w-64">
    <select id="departmentFilter"
      class="appearance-none w-full border border-gray-300 bg-gray-50 text-gray-800 text-sm rounded-lg pl-4 pr-10 py-2.5 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition">
      <option value="">All Departments</option>
      <option value="Administrative">Administrative</option>
      <option value="Finance">Finance</option>
      <option value="Health Services">Health Services</option>
      <option value="Public Safety">Public Safety</option>
      <option value="Brgy Council">Brgy Council</option>
      <option value="GAD">GAD</option>
    </select>
    <i class="fa-solid fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
  </div>

</div>


  <!-- Right Section: Search -->
  <div class="relative w-full sm:w-72">
    <input id="searchInput" type="text" placeholder="Search employees..."
      class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 w-full text-sm bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all" />
    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-gray-400"></i>
  </div>
</div>
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-left">
                    <tr>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider">Employee ID</th>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider">Name</th>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider">Position</th>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider">Department</th>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider">Status</th>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider text-center">Actions</th>
                    </tr>
                </thead>
               <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($personnel as $p)
                        <tr class="hover:bg-blue-50 transition-all duration-150">
                            <td class="px-6 py-4 font-medium">{{ $p->personnel_id }}</td>
                            <td class="px-6 py-4">{{ $p->first_name }} {{ $p->last_name }}</td>
                            <td class="px-6 py-4">{{ $p->position_title }}</td>
                            <td class="px-6 py-4">{{ $p->department }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                    {{ $p->status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">

                                    <!-- View Button -->
                                    <button onclick='viewRecord(@json($p))'
                                        class="inline-flex items-center gap-1.5 px-2.5 py-3 text-xs cursor-pointer font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all duration-150 shadow-sm hover:shadow-md">
                                        <i class="fa-solid fa-eye text-white"></i>
                                        <span>View</span>
                                    </button>

                                    <!-- Edit Button -->
                                    <button onclick='editRecord(@json($p))'
                                        class="inline-flex items-center gap-1.5 px-2.5 py-3 text-xs font-semibold cursor-pointer text-white bg-green-600 rounded-md hover:bg-green-700 transition-all duration-150 shadow-sm hover:shadow-md">
                                        <i class="fa-solid fa-pen-to-square text-white"></i>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Delete Button -->
                                    <form id="deleteForm_{{ $p->personnel_id }}" action="{{ route('DeleteEmploye', $p->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-3 cursor-pointer text-xs font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 transition-all duration-150 shadow-sm hover:shadow-md delete-btn"
                                            data-id="{{ $p->personnel_id }}">
                                            <i class="fa-solid fa-trash text-white"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500 text-sm">
                                No Employee Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-100 border-t border-gray-200 flex justify-end">
            {{ $personnel->links() }}
        </div>
    </div>
</div>



 <!-- Add Employee Modal -->
    <dialog id="my_modal_1" class="modal backdrop:bg-black/60 backdrop:backdrop-blur-sm">
        <div class="modal-box max-w-6xl bg-white rounded-2xl shadow-2xl p-0 overflow-hidden">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 p-3 rounded-xl">
                        <i class="fa-solid fa-user-plus text-2xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Add New Employee</h3>
                        <p class="text-blue-100 text-sm">Fill in employee information</p>
                    </div>
                </div>
                <button onclick="document.getElementById('my_modal_1').close()" class="text-white/80 hover:text-white transition-colors">
                    <i class="fa-solid fa-times text-2xl"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-8 py-6 max-h-[70vh] overflow-y-auto">
                <form action="{{ route('AddEmployee') }}" method="POST" id="employeeForm">
                    @csrf
                    
                    <!-- Personal Information Section -->
                    <div class="mb-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-user text-blue-600"></i>
                            Personal Information
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">First Name *</label>
                                <input type="text" id="first_name" name="first_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Juan" required>
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">Last Name *</label>
                                <input type="text" id="last_name" name="last_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Dela Cruz" required>
                            </div>

                            <div>
                                <label for="middle_name" class="block text-sm font-semibold text-gray-700 mb-2">Middle Name</label>
                                <input type="text" id="middle_name" name="middle_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Santos">
                            </div>

                            <div>
                                <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">Gender *</label>
                                <select id="gender" name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div>
                                <label for="birthdate" class="block text-sm font-semibold text-gray-700 mb-2">Birthdate *</label>
                                <input type="date" id="birthdate" name="birthdate" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="mb-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-address-book text-blue-600"></i>
                            Contact Information
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="contact_number" class="block text-sm font-semibold text-gray-700 mb-2">Contact Number *</label>
                                <input type="text" id="contact_number" name="contact_number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="09123456789" required>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="juan.delacruz@example.com" required>
                            </div>

                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Address *</label>
                                <textarea id="address" name="address" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Complete address" required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Details Section -->
                    <div class="mb-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-briefcase text-blue-600"></i>
                            Employment Details
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                            <div>
                                <label for="position_title" class="block text-sm font-semibold text-gray-700 mb-2">Position *</label>
                                <select id="position_title" name="position_title" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                                    <option value="">Select Position</option>
                                    <option value="Punong Barangay">Punong Barangay</option>
                                    <option value="Barangay Kagawad">Barangay Kagawad</option>
                                    <option value="BPSO">BPSO</option>
                                    <option value="Admin Staff">Admin Staff</option>
                                    <option value="BCPC GAD Focal Person">BCPC GAD Focal Person</option>
                                    <option value="VAWC Desk Officer">VAWC Desk Officer</option>
                                    <option value="Area Monitoring Officer">Area Monitoring Officer</option>
                                    <option value="Admin Officer">Admin Officer</option>
                                    <option value="Accounting">Accounting</option>
                                </select>
                            </div>

                            <div>
                                <label for="department" class="block text-sm font-semibold text-gray-700 mb-2">Department *</label>
                                <select id="department" name="department" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                                    <option value="">Select Department</option>
                                    <option value="Administrative">Administrative</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Health Services">Health Services</option>
                                    <option value="Public Safety">Public Safety</option>
                                    <option value="Brgy Council">Brgy Council</option>
                                    <option value="GAD">GAD</option>
                                </select>
                            </div>

                            <div>
                                <label for="hire_date" class="block text-sm font-semibold text-gray-700 mb-2">Hire Date *</label>
                                <input type="date" id="hire_date" name="hire_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact Section -->
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-phone-volume text-blue-600"></i>
                            Emergency Contact
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="emergency_contact" class="block text-sm font-semibold text-gray-700 mb-2">Emergency Contact Name</label>
                                <input type="text" id="emergency_contact" name="emergency_contact" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Maria Dela Cruz">
                            </div>

                            <div>
                                <label for="emergency_number" class="block text-sm font-semibold text-gray-700 mb-2">Emergency Contact Number</label>
                                <input type="text" id="emergency_number" name="emergency_number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="09123456789">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button" onclick="document.getElementById('my_modal_1').close()" class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition-all">
                            <i class="fa-solid fa-times mr-2"></i>Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-semibold transition-all shadow-lg shadow-blue-500/30">
                            <i class="fa-solid fa-check mr-2"></i>Add Employee
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
 <!-- View Employee Modal -->
<dialog id="viewModal" class="modal backdrop:bg-gray-900/70 backdrop:backdrop-blur-sm">
  <div class="modal-box max-w-5xl bg-white rounded-2xl shadow-[0_8px_40px_rgba(0,0,0,0.15)] p-0 overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-700 px-8 py-6 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <div class="bg-white/20 p-3 rounded-xl">
          <i class="fa-solid fa-user-tie text-white text-2xl"></i>
        </div>
        <div>
          <h3 class="text-2xl font-bold text-white leading-tight">Employee Details</h3>
          <p class="text-indigo-100 text-sm">Personnel record overview</p>
        </div>
      </div>
      <button onclick="$('#viewModal')[0].close()" class="text-white/80 hover:text-white transition">
        <i class="fa-solid fa-xmark text-2xl"></i>
      </button>
    </div>

    <!-- Body -->
    <div class="px-10 py-8 bg-gray-50 max-h-[75vh] overflow-y-auto">
      <!-- Profile Overview -->
      <div class="flex flex-col md:flex-row gap-6 items-center md:items-start mb-10">
        <div class="w-36 h-36 bg-gradient-to-br from-indigo-100 to-blue-50 rounded-full flex items-center justify-center border border-indigo-200">
          <i class="fa-solid fa-user text-indigo-500 text-6xl"></i>
        </div>
        <div class="text-center md:text-left">
          <h2 id="v_full_name" class="text-3xl font-bold text-gray-800 mb-1"></h2>
          <p id="v_position_title" class="text-gray-600 font-medium"></p>
          <p id="v_department" class="text-gray-500 text-sm"></p>
          <span id="v_status" class="inline-block mt-3 px-3 py-1 text-sm font-semibold rounded-full"></span>
        </div>
      </div>

      <!-- Section: Basic Info -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
        <div class="px-6 py-3 border-b bg-gray-100 flex items-center gap-2">
          <i class="fa-solid fa-id-card text-indigo-600"></i>
          <h4 class="font-semibold text-gray-700">Basic Information</h4>
        </div>
        <div class="p-6 grid md:grid-cols-3 gap-5 text-gray-700">
          <div><span class="font-semibold text-gray-600">Employee ID:</span><p id="v_personnel_id"></p></div>
          <div><span class="font-semibold text-gray-600">Gender:</span><p id="v_gender"></p></div>
          <div><span class="font-semibold text-gray-600">Birthdate:</span><p id="v_birthdate"></p></div>
          <div><span class="font-semibold text-gray-600">Hire Date:</span><p id="v_hire_date"></p></div>
        </div>
      </div>

      <!-- Section: Contact Info -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
        <div class="px-6 py-3 border-b bg-gray-100 flex items-center gap-2">
          <i class="fa-solid fa-phone text-indigo-600"></i>
          <h4 class="font-semibold text-gray-700">Contact Information</h4>
        </div>
        <div class="p-6 grid md:grid-cols-2 lg:grid-cols-3 gap-5 text-gray-700">
          <div><span class="font-semibold text-gray-600">Contact Number:</span><p id="v_contact_number"></p></div>
          <div><span class="font-semibold text-gray-600">Email:</span><p id="v_email"></p></div>
          <div class="lg:col-span-3"><span class="font-semibold text-gray-600">Address:</span><p id="v_address" class="leading-snug"></p></div>
        </div>
      </div>

      <!-- Section: Emergency Contact -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-3 border-b bg-gray-100 flex items-center gap-2">
          <i class="fa-solid fa-heart-pulse text-indigo-600"></i>
          <h4 class="font-semibold text-gray-700">Emergency Contact</h4>
        </div>
        <div class="p-6 grid md:grid-cols-2 gap-5 text-gray-700">
          <div><span class="font-semibold text-gray-600">Contact Person:</span><p id="v_emergency_contact"></p></div>
          <div><span class="font-semibold text-gray-600">Contact Number:</span><p id="v_emergency_number"></p></div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-100 px-8 py-4 flex justify-end border-t border-gray-200">
      <button onclick="$('#viewModal')[0].close()" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
        <i class="fa-solid fa-check mr-2"></i>Close
      </button>
    </div>
  </div>
</dialog>

<dialog id="editModal" class="modal backdrop:bg-black/70 backdrop:backdrop-blur-sm">
  <div class="modal-box max-w-4xl bg-white rounded-xl shadow-2xl transform transition-all duration-300">

    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
      <h3 class="text-xl font-bold text-gray-800 tracking-tight flex items-center gap-3">
        <i class="fa-solid fa-user-pen text-indigo-500 text-2xl"></i>
        Edit Employee Details
      </h3>
      <button id="closeEditModal" class="text-gray-400 hover:text-gray-600 transition">
        <i class="fa-solid fa-xmark text-2xl"></i>
      </button>
    </div>

    <div class="px-6 py-6 max-h-[75vh] overflow-y-auto bg-gray-50/50">
      <form id="editEmployeeForm" method="POST" action="{{ route('EditEmployee') }}">
        @csrf
        @method('PUT')
        <input type="hidden" id="edit_personnel_id" name="id">

        <div class="space-y-6">
          
          <div class="p-5 bg-white rounded-lg shadow-sm border border-gray-100">
            <h4 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Personal Information</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
              <div>
                <label for="edit_first_name" class="font-medium text-sm text-gray-600 mb-1 block">First Name</label>
                <input type="text" id="edit_first_name" name="first_name" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>

              <div>
                <label for="edit_middle_name" class="font-medium text-sm text-gray-600 mb-1 block">Middle Name (Optional)</label>
                <input type="text" id="edit_middle_name" name="middle_name"
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>

              <div>
                <label for="edit_last_name" class="font-medium text-sm text-gray-600 mb-1 block">Last Name</label>
                <input type="text" id="edit_last_name" name="last_name" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>

              <div>
                <label for="edit_gender" class="font-medium text-sm text-gray-600 mb-1 block">Gender</label>
                <select id="edit_gender" name="gender" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150 appearance-none">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
              </div>

              <div>
                <label for="edit_birthdate" class="font-medium text-sm text-gray-600 mb-1 block">Birthdate</label>
                <input type="date" id="edit_birthdate" name="birthdate"
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>

              <div>
                <label for="edit_contact_number" class="font-medium text-sm text-gray-600 mb-1 block">Contact Number</label>
                <input type="tel" id="edit_contact_number" name="contact_number"
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>
            </div>
          </div>
          
          <div class="p-5 bg-white rounded-lg shadow-sm border border-gray-100">
            <h4 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Residential Address</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
              
              <div class="lg:col-span-3">
                <label for="edit_address" class="font-medium text-sm text-gray-600 mb-1 block">Address</label>
                <input type="text" id="edit_address" name="address" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150"
                  autocomplete="street-address">
              </div>
            </div>
          </div>
          
          <div class="p-5 bg-white rounded-lg shadow-sm border border-gray-100">
            <h4 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Job Information</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
              <div>
                <label for="edit_email" class="font-medium text-sm text-gray-600 mb-1 block">Work Email</label>
                <input type="email" id="edit_email" name="email"
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>

              <div>
                <label for="edit_department" class="font-medium text-sm text-gray-600 mb-1 block">Department</label>
                <input type="text" id="edit_department" name="department" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>

              <div>
                <label for="edit_position_title" class="font-medium text-sm text-gray-600 mb-1 block">Position/Title</label>
                <input type="text" id="edit_position_title" name="position_title" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>

              <div>
                <label for="edit_hire_date" class="font-medium text-sm text-gray-600 mb-1 block">Hire Date</label>
                <input type="date" id="edit_hire_date" name="hire_date" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>

              <div>
                <label for="edit_status" class="font-medium text-sm text-gray-600 mb-1 block">Employment Status</label>
                <select id="edit_status" name="status" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150 appearance-none">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                  <option value="Resigned">Resigned</option>
                  <option value="Terminated">Terminated</option>
                </select>
              </div>
            </div>
          </div>

          <div class="p-5 bg-white rounded-lg shadow-sm border border-gray-100">
            <h4 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Emergency Contact</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label for="edit_emergency_contact" class="font-medium text-sm text-gray-600 mb-1 block">Contact Name</label>
                <input type="text" id="edit_emergency_contact" name="emergency_contact"
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>

              <div>
                <label for="edit_emergency_number" class="font-medium text-sm text-gray-600 mb-1 block">Contact Number</label>
                <input type="tel" id="edit_emergency_number" name="emergency_number"
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>
            </div>
          </div>
          
        </div>
        
        <div class="flex justify-end  px-6 py-4 bg-white border-t border-gray-100 shadow-t-lg mt-6">
          <button type="button" id="cancelEdit"
            class="px-5 py-2.5 text-gray-600 bg-white hover:bg-gray-50 rounded-lg font-semibold transition border border-gray-300">
            <i class="fa-solid fa-xmark mr-2"></i>Cancel
          </button>
          
          <button type="submit"
            class="ml-3 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition shadow-md shadow-indigo-500/30">
            <i class="fa-solid fa-floppy-disk mr-2"></i>Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</dialog>
<script>
function editRecord(personnel) {
  $('#edit_personnel_id').val(personnel.id);
  $('#edit_first_name').val(personnel.first_name);
  $('#edit_middle_name').val(personnel.middle_name ?? '');
  $('#edit_last_name').val(personnel.last_name);
  $('#edit_gender').val(personnel.gender);
  $('#edit_birthdate').val(personnel.birthdate);
  $('#edit_contact_number').val(personnel.contact_number);
  $('#edit_email').val(personnel.email);
  $('#edit_address').val(personnel.address);
  $('#edit_position_title').val(personnel.position_title);
  $('#edit_department').val(personnel.department);
  $('#edit_hire_date').val(personnel.hire_date);
  $('#edit_status').val(personnel.status);
  $('#edit_emergency_contact').val(personnel.emergency_contact ?? '');
  $('#edit_emergency_number').val(personnel.emergency_number ?? '');

  const modal = $('#editModal')[0];
  modal.showModal();
  $('.modal-box').addClass('scale-100').removeClass('scale-95');
}

$('#closeEditModal, #cancelEdit').on('click', function() {
  $('.modal-box').addClass('scale-95').removeClass('scale-100');
  setTimeout(() => $('#editModal')[0].close(), 150);
});
</script>

<script>
function viewRecord(personnel) {
  const fullName = `${personnel.first_name ?? ''} ${personnel.middle_name ?? ''} ${personnel.last_name ?? ''}`;
  $('#v_full_name').text(fullName.trim());
  $('#v_personnel_id').text(personnel.personnel_id || '');
  $('#v_gender').text(personnel.gender || '');
  $('#v_birthdate').text(formatDate(personnel.birthdate));
  $('#v_hire_date').text(formatDate(personnel.hire_date));
  $('#v_contact_number').text(personnel.contact_number || '');
  $('#v_email').text(personnel.email || '');
  $('#v_address').text(personnel.address || '');
  $('#v_position_title').text(personnel.position_title || '');
  $('#v_department').text(personnel.department || '');
  $('#v_emergency_contact').text(personnel.emergency_contact || '');
  $('#v_emergency_number').text(personnel.emergency_number || '');

  const statusEl = $('#v_status');
  const status = personnel.status || 'Active';
  statusEl.text(status);
  statusEl.removeClass().addClass('inline-block mt-3 px-3 py-1 text-sm font-semibold rounded-full');
  switch(status) {
    case 'Active': statusEl.addClass('bg-green-100 text-green-700 border border-green-200'); break;
    case 'Inactive': statusEl.addClass('bg-gray-100 text-gray-700 border border-gray-200'); break;
    case 'Resigned': statusEl.addClass('bg-yellow-100 text-yellow-700 border border-yellow-200'); break;
    case 'Terminated': statusEl.addClass('bg-red-100 text-red-700 border border-red-200'); break;
    default: statusEl.addClass('bg-blue-100 text-blue-700 border border-blue-200');
  }

  $('#viewModal')[0].showModal();
}

function formatDate(dateString) {
  if (!dateString) return '';
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
}
</script>


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
    customClass: {
        popup: 'colored-toast'
    },
    background: '#ffffff',
    color: '#16a34a', // green text
});
</script>

<style>
.colored-toast {
    border-left: 6px solid #16a34a !important; /* green accent border */
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding-left: 12px !important;
}
</style>
@endif


    <script>
$(document).ready(function() {
    $('.delete-btn').on('click', function() {
        var id = $(this).data('id');
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
$(document).ready(function() {
    const $tbody = $('table tbody');
    const $rows = $tbody.find('tr');
    const $emptyRow = $('<tr id="noDataRow" class="hidden"><td colspan="6" class="px-6 py-6 text-center text-gray-500 text-sm">No Employee Found</td></tr>');
    $tbody.append($emptyRow);

    function filterAndSearch() {
        const searchValue = $('#searchInput').val().toLowerCase();
        const selectedDept = $('#departmentFilter').val().toLowerCase();
        let visibleCount = 0;

        $rows.each(function() {
            if ($(this).attr('id') === 'noDataRow') return; 
            const rowText = $(this).text().toLowerCase();
            const deptText = $(this).find('td:nth-child(4)').text().toLowerCase();
            const matchesSearch = rowText.indexOf(searchValue) > -1;
            const matchesDept = selectedDept === '' || deptText === selectedDept;
            const shouldShow = matchesSearch && matchesDept;

            $(this).toggle(shouldShow);
            if (shouldShow) visibleCount++;
        });

        if (visibleCount === 0) {
            $emptyRow.removeClass('hidden');
        } else {
            $emptyRow.addClass('hidden');
        }
    }

    $('#searchInput').on('keyup', filterAndSearch);
    $('#departmentFilter').on('change', filterAndSearch);
});
</script>
