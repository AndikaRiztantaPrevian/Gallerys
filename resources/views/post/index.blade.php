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
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex justify-between items-center">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
          <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
              <button class="inline-block p-4 border-b-2 rounded-t-lg" id="semua-tab" data-tabs-target="#semua"
                type="button" role="tab" aria-controls="semua" aria-selected="false">Semua</button>
            </li>
            @foreach ($album as $data)
              <li class="me-2" role="presentation">
                <button
                  class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                  id="{{ $data->name }}-tab" data-tabs-target="#{{ $data->name }}" type="button" role="tab"
                  aria-controls="{{ $data->name }}" aria-selected="false">{{ $data->name }}</button>
              </li>
            @endforeach
            <li role="presentation">
              <button
                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal">Tambah Album <i
                  class="fi fi-rr-plus-small"></i></button>
            </li>
          </ul>
        </div>
        <div>
          <button data-modal-target="albumEdit-modal" data-modal-toggle="albumEdit-modal"
            class="text-white bg-gradient-to-br text-xs from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg px-5 py-2.5 text-center me-2 mb-2"
            type="button">List album</button>
        </div>
      </div>
      <div id="default-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="semua" role="tabpanel"
          aria-labelledby="semua-tab">
          <div class="w-full max-w-fit p-5 pb-10 mx-auto mb-10 gap-5 columns-3 space-y-5">
            @forelse ($post as $dataPost)
              <div class="group relative">
                <img class="rounded-lg shadow-md" src="{{ asset('storage/' . $dataPost->image) }}"
                  alt="{{ $dataPost->name }}">
                <div
                  class="absolute top-0 left-0 w-full h-0 flex flex-col justify-center items-center bg-opacity-10 opacity-0 group-hover:h-full group-hover:opacity-100 duration-500">
                  <h1 class="text-1xl px-3 text-white bg-slate-950 bg-opacity-50 capitalize mb-3 rounded-sm">
                    {{ $dataPost->title }}
                  </h1>
                  <div class="flex mt-2 gap-3">
                    <div
                      class="bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-full w-10 h-10 flex justify-center items-center">
                      <a class="text-white" href="{{ route('post.show', $dataPost->id) }}"><i
                          class="fi fi-ss-eye"></i></a>
                    </div>
                    <a href="{{ route('post.edit', $dataPost->id) }}"
                      class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-full w-10 h-10 flex justify-center items-center">
                      <i class="fi fi-sr-pen-clip"></i>
                    </a>
                    <form id="deleteForm{{ $dataPost->id }}" action="{{ route('post.destroy', $dataPost->id) }}"
                      method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" onclick="confirmDelete('{{ $dataPost->id }}')"
                        class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-full w-10 h-10"><i
                          class="fi fi-sr-trash"></i></button>
                    </form>
                  </div>
                </div>
              </div>
            @empty
              <div class="text-center">
                <p class="text-gray-500 dark:text-gray-400">Tidak Ada Gambar Silahkan Upload Gambar Terlebih Dahulu.</p>
              </div>
            @endforelse
          </div>
        </div>
        @foreach ($album as $albumD)
          <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="{{ $albumD->name }}" role="tabpanel"
            aria-labelledby="{{ $albumD->name }}-tab">
            <div class="w-full max-w-fit p-5 pb-10 mx-auto mb-10 gap-5 columns-3 space-y-5">
              @forelse ($albumD->post as $post)
                <div class="group relative">
                  <img class="rounded-lg shadow-sm" src="{{ asset('storage/' . $post->image) }}" alt="">
                  <div
                    class="absolute top-0 left-0 w-full h-0 flex flex-col justify-center items-center bg-opacity-10 opacity-0 group-hover:h-full group-hover:opacity-100 duration-500">
                    <h1 class="text-1xl px-3 text-white bg-slate-950 bg-opacity-50 capitalize mb-3 rounded-md">
                      {{ $post->title }} </h1>
                    <div class="flex mt-2 gap-3">
                      <div
                        class="bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-full w-10 h-10 flex justify-center items-center">
                        <a class="text-white" href="{{ route('post.show', $post->id) }}"><i
                            class="fi fi-ss-eye"></i></a>
                      </div>
                      <a href="{{ route('post.edit', $post->id) }}"
                        class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-full w-10 h-10 flex justify-center items-center">
                        <i class="fi fi-sr-pen-clip"></i>
                      </a>
                      <form id="deletePost{{ $dataPost->id }}" action="{{ route('post.destroy', $post->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDeletePost('{{ $post->id }}')"
                          class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-full w-10 h-10"><i
                            class="fi fi-sr-trash"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              @empty
                <div class="text-center">
                  <p class="text-gray-500 dark:text-gray-400">Tidak Ada Gambar Silahkan Upload Gambar Terlebih Dahulu.
                  </p>
                </div>
              @endforelse
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- Modal Tambah --}}
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
        <form class="p-4 md:p-5" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2">
              <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
              <input type="text" name="title" id="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Beautiful Oddet.." required="">
            </div>
            <div class="col-span-2">
              <label for="album" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Album</label>
              <select id="album" name="album_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected>Pilih Album</option>
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
                placeholder="Ceritakan tentang foto anda!"></textarea>
            </div>
          </div>
          <div class="image-container w-full mb-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
              Gambar</label>
            <input name="image"
              class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
              id="file_input" type="file">
          </div>
          <div class="flex justify-end">
            <button type="submit"
              class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
              Posting
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>


  {{-- Modal Album --}}
  <div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="popup-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
          <form action="{{ route('album.store') }}" method="POST">
            @csrf
            <div>
              <label for="name_album" class="block mb-4 text-base font-bold text-gray-900 dark:text-white">Nama
                Album</label>
              <input type="text" name="name" id="name_album"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Pantai, Pemandangan" required />
            </div>
            <div>
              <button type="submit"
                class="mt-5 px-8 py-3 text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- Modal Album Edit & Delete --}}
  <div id="albumEdit-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="albumEdit-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
          <div>
            <label for="name_album" class="block mb-4 text-base font-bold text-gray-900 dark:text-white">List
              Album</label>
            <div class="flex flex-col justify-between items-center">
              @foreach ($album as $dataA)
                <div class="flex justify-between items-center w-full px-3 py-2 mb-2 border rounded-md">
                  <div class="font-medium">{{ $dataA->name }}</div>
                  <div>
                    <form action="{{ route('album.destroy', $dataA->id) }}" method="POST"
                      id="deleteAlbum{{ $dataA->id }}">
                      @csrf
                      @method('DELETE')
                      <button type="button" onclick="confirmDeleteAlbum('{{ $dataA->id }}')"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><i
                          class="fi fi-br-trash"></i>
                      </button>
                    </form>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(document).ready(function() {
      $('button[id^="buttonEditPost-"]').on('click', function() {
        // Pengambilan Data
        var dataId = $(this).data('id');
        var dataTitle = $(this).data('title');
        var dataDescription = $(this).data('description');
        var dataAlbum = $(this).data('album');
        // form element
        var formEdit = $('#formEdit');
        var inputArea = $('#inputArea');

        $('#edit-modal').modal('show');
        // action
        formEdit.attr('action', `/post/update/${dataId}`);

        inputArea.html('');

        inputArea.append(`
        <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2">
              <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
              <input type="text" name="title" id="title" value="${dataTitle}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Beautiful Oddet.." required="">
            </div>
            <div class="col-span-2">
              <label for="album" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Album</label>
              <select id="album"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option selected>Pilih Album</option>
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
                placeholder="Ceritakan tentang foto anda!">${dataDescription}</textarea>
            </div>
          </div>
          <div class="image-container w-full mb-3">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
              Gambar</label>
            <input
              class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
              id="file_input" type="file">
          </div>
          <div class="flex justify-end">
            <button type="submit"
              class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
              Simpan
            </button>
          </div>`);

        // Tambahkan console.log untuk debug
        console.log('Button clicked:', dataId, dataTitle, dataDescription, dataAlbum);
      });
    });
  </script>

  <script>
    function confirmDelete(postId) {
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: 'Anda tidak dapat mengembalikannya lagi!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('deleteForm' + postId).submit();
        }
      });
    }

    function confirmDeleteAlbum(albumId) {
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: 'Anda tidak dapat mengembalikannya lagi!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('deleteAlbum' + albumId).submit();
        }
      });
    }

    function confirmDeletePost(postId) {
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: 'Anda tidak dapat mengembalikannya lagi!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('deletePost' + postId).submit();
        }
      });
    }
  </script>
</x-app-layout>
