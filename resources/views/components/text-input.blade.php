<div class="relative">
    @if ($parentForm)
    <button 
        type="button" 
        @click="$refs['input-{{$name}}'].value=''; $refs['{{$parentForm}}'].submit();"
        class="absolute right-2 top-1/2 -translate-y-1/2"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>          
    </button> 
    @endif



    <input 
    x-ref="input-{{$name}}"
    id="{{ $name }}" 
    type="text" 
    placeholder="{{ $placeholder }}" 
    name="{{ $name }}" 
    value="{{ $value }}"
    class="pr-8 rounded-md w-full border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2"

>
</div>
