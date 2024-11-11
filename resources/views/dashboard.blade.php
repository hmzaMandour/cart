@vite(['resources/css/app.css', 'resources/js/app.js'])
<div>
    @include('layouts.navigation')

    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}


    <div class="flex ">
        @include('layouts.sidebar')
        <div class="py-12 flex items-center justify-center m-auto >
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="text-6xl p-10 font-bold">Hello {{ Auth::user()->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
