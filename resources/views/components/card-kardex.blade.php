<div class="w-full bg-gray-100 rounded-md shadow-sm p-4 mb-3">
    <div class="grid grid-cols-2 mb-2">
        <div>
            <label>{{__('N° transition')}}: </label>
            <span>{{$id}}</span>
        </div>

        <div class="flex items-center justify-start gap-2">
            <label>{{__('Date')}}{{$readonly ? '' : '*'}}: </label>
            <div class="flex flex-col">
                <input max="{{date('Y-m-d')}}" value="{{date('Y-m-d',strtotime($date))}}" type="date" class="px-2 py-1 border rounded-md {{ $readonly ? 'bg-gray-50 outline-none' : 'bg-white' }}" @if($readonly) readonly @endif name="created_at" id="created_at" />
                @if($errors->has('created_at'))
                <span class="text-red-500 text-xs italic">{{$errors->first('created_at')}}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="flex items-start justify-start gap-2">
        <label>{{__('Detail')}}{{$readonly ? '' : '*'}}: </label>
        <div class="w-full">
            <textarea name="detail" id="detail" class="px-2 py-1 border rounded-md w-full resize-none {{ $readonly ? 'bg-gray-50 outline-none cursor-default' : 'bg-white' }}" @if($readonly) readonly @endif autofocus>{{$detail}}</textarea>
            @if($errors->has('detail'))
            <span class="text-red-500 text-xs italic">{{$errors->first('detail')}}</span>
            @endif
        </div>
    </div>

</div>