<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Beranda') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="w-full max-w-fit p-5 mx-auto mb-10 gap-5 columns-3 space-y-5">
            @foreach ($post as $data)
              <div class="group relative">
                <img class="rounded-md" src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->title }}">
                <div
                  class="absolute top-0 left-0 w-full h-0 flex flex-col justify-center items-center bg-opacity-10 opacity-0 group-hover:h-full group-hover:opacity-100 duration-500">
                  <h1 class="text-1xl px-3 text-white bg-slate-950 bg-opacity-40 rounded-sm">{{ $data->title }}</h1>
                  <a type="button"
                    class="mt-5 px-8 py-3 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm"
                    href="{{ route('post.show', $data->id) }}">Selengkapnya</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
