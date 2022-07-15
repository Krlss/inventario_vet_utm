<div class="flex flex-col w-full md:max-w-sm max-w-none">
    <label for="{{ $element }}" class="font-bold">{{ $label }}</label>
    <select id="{{ $element }}" name="{{ $element }}" autocomplete="country-name"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 ">
        <option  value="0">Todos</option>
        @foreach ($dates as $date)
            <option value="{{$date}}">{{ ucwords($date) }}</option>
        @endforeach

    </select>
</div>
