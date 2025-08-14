<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - IMRON</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}">
    <link rel="stylesheet" href="{{ asset('chatbotv2/styles.css') }}">
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer></script>
    <script src="../assets/js/init-alpine.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/script.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex h-screen w-full">
        <div class="w-[80%] [background:linear-gradient(65deg,#B40A32,#FF88A4)] flex items-center justify-center">
            <img src="{{ asset('assets/img/IMRON Mascot Transparent.png') }}" alt="Logo IMRON" class="w-1/2 h-auto" />
        </div>
        <div class="w-2/5 bg-white flex items-center justify-center">
            <div class="flex flex-col items-center">
                <img src="{{ asset('assets/img/IMRON Title.svg') }}" alt="Logo IMRON" class="w-1/2 h-auto m-8" />
                <div class="w-[50vh]">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <h3 class="mb-4 font-bold">Login</h3>
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Username</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Username" name="username" value="{{ old('username') }}" />
                            @error('username')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </label>

                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Password</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Password" type="password" name="password" />
                            @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </label>

                        <button
                            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-400 hover:bg-red-400 focus:outline-none focus:shadow-outline-purple">
                            Log in
                        </button>
                    </form>
                    <div class="mt-8">
                        <a class="text-sm font-medium text-red-600 dark:text-red-400 hover:underline"
                            href="{{ route('show.register') }}">
                            Register
                        </a>
                    </div>
                </div>
                @include('components.chatbot')
            </div>
        </div>
    </div>

    <script>
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: {
                !!json_encode(session('success')) !!
            },
            confirmButtonText: 'OK'
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: {
                !!json_encode(session('error')) !!
            },
            confirmButtonText: 'OK'
        });
        @endif

        @if($errors->has('login_error'))
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: {!! json_encode($errors->first('login_error')) !!},
            confirmButtonText: 'OK'
        });
        @endif
    </script>
    <script>
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