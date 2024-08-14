<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"rel="stylesheet"/>
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        @vite('resources/css/main.css')
        @vite('resources/css/app.css')
        @vite('resources/css/all.min.css')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <title>Emlak Bul | {{ $title }}</title>
      </head>
</head>
<body class="bg-gray-50">
    
    <a href="{{ URL('/feed') }}" class="bg-blue-600 text-white hover:bg-blue-700 w-12 h-12 flex items-center justify-center rounded-full m-4">
        <i class="fa-solid fa-arrow-left"></i>
    </a>

    <a href="{{ URL('/feed') }}" class="w-fit mx-auto block">
        <img src="{{ URL('images/logo.png') }}" alt="Logo" class="max-h-14">
    </a>

    @yield('content')

</body>
</html>