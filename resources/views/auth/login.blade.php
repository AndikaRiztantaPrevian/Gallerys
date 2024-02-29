<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <h5 class="my-4 text-xl font-medium text-emerald-700 dark:text-white capitalize">Selamat datang di gallerys
    </h5>

    <!-- Email Address -->
    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
        autofocus autocomplete="username" placeholder="example@gmail.com" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
        autocomplete="current-password" placeholder="••••••••" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="flex items-start my-3">
      @if (Route::has('password.request'))
        <a href="#" class="ms-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Lupa Password?</a>
      @endif
    </div>
    <button type="submit"
      class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Masuk</button>
    <div class="text-sm font-medium text-gray-500 dark:text-gray-300 mt-3">Belum daftar? <a
        href="{{ route('register') }}" class="text-blue-700 hover:underline dark:text-blue-500">Buat Akun</a></div>
  </form>

</x-guest-layout>
