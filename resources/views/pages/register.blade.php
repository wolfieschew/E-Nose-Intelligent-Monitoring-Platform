<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | IMRON Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex h-screen w-full">
    <!-- Kiri -->
    <div class="w-[80%] [background:linear-gradient(65deg,#B40A32,#FF88A4)] flex items-center justify-center">
        <img src="{{ asset('assets/img/IMRON Mascot Transparent.png') }}" alt="Logo IMRON" class="w-1/2 h-auto" />
    </div>
    <!-- Kanan -->
    <div class="w-2/5 bg-white flex items-center justify-center">
        <div class="flex flex-col items-center">
            <img src="{{ asset('assets/img/IMRON Title.svg') }}" alt="Logo IMRON" class="w-1/2 h-auto m-8" />
            <div class="w-[50vh]">
                <!-- Menampilkan notifikasi sukses jika ada -->
                        @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                        @endif

                <form action="{{route('register')}}" method="post">
                    @csrf

                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Username</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Username" type="text"
                            name="username"
                            required />
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Password</span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Password" type="password"
                            name="password"
                            required />
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Confirm Password
                        </span>
                        <input
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Password" type="password"
                            name="password_confirmation" required />
                    </label>

                    <div class="flex mt-6 text-sm">
                        <label class="flex items-center dark:text-gray-400">
                            <input type="checkbox"
                                class="text-red-600 form-checkbox focus:border-red-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" />
                            <span class="ml-2">
                                I agree to the
                                <span class="underline">privacy policy</span>
                            </span>
                        </label>
                    </div>

                    <button class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-400 hover:bg-red-400 focus:outline-none focus:shadow-outline-purple">
                        Register
                    </button>
                </form>

                <div class="mt-8">
                    <p class="mt-4">
                        <a class="text-sm font-medium text-red-600 dark:text-red-400 hover:underline"
                            href="{{ route('login') }}">
                            Already have an account? Login
                        </a>
                    </p>
                </div>
            </div>
            @include('components.chatbot')
        </div>
    </div>
</div>
<script>
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: "{!! implode('<br>', $errors->all()) !!}",
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Registrasi Berhasil',
            text: "{{ session('success') }}",
            confirmButtonText: 'OK'
        });
    @endif
</script>
</body>

</html>