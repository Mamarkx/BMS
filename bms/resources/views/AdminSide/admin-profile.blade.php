<x-admin-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">User Profile</h1>
                <p class="text-sm text-gray-500">Review and manage user information</p>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-lg p-6 space-y-6">

            <!-- Name Section -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Personal Information</h2>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-gray-500">First Name</dt>
                        <dd class="text-gray-900 font-medium">{{ $user->first_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Middle Name</dt>
                        <dd class="text-gray-900 font-medium">{{ $user->middle_name ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Last Name</dt>
                        <dd class="text-gray-900 font-medium">{{ $user->last_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Suffix</dt>
                        <dd class="text-gray-900 font-medium">{{ $user->suffix ?? '—' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Contact Section -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Contact Details</h2>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-gray-500">Email</dt>
                        <dd class="text-gray-900 font-medium">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Address</dt>
                        <dd class="text-gray-900 font-medium">{{ $user->address }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Account Section -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Account Info</h2>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-gray-500">Role</dt>
                        <dd class="text-gray-900 font-medium capitalize">{{ $user->role }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Password</dt>
                        <dd class="text-gray-900 font-medium">••••••••</dd>
                    </div>
                </dl>
            </div>

        </div>
    </div>
</x-admin-layout>
