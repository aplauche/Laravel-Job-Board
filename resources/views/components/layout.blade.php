<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

       @vite('resources/css/app.css')
       @vite('resources/js/app.js')
    </head>
    <body class="bg-gradient-to-r from-indigo-100 from-10% via-sky-100 via-30% to-emerald-100 to-90% mx-auto mt-10 max-w-2xl text-slate-700">
        

        {{-- Navigation Bar --}}
        <nav class="mb-8 flex justify-between items-center text-lg font-medium">
            <ul>
                <li>
                    <a href="{{ route('jobs.index') }}">Home</a>
                </li>
            </ul>
            <ul class="flex space-x-4">
                @auth
                    <li>Hello, {{ auth()->user()->name ?? 'Guest' }}</li>
                    <li><a href="{{ route('my-job-applications.index') }}">My Applications</a></li>
                    <li>
                        <form action="{{ route('auth.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE') 
                            {{-- method spoofing to transform post to delete request --}}
                            <button class="button">Sign out</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('auth.create') }}">Sign in</a>
                    </li>
                @endauth
            </ul>
        </nav>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div role="alert" class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
                <p class="font-bold">Success!</p>
                <p>{{ session('success')}}</p>
            </div>
        @endif

        {{ $slot }}
    </body>
</html>