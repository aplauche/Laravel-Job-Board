{{-- using attributes->class() allows us to pass additional classes to component that will be merged in --}}
{{-- shorthand for attributes->merge(["class" => "example-class-name"]) --}}
<div {{ $attributes->class(["rounded-md border border-slate-300 bg-white p-4 shadow-sm"]) }}>
    {{ $slot }}
</div>