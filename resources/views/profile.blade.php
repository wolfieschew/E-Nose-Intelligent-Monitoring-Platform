<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.title')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}">
</head>

<body>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Edit Profile</h2>

        <!-- Success message -->
        @if(session('success'))
            <div class="bg-green-100 border-t-4 border-green-500 text-green-700 px-4 py-3" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Profile Form -->
        <form action="{{ route('update-profile') }}" method="POST">
            @csrf 
            <div class="grid gap-6 mb-6 sm:grid-cols-2">
                <!-- User Name -->
                <div>
                    <label for="user_name" class="block text-sm font-medium text-gray-700">User Name</label>
                    <input type="text" id="user_name" name="user_name" value="{{ old('user_name', $user->user_name) }}"
                        class="w-full px-3 py-2 border rounded-md @error('user_name') border-red-500 @enderror" required>
                    @error('user_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea id="address" name="address" rows="3" class="w-full px-3 py-2 border rounded-md @error('address') border-red-500 @enderror" required>{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-3 py-2 border rounded-md @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full px-3 py-2 border rounded-md @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
                    <input type="text" id="company" name="company" value="{{ old('company', $user->company) }}"
                        class="w-full px-3 py-2 border rounded-md @error('company') border-red-500 @enderror">
                    @error('company')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="3" class="w-full px-3 py-2 border rounded-md @error('description') border-red-500 @enderror">{{ old('description', $user->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</body>

</html>
