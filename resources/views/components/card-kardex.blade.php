<div class="w-full bg-gray-200 rounded-md shadow-sm p-4 flex flex-col gap-2 mb-3">

    <x-card-kardex-detail label="{{__('N° transition')}}" value="{{$id}}" readonly />

    <div class="flex lg:flex-row flex-col lg:items-center items-start gap-2 lg:justify-between justify-start w-full">
        <x-card-kardex-detail label="{{__('Date')}}" value="{{$date}}" two date readonly="{{$readonly}}" />
        <x-card-kardex-detail class="w-full lg:max-w-3xl max-w-none" label="{{__('Detail')}}" value="{{$detail}}" full two readonly="{{$readonly}}" autofocus />
    </div>

</div>