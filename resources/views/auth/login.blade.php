<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 transition-all duration-300">
        <div class="text-center mb-6">
            <div class="w-12 h-12 mx-auto bg-indigo-500 text-white flex items-center justify-center rounded-full mb-3">
                🛒
            </div>
            <h1 class="text-xl font-semibold text-gray-800">e-KASIR LAB</h1>
            <p class="text-sm text-gray-500">Masuk ke akun Anda</p>
        </div>

        <x-auth-session-status class="rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700" :status="session('status')" />
        <x-auth-validation-errors class="rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4" x-data="{ showPassword: false, loading: false }" @submit="loading = true">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="relative mt-2">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16v16H4z" />
                            <path d="M4 7l8 6 8-6" />
                        </svg>
                    </span>
                    <x-text-input id="email" class="block w-full px-4 py-3 pl-11 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@domain.com" />
                </div>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative mt-2">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="6" y="11" width="12" height="8" rx="2" />
                            <path d="M8 11V8a4 4 0 118 0v3" />
                        </svg>
                    </span>
                    <input id="password" class="block w-full px-4 py-3 pl-11 pr-11 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" placeholder="Masukkan password" />
                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" :class="{ 'hidden': showPassword, 'block': !showPassword }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg class="h-5 w-5" :class="{ 'block': showPassword, 'hidden': !showPassword }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 00-4.24-4.24" />
                            <line x1="1" y1="1" x2="23" y2="23" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center text-sm mb-4">
                <label class="inline-flex items-center gap-2">
                    <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-700 transition duration-200">Forgot password?</a>
                @endif
            </div>

            <button type="submit" :disabled="loading" class="w-full py-3 rounded-xl text-white bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 transition duration-300 shadow-md hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed">
                <span x-show="!loading">Login</span>
                <span x-show="loading" class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-opacity="0.25" />
                        <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                    </svg>
                    Memproses...
                </span>
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">Belum punya akun? Hubungi administrator untuk mendapatkan akses.</p>
</x-guest-layout>
