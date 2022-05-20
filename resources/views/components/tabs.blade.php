<li class="{{ Request::is($routeCurrent) ? '' : '' }} mr-1">
    <a class="{{ Request::is($routeCurrent) ? 'font-bold cursor-default' : '' }} bg-white inline-block py-2 px-4" @if(!Request::is($routeCurrent)) href="{{ route($routeTo) }}" @endif>{{$title}}</a>
</li>