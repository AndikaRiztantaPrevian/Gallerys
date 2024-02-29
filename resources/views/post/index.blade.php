<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-column justify-between items-center">
      <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Postingan Anda') }}
        </h2>
      </div>
      <div>
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
          class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
          type="button">Upload Gallery</button>
      </div>
    </div>
  </x-slot>

  <div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Upload Gallery
          </h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-toggle="crud-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <form method="POST" action="{{ route('post.store') }}" class="p-4 md:p-5">
          <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2">
              <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
              <input type="text" name="title" id="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Beautiful Oddet.." required="">
            </div>
            <div class="col-span-2">
              <label for="album" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Album</label>
              <select id="album"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected="">Pilih Album</option>
                <option value="TV">Pemandangan</option>
                <option value="PC">Gunung</option>
                <option value="GA">Pantai</option>
              </select>
            </div>
            <div class="col-span-2">
              <label for="description"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
              <textarea id="description" name="description" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Ceritakan tentang foto anda!"></textarea>
            </div>
            <div class="image-container">
              <input type="file" class="dropify">
            </div>
          </div>
          <button type="submit"
            class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
            Posting
          </button>
        </form>
      </div>
    </div>
  </div>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="grid gap-4">
              <div class="group relative">
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="">
                <div
                  class="absolute top-0 left-0 w-full h-0 flex flex-col justify-center items-center bg-opacity-10 opacity-0 group-hover:h-full group-hover:opacity-100 duration-500">
                  <h1 class="text-1xl px-3 text-white bg-slate-950 bg-opacity-40">Fiction T-Shirt Store</h1>
                  <a class="mt-5 px-8 py-3 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm"
                    href="#">Edit</a>
                </div>
              </div>
              <div class="group relative">
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg" alt="">
                <div
                  class="absolute top-0 left-0 w-full h-0 flex flex-col justify-center items-center bg-opacity-10 opacity-0 group-hover:h-full group-hover:opacity-100 duration-500">
                  <h1 class="text-1xl px-3 text-white bg-slate-950 bg-opacity-40">Fiction T-Shirt Store</h1>
                  <a class="mt-5 px-8 py-3 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm"
                    href="#">Edit</a>
                </div>
              </div>
              <div class="group relative">
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg" alt="">
                <div
                  class="absolute top-0 left-0 w-full h-0 flex flex-col justify-center items-center bg-opacity-10 opacity-0 group-hover:h-full group-hover:opacity-100 duration-500">
                  <h1 class="text-1xl px-3 text-white bg-slate-950 bg-opacity-40">Fiction T-Shirt Store</h1>
                  <a class="mt-5 px-8 py-3 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm"
                    href="#">Edit</a>
                </div>
              </div>
            </div>
            <div class="grid gap-4">
              <div class="group relative">
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg" alt="">
                <div
                  class="absolute top-0 left-0 w-full h-0 flex flex-col justify-center items-center bg-opacity-10 opacity-0 group-hover:h-full group-hover:opacity-100 duration-500">
                  <h1 class="text-1xl px-3 text-white bg-slate-950 bg-opacity-40">Fiction T-Shirt Store</h1>
                  <a class="mt-5 px-8 py-3 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm"
                    href="#">Edit</a>
                </div>
              </div>
              <div class="group relative">
                <div
                  class="absolute top-0 left-0 w-full h-0 flex flex-col justify-center items-center bg-opacity-10 opacity-0 group-hover:h-full group-hover:opacity-100 duration-500">
                  <h1 class="text-1xl px-3 text-white bg-slate-950 bg-opacity-40">Fiction T-Shirt Store</h1>
                  <a class="mt-5 px-8 py-3 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm"
                    href="#">Edit</a>
                </div>
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg" alt="">
              </div>
              <div class="group relative">
                <div
                  class="absolute top-0 left-0 w-full h-0 flex flex-col justify-center items-center bg-opacity-10 opacity-0 group-hover:h-full group-hover:opacity-100 duration-500">
                  <h1 class="text-1xl px-3 text-white bg-slate-950 bg-opacity-40">Fiction T-Shirt Store</h1>
                  <a class="mt-5 px-8 py-3 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm"
                    href="#">Edit</a>
                </div>
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg" alt="">
              </div>
            </div>
            <div class="grid gap-4">
              <div>
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg" alt="">
              </div>
              <div>
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg" alt="">
              </div>
              <div>
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg" alt="">
              </div>
            </div>
            <div class="grid gap-4">
              <div>
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg" alt="">
              </div>
              <div>
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg" alt="">
              </div>
              <div>
                <img class="h-auto max-w-full rounded-lg"
                  src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-11.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
  $('.dropify').dropify();
</script>
