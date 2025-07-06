<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/main.css')
    @vite('resources/css/app.css')
    <title>500</title>
</head>
<body class="bg-white">

    <div class="pt-16 p-5">
        <div class="w-full md:w-1/4 mx-auto grayscale opacity-75">
            <a href="{{URL('/feed')}}">
                <img src="{{URL('images/logo.png')}}" alt="">
            </a>
        </div>
        <div class="text-center pt-10">
            <h1 class="text-5xl pb-3 text-slate-600 font-semibold">Hata 404</h1>
            <h2 class="text-2xl text-slate-400">Sunucu Hatası</h2>
        </div>
        <div class="w-full md:w-1/4 mx-auto pt-5">
            <img src="{{URL('images/error_message.jpg')}}" alt="">
        </div>
    </div>

</body>
</html>