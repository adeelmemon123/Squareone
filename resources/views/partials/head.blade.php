<head>
    <script src="{{ url('ckeditor/ckeditor.js') }}"></script>
    <!-- <script src="{{ url('dropzone/dropzone.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('dropzone/dropzone.min.css') }}" type="text/css" /> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container--default .select2-selection--single {
            height: 42px;
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        @media (min-width: 768px) {
            .select2-container--default .select2-selection--single {
                width: 400px;
            }
        }

        @media (min-width: 992px) {
            .select2-container--default .select2-selection--single {
                width: 380px;
            }
        }

        @media (min-width: 1200px) {
            .select2-container--default .select2-selection--single {
                width: 600px;
            }
        }
    </style>

@vite('resources/css/app.css', 'resources/js/app.js')



    @php
        $currentPath = ucfirst(Str::afterLast(Request::path(), '/'));
    @endphp

    @if (isset($site_title))
        <title>{{ $site_title }} | {{ $currentPath }} @yield('title', '')</title>
    @else
        <title>Personal Profile | @yield('title', '')</title>
    @endif

    <link rel="icon" href="{{ asset('images/main.png') }}" type="image/x-icon">
</head>
