<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          @yield('title','Dashboard')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg p-4 mt-9 shadow-lg">
                @yield('content')
            </div>
        </div>
    </div>
</x-app-layout>
