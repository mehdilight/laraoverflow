<x-layouts.empty>
  <x-slot:title>
    Login
  </x-slot:title>

  <section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="{{ route('auth.login.create') }}"
         class="flex items-center mb-6 text-2xl font-semibold text-gray-900 flex items-center space-x-3 focus:outline-none focus:ring focus:ring-gray-200">
        <x-app-logo/>
      </a>
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Sign in to your account
          </h1>
          <form class="space-y-4 md:space-y-6" action="{{ route('auth.login.store') }}" method="post">
            @csrf
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
              <input
                type="email"
                name="email"
                id="email"
                class="input @error('email') input-has-error @enderror"
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
              Sign in
            </button>
            <p class="text-sm font-light text-gray-500">
              Don’t have an account yet?
              <a
                href="{{ route('auth.register.create') }}"
                class="font-medium text-primary-600 hover:underline focus:outline-none focus:ring focus:ring-gray-200"
              >
                Sign up
              </a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</x-layouts.empty>
