<div x-data="{ editDeviceOpen: false }">
    <!-- Modal Edit Device -->
    <div x-show="editDeviceOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-2xl w-2/5 max-w-lg max-h-lg flex flex-col">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Edit Device</h3>
                <button @click="editDeviceOpen = false" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">✖</button>
            </div>
            <form action="{{ route('update-device') }}" method="POST" class="flex-1 flex flex-col justify-between mt-4">
                @csrf
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Pilih Device</label>
                <select name="device_id" required class="mb-2">
                    <option value="">-- Pilih Device --</option>
                    @foreach($data as $device)
                        <option value="{{ $device->device_id }}">{{ $device->device_name }} ({{ $device->device_id }})</option>
                    @endforeach
                </select>
                <input type="text" name="device_name" placeholder="Device Name" class="mb-2">
                <input type="text" name="ip_address" placeholder="IP Address" class="mb-2">
                <input type="text" name="mac_address" placeholder="Mac Address" class="mb-2">
                <select name="type" class="mb-2">
                    <option value="e-nose">E-Nose</option>
                    <option value="edge">Edge</option>
                </select>
                <textarea name="description" placeholder="Description" class="mb-2"></textarea>
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Hak Akses User</label>
                <select name="user_names[]" multiple class="mb-2">
                    @foreach($users as $user)
                        <option value="{{ $user->user_name }}">{{ $user->user_name }}</option>
                    @endforeach
                </select>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="editDeviceOpen = false" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded">Update Device</button>
                </div>
            </form>
        </div>
    </div>
</div>
