<li class="{{ Request::is($routeCurrent) ? '' : '' }} md:w-full w-auto">
    <a class="{{ Request::is($routeCurrent) ? 'font-bold cursor-default bg-green-page text-white' : 'hover:bg-gray-100 hover:text-black' }} text-black inline-block py-2 px-4 hover:no-underline w-full" @if(!Request::is($routeCurrent)) href="{{ route($routeTo) }}" @endif>{{$title}}</a>
</li>