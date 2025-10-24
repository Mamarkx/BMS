<x-admin-layout>
    <div class="p-6  rounded-2xl h-dvh">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Announcement Management</h1>

            <!-- Button to open modal -->
            <button class="btn btn-primary" onclick="document.getElementById('createModal').showModal()">
                + New Announcement
            </button>
        </div>

        <!-- DaisyUI Modal for Create -->
        <dialog id="createModal" class="modal">
            <div class="modal-box max-w-2xl">
                <h3 class="font-bold text-lg mb-4">Create New Announcement</h3>

                <form id="createAnnouncementForm" method="POST" action="{{ route('announce.store') }}"
                    enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-medium text-sm mb-1">Title</label>
                        <input type="text" name="title" class="input input-bordered w-full"
                            placeholder="Enter announcement title" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">Content</label>
                        <textarea name="content" class="textarea textarea-bordered w-full" rows="4"
                            placeholder="Write your announcement..." required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm mb-1">Category</label>
                            <select name="category" class="select select-bordered w-full">
                                <option disabled selected>Select category</option>
                                <option>Event</option>
                                <option>Emergency</option>
                                <option>Health</option>
                                <option>Public Notice</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm mb-1">Attachment (optional)</label>
                            <input type="file" name="attachment" class="file-input file-input-bordered w-full">
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Post</button>
                        <button type="button" class="btn"
                            onclick="document.getElementById('createModal').close()">Cancel</button>
                    </div>
                </form>
            </div>
        </dialog>
        @if ($announce->isEmpty())
            <div class="text-center text-gray-500 bg-white shadow-md rounded-xl py-10">
                No announcements found.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($announce as $announcement)
                    <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-lg transition relative">
                        <!-- Image -->
                        @if ($announcement->attachment)
                            <img src="{{ asset('storage/' . $announcement->attachment) }}" alt="Announcement Image"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400 text-sm">
                                No Image
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="p-5 space-y-3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-800">
                                        {{ $announcement->title }}
                                    </h2>
                                    <p class="text-sm text-gray-500">
                                        {{ $announcement->category ?? 'Uncategorized' }}
                                    </p>
                                </div>

                                <div class="flex space-x-3">
                                    <!-- Edit Button -->
                                    <button class="text-blue-600 hover:text-blue-800"
                                        onclick="document.getElementById('editModal-{{ $announcement->id }}').showModal()">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('DeleteAnnounce', $announcement->id) }}"
                                        id="deleteForm_{{ $announcement->id }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-600 hover:text-red-800 delete-btn"
                                            data-id="{{ $announcement->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>

                            <p class="text-gray-700 text-sm line-clamp-3">
                                {{ Str::limit(strip_tags($announcement->content), 200, '...') }}
                            </p>
                        </div>

                        <!-- DaisyUI Modal for Edit -->
                        <dialog id="editModal-{{ $announcement->id }}" class="modal">
                            <div class="modal-box max-w-2xl">
                                <h3 class="font-bold text-lg mb-4">Edit Announcement</h3>

                                <form method="POST" action="{{ route('announce.update', $announcement->id) }}"
                                    enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label class="block font-medium text-sm mb-1">Title</label>
                                        <input type="text" name="title" value="{{ $announcement->title }}"
                                            class="input input-bordered w-full" required>
                                    </div>

                                    <div>
                                        <label class="block font-medium text-sm mb-1">Content</label>
                                        <textarea name="content" class="textarea textarea-bordered w-full" rows="4" required>{{ $announcement->content }}</textarea>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium text-sm mb-1">Category</label>
                                            <select name="category" class="select select-bordered w-full">
                                                <option disabled>Select category</option>
                                                <option {{ $announcement->category === 'Event' ? 'selected' : '' }}>
                                                    Event</option>
                                                <option
                                                    {{ $announcement->category === 'Emergency' ? 'selected' : '' }}>
                                                    Emergency</option>
                                                <option {{ $announcement->category === 'Health' ? 'selected' : '' }}>
                                                    Health</option>
                                                <option
                                                    {{ $announcement->category === 'Public Notice' ? 'selected' : '' }}>
                                                    Public Notice</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block font-medium text-sm mb-1">Attachment (optional)</label>
                                            <input type="file" name="attachment"
                                                class="file-input file-input-bordered w-full">
                                        </div>
                                    </div>

                                    <div class="modal-action">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="button" class="btn"
                                            onclick="document.getElementById('editModal-{{ $announcement->id }}').close()">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </dialog>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $announce->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</x-admin-layout>
<script>
    const form = document.getElementById('createAnnouncementForm');

    form.addEventListener('submit', function(e) {
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = `
        <svg class="animate-spin h-5 w-5 mr-2 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
        Posting...
    `;
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
            timer: 2000,
            timerProgressBar: true,
            customClass: {
                popup: 'colored-toast-success'
            },
            background: '#ffffff',
            color: '#16a34a',
        });
    </script>
@endif

@if ($errors->has('attachment'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'File upload error',
            text: '{{ $errors->first('attachment') }}',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            customClass: {
                popup: 'colored-toast-error'
            },
            background: '#ffffff',
            color: '#dc2626',
        });
    </script>
@endif

<style>
    .colored-toast-success,
    .colored-toast-error {
        border-radius: 8px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 12px 16px !important;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
    }

    .colored-toast-success {
        border-left: 6px solid #16a34a !important;
        /* Green */
    }


    .colored-toast-error {
        border-left: 6px solid #dc2626 !important;
        /* Red */
    }
</style>

<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id'); // get announcement ID

            Swal.fire({
                title: 'Are you sure?',
                text: "This announcement will be permanently deleted!",
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
                    // Submit the specific form
                    $('#deleteForm_' + id).submit();
                }
            });
        });
    });
</script>
