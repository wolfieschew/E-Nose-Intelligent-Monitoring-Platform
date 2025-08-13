      <!-- Desktop sidebar -->
      <link rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

      <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0 h-full">
          <div class="py-4 text-gray-500 dark:text-gray-400">
              <div class="flex items-center  ml-4">
                  <img class="w-12 h-12" src = "{{ asset('assets/img/imron.png') }}" alt="imron">
                  <a class=" text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                      @if (Auth::check())
                          <p>Welcome, {{ Auth::user()->user_name }}</p>
                      @else
                          <p>Welcome, Guest!</p>
                      @endif
                  </a>
              </div>

              <ul class="mt-4">
                  <!-- Dashboard -->
                  <li class="relative px-6 py-3">
                      <span class="absolute inset-y-0 left-0 w-1 bg-teal-600 rounded-tr-lg rounded-br-lg"
                          aria-hidden="true" {{ request()->routeIs('admin-enose-dashboard') ? '' : 'hidden' }}>
                      </span>

                      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                        hover:text-gray-800 dark:hover:text-gray-200
                        {{ request()->routeIs('admin-enose-dashboard') ? 'text-gray-900' : 'text-gray-500' }}"
                          href="{{ route('admin-enose-dashboard') }}">
                          <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                              <path
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                              </path>
                          </svg>
                          <span class="ml-4">Dashboard</span>
                      </a>
                  </li>

                  <!-- Transaksi -->
                  <li class="relative px-6 py-3">
                      <span class="absolute inset-y-0 left-0 w-1 bg-teal-600 rounded-tr-lg rounded-br-lg"
                          aria-hidden="true" {{ request()->routeIs('admin-transaksi-enose') ? '' : 'hidden' }}>
                      </span>

                      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                        hover:text-gray-800 dark:hover:text-gray-200
                        {{ request()->routeIs('admin-transaksi-enose') ? 'text-gray-900' : 'text-gray-500' }}"
                          href="{{ route('admin-transaksi-enose') }}">
                          <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                              <path
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                              </path>
                          </svg>
                          <span class="ml-4">Transaction E-Nose</span>
                      </a>
                  </li>

                  <li class="relative px-6 py-3">
                      <span class="absolute inset-y-0 left-0 w-1 bg-teal-600 rounded-tr-lg rounded-br-lg"
                          aria-hidden="true" {{ request()->routeIs('admin-transaksi-edge') ? '' : 'hidden' }}>
                      </span>

                      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                        hover:text-gray-800 dark:hover:text-gray-200
                        {{ request()->routeIs('admin-transaksi-edge') ? 'text-gray-900' : 'text-gray-500' }}"
                          href="{{ route('admin-transaksi-edge') }}">
                          <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                              <path
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                              </path>
                          </svg>
                          <span class="ml-4">Transaction Edge</span>
                      </a>
                  </li>

                  <!-- Device -->
                  <li class="relative px-6 py-3">
                      <span class="absolute inset-y-0 left-0 w-1 bg-teal-600 rounded-tr-lg rounded-br-lg"
                          aria-hidden="true" {{ request()->routeIs('admin-device') ? '' : 'hidden' }}>
                      </span>

                      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                        hover:text-gray-800 dark:hover:text-gray-200
                        {{ request()->routeIs('admin-device') ? 'text-gray-900' : 'text-gray-500' }}"
                          href="{{ route('admin-device') }}">
                          <span class="material-symbols-outlined">
                              devices
                          </span>
                          <span class="ml-4">Device Management</span>
                      </a>
                  </li>

                  <!-- User Management -->
                  <li class="relative px-6 py-3">
                      <span class="absolute inset-y-0 left-0 w-1 bg-teal-600 rounded-tr-lg rounded-br-lg"
                          aria-hidden="true" {{ request()->routeIs('user-management') ? '' : 'hidden' }}>
                      </span>

                      <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                        hover:text-gray-800 dark:hover:text-gray-200
                        {{ request()->routeIs('user-management') ? 'text-gray-900' : 'text-gray-500' }}"
                          href="{{ route('user-management') }}">
                          <span class="material-symbols-outlined">
                              group
                          </span>
                          <span class="ml-4">User Management</span>
                      </a>
                  </li>
              </ul>
              <ul>
                  <li class="relative px-6 py-3">
                      {{-- <button
                          class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                          @click="togglePagesMenu" aria-haspopup="true">
                          <span class="inline-flex items-center">
                              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                  stroke="currentColor">
                                  <path
                                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                                  </path>
                              </svg>
                              <span class="ml-4">Pages</span>
                          </span>
                          <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                          </svg>
                      </button> --}}
                      {{-- <template x-if="isPagesMenuOpen">
                          <ul x-transition:enter="transition-all ease-in-out duration-300"
                              x-transition:enter-start="opacity-25 max-h-0"
                              x-transition:enter-end="opacity-100 max-h-xl"
                              x-transition:leave="transition-all ease-in-out duration-300"
                              x-transition:leave-start="opacity-100 max-h-xl"
                              x-transition:leave-end="opacity-0 max-h-0"
                              class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                              aria-label="submenu">
                              <li
                                  class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                  <a class="w-full" href="{{ route('login') }}">Login</a>
                              </li>
                              <li
                                  class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                  <a class="w-full" href="{{ route('create.account') }}">
                                      Create account
                                  </a>
                              </li>
                              <li
                                  class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                  <a class="w-full" href="{{ url('/forgot-password') }}">
                                      Forgot password
                                  </a>
                              </li>
                              <li
                                  class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                  <a class="w-full" href="{{ route('not.found') }}">404</a>
                              </li>
                              <li
                                  class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                  <a class="w-full" href="{{ route('blank') }}">Blank</a>
                              </li>
                          </ul>
                      </template> --}}
                  </li>
              </ul>
          </div>
      </aside>
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
          x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
          x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
      <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
          x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
          x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
          x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
          @keydown.escape="closeSideMenu">
          <div class="py-4 text-gray-500 dark:text-gray-400">
              <div class="flex items-center ml-4">
                  <img class="w-12 h-12" src = "{{ asset('assets/img/imron.png') }}" alt="imron">
                  <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                      Imron
                  </a>
              </div>
              <ul class="mt-4">
                  <li class="relative px-6 py-3">
                      <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                          aria-hidden="true"></span>
                      <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                          href="{{ route('admin-enose-dashboard') }}">
                          <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                              <path
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                              </path>
                          </svg>
                          <span class="ml-4">Dashboard</span>
                      </a>
                  </li>

                  <!-- Transaksi Enose -->
                  <li class="relative px-6 py-3">
                      <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                          aria-hidden="true"></span>
                      <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                          href="{{ route('admin-transaksi-enose') }}">
                          <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                              <path
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                              </path>
                          </svg>
                          <span class="ml-4">Transaksi</span>
                      </a>
                  </li>
                    <!-- Transaksi Edge -->
                  <li class="relative px-6 py-3">
                    <span class="absolute inset-y-0 left-0 w-1 bg-teal-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true" {{ request()->routeIs('admin-transaksi-edge') ? '' : 'hidden' }}>
                    </span>

                    <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150
                      hover:text-gray-800 dark:hover:text-gray-200
                      {{ request()->routeIs('admin-transaksi-edge') ? 'text-gray-900' : 'text-gray-500' }}"
                        href="{{ route('admin-transaksi-edge') }}">
                        <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                        <span class="ml-4">Transaction Edge</span>
                    </a>
                </li>
                  <li class="relative px-6 py-3">
                      <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                          aria-hidden="true"></span>
                      <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                          href="{{ route('admin-device') }}">
                          <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                              <path
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                              </path>
                          </svg>
                          <span class="ml-4">Device</span>
                      </a>
                  </li>
                  {{-- <li class="relative px-6 py-3">
                      {{-- <button
                          class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                          @click="togglePagesMenu" aria-haspopup="true">
                          <span class="inline-flex items-center">
                              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                  stroke="currentColor">
                                  <path
                                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                                  </path>
                              </svg>
                              <span class="ml-4">Pages</span>
                          </span>
                          <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                          </svg>
                      </button> --}}
                      {{-- <template x-if="isPagesMenuOpen">
                          <ul x-transition:enter="transition-all ease-in-out duration-300"
                              x-transition:enter-start="opacity-25 max-h-0"
                              x-transition:enter-end="opacity-100 max-h-xl"
                              x-transition:leave="transition-all ease-in-out duration-300"
                              x-transition:leave-start="opacity-100 max-h-xl"
                              x-transition:leave-end="opacity-0 max-h-0"
                              class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                              aria-label="submenu">
                              <li
                                  class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                  <a class="w-full" href="{{ route('login') }}">Login</a>
                              </li>
                              <li
                                  class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                  <a class="w-full" href="{{ route('create.account') }}">
                                      Create account
                                  </a>
                              </li>
                              <li
                                  class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                  <a class="w-full" href="{{ route('forgot.password') }}">
                                      Forgot password
                                  </a>
                              </li>
                              <li
                                  class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                  <a class="w-full" href="{{ route('not.found') }}">404</a>
                              </li>
                              <li
                                  class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                  <a class="w-full" href"{{ route('blank') }}">Blank</a>
                              </li>
                          </ul>
                      </template> --}}
                  {{-- </li> --}}
              </ul>
      </aside>
