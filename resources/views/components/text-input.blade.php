<div class="relative">

    @if ('text-area' !== $type)    
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
            type={{$type}} 
            placeholder="{{ $placeholder }}" 
            name="{{ $name }}" 
            value="{{ old($name, $value) }}"
            @class([
                'rounded-md w-full border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2', 
                'pr-8' => $parentForm,
                'ring-slate-300' => !$errors->has($name),
                'ring-red-300' => $errors->has($name)
            ])
        >
    @else
        <textarea
            id="{{ $name }}"
            name="{{ $name }}" 
            @class([
                'rounded-md w-full border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2', 
                'pr-8' => $parentForm,
                'ring-slate-300' => !$errors->has($name),
                'ring-red-300' => $errors->has($name)
            ])
        >
            {{ old($name, $value) }}
        </textarea> 
    @endif


    @error($name)
        <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
    @enderror

</div>
