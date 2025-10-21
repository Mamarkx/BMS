<x-admin-layout>
<div class="w-full p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="space-y-2">
            <h3 class="font-semibold text-3xl text-gray-800">Business Permit Applications</h3>
            <p class="text-gray-500 text-lg">Manage and track all resident requests</p>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-md border border-gray-300">
        <table class="min-w-full table-auto text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-6 text-sm font-medium text-gray-700">Reference Number</th>
                    <th class="py-3 px-6 text-sm font-medium text-gray-700">Name Owner</th>
                    <th class="py-3 px-6 text-sm font-medium text-gray-700">Type</th>
                    <th class="py-3 px-6 text-sm font-medium text-gray-700">Status</th>
                    <th class="py-3 px-6 text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $d)
                    <tr class="border-b border-gray-300 hover:bg-gray-50 text-sm text-gray-800">
                        <td class="py-3 px-6">{{ $d->reference_number }}</td>
                        <td class="py-3 px-6">{{ $d->name_owner }}</td>
                        <td class="py-3 px-6">{{ $d->type }}</td>
                        <td class="py-3 px-6">
                            <span class="inline-block px-3 py-1 rounded-full font-medium
                                {{ $d->status === 'Pending' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $d->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $d->status === 'Released' ? 'bg-blue-100 text-blue-700' : '' }}">
                                {{ ucfirst($d->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-lg flex items-center gap-2">
                            <!-- View/Edit/Delete -->
                            <button class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-eye"></i></button>
                            <button class="text-gray-600 hover:text-green-800"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="text-red-600 hover:text-red-800" onclick="deleteRecord({{ $d->id }})"><i class="fa-solid fa-trash"></i></button>

                            <!-- Approve -->
                            <form id="approveForm{{ $d->id }}" action="{{ route('approve.business-permit', $d->id) }}" method="POST">
                                @csrf
                            </form>
                            <button class="text-green-600 hover:text-yellow-800" onclick="showApprovalConfirmation({{ $d->id }})"><i class="fa-solid fa-check-circle"></i></button>

                            <!-- Schedule Release -->
                            <button class="text-blue-600 hover:text-blue-800" onclick="openReleaseModal({{ $d->id }})"><i class="fa-solid fa-calendar-check"></i></button>
                        </td>
                    </tr>
                    
                    <!-- Release Modal -->
                    <div id="releaseModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                            <h3 class="text-xl font-semibold mb-4">Schedule Document Release</h3>
                            <form id="releaseForm" action="{{ route('businessPermit.release', $d->id) }}" method="POST">
                                @csrf
                                <label for="release_date" class="block text-sm font-medium text-gray-700">Select Release Date:</label>
                                <input type="date" name="release_date" id="release_date" class="w-full p-2 border border-gray-300 rounded-md mt-2" required>
                                <div class="flex justify-end gap-4 mt-4">
                                    <button type="button" class="text-gray-500" onclick="closeReleaseModal()">Cancel</button>
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Schedule Release</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-2 text-gray-500 text-lg">No requests available.</td>
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

<!-- Scripts -->
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
function showApprovalConfirmation(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to approve this document?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Approve',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
            document.getElementById('approveForm' + id).submit();
        }
    });
}

function openReleaseModal(id) {
    document.getElementById('releaseForm').action = '/business-permit/' + id ;
    document.getElementById('releaseModal').classList.remove('hidden');
}

function closeReleaseModal() {
    document.getElementById('releaseModal').classList.add('hidden');
}
</script>

</x-admin-layout>
