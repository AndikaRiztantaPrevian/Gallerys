<x-app-layout>
  <div class="container h-screen mx-auto p-8 md:flex gap-4">
    <div class="md:w-2/4">
      <div class="mb-4">
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->tile }}"
          class="w-full h-auto max-h-full object-cover rounded">
      </div>
      <div class="flex items-center mb-2">
        <div class="title" style="width: 90%;"> 
          <h1 class="text-2xl font-bold underline underline-offset-8 truncate">{{ $post->title }}</h1>
        </div>
        <div class="action-button flex flex-col justify-center items-center" style="width: 10%">
          <div class="count text-sm">{{ $likeCount }}</div>
          @forelse ($like as $likeData)
            <form action="{{ route('like.destroy', $likeData->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="border-none bg-transparent outline-none focus:outline-none">
                <i class="fi fi-sr-heart text-red-600"></i>
              </button>
            </form>
          @empty
            <form action="{{ route('like.store') }}" method="POST">
              @csrf
              <input type="hidden" name="post_id" value="{{ $post->id }}" hidden>
              <button type="submit" class="border-none bg-transparent outline-none focus:outline-none">
                <i class="fi fi-br-heart text-red-600"></i>
              </button>
            </form>
          @endforelse
        </div>
      </div>
      <p class="text-gray-700 mb-8 text-sm">{{ $post->description }}</p>
    </div>
    <div class="md:w-2/4">
      <div class="bg-white p-6 rounded shadow h-full max-h-fit">
        <h2 class="text-xl font-bold mb-4">Komentar</h2>
        <hr>
        <div class="comment-container h-full py-2 overflow-y-auto " style="max-height: 82%">
          @foreach ($post->comment()->get() as $data)
            <div class="chat bg-gray-100 mb-2 px-4 py-2 rounded-md">
              @if ($data->user->id == Auth::user()->id)
                <div class="name-action flex justify-between items-center">
                  <div class="username font-bold">{{ $data->user->name }}</div>
                  <div class="action-comment">
                    <button id="dropdownMenuIconHorizontalButton-{{ $data->id }}"
                      data-dropdown-toggle="dropdownDotsHorizontal-{{ $data->id }}"
                      class="inline-flex items-center p-1 text-sm font-medium text-white text-center bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 rounded-lg"
                      type="button">
                      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 3">
                        <path
                          d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                      </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownDotsHorizontal-{{ $data->id }}"
                      class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownMenuIconHorizontalButton-{{ $data->id }}">
                        <li>
                          <button id="buttonEditModal-{{ $data->id }}" data-modal-target="popup-modal"
                            data-modal-toggle="popup-modal" data-id="{{ $data->id }}"
                            data-message="{{ $data->message }}"
                            class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</button>
                        </li>
                        <li>
                          <form action="{{ route('comment.destory', $data->id) }}" method="POST"
                            id="formDelete{{ $data->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete('{{ $data->id }}')""
                              class="block px-4 py-2 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</button>
                          </form>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              @else
                <div class="username font-bold">{{ $data->user->name }}</div>
              @endif
              <div class="text-chat text-sm capitalize">{{ $data->message }}</div>
              <div class="time text-sm text-end">
                {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, MMMM YYYY') }}
              </div>
            </div>
          @endforeach
        </div>
        <div class="comment-send-container mt-3 h-11">
          <form action="{{ route('comment.store') }}" method="POST" class="flex items-center gap-2">
            @csrf
            <div class="relative z-0 mb-5 group" style="width: 94%">
              <input type="hidden" name="post_id" value="{{ $post->id }}" hidden>
              <input type="text" name="message" id="comment"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-yellow-300 focus:outline-none focus:ring-0 focus:border-yellow-300 peer"
                placeholder="" required />
              <label for="comment"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-yellow-300 peer-focus:dark:text-yellow-300 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Komentar</label>
            </div>
            <div class="buttonsubmit" style="width: 4%">
              <button type="submit" class="bg-yellow-300 w-8 h-8 rounded-full flex items-center justify-center"><i
                  class="fi fi-bs-paper-plane text-white"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Edit --}}
  <div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="popup-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
          <form method="POST" id="formEdit">
            @csrf
            @method('PUT')
            <div id="inputArea">

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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(document).ready(function() {
      $('button[id^="buttonEditModal-"]').on('click', function() {
        // Pengambilan Data
        var dataId = $(this).data('id');
        var dataMessage = $(this).data('message');
        // form element
        var formEdit = $('#formEdit');
        var inputArea = $('#inputArea');
        // action
        formEdit.attr('action', `/comment/update/${dataId}`);

        inputArea.html('');

        inputArea.append(`
            <label for="message" class="block mb-4 text-base font-bold text-gray-900 dark:text-white">Pesan</label>
            <input type="text" name="message" value="${dataMessage}" id="messageModal"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              required />`);

        // Tambahkan console.log untuk debug
        console.log('Button clicked:', dataId, dataMessage);
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
          document.getElementById('formDelete' + postId).submit();
        }
      });
    }
  </script>
</x-app-layout>
