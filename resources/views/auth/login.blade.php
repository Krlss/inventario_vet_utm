<x-guest-layout>
    <x-jet-authentication-card>
        <!-- <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot> -->
        <div class="w-full mb-4 text-center">
            <h1 class="font-bold text-green-page leading-none text-base ">SISTEMA DE INVENTARIO Y FARMACIA <br>CLINICA VETERINARIA UTM</h1>
        </div>

        <x-jet-validation-errors class="mb-4 px-5" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 px-5">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="relative px-5">
                <input id="email" class="text-sm mt-1 border border-gray-400 outline-none w-full h-8 pl-12 rounded-md shadow" type="email" name="email" :value="old('email')" required autofocus placeholder="Ingrese su correo" />
                <label for="email" class="absolute left-9 cursor-pointer" style="top: 12px">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.608 12.172C14.608 13.012 14.847 13.347 15.472 13.347C16.865 13.347 17.752 11.572 17.752 8.62C17.752 4.108 14.464 1.948 10.359 1.948C6.13601 1.948 2.29501 4.78 2.29501 10.132C2.29501 15.244 5.65501 18.028 10.815 18.028C12.567 18.028 13.743 17.836 15.542 17.236L15.928 18.843C14.152 19.42 12.254 19.587 10.791 19.587C4.02301 19.587 0.39801 15.867 0.39801 10.131C0.39801 4.347 4.59901 0.411003 10.383 0.411003C16.407 0.411003 19.598 4.011 19.598 8.427C19.598 12.171 18.423 15.027 14.727 15.027C13.046 15.027 11.943 14.355 11.799 12.866C11.367 14.522 10.215 15.027 8.65401 15.027C6.56601 15.027 4.81401 13.418 4.81401 10.179C4.81401 6.915 6.35101 4.899 9.11101 4.899C10.575 4.899 11.487 5.475 11.893 6.387L12.59 5.115H14.606V12.172H14.608V12.172ZM11.657 9.004C11.657 7.685 10.672 7.132 9.85601 7.132C8.96801 7.132 7.98501 7.851 7.98501 9.964C7.98501 11.644 8.72901 12.58 9.85601 12.58C10.648 12.58 11.657 12.076 11.657 10.684V9.004Z" fill="#9CA3AF" />
                    </svg>
                </label>
            </div>

            <div class="mt-4 relative px-5">
                <input id="password" class="text-sm mt-1 border border-gray-400 outline-none w-full h-8 pl-12 rounded-md shadow" type="password" name="password" required autocomplete="current-password" placeholder="Ingrese su contraseña" />
                <label for="password" class="absolute left-9 cursor-pointer" style="top: 12px">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 10.5H9M12.5 8.5V7.5C12.5 7.23478 12.3946 6.98043 12.2071 6.79289C12.0196 6.60536 11.7652 6.5 11.5 6.5H1.5C1.23478 6.5 0.98043 6.60536 0.792893 6.79289C0.605357 6.98043 0.5 7.23478 0.5 7.5V13.5C0.5 13.7652 0.605357 14.0196 0.792893 14.2071C0.98043 14.3946 1.23478 14.5 1.5 14.5H11.5C11.7652 14.5 12.0196 14.3946 12.2071 14.2071C12.3946 14.0196 12.5 13.7652 12.5 13.5V12.5V8.5ZM12.5 8.5H8.5C7.96957 8.5 7.46086 8.71071 7.08579 9.08579C6.71071 9.46086 6.5 9.96957 6.5 10.5C6.5 11.0304 6.71071 11.5391 7.08579 11.9142C7.46086 12.2893 7.96957 12.5 8.5 12.5H12.5V8.5ZM12.5 8.5C13.0304 8.5 13.5391 8.71071 13.9142 9.08579C14.2893 9.46086 14.5 9.96957 14.5 10.5C14.5 11.0304 14.2893 11.5391 13.9142 11.9142C13.5391 12.2893 13.0304 12.5 12.5 12.5V8.5ZM3.5 6.5V3.5C3.5 2.70435 3.81607 1.94129 4.37868 1.37868C4.94129 0.81607 5.70435 0.5 6.5 0.5C7.29565 0.5 8.05871 0.81607 8.62132 1.37868C9.18393 1.94129 9.5 2.70435 9.5 3.5V6.5H3.5ZM12 10.5H13H12ZM10 10.5H11H10Z" stroke="#9CA3AF" />
                    </svg>
                </label>
            </div>

            <div class="w-full mt-4 px-5">
                <button type="submit" class="w-full h-8 bg-green-page text-white rounded-md font-bold hover:bg-green-900">
                    INGRESAR
                </button>
            </div>
        </form>

        <div class="w-full mt-7 mb-2 px-5 text-center">
            <small>© 2022 Universidad Técnica de Manabí</small>
        </div>
    </x-jet-authentication-card>

    <div class="absolute bottom-5 right-5">
        <img src="{{asset('logo_fci.png')}}" />
    </div>
</x-guest-layout>