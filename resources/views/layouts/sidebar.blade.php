<div :class="{'md:w-16': !open}" class="min-h-screen bg-green-1000 md:w-16 w-72 hidden md:flex sidebar" x-data="{ open: false }">

    <!-- Open sidebar -->
    <div :class="{'items-center': !open}" class="flex flex-col items-center w-full p-2">


        <!-- hamburger button -->
        <div :class="{'justify-end': open, 'justify-center': !open }" class="flex justify-center w-full">
            <button type="button" @click="open = !open">
                <div :class="{'hidden': open}">
                    <x-icon icon="arrow-right-sidebar" width=25 height=25 viewBox="1024 1024" strokeWidth=0 fill="white" />
                </div>
                <div :class="{'hidden': !open}" class="hidden">
                    <x-icon icon="arrow-left-sidebar" width=25 height=25 viewBox="1024 1024" strokeWidth=0 fill="white" />
                </div>
            </button>
        </div>


        <div class="mt-4 space-y-4 text-white font-medium">
            <a href="{{ route('dashboard') }}" class="flex flex-row items-center">
                <x-icon icon="home-sidebar" width=30 height=30 viewBox="1024 1024" strokeWidth=0 fill="{{ Request::is('/') ? '#FFFF3A' : 'white' }}" />
                <span :class="{'hidden': !open}" class="hidden ml-2  {{ Request::is('/') ? 'text-yellow-navbar' : 'text-white' }}">{{__('Home')}}</span>
            </a>
            <a class="flex flex-row items-center" href="{{ route('dashboard.products-expires') }}">
                <x-icon icon="warning" width=30 height=30 viewBox="1024 1024" strokeWidth=0 fill="white" />
                <span :class="{'hidden': !open}" class="hidden ml-2">{{__('Products for expire')}}</span>
            </a>
        </div>

    </div>
</div>