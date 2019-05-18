<html lang="{{ str_replace('_', '-', app() -> getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">
    {{-- Style--}}
    <link rel="stylesheet" href="{{ mix('/css/main.css') }}">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/0.7.4/tailwind.min.css"
    />
</head>
<body class="bg-grey-lighter">
<div id="app">
    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@stack('inline-scripts')
</body>
</html>
