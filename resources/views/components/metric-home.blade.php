<a @if($url) href="{{$url}}" @endif class="">
    <div class="border border-gray-400 bg-white rounded-lg shadow-sm px-4 py-2 flex items-center justify-between space-x-2">
        <div class="flex flex-col overflow-hidden">
            <span class="text-md font-bold truncate">{{$title}}</span>
            <span class="font-medium truncate">{{shortenNumber($value)}}</span>
        </div>
        @if($url)
        <x-icon icon="arrow-right-sidebar" class="mt-1" width=10 height=10 viewBox="1024 1024" strokeWidth=0 fill="black" />
        @endif
    </div>
</a>