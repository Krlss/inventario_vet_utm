<div {{ $attributes->merge(['class' => "flex  items-center $two ? 'justify-center' : 'justify-start' gap-2 $class"]) }}>
    <span class="font-semibold">{{$label}}: </span>
    <div class="px-4 py-1 bg-white border rounded-md {{ $full ? 'w-full' : '' }}">{{$value}}</div>
</div>