<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edge Dashboard - Imron</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" defer></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=devices" />
</head>

<body>
    <div class="flex h-screen w-full bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        {{-- Include Sidebar --}}
        @include('components.sidebar')

        <div class="flex flex-col flex-1 w-full">
            {{-- Include Navbar --}}
            @include('components.navbar')

            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <div class="flex items-center justify-between my-6">
                        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                            <span>Edge Dashboard</span>
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="p-2 bg-gray-100 dark:bg-gray-900 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-700 dark:text-gray-200">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg shadow-lg z-10">
                                    <a href="{{ route('edge-dashboard') }}" class="text-sm block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 bg-blue-50 dark:bg-blue-900 rounded-t-lg">Edge Dashboard</a>
                                    <a href="{{ route('dashboard') }}" class="text-sm block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-b-lg">E-Nose Dashboard</a>
                                </div>
                            </div>
                        </h2>
                    </div>



                    <!-- Statistics Cards -->
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <!-- Total Samples Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Samples{{ $hasFilters ? ' (filtered)' : '' }}
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ number_format($totalDataSample) }}
                                </p>
                            </div>
                        </div>



                        <!-- Dropdown untuk memilih device -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Pilih Device
                                </p>
                                <select
                                    class="text-sm font-semibold text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 rounded px-2 py-1"
                                    onchange="window.location.href = this.value"
                                >
                                    @foreach ($deviceList as $device)
                                        <option
                                            value="{{ route('edge-dashboard', array_merge(request()->query(), ['device_id' => $device->device_id])) }}"
                                            {{ $selectedDeviceId == $device->device_id ? 'selected' : '' }}
                                        >
                                            {{ $device->device_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <!-- Total Types Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm10 10h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Jenis Objek Deteksi{{ $hasFilters ? ' (filtered)' : '' }}
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $totalType }}
                                </p>
                            </div>
                        </div>

                        <!-- Last Activity Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Last Activity{{ $hasFilters ? ' (filtered)' : '' }}
                                </p>
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $lastActive }}
                                </p>
                            </div>
                        </div>
                    </div>


                     <!-- Charts Section -->
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Analytics{{ $hasFilters ? ' (filtered)' : '' }}
                    </h2>
                                       {{-- Collapsible Filter Form --}}
                         <div class="mb-6" x-data="{ filterOpen: false }">
                             <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                                 {{-- Filter Toggle Header --}}
                                 <button @click="filterOpen = !filterOpen" class="w-full px-4 py-3 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                     <h3 class="text-sm font-medium text-gray-700 dark:text-gray-200 flex items-center gap-2">
                                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                                         </svg>
                                         Filter Data
                                         @if($hasFilters ?? false)
                                             <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full">Aktif</span>
                                         @endif
                                     </h3>
                                     <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="{'rotate-180': filterOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                     </svg>
                                 </button>

                                 {{-- Collapsible Filter Form --}}
                                 <div x-show="filterOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="border-t border-gray-200 dark:border-gray-700">
                                     <form method="GET" action="{{ url('/edge-dashboard') }}" class="p-4">
                                         <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                             {{-- Category Filter --}}
                                             <div>
                                                 <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Kategori</label>
                                                 <select name="category" class="w-full px-3 py-2 text-sm rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                                     <option value="">Semua Kategori</option>
                                                     <option value="dosen-staff" {{ request('category') == 'dosen-staff' ? 'selected' : '' }}>Dosen-Staff</option>
                                                     <option value="mahasiswa" {{ request('category') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                                     <option value="lainnya" {{ request('category') == 'lainnya' ? 'selected' : '' }}>Objek Lainnya</option>
                                                 </select>
                                             </div>

                                             {{-- Start Date --}}
                                             <div>
                                                 <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tanggal Mulai</label>
                                                 <input type="date" name="start_date" value="{{ request('start_date') }}"
                                                        class="w-full px-3 py-2 text-sm rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                                             </div>

                                             {{-- End Date --}}
                                             <div>
                                                 <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Tanggal Akhir</label>
                                                 <input type="date" name="end_date" value="{{ request('end_date') }}"
                                                        class="w-full px-3 py-2 text-sm rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
                                             </div>

                                             {{-- Action Buttons --}}
                                             <div class="flex items-end gap-2">
                                                 <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                     </svg>
                                                     Filter
                                                 </button>

                                                 @if($hasFilters ?? false)
                                                 <a href="{{ url('/edge-dashboard') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                     </svg>
                                                     Reset
                                                 </a>
                                                 @endif
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>

                             {{-- Compact Filter Summary --}}
                             @if(isset($filterSummary) && $filterSummary)
                             <div class="mt-3 px-3 py-2 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-md">
                                 <div class="flex items-center justify-between">
                                     <p class="text-sm text-blue-800 dark:text-blue-200 flex items-center gap-2">
                                         <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                             <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                         </svg>
                                         <span class="font-medium">Filter aktif:</span> {{ $filterSummary }}
                                     </p>
                                 </div>
                             </div>
                             @endif
                         </div>

                         {{-- Error Messages --}}
                         @if(session('error'))
                         <div class="mb-4 p-4 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-800 rounded-lg">
                             <p class="text-sm text-red-800 dark:text-red-200">
                                 {{ session('error') }}
                             </p>
                         </div>
                         @endif

                    <div class="grid gap-6 mb-8 md:grid-cols-2">




                        <!-- Pie Chart -->
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                                Distribusi Hasil Deteksi
                            </h4>
                            <div class="relative" style="height: 300px;">
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>

                        <!-- Line Chart -->
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                                Deteksi {{ $hasFilters ? 'Per Periode' : '(7 Hari Terakhir)' }}
                            </h4>
                            <div class="relative" style="height: 300px;">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get data from PHP - with proper error handling
            const pieLabels = {!! $pieLabels ?? json_encode([]) !!};
            const pieData = {!! $pieData ?? json_encode([]) !!};
            const lineLabels = {!! $lineLabels ?? json_encode([]) !!};
            const lineData = {!! $lineData ?? json_encode([]) !!};
            const types = {!! json_encode($types ?? []) !!};

            // Color palette
            const colors = [
                'rgba(59, 130, 246, 0.8)',  // blue
                'rgba(16, 185, 129, 0.8)',  // green
                'rgba(245, 158, 11, 0.8)',  // amber
                'rgba(239, 68, 68, 0.8)',   // red
                'rgba(139, 92, 246, 0.8)',  // purple
                'rgba(236, 72, 153, 0.8)',  // pink
                'rgba(6, 182, 212, 0.8)',   // cyan
                'rgba(34, 197, 94, 0.8)'    // emerald
            ];

            // Pie Chart
            const pieCtx = document.getElementById('pieChart');
            if (pieCtx && pieLabels.length > 0) {
                new Chart(pieCtx, {
                    type: 'doughnut',
                    data: {
                        labels: pieLabels,
                        datasets: [{
                            data: pieData,
                            backgroundColor: colors.slice(0, pieLabels.length),
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                                
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = ((context.parsed * 100) / total).toFixed(1);
                                        return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Line Chart
            const lineCtx = document.getElementById('lineChart');
            if (lineCtx && lineLabels.length > 0) {
                // Filter only types that have detection data (sum > 0)
                const datasetsWithData = types
                    .map((type, index) => {
                        const data = lineData[type] || Array(lineLabels.length).fill(0);
                        const hasData = data.some(value => value > 0);
                        
                        if (hasData) {
                            return {
                                label: type.charAt(0).toUpperCase() + type.slice(1),
                                data: data,
                                borderColor: colors[index % colors.length],
                                backgroundColor: colors[index % colors.length].replace('0.8', '0.1'),
                                tension: 0.4,
                                fill: true
                            };
                        }
                        return null;
                    })
                    .filter(dataset => dataset !== null);

                // Only create chart if there's data to display
                if (datasetsWithData.length > 0) {
                    new Chart(lineCtx, {
                        type: 'line',
                        data: {
                            labels: lineLabels,
                            datasets: datasetsWithData
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                    position: 'bottom',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 20,
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                } else {
                    // Display message when no data is available
                    const canvasContainer = lineCtx.parentElement;
                    canvasContainer.innerHTML = '<div class="flex items-center justify-center h-full text-gray-500 dark:text-gray-400"><p>Tidak ada data deteksi untuk periode ini</p></div>';
                }
            }
        });
    </script>
</body>

</html>
