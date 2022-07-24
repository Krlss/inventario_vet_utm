<div class="w-full bg-gray-100 rounded-md shadow-sm p-4 mb-3">
    <div class="grid grid-cols-2 mb-2">
        <div>
            <label>{{__('N° transition')}}: </label>
            <span>{{$id}}</span>
        </div>
    </div>

    <div class="flex items-start justify-start gap-2">
        <label>{{__('Detail')}}{{$readonly ? '' : '*'}}: </label>
        <div class="w-full">
            {{Form::hidden('id', old('id'))}}
            {!! Form::textarea('detail', $kardex ? $kardex->detail : old('detail'), ['class' => 'px-2 py-1 border rounded-md w-full resize-none {{ $readonly ? "bg-gray-50 outline-none cursor-default" : "bg-white" }}', 'rows' => 2, 'readonly' => $readonly ? true : false, 'autofocus' => true, 'required' => true]) !!}
            @if($errors->has('detail'))
            <span class="text-red-500 text-xs">{{$errors->first('detail')}}</span>
            @endif
        </div>
    </div>

</div>