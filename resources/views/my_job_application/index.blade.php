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
          <div>
            <form action="{{ route('my-job-applications.destroy', $application) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="button">Cancel</button>
            </form>
          </div>
        </div>
      </x-job-card>
  @empty
    <div class="rounded-md border border-dashed border-slate-300 p-8">
      <div class="text-center font-medium">
        No job application yet
      </div>
      <div class="text-center">
        Go find some jobs <a class="text-indigo-500 hover:underline"
          href="{{ route('jobs.index') }}">here!</a>
      </div>
    </div>
  @endforelse


</x-layout>