<div class="bg-white rounded-2xl shadow-lg p-6">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Informasi Profil</h2>
        <p class="text-sm text-gray-500">Kelola data akun Anda</p>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')

        @if(auth()->user()->role === 'admin')
        <div class="flex items-center gap-4 mb-6">
            <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : '/default.png' }}" class="w-20 h-20 rounded-full object-cover ring-4 ring-indigo-100" alt="Foto Profil">
            <div>
                <label class="text-sm text-gray-600">Foto Profil</label>
                <input id="profile_photo" name="profile_photo" type="file" accept="image/jpeg,image/png" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                <p class="text-xs text-gray-400">Format JPG/PNG maksimal 2MB</p>
                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="text-sm text-gray-600">Nama</label>
                <input id="name" name="name" type="text" class="mt-1 w-full p-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label class="text-sm text-gray-600">Email</label>
                <input id="email" name="email" type="email" class="mt-1 w-full p-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <div class="mt-6 border-t pt-6">
            <h3 class="text-md font-semibold mb-3">Ubah Password</h3>
            <div class="space-y-4">
                <div>
                    <label class="text-sm text-gray-600">Password Baru</label>
                    <input type="password" name="password" class="mt-1 w-full p-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Password baru" />
                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>
                <div>
                    <label class="text-sm text-gray-600">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="mt-1 w-full p-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Konfirmasi password" />
                    <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                </div>
            </div>
        </div>

        <button class="mt-6 w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-3 rounded-xl shadow-md hover:scale-105 hover:brightness-110 transition">
            Simpan Perubahan
        </button>
    </form>
</div>
