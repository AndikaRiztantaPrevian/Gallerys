<x-app-layout>
  <div class="container h-screen mx-auto p-8 md:flex gap-4 flex justify-center">
    <div class="border shadow" style="width: 70%; height: 88%">
      <form class="p-4 md:p-5" action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid gap-4 mb-4 grid-cols-2">
          <div class="col-span-2">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
            <input type="text" value="{{ $post->title }}" name="title" id="title"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
              placeholder="Beautiful Oddet.." required="">
          </div>
          <div class="col-span-2">
            <label for="album" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Album</label>
            <select id="album" name="album_id"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              <option value="{{ $post->album->id }}" selected>{{ $post->album->name }}</option>
              @foreach ($album as $dataDrop)
                <option value="{{ $dataDrop->id }}">{{ $dataDrop->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-span-2">
            <label for="description"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
            <textarea id="description" name="description" rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Ceritakan tentang foto anda!">{{ $post->description }}</textarea>
          </div>
        </div>
        <div class="image-container w-full mb-3">
          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
            Gambar</label>
          <input name="image" value="{{ $post->image }}"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="file_input" type="file">
        </div>
        <div class="flex justify-end">
          <button type="submit"
            class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
