<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="bg-gray-50 dark:bg-gray-800 scrollbar scrollbar-w-3 scrollbar-thumb-rounded-[0.25rem]
        scrollbar-track-slate-200 scrollbar-thumb-gray-400
        dark:scrollbar-track-gray-900 dark:scrollbar-thumb-gray-700">

    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <main class="md:ml-64 h-auto p-2 pt-14">
            @yield('content')
        </main>
    </div>

    @include('partials.scripts')
    @yield('scripts')
</body>
</html>
