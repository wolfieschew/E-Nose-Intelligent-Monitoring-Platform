<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Windmill Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>
</head>

<body>
    <div class="flex h-screen w-full bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        {{-- Include Sidebar --}}
        @include('components.admin-sidebar')

        <div class="flex flex-col flex-1 w-full">
            {{-- Include Header --}}
            @include('components.navbar')
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Transaction Edge
                    </h2>

                    <!-- Pencarian -->
                    <div class="mb-4">
                        <input type="text" id="searchInput" class="w-full px-4 py-2 text-gray-700 border rounded-lg dark:bg-gray-700 dark:text-gray-200" placeholder="Cari transaksi...">
                    </div>

                    <!-- New Table -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                                <form method="GET" class="mb-4 w-40">
                                    <label for="per_page" class="text-sm font-medium text-gray-700 dark:text-gray-300">Tampilkan:</label>
                                    <select name="per_page" id="per_page" onchange="this.form.submit()" class="block w-full mt-1 text-sm dark:bg-gray-800 dark:text-gray-200 border-gray-300 rounded">
                                        @foreach ([10, 20, 50, 100] as $size)
                                            <option value="{{ $size }}" {{ request('per_page', 20) == $size ? 'selected' : '' }}>
                                                {{ $size }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            <table  id="transactionTable"  class="w-full whitespace-no-wrap">


                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Detection Time</th>
                                        <th class="px-4 py-3">Type</th>
                                        <th class="px-4 py-3">Value</th>
                                        <th class="px-4 py-3">Device ID</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($data as $item)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm">{{ $item['detection_time'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $item['type'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $item['value'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $item['device_id'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                         <!-- Tombol Download CSV -->
                        <div class="mt-4">
                            <button onclick="downloadTableAsCSV()" class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700 focus:outline-none">
                                Download CSV
                            </button>
                        </div>

                        </div>
                        <div
                            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                            <span class="flex items-center col-span-3">
                                Showing {{ $data->firstItem() }} - {{ $data->lastItem() }} of {{ $data->total() }}
                            </span>

                            <span class="col-span-2"></span>
                            <!-- Pagination -->
                            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                                <nav aria-label="Table navigation">
                                    <!-- Pagination otomatis dari Laravel -->
                                    <div class="mt-4">
                                        {{ $data->withQueryString()->links() }}
                                    </div>

                                </nav>
                            </span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        // Script untuk mencari data transaksi
        document.getElementById('searchInput').addEventListener('input', function() {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('#transactionTable tbody tr');

            rows.forEach(function(row) {
                let cells = row.getElementsByTagName('td');
                let match = false;

                // Periksa setiap kolom dalam baris
                for (let i = 0; i < cells.length; i++) {
                    if (cells[i].textContent.toLowerCase().includes(searchValue)) {
                        match = true;
                        break;
                    }
                }

                // Tampilkan atau sembunyikan baris berdasarkan pencarian
                if (match) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function downloadTableAsCSV() {
            const table = document.getElementById('transactionTable');
            let csv = [];
            const rows = table.querySelectorAll('tr');

            for (let row of rows) {
                const cols = row.querySelectorAll('th, td');
                let rowData = [];
                for (let col of cols) {
                    // Escape double quotes
                    let text = col.innerText.replace(/"/g, '""');
                    rowData.push(`"${text}"`);
                }
                csv.push(rowData.join(','));
            }

            // Buat file CSV
            const csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
            const downloadLink = document.createElement('a');
            downloadLink.download = 'transaction_data.csv';
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = 'none';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
    }
    </script>
</body>

</html>
