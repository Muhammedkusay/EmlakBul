@extends('layouts.main', ['user' => $user ?? '', 'title' => $publisher->kurum_adi ?? $publisher->ad])

@section('content')

<div class="w-full md:w-3/4 min-h-96 p-4 mx-auto">
    <div class="flex flex-col lg:flex-row py-5">
        <div class="w-52 h-52 flex items-center justify-center mb-4 mx-auto sm:mx-0 sm:mr-12 overflow-hidden rounded-full bg-white border border-gray-300">
            @if($publisher->kullanici_tipi == 'bireysel')
                <img class="w-fit h-fit" src="{{ asset('images/default_profile_picture.png') }}" alt="profile_picture">
            @else
                <img class="w-fit h-fit" src="{{ asset('storage/'. $publisher->avatar) }}" alt="profile_picture">
            @endif
        </div>
        
        <div class="w-full lg:w-1/3">
            @if($publisher->kullanici_tipi == 'bireysel')
                {{-- ad, soyad --}}
                <div class="grid sm:grid-cols-2 grid-cols-1 gap-4">
                    <div class="mb-5">
                        <label for="ad" class="block mb-2 text-sm font-medium text-gray-900">Ad</label>
                        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $publisher->ad }}</p>
                    </div>
                    <div class="mb-5">
                        <label for="soyad" class="block mb-2 text-sm font-medium text-gray-900">Soyad</label>
                        <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $publisher->soyad }}</p>
                    </div>
                </div>
            @else
                {{-- kurum adi --}}
                <div class="mb-5">
                    <label for="kurum_adi" class="block mb-2 text-sm font-medium text-gray-900">Kurum Adı</label>
                    <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $publisher->kurum_adi }}</p>
                </div>
            @endif
    
            {{-- email --}}
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Epostas Adresi</label>
                <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $publisher->email }}</p>
            </div>
    
            {{-- tel --}}
            <div class="mb-0">
                <label for="tel" class="block mb-2 text-sm font-medium text-gray-900">Telefon numarası</label>
                <p class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $publisher->tel ?? 'Numara Eklenmedi' }}</p>
            </div>   
    
        </div>
    
    </div>

    <h3 class="text-4xl font-semibold pt-16">Yayınladığı İlanlar</h3>
    {{-- if posts length is 0 --}}
    @if(count($posts) == 0 && count($lands) == 0)
        <div id="alert-1" class="flex items-center w-full md:w-2/3 p-4 mt-5 mx-auto text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 border border-blue-500" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm">
                Hiçbir ilan bulunmamıştır
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 py-12">
            {{-- list cards --}}
            @forEach($posts as $i => $post)
                {{-- card --}}
                <div class="w-full sm:max-w-sm bg-white border border-gray-200 overflow-hidden rounded-lg shadow">

                    {{-- gallery --}}
                    <div id="default-carousel" class="relative" data-carousel="static">
                        {{-- images --}}
                        <div class="overflow-hidden relative h-52 md:h-60 rounded-lg">
                            @forEach($post_images[$i] as $image)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl">
                                        first slide
                                    </span>
                                    <img src="{{asset('storage/'. $image->image)}}" alt="" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                                </div>
                            @endforEach
                        </div>
                        {{-- buttons --}}
                        <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                            @for($btn = 1; $btn <= count($post_images[$i]); $btn++)
                                <button class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                            @endfor
                        </div>
                        {{-- previous & next --}}
                        <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                                <i class="fa-solid fa-chevron-left"></i>
                            </span>
                            <span class="hidden">previous</span>
                        </button>
                        <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
                            <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                                <i class="fa-solid fa-chevron-right"></i>
                            </span>
                            <span class="hidden">next</span>
                        </button>
                    </div>

                    {{-- info --}}
                    <div class="p-5 flex flex-col justify-between">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $post->title }}</h5>
                        <p class="mb-6 h-20 font-normal text-gray-500 overflow-y-auto">{{ $post->description }}</p>
                        <div class="mb-4 font-normal text-gray-700 flex items-center">

                            <div class="flex items-center mr-3 text-nowrap">
                                <i class="fa-solid fa-square mr-2 text-gray-600"></i>
                                <p>{{ $post->net_metrekare }}</p>m<sup>2</sup>
                            </div>
                            
                            @if($post->kategori != 'isyeri')
                                <div class="flex items-center mr-3">
                                    <i class="fa-solid fa-house-chimney mr-2 text-gray-600"></i>
                                    <p class="text-nowrap">{{ $post->oda_sayisi .'+'. $post->salon_sayisi}}</p>
                                </div>
                            @endif

                            <div class="flex items-center mr-3">
                                <i class="fa-solid fa-location-dot mr-2 text-gray-600"></i>
                                <p class="text-nowrap">{{ $post->il .' / '. $post->ilce}}</p>
                            </div>

                        </div>

                        <div class="flex items-center justify-between bottom-0">
                            <a href="{{route('posts.show', $post->id)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Göster
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                            <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900">{{ $post->fiyat }}<span>₺</span></h5>
                        </div>
                    </div>

                </div>
            @endforEach

            {{-- list lands cards --}}
            @forEach($lands as $i => $land)
                {{-- card --}}
                <div class="w-full sm:max-w-sm bg-white border border-gray-200 overflow-hidden rounded-lg shadow">

                    {{-- gallery --}}
                    <div id="default-carousel" class="relative" data-carousel="static">
                        {{-- images --}}
                        <div class="overflow-hidden relative h-52 md:h-60 rounded-lg">
                            @forEach($land_images[$i] as $image)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl">
                                        first slide
                                    </span>
                                    <img src="{{asset('storage/'. $image->image)}}" alt="" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                                </div>
                            @endforEach
                        </div>
                        {{-- buttons --}}
                        <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                            @for($btn = 1; $btn <= count($land_images[$i]); $btn++)
                                <button class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                            @endfor
                        </div>
                        {{-- previous & next --}}
                        <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                                <i class="fa-solid fa-chevron-left"></i>
                            </span>
                            <span class="hidden">previous</span>
                        </button>
                        <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
                            <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                                <i class="fa-solid fa-chevron-right"></i>
                            </span>
                            <span class="hidden">next</span>
                        </button>
                    </div>

                    {{-- info --}}
                    <div class="p-5 flex flex-col justify-between">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $land->title }}</h5>
                        <p class="mb-6 h-20 font-normal text-gray-500 overflow-y-auto">{{ $land->description }}</p>
                        <div class="mb-4 font-normal text-gray-700 flex items-center">

                            <div class="flex items-center mr-3 text-nowrap">
                                <i class="fa-solid fa-square mr-2 text-gray-600"></i>
                                <p>{{ $land->arsa_alani }}</p>m<sup>2</sup>
                            </div>

                            <div class="flex items-center mr-3">
                                <i class="fa-solid fa-location-dot mr-2 text-gray-600"></i>
                                <p class="text-nowrap">{{ $land->il .' / '. $land->ilce}}</p>
                            </div>

                        </div>

                        <div class="flex items-center justify-between bottom-0">
                            <a href="{{route('posts.show', $land->id)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Göster
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                            <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900">{{ $land->fiyat }}<span>₺</span></h5>
                        </div>
                    </div>

                </div>
            @endforEach
        </div>
    @endif

</div>


@endsection