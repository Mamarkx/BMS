<x-admin-layout>

<!-- Dashboard Grid -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Total Employees Card -->
    <div class="bg-white rounded-xl border border-gray-300 p-6 py-10 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">Total Residents</p>
            <h2 class="text-3xl font-bold text-gray-800 mt-1">1,250</h2>
        </div>
        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
            <!-- User Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
        </div>
    </div>
    <!-- New Hires Card -->
    <div class="bg-white rounded-xl border border-gray-300 p-6 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">Barangay Officials</p>
            <h2 class="text-3xl font-bold text-gray-800 mt-1">30</h2>
        </div>
        <div class="p-3 rounded-full bg-green-100 text-green-500">
            <!-- Add User Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <line x1="19" y1="8" x2="19" y2="14"/>
                <line x1="22" y1="11" x2="16" y2="11"/>
            </svg>
        </div>
    </div>
    <!-- Turnover Rate Card -->
    <div class="bg-white rounded-xl border border-gray-300 p-6 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">Pending Requests</p>
            <h2 class="text-3xl font-bold text-gray-800 mt-1">12</h2>
        </div>
        <div class="p-3 rounded-full bg-red-100 text-red-500">
            <!-- Trending Down Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/>
                <polyline points="17 7 22 7 22 12"/>
            </svg>
        </div>
    </div>
    <!-- Another Turnover Rate Card (Similar) -->
    <div class="bg-white rounded-xl border border-gray-300 p-6 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">Turnover Rate</p>
            <h2 class="text-3xl font-bold text-gray-800 mt-1">12.3%</h2>
        </div>
        <div class="p-3 rounded-full bg-red-100 text-red-500">
            <!-- Trending Down Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/>
                <polyline points="17 7 22 7 22 12"/>
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
