<!DOCTYPE html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/favicon.ico') }}">

    <title>ChatBot</title>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js "></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">




    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @livewireStyles
</head>

<body class="h-full">
    <div id="ap" class="min-h-screen bg-gray-100 text-gray-800" x-data="{ openHelp: false }">

        <x-navbar />
        <x-sidebar />
        <x-notification />
        <x-session-msg />
        {{-- <x-pre-loader /> --}}
        <div class="  sm:ml-64  px-3 md:px-10  pb-10 mt-16 pt-10 h-screen overflow-y-auto">
            {{ $slot }}
        </div>
        <div class="sm:ml-64 ">
            <x-footer />
        </div>

    </div>

    <script>
        function logout(e) {
            localStorage.clear();
            e.closest('form').submit();
        }
    </script>




    @livewireScripts
</body>

</html>
