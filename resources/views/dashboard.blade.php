<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    {{ __("You're logged in!") }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="flex">
        <aside class="w-64 bg-gray-900 text-white min-h-screen">
            <nav class="mt-4 space-y-2">
                <a href="{{route('dashboard')}}" class="block px-4 py-2 hover:bg-gray-700 rounded">
                    Dashboard
                </a>
                <a href="{{route('products')}}" class="block px-4 py-2 hover:bg-gray-700 rounded">
                    Products
                </a>
            </nav>
        </aside>
    </div>
</x-app-layout>
