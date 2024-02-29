<section>
  <header>
    <h2 class="text-lg font-medium text-gray-900">
      {{ __('Ubah Kata Sandi') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
      {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
    </p>
  </header>

  <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')

    <div>
      <x-input-label for="update_password_current_password" :value="__('Kata Sandi Lama')" />
      <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full"
        autocomplete="current-password" />
      <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div>
      <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" />
      <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full"
        autocomplete="new-password" />
      <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div>
      <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" />
      <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
        class="mt-1 block w-full" autocomplete="new-password" />
      <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
      <button
        class="font-semibold text-xs tracking-widest text-white uppercase  bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 rounded-lg  px-5 py-2.5 text-center me-2 mb-2"
        type="submit">{{ __('Simpan') }}</button>

      @if (session('status') === 'password-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
          {{ __('Saved.') }}</p>
      @endif
    </div>
  </form>
</section>
