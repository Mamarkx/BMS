<x-admin-layout>
  <div class=" mx-auto py-12 px-4 lg:px-8">
    <!-- Heading -->
    <div class="text-center mb-10">
      <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">Attendance Sheet</h2>
      <p class="mt-2 text-sm text-gray-500">Daily log of employee attendance</p>
    </div>

    <!-- Attendance Table Card -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
      <table class="min-w-full divide-y divide-gray-200 text-sm">
        <!-- Table Header -->
        <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
          <tr>
            <th class="px-6 py-4 text-left font-semibold tracking-wide">Employee</th>
            <th class="px-6 py-4 text-left font-semibold tracking-wide">Date</th>
            <th class="px-6 py-4 text-left font-semibold tracking-wide">In-Time</th>
            <th class="px-6 py-4 text-left font-semibold tracking-wide">Out-Time</th>
            <th class="px-6 py-4 text-left font-semibold tracking-wide">Status</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          <!-- Row 1 -->
          <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
            <td class="px-6 py-4 font-medium text-gray-900">John Doe</td>
            <td class="px-6 py-4 text-gray-700">Sep 12, 2025</td>
            <td class="px-6 py-4 text-gray-700">08:00 AM</td>
            <td class="px-6 py-4 text-gray-700">05:00 PM</td>
            <td class="px-6 py-4">
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                <i class="fa-solid fa-check-circle mr-1"></i> Present
              </span>
            </td>
          </tr>
          <!-- Row 2 -->
          <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
            <td class="px-6 py-4 font-medium text-gray-900">Jane Smith</td>
            <td class="px-6 py-4 text-gray-700">Sep 12, 2025</td>
            <td class="px-6 py-4 text-gray-700">08:30 AM</td>
            <td class="px-6 py-4 text-gray-700">05:00 PM</td>
            <td class="px-6 py-4">
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                <i class="fa-solid fa-exclamation-circle mr-1"></i> Late
              </span>
            </td>
          </tr>
          <!-- Row 3 -->
          <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
            <td class="px-6 py-4 font-medium text-gray-900">Michael Johnson</td>
            <td class="px-6 py-4 text-gray-700">Sep 12, 2025</td>
            <td class="px-6 py-4 text-gray-700">09:00 AM</td>
            <td class="px-6 py-4 text-gray-700">05:00 PM</td>
            <td class="px-6 py-4">
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                <i class="fa-solid fa-times-circle mr-1"></i> Absent
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</x-admin-layout>
