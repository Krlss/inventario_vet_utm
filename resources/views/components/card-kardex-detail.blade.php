<div {{ $attributes->merge(['class' => "flex  items-center $two ? 'justify-center' : 'justify-start' gap-2 $class"]) }}>
    <span class="font-semibold">{{$label}}: </span>
    <input value="{{$date ? date('Y-m-d',strtotime($value)) : $value}}" max="{{date('Y-m-d')}}" type="{{ $date ? 'date' : 'text' }}" @if($readonly) readonly @endif class="px-2 py-1 border rounded-md {{ $full ? 'w-full' : '' }} {{ $readonly ? 'outline-none cursor-default bg-gray-100 ' : 'bg-white'}} " @if($autofocus) autofocus @endif />
</div>