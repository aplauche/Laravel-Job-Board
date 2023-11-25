<x-layout>
  <h1 class="my-16 text-center text-4xl font-medium text-slate-600">Sign in to your account</h1>

  <x-card class="py-8 px-16">
    <form action="{{ route('auth.store') }}" method="POST">
      @csrf

      <div class="mb-8">
        <label class="mb-2 block text-sm font-medium text-slate-900" for="email">Email</label>
        <x-text-input placeholder="example@email.com" name="email" />
      </div>

      <div class="mb-8">
        <label class="mb-2 block text-sm font-medium text-slate-900" for="password">Password</label>
        <x-text-input type="password" placeholder="password123... NOT" name="password" />
      </div>

      <div class="mb-8 flex justify-between text-sm font-medium">
        <div>
          <div class="flex items-center space-x-2">
            <input id="remember" type="checkbox" class="rounded-sm border border-slate-400">
            <label for="remember">Remember me</label>
          </div>
        </div>
        <div><a href="#" class="text-indigo-600 hover:underline">Forgot password</a></div>
      </div>

      <button class="button w-full">
        Login
      </button>
    </form>
  </x-card>
</x-layout>