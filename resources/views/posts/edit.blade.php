<x-layout>
  <h2 class="font-bold mb-4">Update post</h2>
  <a href="{{ route('dashboard')}}" class="block mb-2 text-xs text-blue-500"> &larr;Go back to your dashboard</a>
  <div class="card">
  <form action="{{ route('posts.update',$post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Title field --}}
    <div class="mb-2">
      <label for="title" class="block text-gray-700">Post title</label>
      <input type="text" name="title" value="{{ $post->title }}" id="title" 
             class="input mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 
                    focus:outline-none focus:border-blue-500 
                    @error('title') border-red-500 @enderror">
      @error('title')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Body field --}}
    <div class="mb-2">
      <label for="body" class="block text-gray-700">Post Content</label>
      <textarea name="body" rows="5" 
                class="input mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 
                       focus:outline-none focus:border-blue-500 
                       @error('body') border-red-500 @enderror">{{ $post->body }}</textarea>
      @error('body')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- current photo --}}
    @if ($post->image)
    <div class="mb-4">
      <label >Current Cover Photo</label>
       <img src="{{ asset('storage/'. $post->image )}}" alt="Post Image" class="w-1/4 h-68 object-cover object-center rounded-md">
    </div>
    @endif
    <div class="mb-4">
      <label for="image" class="block text-gray-700 font-semibold">Cover Photo</label>
      <input type="file" name="image" id="image" class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500">
      @error('image')
      <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Submit Button --}}
    <button class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
      Update
    </button>
  </form>
</div>
</x-layout>