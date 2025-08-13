<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Imron Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>
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
                            <!-- Judul Dashboard Dinamis: Menyesuaikan dengan rute aktif -->
                            <span>
                                {{ request()->routeIs('dashboard') ? 'E-Nose Dashboard' : 'Edge Dashboard' }}
                            </span>
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open"
                                    class="p-2 bg-gray-100 dark:bg-gray-900 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor"
                                        class="w-5 h-5 text-gray-700 dark:text-gray-200">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false"
                                    class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded shadow-lg">
                                    <!-- Dropdown Pilihan untuk Menavigasi ke Dashboard -->
                                    <a href="{{ route('dashboard') }}"
                                        class="text-sm block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Enose</a>
                                    <a href="{{ route('edge-dashboard') }}"
                                        class="text-sm block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Edge</a>
                                </div>
                            </div>
                        </h2>
                    </div>

                    <!-- Cards -->
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                <svg class="w-5 h-5" fill="currentColor" height="20" viewBox="0 0 20 20"
                                    width="20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.9999 2C9.36406 2 7.91172 2.78555 6.99951 4C9.24074 4 11.1953 5.22884 12.2255 7.04952C12.4791 7.01685 12.7376 7 13 7H15.9999V3.33505C15.9999 2.59772 15.4022 2 14.6648 2H10.9999Z" />
                                    <path
                                        d="M7.33746 14.9888C7.22594 14.9962 7.11341 15 7 15C4.23858 15 2 12.7614 2 10V6.33505C2 5.59772 2.59772 5 3.33505 5H7C8.75691 5 10.3022 5.90616 11.1939 7.2766C9.72989 7.73815 8.50822 8.74592 7.76795 10.0609L6.35355 8.64649C6.15829 8.45123 5.84171 8.45123 5.64645 8.64649C5.45118 8.84176 5.45118 9.15834 5.64645 9.3536L7.32882 11.036C7.11575 11.6513 7 12.3122 7 13C7 13.6971 7.11888 14.3664 7.33746 14.9888Z" />
                                    <path
                                        d="M8 13C8 10.2386 10.2386 8 13 8H16.6649C17.4023 8 18 8.59772 18 9.33505V13C18 15.7614 15.7614 18 13 18C11.7994 18 10.6976 17.5768 9.83568 16.8715L8.85363 17.8536C8.65837 18.0488 8.34178 18.0488 8.14652 17.8536C7.95126 17.6583 7.95126 17.3417 8.14652 17.1464L9.12856 16.1644C8.4232 15.3025 8 14.2007 8 13Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Data Prediction
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $totalDataSample }}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                <svg class="w-6 h-6 fill-current text-green-500 dark:text-green-100"
                                    enable-background="new 0 0 64 64" viewBox="0 0 64 64"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="M63.8,31.5L53.4,9.9c-0.5-1-1.6-1.7-2.9-1.7h-7.6h-2.4H2.8c-1.6,0-2.9,1.3-2.9,2.9v30.5v2.4v9.8c0,1.2,0.9,2.1,2.1,2.1h38.4v0h21.4c1.2,0,2.2-1,2.2-2.2v-9.7v-2.4v-9C64.1,32.2,64,31.8,63.8,31.5z M43,10.7h7.5c0.3,0,0.6,0.2,0.7,0.3l10.5,21.6c0,0,0,0,0,0.1v8.8H43V10.7z M2.4,11c0-0.2,0.2-0.4,0.4-0.4h37.5v30.7H2.4V11z M40.3,53.3H2.4v-9.3h37.9V53.3z M61.6,53.3H43v-9.3h18.6V53.3z" />
                                        <rect width="31.5" height="24.8" x="5.6" y="13.7" class="fill-current" />
                                        <line stroke="currentColor" stroke-miterlimit="10" stroke-width="1.5"
                                            x1="25.4" x2="34.9" y1="49.9" y2="49.9" />
                                        <line stroke="currentColor" stroke-miterlimit="10" stroke-width="1.5"
                                            x1="5.6" x2="5.6" y1="43.9" y2="55.8" />
                                        <line stroke="currentColor" stroke-miterlimit="10" stroke-width="1.5"
                                            x1="9.1" x2="9.1" y1="43.9" y2="55.8" />
                                    </g>
                                </svg>
                            </div>

                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Device
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $totalDevice }}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg class="w-6 h-6 fill-current text-blue-500 dark:text-blue-100" height="24"
                                    viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm10 10h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4z" />
                                </svg>
                            </div>

                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Type
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $totalType }}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                                <?php echo '<?xml version="1.0"?>'; ?>
                                <svg height="20" viewBox="0 0 24 24" width="20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.11409306,6 L8,6 L8,8 L2,8 L2,1.99121094 L4,1.99121094 L4,4.25644966 C6.23707736,1.91055844 8.78662625,1 12,1 C18.0751322,1 23,5.92486775 23,12 C23,18.0751322 18.0751322,23 12,23 C5.92486775,23 1,18.0751322 1,12 L3,12 C3,16.9705627 7.02943725,21 12,21 C16.9705627,21 21,16.9705627 21,12 C21,7.02943725 16.9705627,3 12,3 C9.1592152,3 7.04465569,3.7913744 5.11409306,6 Z M13,11 L17,11 L17,13 L11,13 L11,6 L13,6 L13,11 Z"
                                        fill="currentColor" />
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Last Active
                                </p>
                                <p class="text-md font-light text-gray-700 dark:text-gray-200">
                                    {{ $lastActive }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Charts -->
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Charts
                    </h2>
                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                                Prediction
                            </h4>
                            <canvas id="pie" data-values='@json($values)'
                                data-labels='@json($labels)'></canvas>
                            <div
                                class="flex flex-wrap justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                                {{-- @php
                                    $colors = [
                                        'bg-teal-600',
                                        'bg-blue-500',
                                        'bg-purple-600',
                                        'bg-white-400',
                                        'bg-pink-500',
                                        'bg-green-500',
                                    ];
                                @endphp

                                @foreach ($labels as $index => $label)
                                    <div class="flex items-center space-x-1 mt-1">
                                        <span
                                            class="inline-block w-3 h-3 {{ $colors[$index % count($colors)] }} rounded-full"></span>
                                        <span>{{ $label }}</span>
                                    </div>
                                @endforeach --}}
                            </div>

                        </div>
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                                Monthly Predictions
                            </h4>
                            <canvas id="lineChart" width="400" height="200"></canvas>

                            <script>
                                const lineLabels = @json($labels_Line);
                                const lineDatasets = @json($datasets);
                            </script>

                            {{-- <script src="{{ asset('js/line.js') }}"></script> --}}


                            {{-- <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                                <!-- Chart legend -->
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                                    <span>e-nose 1</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"></span>
                                    <span>e-nose 2</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                                    <span>e-nose 3</span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
