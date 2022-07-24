<a href="{{$route}}" class="w-full bg-green-page rounded-md py-2 px-4 text-white mb-2 hover:bg-green-900">
    <div class="flex items-center justify-between space-x-2">
        <div class="flex flex-col overflow-hidden">
            <span class="font-bold text-lg truncate">{{$name}}</span>
            <span class="text-sm truncate">{{$desc}} </span>
        </div>
        <x-icon icon="arrow-right-sidebar" class="mt-1" width=10 height=10 viewBox="1024 1024" strokeWidth=0 fill="white" />
    </div>
</a>