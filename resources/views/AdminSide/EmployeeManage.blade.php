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
                    <i class="fa-solid fa-user-plus text-lg"></i>
                    <span class="text-lg">Add Employee</span>
                </button>
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
                                    <option value="Other">Other</option>
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

                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                                <select id="status" name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Resigned">Resigned</option>
                                    <option value="Terminated">Terminated</option>
                                </select>
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