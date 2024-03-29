<x-card class="mb-4">
    <div class="flex justify-between mb-4">
      <h2 class="text-lg font-medium">{{ $job->title }}
        @if ($job->deleted_at !== null)
            <span class=" text-red-500">(Deleted)</span>
        @endif
      </h2>
      <div class="text-slate-500">${{ number_format($job->salary ) }}</div>
    </div>

    <div class="mb-4 flex justify-between text-sm text-slate-500 items-center">
      <div class="flex space-x-4 items-center">
        <div>{{ $job->employer->company_name }}</div>
        <div>{{ $job->location }}</div>


      </div>
      <div class="flex space-x-1 text-xs items-center">
        <x-tag>
          <a href="{{ route('jobs.index', ['experience' => $job->experience]) }}">{{ $job->experience }}</a>
        </x-tag>
        <x-tag>
          <a href="{{ route('jobs.index', ['category' => $job->category]) }}">{{ $job->category }}</a>
        </x-tag>
      </div>
    </div>

    {{ $slot }}

</x-card>