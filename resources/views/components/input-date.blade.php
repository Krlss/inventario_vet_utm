<div class="flex flex-col justify-center items-start">
    <label class="font-bold mr-2">{{$label}}</label>
    <input id={{$element}} class="bg-gray-200 border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-green-900 filter-select" name="{{$element}}" type="date" max="{{date('Y-m-d')}}" />
</div>