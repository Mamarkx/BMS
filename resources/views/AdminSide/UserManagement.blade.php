<x-admin-layout>
<div class="w-full p-10  bg-gray-50 ">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                <i class="fa-solid fa-users text-blue-600"></i>User Management
            </h2>
            <p class="text-gray-500 text-base">Monitor and manage all users account</p>
        </div>
     <!-- ✅ Example trigger button -->
        <button onclick="openAddUserModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg shadow-md">
        <i class="fa-solid fa-user-plus mr-2"></i> Add User
        </button>

    </div>      

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
<div class="px-6 py-5 bg-white/60 backdrop-blur-md  shadow-md border border-gray-200 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

 <div class="relative w-full sm:w-72">
  <input id="searchInput" type="text" placeholder="Search Users..."
    onkeyup="searchResidents()"
    class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 w-full text-sm bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all" />
  <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-gray-400"></i>
</div>
</div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-left">
                    <tr>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider">ID</th>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider">Full Name</th>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider">Email</th>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider">Role</th>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider">Status</th>
                        <th class="px-6 py-3 font-semibold uppercase text-xs tracking-wider text-center">Actions</th>
                    </tr>
                </thead>
               <tbody class="bg-white divide-y divide-gray-100" id="residentTableBody">
                    @forelse ($users as $p)
                        <tr class="hover:bg-blue-50 transition-all duration-150">
                            <td class="px-6 py-4 font-medium">{{ $p->id }}</td>
                            <td class="px-6 py-4">{{ $p->first_name }} {{ $p->last_name }}</td>
                            <td class="px-6 py-4">{{ $p->email }}</td>
                            <td class="px-6 py-4">{{ $p->role }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                    {{ $p->status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- Edit Button -->
                                    <button onclick='editRecord(@json($p))'
                                        class="inline-flex items-center gap-1.5 px-2.5 py-3 text-xs font-semibold cursor-pointer text-white bg-green-600 rounded-md hover:bg-green-700 transition-all duration-150 shadow-sm hover:shadow-md">
                                        <i class="fa-solid fa-pen-to-square text-white"></i>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Delete Button -->
                                    <form id="deleteForm_{{ $p->id }}" action="{{ route('DeleteUserAccount', $p->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-3 cursor-pointer text-xs font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 transition-all duration-150 shadow-sm hover:shadow-md delete-btn"
                                            data-id="{{ $p->id }}">
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
                                No Users Found
                            </td>
                        </tr>
                    @endforelse
                   
                </tbody>
            
            </table>
            <p id="noResults" class="hidden text-center text-gray-500 mt-3">No results found.</p>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-100 border-t border-gray-200 flex justify-end">
            {{ $users->links() }}
        </div>
    </div>
</div>


<!-- Add User Modal -->
<!-- ✅ Add User Modal -->
<dialog id="addUserModal" class="modal backdrop:bg-black/60 backdrop:backdrop-blur-sm">
  <div class="modal-box max-w-3xl bg-white rounded-2xl shadow-2xl overflow-hidden transition-all duration-200 scale-95 opacity-0">

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-5 flex justify-between items-center">
      <div class="flex items-center gap-3">
        <div class="bg-white/20 p-3 rounded-xl">
          <i class="fa-solid fa-user-plus text-white text-2xl"></i>
        </div>
        <div>
          <h3 class="text-2xl font-bold text-white">Add New User</h3>
          <p class="text-blue-100 text-sm">Please enter the user details below to create an account</p>
        </div>
      </div>
      <button id="closeAddModal" type="button" class="text-white/80 hover:text-white transition">
        <i class="fa-solid fa-xmark text-2xl"></i>
      </button>
    </div>

    <!-- Body -->
    <div class="px-8 py-6 bg-gray-50">
      <form action="{{ route('AddUserAcc') }}" method="POST" id="addUserForm">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

          <div>
            <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">First Name *</label>
            <input type="text" id="first_name" name="first_name" required
              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
          </div>

          <div>
            <label for="middle_name" class="block text-sm font-semibold text-gray-700 mb-2">Middle Name</label>
            <input type="text" id="middle_name" name="middle_name"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
          </div>

          <div>
            <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">Last Name *</label>
            <input type="text" id="last_name" name="last_name" required
              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
          </div>

          <div>
            <label for="suffix" class="block text-sm font-semibold text-gray-700 mb-2">Suffix</label>
            <input type="text" id="suffix" name="suffix"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
          </div>

          <div class="md:col-span-2">
      <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
      <textarea id="address" name="address" rows="2"
        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition"></textarea>
    </div>

    <div>
      <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
      <input type="email" id="email" name="email" required
        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
    </div>

    <div>
      <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password *</label>
      <input type="password" id="password" name="password" required
        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
    </div>

    <div>
      <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password *</label>
      <input type="password" id="password_confirmation" name="password_confirmation" required
        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
    </div>

    <div>
      <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Role *</label>
      <select id="role" name="role" required
        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
        <option value="">Select Role</option>
        <option value="Admin">Admin</option>
        <option value="Resident">Resident</option>
      </select>
    </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200 mt-8">
          <button type="button" id="cancelAddUser"
            class="px-6 py-3 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg font-semibold transition">
            <i class="fa-solid fa-xmark mr-2"></i>Cancel
          </button>
          <button type="submit"
            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-md transition">
            <i class="fa-solid fa-user-plus mr-2"></i>Add User
          </button>
        </div>
      </form>
    </div>
  </div>
</dialog>

<script>
const addUserModal = document.getElementById('addUserModal');
const modalBox = addUserModal.querySelector('.modal-box');

function openAddUserModal() {
  addUserModal.showModal();
  setTimeout(() => {
    modalBox.classList.remove('scale-95', 'opacity-0');
    modalBox.classList.add('scale-100', 'opacity-100');
  }, 10);
}

function closeAddUserModal() {
  modalBox.classList.add('scale-95', 'opacity-0');
  modalBox.classList.remove('scale-100', 'opacity-100');
  setTimeout(() => addUserModal.close(), 150);
}

// Event listeners
document.getElementById('closeAddModal').addEventListener('click', closeAddUserModal);
document.getElementById('cancelAddUser').addEventListener('click', closeAddUserModal);
</script>


 <!-- Edit User Modal -->
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
      <form id="editEmployeeForm" method="POST" action="{{ route('UpdateUserAcc') }}">
        @csrf
        <input type="hidden" id="edit_id" name="id">

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
                <label for="edit_suffix" class="font-medium text-sm text-gray-600 mb-1 block">Suffix (Optional)</label>
                <input type="text" id="edit_suffix" name="suffix" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>
              

              <div>
                <label for="edit_status" class="font-medium text-sm text-gray-600 mb-1 block">Status</label>
                <select id="edit_status" name="status" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150 appearance-none">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
               <div>
                <label for="edit_role" class="font-medium text-sm text-gray-600 mb-1 block">Role</label>
                <select id="edit_role" name="role" 
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150 appearance-none">
                  <option value="Admin">Admin</option>
                  <option value="Resident">Resident</option>
                </select>
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
            <h4 class="text-lg font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Account Information</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
              <div>
                <label for="edit_email" class="font-medium text-sm text-gray-600 mb-1 block">Email</label>
                <input type="email" id="edit_email" name="email"
                  class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-150">
              </div>

              <div>
                <label for="edit_password" class="font-medium text-sm text-gray-600 mb-1 block">Password</label>
                <input type="password" id="edit_password" name="password" 
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
function editRecord(user) {
  $('#edit_id').val(user.id);
  $('#edit_first_name').val(user.first_name);
  $('#edit_middle_name').val(user.middle_name ?? '');
  $('#edit_last_name').val(user.last_name);
  $('#edit_suffix').val(user.suffix ?? '');
  $('#edit_address').val(user.address);
  $('#edit_email').val(user.email);
  $('#edit_role').val(user.role);
    $('#edit_status').val(user.status);
    $('#edit_password').val('');

  const modal = $('#editModal')[0];
  modal.showModal();
  $('.modal-box').addClass('scale-100').removeClass('scale-95');
}

$('#closeEditModal, #cancelEdit').on('click', function() {
  $('.modal-box').addClass('scale-95').removeClass('scale-100');
  setTimeout(() => $('#editModal')[0].close(), 150);
});
</script>

</x-admin-layout>

<script>
  function searchResidents() {
      const input = document.getElementById("searchInput").value.toLowerCase();
      const rows = document.getElementById("residentTableBody").getElementsByTagName("tr");
      const noResults = document.getElementById("noResults");
      let matchFound = false;

      for (let i = 0; i < rows.length; i++) {
          const cells = rows[i].getElementsByTagName("td");
          let rowMatch = false;

          // Loop through each cell in the row
          for (let j = 0; j < cells.length; j++) {
              if (cells[j].innerText.toLowerCase().includes(input)) {
                  rowMatch = true;
                  break;
              }
          }

          // Toggle row visibility
          rows[i].style.display = rowMatch ? "" : "none";
          if (rowMatch) matchFound = true;
      }

      // Toggle "No results" message
      noResults.classList.toggle("hidden", matchFound);
  }
</script>



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
  color: '#16a34a'
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
$(document).ready(function() {
  $('.delete-btn').on('click', function() {
    const id = $(this).data('id');

    Swal.fire({
      title: 'Are you sure?',
      text: "This user record will be permanently deleted!",
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
