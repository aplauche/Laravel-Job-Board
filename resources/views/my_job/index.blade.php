<x-layout>
  <x-breadcrumbs class="mb-4" :links="[
    'My Jobs' => '#'
  ]" />

  <div class="mb-8 text-right">
    <x-button-link href="{{route('my-jobs.create')}}">Create Job Listing</x-button-link>
  </div>

  @forelse ($jobs as $job)

  <x-job-card :job="$job">
   <div class="text-xs text-slate-500">
      @forelse ($job->jobApplications as $application)
          <div class="mb-4 flex items-center justify-between">
            <div>
              <div><strong>{{ $application->user->name }}</strong></div>
              <div>Applied {{$application->created_at->diffForHumans()}}</div>
              <div>Download CV</div>
            </div>
            <div>
              ${{number_format($application->expected_salary)}}
            </div>
          </div>
      @empty
          <div>
            No applications yet...
          </div>
      @endforelse

      @can('update', $job)
        <div class="flex space-x-2 mt-2">
          <x-button-link href="{{route('my-jobs.edit', $job)}}">Edit</x-button-link>
        </div>
      @endcan

   </div>
  </x-job-card>
      
  @empty
      <div class="rounded-md border border-dashed border-slate-300 p-8">
        <div class="text-center font-medium">
          No jobs yet
        </div>
        <div class="text-center">
          Post your first job <a class="text-indigo-500 hover:underline" href="{{route('my-jobs.create')}}">here!</a>
        </div>
      </div>
  @endforelse


</x-layout>