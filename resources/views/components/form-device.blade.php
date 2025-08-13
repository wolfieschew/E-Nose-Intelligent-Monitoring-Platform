<div x-data="{ open: false, editOpen: false }">
    <!-- Tombol Add Device dan Edit Device -->
    <div class="flex gap-2 mb-4">
        <button @click="open = true"
            class="px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition">
            Add Device
        </button>
        <button @click="editOpen = true"
            class="px-4 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition">
            Edit Device
        </button>
    </div>

    <!-- Overlay Modal -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-2xl w-2/5 max-w-lg max-h-lg flex flex-col">

            <!-- Header Modal -->
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Add New Device</h3>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                    ✖
                </button>
            </div>

            <!-- Form Add Device -->
            <form action="{{ route('add-device') }}" method="POST" class="flex-1 flex flex-col justify-between mt-4">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Device ID</label>
                        <input type="text" name="device_id"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Device Name</label>
                        <input type="text" name="device_name"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">IP Address</label>
                        <input type="text" name="ip_address"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Mac Address</label>
                        <input type="text" name="mac_address"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Type</label>
                        <select name="type"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white" required>
                            <option value="e-nose">E-Nose</option>
                            <option value="edge">Edge</option>
                        </select>
                    </div>
                    {{--
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Username</label>
                        <select name="user_name"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white" required>
                            <option value="">Select Username</option>
                            @foreach($users as $user)
                                <option value="{{ $user->user_name }}">{{ $user->user_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Description</label>
                        <textarea name="description"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white"></textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 border rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition">
                        Add Device
                    </button>
                </div>
            </form>

            <!-- Form Tambah User ke Device -->
            <form action="{{ route('add-user-to-device') }}" method="POST" class="flex-1 flex flex-col justify-between mt-8">
                @csrf
                <h3 class="text-md font-semibold text-gray-700 dark:text-gray-200 mb-2">Tambah User ke Device</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Pilih Device</label>
                        <select name="device_id" required
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white">
                            <option value="">Pilih Device</option>
                            @foreach($data as $device)
                                <option value="{{ $device->device_id }}">{{ $device->device_name }} ({{ $device->device_id }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Pilih User</label>
                        <select name="user_name" required
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white">
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->user_name }}">{{ $user->user_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition">
                        Tambah User ke Device
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Device -->
    <div x-show="editOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-2xl w-2/5 max-w-lg max-h-lg flex flex-col">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Edit Device</h3>
                <button @click="editOpen = false" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">✖</button>
            </div>
            <form action="{{ route('update-device') }}" method="POST" class="flex-1 flex flex-col justify-between mt-4">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Pilih Device</label>
                        <select name="device_id" required
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white">
                            <option value="">-- Pilih Device --</option>
                            @foreach($data as $device)
                                <option value="{{ $device->device_id }}">{{ $device->device_name }} ({{ $device->device_id }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Device Name</label>
                        <input type="text" name="device_name"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">IP Address</label>
                        <input type="text" name="ip_address"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Mac Address</label>
                        <input type="text" name="mac_address"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Type</label>
                        <select name="type"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white" required>
                            <option value="e-nose">E-Nose</option>
                            <option value="edge">Edge</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Description</label>
                        <textarea name="description"
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Hak Akses User</label>
                        <select name="user_names[]" multiple
                            class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-teal-400 transition dark:bg-gray-700 dark:text-white">
                            @foreach($users as $user)
                                <option value="{{ $user->user_name }}">{{ $user->user_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" @click="editOpen = false"
                        class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 border rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition">
                        Update Device
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
