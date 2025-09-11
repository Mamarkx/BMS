<div id="edit-resident-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-white/10 backdrop-blur-sm">

    <div class="bg-white p-6 rounded-lg w-full md:max-w-2xl max-w-md shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Edit Resident</h2>

        <form id="editResidentForm" method="POST" action="{{ route('residents.update', $resident->resident_id) }}">
            @csrf
            @method('PUT')

            <!-- First Name -->
            <div class="mb-3">
                <label class="block text-sm font-medium">First Name</label>
                <input type="text" name="first_name" value="{{ $resident->first_name }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <!-- Middle Name -->
            <div class="mb-3">
                <label class="block text-sm font-medium">Middle Name</label>
                <input type="text" name="middle_name" value="{{ $resident->middle_name }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <!-- Last Name -->
            <div class="mb-3">
                <label class="block text-sm font-medium">Last Name</label>
                <input type="text" name="last_name" value="{{ $resident->last_name }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label class="block text-sm font-medium">Gender</label>
                <select name="gender" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="Male" {{ $resident->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $resident->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ $resident->gender == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Birthdate -->
            <div class="mb-3">
                <label class="block text-sm font-medium">Birthdate</label>
                <input type="date" name="birth_date" value="{{ $resident->birth_date }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <!-- Civil Status -->
            <div class="mb-3">
                <label class="block text-sm font-medium">Civil Status</label>
                <select name="civil_status" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="Single" {{ $resident->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Married" {{ $resident->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                    <option value="Widowed" {{ $resident->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                </select>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label class="block text-sm font-medium">Address</label>
                <textarea name="address" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ $resident->address }}</textarea>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="block text-sm font-medium">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="Active" {{ $resident->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $resident->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-2">
                <button type="button" class="px-4 py-2 bg-gray-300 rounded closeModal">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>
