<x-admin-layout>
<div class="w-full p-6 bg-gray-50 min-h-screen">

    <!-- Header -->
    <div class="mb-8">
        <h3 class="font-bold text-3xl text-gray-900 mb-2">Cedula Applications</h3>
        <p class="text-gray-600 text-base">Manage and track all resident requests</p>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($data->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Reference #</th>
                            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Name</th>
                            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Type</th>
                            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data as $d)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $d->reference_number }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $d->name }}</td>
                                <td class="py-4 px-6 text-sm text-gray-700">{{ $d->type }}</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $d->status === 'Pending' ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $d->status === 'Approved' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                        {{ $d->status === 'Released' ? 'bg-blue-100 text-blue-800' : '' }}">
                                        {{ ucfirst($d->status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <!-- View -->
                                        <button class="text-blue-600 hover:text-blue-800 transition-colors" title="View">
                                            <i class="fa-solid fa-eye text-lg"></i>
                                        </button>
                                        
                                        <!-- Edit -->
                                        <button class="text-gray-600 hover:text-green-700 transition-colors" title="Edit">
                                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                                        </button>
                                        
                                        <!-- Delete -->
                                        <button class="text-red-600 hover:text-red-800 transition-colors" onclick="deleteRecord({{ $d->id }})" title="Delete">
                                            <i class="fa-solid fa-trash text-lg"></i>
                                        </button>

                                        <!-- Approve -->
                                        @if($d->status === 'Pending')
                                            <form id="approveForm{{ $d->id }}" action="{{ route('approve.cedula', $d->id) }}" method="POST" class="hidden">
                                                @csrf
                                            </form>
                                            <button class="text-green-600 hover:text-green-800 transition-colors" onclick="showApprovalConfirmation({{ $d->id }})" title="Approve">
                                                <i class="fa-solid fa-check-circle text-lg"></i>
                                            </button>
                                        @endif

                                        <!-- Schedule Release -->
                                        @if($d->status === 'Approved')
                                            <button class="text-indigo-600 hover:text-indigo-800 transition-colors" onclick="openReleaseModal({{ $d->id }})" title="Schedule Release">
                                                <i class="fa-solid fa-calendar-check text-lg"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <!-- Release Modal -->
<div id="releaseModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md transform transition-all">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Schedule Release</h3>
            <button onclick="closeReleaseModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="releaseForm" action="{{ route('cedula.release' ,$d->id )}}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="release_date" class="block text-sm font-semibold text-gray-700 mb-2">
                    Select Release Date
                </label>
                <input 
                    type="date" 
                    name="release_date" 
                    id="release_date" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                    required
                    min="{{ date('Y-m-d') }}">
            </div>
            
            <div class="flex justify-end gap-3">
                <button 
                    type="button" 
                    onclick="closeReleaseModal()" 
                    class="px-5 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors">
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors shadow-sm">
                    Schedule Release
                </button>
            </div>
        </form>
    </div>
</div>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $data->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <i class="fa-solid fa-inbox text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg font-medium">No requests available</p>
                <p class="text-gray-400 text-sm mt-1">Check back later for new applications</p>
            </div>
        @endif
    </div>

</div>


<!-- Scripts -->
@if(session('success'))
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
    color: '#ffffff'
});
</script>
@endif

<script>
function showApprovalConfirmation(id) {
    Swal.fire({
        title: 'Approve Document?',
        text: "This will mark the document as approved and ready for release.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Approve',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('approveForm' + id).submit();
        }
    });
}

function openReleaseModal(id) {
    document.getElementById('releaseForm').action = '/cedula/' + id;
    document.getElementById('releaseModal').classList.remove('hidden');
}

function closeReleaseModal() {
    document.getElementById('releaseModal').classList.add('hidden');
    document.getElementById('release_date').value = '';
}

function deleteRecord(id) {
    Swal.fire({
        title: 'Delete Record?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Add your delete logic here
            // Example: document.getElementById('deleteForm' + id).submit();
        }
    });
}

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeReleaseModal();
    }
});
</script>

</x-admin-layout>