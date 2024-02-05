<x-layouts.empty>
  <x-slot:title>
    Register
  </x-slot:title>

  <section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="{{ route('auth.register.create') }}"
         class="flex items-center mb-6 text-2xl font-semibold text-gray-900 flex items-center space-x-3 focus:outline-none focus:ring focus:ring-gray-200">
        <x-app-logo/>
      </a>
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Signup now
          </h1>
          <form class="space-y-4 md:space-y-6" action="{{ route('auth.register.store') }}" method="post">
            @csrf
            <div>
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Full name</label>
              <input
                type="text"
                name="name"
                id="password"
                value="{{ old('name') }}"
                class="input @error('name') input-has-error @enderror"
              >
              @error('name')
              <p class="text-red-500 text-xs mt-1">
                {{ $message }}
              </p>
              @enderror
            </div>
            <div>
              <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
              <input
                type="text"
                name="username"
                id="password"
                value="{{ old('username') }}"
                class="input @error('username') input-has-error @enderror"
              >
              @error('username')
              <p class="text-red-500 text-xs mt-1">
                {{ $message }}
              </p>
              @enderror
            </div>
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
              <input
                type="email"
                name="email"
                id="email"
                class="input @error('email') input-has-error @enderror"
                value="{{ old('email') }}"
              >
              @error('email')
              <p class="text-red-500 text-xs mt-1">
                {{ $message }}
              </p>
              @enderror
            </div>
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
              <input
                type="password"
                name="password"
                id="password"
                class="input @error('password') input-has-error @enderror"
              >
              @error('password')
              <p class="text-red-500 text-xs mt-1">
                {{ $message }}
              </p>
              @enderror
            </div>
            <div>
              <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm
                Password</label>
              <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                class="input @error('password_confirmation') input-has-error @enderror"
              >
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input
                    id="remember"
                    aria-describedby="remember"
                    type="checkbox"
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-gray-200 bg-gray-400">
                </div>
                <div class="ml-3 text-sm">
                  <label for="remember" class="text-gray-500">Remember me</label>
                </div>
              </div>
              <a
                href="#"
                class="text-sm font-medium text-primary-600 hover:underline focus:outline-none focus:ring focus:ring-gray-200"
              >
                Forgot password?
              </a>
            </div>
            <button
              type="submit"
              class="btn btn-primary w-full"
            >
              Register
            </button>
            <p class="text-sm font-light text-gray-500">
              Already have an account?
              <a
                href="{{ route('auth.login.create') }}"
                class="font-medium text-primary-600 hover:underline focus:outline-none focus:ring focus:ring-gray-200"
              >
                Login
              </a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</x-layouts.empty>
