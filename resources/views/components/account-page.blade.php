<section id="account" aria-labelledby="account-title" class="mt-8">
  <h2 class="sr-only" id="account-title">Account</h2>
  <div class="overflow-hidden rounded-lg bg-white shadow mb-8 p-6">
      <h1 class="text-3xl font-extrabold text-gray-900 text-center mb-8">Account Details</h1>
      @auth
          <div class="flex justify-center items-center space-x-4 mb-8">
              <div class="relative w-44 h-44 bg-white p-4 rounded-full shadow-md transition-all duration-400 group">
                  <div class="relative w-full h-full">
                      <img src="{{ asset('profile_photos/' . Auth::user()->profile_photo) }}" alt="Profile Photo" class="w-full h-90% object-cover rounded-full transition-all duration-400 group-hover:rounded-lg group-hover:-translate-y-10">
                  </div>
              </div>
          </div>

          <div class="space-y-4 mb-8">
            <div class="flex flex-col">
              <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
              <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            </div>
          </div>

          <div class="mb-6">
              <h4 class="text-xl font-semibold">Change Profile Photo</h4>
              <form method="POST" action="{{ route('updateProfilePhoto') }}" enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                  <div class="form-group mt-2">
                      <input type="file" name="profile_photo" id="profile_photo" class="form-control py-2 px-3 border rounded-md">
                  </div>
                  <button type="submit" class="mt-4 w-full py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-md">
                      Update Photo
                  </button>
              </form>
          </div>

          <div class="mb-6">
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="w-full py-2 px-4 bg-red-500 hover:bg-red-700 text-white font-semibold rounded-md">
                      Logout
                  </button>
              </form>
          </div>
      @else
          <div class="text-center">
              <p>You are not logged in. Please <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">login</a> or <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">register</a>.</p>
          </div>
      @endauth

      @if (session('success'))
          <div class="alert alert-success mt-4 bg-green-100 border-t-4 border-green-500 text-green-900 p-4 rounded">
              {{ session('success') }}
          </div>
      @endif
      @if (session('error'))
          <div class="alert alert-danger mt-4 bg-red-100 border-t-4 border-red-500 text-red-900 p-4 rounded">
              {{ session('error') }}
          </div>
      @endif
  </div>
</section>