<div id="edit-resident-modal" class="fixed inset-0 flex items-center justify-center z-50 bg-black/60 ">
    <div class="bg-white rounded-2xl w-full max-w-4xl shadow-2xl max-h-[90vh] overflow-hidden m-4">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-8 py-6">
            <h2 class="text-3xl font-bold text-white mb-1">Edit Resident Information</h2>
            <p class="text-emerald-100 text-sm">Update resident details and information</p>
        </div>

        <!-- Modal Body -->
        <div class="overflow-y-auto max-h-[calc(90vh-180px)] px-8 py-6">
            <form id="editResidentForm" method="POST" action="{{ route('residents.update', $resident->resident_id) }}"
                class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Personal Information Section -->
                <div class="space-y-5">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-emerald-100">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-user text-emerald-600"></i>
                        </div>
                        <h4 class="text-xl font-bold text-slate-800">Personal Information</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">First Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="first_name" value="{{ $resident->first_name }}"
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                                placeholder="Juan" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Middle Name</label>
                            <input type="text" name="middle_name" value="{{ $resident->middle_name }}"
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                                placeholder="Santos">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Last Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="last_name" value="{{ $resident->last_name }}"
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                                placeholder="Dela Cruz" required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Gender <span
                                    class="text-red-500">*</span></label>
                            <select name="gender"
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                                required>
                                <option value="Male" {{ $resident->sex == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $resident->sex == 'Female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="Other" {{ $resident->sex == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Birthdate <span
                                    class="text-red-500">*</span></label>
                            <input type="date" name="birth_date" value="{{ $resident->birth_date }}"
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                                required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Civil Status <span
                                    class="text-red-500">*</span></label>
                            <select name="civil_status"
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                                required>
                                <option value="Single" {{ $resident->civil_status == 'Single' ? 'selected' : '' }}>
                                    Single</option>
                                <option value="Married" {{ $resident->civil_status == 'Married' ? 'selected' : '' }}>
                                    Married</option>
                                <option value="Widowed" {{ $resident->civil_status == 'Widowed' ? 'selected' : '' }}>
                                    Widowed</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Contact & Residence Section -->
                <div class="space-y-5">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-blue-100">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-location-dot text-blue-600"></i>
                        </div>
                        <h4 class="text-xl font-bold text-slate-800">Contact & Status</h4>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Status <span
                                class="text-red-500">*</span></label>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Contact Number * <span
                                    class="text-red-500">*</span></label>
                            <input type="string" name="contact_number" value="{{ $resident->contact_number }}"
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                                required>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Complete Address <span
                                class="text-red-500">*</span></label>
                        <textarea name="address" rows="4"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 resize-none"
                            placeholder="Street, Barangay, City, Province" required>{{ $resident->address }}</textarea>
                    </div>

                </div>

            </form>
        </div>

        <!-- Modal Footer -->
        <div class="sticky bottom-0 bg-slate-50 px-8 py-5 border-t border-slate-200 flex justify-end gap-3">
            <button type="button"
                class="closeModal px-6 py-3 bg-white border-2 border-slate-300 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 transition-all duration-200">
                Cancel
            </button>
            <button type="submit" form="editResidentForm"
                class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl hover:from-emerald-700 hover:to-teal-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                <i class="fa-solid fa-check mr-2"></i>
                Update Resident
            </button>
        </div>
    </div>
</div>
