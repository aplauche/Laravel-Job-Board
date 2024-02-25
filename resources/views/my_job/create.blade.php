<x-layout>

  <x-breadcrumbs class="mb-4" :links="[
    'My Jobs' => route('my-jobs.index'),
    'Create' => '#'
  ]" />

  <x-card>

    <form action="{{route('my-jobs.store')}}" method="POST">
      @csrf


      <div class="mb-4 grid grid-cols-2 gap-4">

        <div>
          <x-label for="title" :required="true">Job Title</x-label>
          <x-text-input name="title" />
        </div>
        <div>
          <x-label for="location" :required="true">Job Location</x-label>
          <x-text-input name="location" />
        </div>
        <div class="col-span-2">
          <x-label for="salary" :required="true">Salary</x-label>
          <x-text-input name="salary" type="number" />
        </div>
        <div class="col-span-2">
          <x-label for="description" :required="true">Description</x-label>
          <x-text-input name="description" type="textarea" />
        </div>

        <div>
          <x-label for="experience" :required="true">Experience</x-label>
          <x-radio-group :all-option="false" name="experience" :value="old('experience')" :options="array_combine( array_map('ucfirst' ,\App\Models\Job::$experience) ,\App\Models\Job::$experience )"/>
        </div>
        <div>
          <x-label for="category" :required="true">Category</x-label>
          <x-radio-group :all-option="false" name="category" :value="old('category')" :options="\App\Models\Job::$category"/>
        </div>

      </div>

      <button type="submit" class="button w-full">Create Listing</button>

    </form>

  </x-card>

</x-layout>