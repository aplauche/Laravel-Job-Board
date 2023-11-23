<x-layout>

  <x-breadcrumbs 
    class="mb-4" 
    {{-- only use colon if you want the value interpolated as PHP --}}
    :links="['Jobs' => '#']"
  />

  <x-card class="mb-4 text-sm" x-data="">
    <form x-ref="filters" id="filtering-form" action="{{ route('jobs.index') }}" method="GET">
      <div class="grid mb-4 grid-cols-2 gap-4">
        <div>
          <div class="mb-1 text-sm font-semibold">Search</div>
          <x-text-input parentForm="filters" name="search" value="{{ request('search') }}" placeholder="Search for any text" />
        </div>

        <div>
          <div class="mb-1 text-sm font-semibold">Salary</div>
          <div class="flex space-x-2">
            <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="From" />
            <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To" />
          </div>
        </div>

        <div>
          <div class="mb-1 text-sm font-semibold">Experience</div>
          {{-- Fancy way to uppercase labels --}}
          <x-radio-group name="experience" :options="array_combine( array_map('ucfirst' ,\App\Models\Job::$experience) ,\App\Models\Job::$experience )"/>
        </div>

        <div>
          <div class="mb-1 text-sm font-semibold">Category</div>
          {{-- Basic way to push labels instead --}}
          <x-radio-group name="category" :options="\App\Models\Job::$category"/>
        </div>
      </div>

      <button class="w-full button">Apply</button>
    </form>
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