<x-admin-layout>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Residents -->
        <div
            class="bg-white rounded-xl border border-gray-300 p-6 py-10 flex items-center justify-between shadow-sm hover:shadow-md transition">
            <div>
                <p class="text-gray-500 text-sm">Total Residents</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</h2>
            </div>
            <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                <i class="fa-solid fa-users text-2xl"></i>
            </div>
        </div>

        <!-- Barangay Employees -->
        <div
            class="bg-white rounded-xl border border-gray-300 p-6 flex items-center justify-between shadow-sm hover:shadow-md transition">
            <div>
                <p class="text-gray-500 text-sm">Barangay Employees</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalEmpoyees }}</h2>
            </div>
            <div class="p-3 rounded-full bg-green-100 text-green-500">
                <i class="fa-solid fa-user-tie text-2xl"></i>
            </div>
        </div>

        <!-- Pending Requests -->
        <div
            class="bg-white rounded-xl border border-gray-300 p-6 flex items-center justify-between shadow-sm hover:shadow-md transition">
            <div>
                <p class="text-gray-500 text-sm">Pending Requests</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalPending }}</h2>
            </div>
            <div class="p-3 rounded-full bg-red-100 text-red-500">
                <i class="fa-solid fa-hourglass-half text-2xl"></i>
            </div>
        </div>

        <!-- Certificates Issued -->
        <div
            class="bg-white rounded-xl border border-gray-300 p-6 flex items-center justify-between shadow-sm hover:shadow-md transition">
            <div>
                <p class="text-gray-500 text-sm">Certificate Issued</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalCertificate }}</h2>
            </div>
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                <i class="fa-solid fa-file-circle-check text-2xl"></i>
            </div>
        </div>

    </section>


    <!-- Charts and Data Tables -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white rounded-2xl border border-gray-300 p-6">
            <h3 class="text-lg font-semibold text-gray-800">Employee Demographics</h3>
            <div class="mt-4 h-64 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                <canvas id="employeeDemographicsChart"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-300 p-6">
            <h3 class="text-lg font-semibold text-gray-800">Resident Trend</h3>
            <div class="mt-4 h-64 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                <canvas id="headcountTrendChart"></canvas>
            </div>
        </div>



    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('employeeDemographicsChart').getContext('2d');
        var employeeDemographicsChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Male', 'Female', 'Other'],
                datasets: [{
                    label: 'Employee Demographics',
                    data: [60, 35, 5],
                    backgroundColor: ['#4CAF50', '#FF9800', '#2196F3'],
                    borderColor: ['#fff', '#fff', '#fff'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        });

        var ctx = document.getElementById('headcountTrendChart').getContext('2d');
        var residentGrowthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Residents Added Per Month',
                    data: @json($residentsPerMonth),
                    fill: true,
                    borderColor: '#2563EB',
                    backgroundColor: 'rgba(37, 99, 235, 0.15)',
                    borderWidth: 2,
                    tension: 0.25,
                    pointRadius: 4,
                    pointBackgroundColor: '#1D4ED8'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-admin-layout>
