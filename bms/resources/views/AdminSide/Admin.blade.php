<x-admin-layout>

    <!-- Dashboard Grid -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Residents -->
        <div class="bg-white rounded-xl border border-gray-300 p-6 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Residents</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</h2>
            </div>
            <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                <!-- Users Group -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-3-3.87M7
                        21v-2a4 4 0 0 1 3-3.87" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </div>
        </div>

        <!-- Barangay Employees -->
        <div class="bg-white rounded-xl border border-gray-300 p-6 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Barangay Employees</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalEmpoyees }}</h2>
            </div>
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <!-- Shield Badge -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6
                        8 10 8 10z" />
                </svg>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="bg-white rounded-xl border border-gray-300 p-6 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Pending Requests</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalPending }}</h2>
            </div>
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <!-- Hourglass / Clock -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 6v6l4 2" />
                </svg>
            </div>
        </div>

        <!-- Certificate Issued -->
        <div class="bg-white rounded-xl border border-gray-300 p-6 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Certificate Issued</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalCertificate }}</h2>
            </div>
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                <!-- Document with Check -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2
                        2v16a2 2 0 0 0 2 2h12a2
                        2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <path d="M9 15l2 2 4-4" />
                </svg>
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
            <h3 class="text-lg font-semibold text-gray-800">Headcount Trend</h3>
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
        var headcountTrendChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Headcount Trend',
                    data: [120, 1250, 1300, 130, 1300, 1350],
                    fill: false,
                    borderColor: '#4CAF50',
                    borderWidth: 2,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 100
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
</x-admin-layout>
