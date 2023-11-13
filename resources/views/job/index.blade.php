<x-layout>

  <x-breadcrumbs 
    class="mb-4" 
    {{-- only use colon if you want the value interpolated as PHP --}}
    :links="['Jobs' => '#']"
  />

  <x-card class="mb-4 text-sm">
    <div class="grid mb-4 grid-cols-2 gap-4">
      <div>
        <div class="mb-1 text-sm font-semibold">Search</div>
        <x-text-input name="search" value="" placeholder="Search for any text" />
      </div>
      <div>
        <div class="mb-1 text-sm font-semibold">Salary</div>
        <div class="flex space-x-2">
          <x-text-input name="min_salary" value="" placeholder="From" />
          <x-text-input name="max_salary" value="" placeholder="To" />
        </div>

      </div>
    </div>
  </x-card>

  @foreach ($jobs as $job)

    <x-job-card :job="$job">
      <div>
        <x-button :href="route( 'jobs.show', $job)">
          Details
        </x-button>
      </div>
    </x-job-card>

  @endforeach

</x-layout>