<x-layout>
    <div class="container mx-auto py-24 px-4 lg:px-8 min-h-[700px]">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-900">Application Management</h2>
                <p class="text-sm text-gray-600 mt-1">Monitor and track all document requests</p>
            </div>
            @if (!$applications->isEmpty())
                <div class="text-sm text-gray-600">
                    <span class="font-medium text-gray-900">{{ $applications->count() }}</span> Total Applications
                </div>
            @endif
        </div>

        @if ($applications->isEmpty())
            <div class="bg-white border border-gray-200 rounded-lg p-20 text-center">
                <i class="fa-solid fa-folder-open text-gray-300 text-4xl mb-3"></i>
                <p class="text-gray-600">No applications submitted yet.</p>
            </div>
        @else
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full table-fixed">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="w-2/5 px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Request Document
                                </th>
                                <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Date Issued
                                </th>
                                <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Release Date
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($applications as $application)
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <i class="fa-solid fa-file-lines text-gray-400 group-hover:text-blue-600 transition-colors"></i>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900 truncate">
                                                {{ $application->type ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-700">
                                            {{ $application->issue_date ? $application->issue_date->format('M d, Y') : '—' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium
                                            {{ $application->status === 'Pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}
                                            {{ $application->status === 'Approved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : '' }}
                                            {{ $application->status === 'To be Release' ? 'bg-blue-50 text-blue-700 border border-blue-200' : '' }}
                                            {{ $application->status === 'Rejected' ? 'bg-red-50 text-red-700 border border-red-200' : '' }}
                                        ">
                                            {{ $application->status ?? 'N/A' }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-700">
                                            {{ $application->release_date ? $application->release_date->format('M d, Y') : '—' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-layout>