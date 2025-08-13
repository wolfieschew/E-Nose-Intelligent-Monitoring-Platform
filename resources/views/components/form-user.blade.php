<div x-data="{ openTab: null }">
    <div class="flex gap-3 mb-4">
        <!-- Tombol Add User Baru -->
       <button @click="window.location.href='{{ route('register') }}'"
           	class="px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition">
    		Add User
		</button>


        <!-- Tombol Update User -->
        <button @click="openTab = 'update'"
            class="px-4 py-2 ml-4 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition">
            Update User
        </button>
    </div>

    <!-- Modal Add User -->
    <div x-show="openTab === 'add'" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-2xl w-2/5 max-w-lg max-h-lg flex flex-col">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Add New User</h3>
                <button @click="openTab = null" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">✖</button>
            </div>
            <form action="{{ route('add-user') }}" method="POST" class="flex-1 flex flex-col justify-between mt-4">
                @csrf
                <input type="text" name="user_name" placeholder="Username" required class="mb-2">
                <input type="password" name="password" placeholder="Password" required class="mb-2">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="mb-2">
                <input type="text" name="address" placeholder="Address" class="mb-2">
                <input type="email" name="email" placeholder="Email" class="mb-2">
                <input type="text" name="phone" placeholder="Phone" class="mb-2">
                <input type="text" name="company" placeholder="Company" class="mb-2">
                <textarea name="description" placeholder="Description" class="mb-2"></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="openTab = null" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded">Add User</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Update User -->
    <div x-show="openTab === 'update'" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-2xl w-2/5 max-w-lg max-h-lg flex flex-col">
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Update User Detail</h3>
                <button @click="openTab = null" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">✖</button>
            </div>
            <form action="{{ route('update-user-detail') }}" method="POST" class="flex-1 flex flex-col justify-between mt-4">
                @csrf
                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Pilih User</label>
                <select name="user_name" required class="mb-2">
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->user_name }}">{{ $user->user_name }}</option>
                    @endforeach
                </select>
                <input type="text" name="address" placeholder="Address" class="mb-2">
                <input type="email" name="email" placeholder="Email" class="mb-2">
                <input type="text" name="phone" placeholder="Phone" class="mb-2">
                <input type="text" name="company" placeholder="Company" class="mb-2">
                <textarea name="description" placeholder="Description" class="mb-2"></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="openTab = null" class="px-4 py-2 border rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
