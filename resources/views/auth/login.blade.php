<x-layout>
    <h1 class="text-3xl font-bold mb-4 text-center">Welcome to Sign-In </h1>
  <div class="mx-auto max-w-screen-sm bg-white shadow-md rounded-lg p-6">
      <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="mb-2">
              <label for="email" class="block text-gray-700">Email</label>
              <input type="text" name="email" value="{{ old('email')}}" id="email" class="input mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror">
              @error('email')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>
          <div class="mb-2">
              <label for="password" class="block text-gray-700">Password</label>
              <input type="password" name="password" id="password" class="input mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500 @error('password') border-red-500 @enderror">
              @error('password')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>
          {{-- Remember checkbox --}}
          <div class="mb-2">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>        
          </div>
          @error('failed')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
          <div class="mb-2">
              <button type="submit" class="btn bg-blue-500 text-white px-4 py-2 rounded-lg focus:outline-none hover:bg-blue-600">Login</button>
          </div>
      </form>
  </div>
</x-layout>
