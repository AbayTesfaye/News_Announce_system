@props(['post','full'=>false])

<div class="card bg-white shadow-md rounded-lg p-6 mb-6">
  {{-- title --}}
  <h2 class="text-2xl font-semibold mb-2">{{ $post->title }}</h2>

  {{-- author and date --}}
  <div class="text-xs text-gray-600 font-light mb-4">
      <span>Posted on {{ $post->created_at->diffForHumans() }} by</span>
      <a href="{{ route('user.posts',$post->user)}}" class="text-blue-500 font-medium">{{ $post->user->username}}</a>
  </div>
  {{-- body --}}

   @if ($full)
      <div class="text-sm text-gray-800">
        <span>{{ $post->body }}</span>
      </div>
   @else
       <div class="text-sm text-gray-800">
        <span>{{ Str::words($post->body,15) }}</span>
        <a href="{{ route('posts.show', $post)}}" class="text-blue-500">
        Read More &rarr;
        </a>
      </div>
   @endif
   <div class="flex items-center justify-end gap-4 mt-6">
      {{ $slot }}
   </div>

</div>