<x-layout>

  <x-breadcrumbs 
    class="mb-4" 
    :links="['Jobs' => route('jobs.index'), $job->title => '#']"
  />

  <x-job-card :job="$job">
    <p class="text-sm text-slate-500 mb-4">{!! nl2br(e($job->description)) !!}</p>
    @can('apply', $job)
      <x-button-link :href="route('job.application.create', $job)">Apply</x-button-link>
    @else 
      <div class="text-center text-sm font-medium mt-8">
        You have already applied to this job!
      </div>
    @endcan

  </x-job-card>

  <x-card class="mb-4">
    <h2 class="mb-4 text-lg font-medium">More jobs from {{$job->employer->company_name}}</h2>
    <div class="text-sm text-slate-500">
      @foreach ($job->employer->jobs as $relatedJob)
        @if($job->id !== $relatedJob->id)
          <div class="flex mb-4 justify-between">
            <div>
              <div class="text-slate-700"><a href="{{ route('jobs.show', $relatedJob) }}">{{$relatedJob->title}}</a></div>
              <div class="text-xs">{{ $relatedJob->created_at->diffForHumans() }}</div>
            </div>
            <div class="text-xs">${{ number_format($relatedJob->salary) }}</div>
          </div>
        @endif
      @endforeach
    </div>
  </x-card>


</x-layout>