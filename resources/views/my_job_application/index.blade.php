<x-layout>

  <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), 'My Applications' => '#']" />


  <x-card class="mb-4">
    <h2 class="text-lg font-medium">Your Job Applications</h2>
  </x-card>

  @forelse ($applications as $application)
      <x-job-card :job="$application->job">
        <div class="flex justify-between">
          <div class="text-xs text-slate-500">
            <div>Applied: {{ $application->created_at->diffForHumans() }} </div>
            <div>Asking: ${{ number_format($application->expected_salary) }} </div>
            <div>Number of Applicants: {{ $application->job->job_applications_count }}</div>
            <div>Average Asking Salary: ${{ number_format($application->job->job_applications_avg_expected_salary) }}</div>
          </div>
          <div></div>
        </div>
      </x-job-card>
  @empty
    <x-card>
      <h2 class="mb-4 text-lg font-medium">No current pending applications...</h2>
    </x-card>
  @endforelse


</x-layout>