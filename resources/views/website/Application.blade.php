<x-layout>
    <div class="container mx-auto py-24 px-4 lg:px-8 h-[700px]">
        <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">Your Application Details</h2>

        @if ($applications->isEmpty())
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-10 text-center shadow-md">
                <i class="fa-solid fa-folder-open text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500 text-lg">You have no applications submitted yet.</p>
            </div>
        @else
            <div class="bg-white shadow-md rounded-2xl overflow-hidden border border-gray-100">
                <div class="grid grid-cols-3 gap-4 bg-gray-50 px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wide">
                    <div>Request Document</div>
                    <div>Date Issued</div>
                    <div>Status</div>
                </div>

                <div class="divide-y divide-gray-100">
                    @foreach ($applications as $application)
                        <div class="grid grid-cols-3 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition">
                            <div class="text-sm font-medium text-gray-900 flex items-center gap-2">
                                <i class="fa-solid fa-file-lines text-indigo-500"></i>
                                {{ $application->type ?? 'N/A' }}
                            </div>

                         
                            <div class="text-sm text-gray-700">
                                <p><strong>{{ $application->issue_date ? $application->issue_date->format('M d, Y') : 'N/A' }}</strong></p>
                            </div>

                           
                            <div>
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $application->status === 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $application->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $application->status === 'Released' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $application->status === 'Rejected' ? 'bg-red-100 text-red-700' : '' }}
                                ">
                                    {{ $application->status ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layout>
