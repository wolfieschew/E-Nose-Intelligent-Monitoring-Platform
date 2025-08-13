<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('components.title')
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
                        Transaction
                    </h2>

                    <!-- Pencarian -->
                    <!-- Input pencarian -->
                    <input type="text" id="searchInput" placeholder="Cari data..."
                        class="mb-4 px-3 py-2 border rounded-md w-full">
                    <p id="resultCount" class="text-sm text-gray-600 mt-2 mb-4"></p>



                    <!-- New Table -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table id="transactionTable" class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Device ID</th>
                                        <th class="px-4 py-3">Waktu</th>
                                        <th class="px-4 py-3">Type</th>
                                        <th class="px-4 py-3">Data Sampling</th>
                                        <th class="px-4 py-3">Prediksi</th>
                                        <th class="px-4 py-3">Explainable AI</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($data as $item)
                                        <tr id= "tr" class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <p class="font-semibold">{{ $item['device_id'] }}</p>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm">{{ $item['date_time'] }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <p class="font-semibold">{{ $item['type'] }}</p>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{-- Data Sampling kosong untuk saat ini --}}
                                                <button onclick="adminDownloadRowCSV('{{ $item['date_time'] }}')" class="font-semibold">Download</button>
                                            </td>

                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                <p class="font-semibold">Kualitas :
                                                    {{ $item['value']['0']['Class'] ?? '-' }}</p>
                                                <p class="font-semibold">Score :
                                                    {{ $item['value']['0']['Score'][0] ?? '-' }}</p>
                                                <p class="font-semibold">Kategori :
                                                    {{ $item['value']['0']['Multiclass'][0] ?? '-' }}</p>
                                            </td>
                                            {{-- Tampilkan hanya di baris pertama --}}
                                            @if ($loop->first && $data->currentPage() == 1)
                                                <td class="px-4 py-3 text-sm">
                                                    <div class="mb-2">
                                                        <a href="https://intsys-repository.telkomuniversity.ac.id/apps/end_point/explanation_kualitas_e-nose_1.html"
                                                         target="_blank"
                                                            class="px-2 py-1 font-semibold leading-tight text-orange-500 bg-orange-100 rounded-full dark:bg-orange-500 dark:text-orange-100">
                                                            Kualitas
                                                        </a>
                                                    </div>
                                                    <div class="mb-2">
                                                        <a href="https://intsys-repository.telkomuniversity.ac.id/apps/end_point/explanation_organoleptik_e-nose_1.html"
                                                         target="_blank"
                                                            class="px-2 py-1 font-semibold leading-tight text-teal-500 bg-teal-100 rounded-full dark:bg-teal-500 dark:text-teal-100">
                                                            Score
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="https://intsys-repository.telkomuniversity.ac.id/apps/end_point/explanation_kategori_e-nose_1.html"
                                                         target="_blank"
                                                            class="px-2 py-1 font-semibold leading-tight text-blue-500 bg-blue-100 rounded-full dark:bg-blue-500 dark:text-blue-100">
                                                            Kategori
                                                        </a>
                                                    </div>
                                                </td>
                                            @else
                                            @endif
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div
                            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                            <span class="flex items-center col-span-3">
                                Showing 10 of 100
                            </span>
                            <span class="col-span-2"></span>
                            <!-- Pagination -->
                            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                                <nav aria-label="Table navigation">
                                    <button>
                                        {{ $data->links() }}
                                    </button>
                                </nav>
                            </span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.trim().toLowerCase();
            const rows = document.querySelectorAll('#transactionTable tbody tr');
            let count = 0;

            rows.forEach(function(row) {
                let cells = row.querySelectorAll('td');
                let match = false;

                cells.forEach((cell, index) => {
                    // Skip kolom tombol dan link (misalnya index 3 dan 5)
                    if (index === 3 || index === 5) return;

                    // Ambil isi asli
                    const originalHTML = cell.innerHTML;
                    const originalText = cell.textContent.trim();

                    // Bersihkan highlight sebelumnya
                    cell.innerHTML = originalText;

                    // Cek match
                    if (searchValue && originalText.toLowerCase().includes(searchValue)) {
                        // Buat highlight
                        const regex = new RegExp(`(${searchValue})`, 'gi');
                        const highlighted = originalText.replace(regex,
                            `<span class=" text-red-600 font-semibold rounded px-1">$1</span>`);
                        cell.innerHTML = highlighted;
                        match = true;
                    }
                });

                // Tampilkan atau sembunyikan
                if (match || searchValue === "") {
                    row.style.display = '';
                    if (match) count++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('resultCount').textContent = searchValue ?
                `Menampilkan ${count} hasil pencarian.` : '';
        });
    </script>



    <script>
        function adminDownloadRowCSV(dateTime) {
            const encoded = encodeURIComponent(dateTime);
            window.location.href = `/admin-download-row?date_time=${encoded}`;
        }
    </script>


    </script>
</body>

</html>
