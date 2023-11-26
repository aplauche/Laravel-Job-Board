<x-layout>

  <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply' => '#']" />

  <x-job-card :job="$job"/>

  <x-card>
    <h2 class="mb-4 text-lg font-medium">Your Job Application</h2>

    <form action="{{ route('job.application.store', $job) }}" method="POST">
      @csrf
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-slate-900" for="expected_salary">Expected Salary</label>
        <x-text-input type="number" name="expected_salary" />
      </div>

      <button type="submit" class="button w-full">Apply</button>
    </form>
  </x-card>

</x-layout>