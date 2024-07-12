<x-layout>
  <h1>Hello, {{ auth()->user()->username }}</h1>
  {{-- create post form --}}
  <div class="card mb-4">
    <h2 class="font-bold mb-4">Create a new post</h2>
    @if (session('success'))
        <x-flashMsg msg="{{ session('success') }}" />
    @elseif (session('delete'))
        <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
    @endif
  
    <form action="{{ route('posts.store') }}" method="POST">
      @csrf
      {{-- Title field --}}
      <div class="mb-2">
        <label for="title" class="block text-gray-700">Post title</label>
        <input type="text" name="title" value="{{ old('title') }}" id="title" 
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
                         @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>
        @error('body')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      {{-- Submit Button --}}
      <button class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        Create
      </button>
    </form>
  </div>
  <h2 class="font-bold mb-4">Latest posts by user</h2>
  <div class="grid grid-cols-2 gap-6">
    @foreach ($posts as $post)
       <x-postCard :post="$post">
          {{-- Update post --}}
          <a href="{{ route('posts.edit',$post)}}" class="bg-green-500 text-white px-2 py-1 text-xs rounded-md">Update</a>
          {{-- Delete post --}}
          <form action="{{ route('posts.destroy', $post) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
          </form>
       </x-postCard>
    @endforeach
  </div>
  <div>
    {{ $posts->links() }}
  </div>
</x-layout>
