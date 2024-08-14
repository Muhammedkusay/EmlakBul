@extends('layouts.main', ['user' => $user ?? '', 'title' => 'Ana Sayfa'])

@section('content')

<div class="min-h-svh">
    {{-- search section --}}
    <div class="relative h-full bg-gradient-to-b from-blue-200 from-5% to-95%">

        <h1 class="w-fit text-4xl md:text-5xl font-semibold mx-auto py-6 px-4 md:py-8 lg:py-12 transition-all duration-300"><span id="word-carousel" class="text-blue-600">Ev</span> Bulmaya Hazır mısın?</h1>
        <div class="w-full lg:w-1/2 p-4 mx-auto">
            <h2 class="mb-2 text-lg font-semibold">Hızlı Arama Yapın</h2>
            
            {{-- search --}}
            <form action="{{route('search')}}" method="GET" class="w-full flex relative">
                @csrf
                <div class="w-full flex relative rounded-full shadow-sm border border-slate-300">
                    <input type="text" id="search_input" name="search_input" autocomplete="off" class="w-full py-3 px-4 pl-5 rounded-full focus:border-none border-none focus:ring-0 placeholder-gray-400 bg-white" placeholder="Örnek: Ankara'da kiralık ev">
                    <button type="submit" id="search-btn" aria-label="search" name="search-btn">
                        <i class="fa-solid fa-magnifying-glass absolute top-0 right-0 py-4 pl-6 px-7 rounded-br-full rounded-tr-full hover:bg-gray-100 cursor-pointer"></i>
                    </button>
                </div>
                <div id="search_list" class="absolute w-full top-full bg-white rounded-lg shadow-sm z-50">
                    {{-- suggestions --}}
                </div>
            </form>

            {{-- quick access links --}}
            <ul class="w-fit flex flex-wrap gap-4 mt-5 mx-auto">
                <li>
                    <a href="/search?search_input=konut" name="quick-access-link" class="flex items-center justify-center size-12 shadow-sm text-sm font-medium hover:text-white focus:outline-none bg-white rounded-full hover:bg-purple-500 text-purple-500 border border-purple-500 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        <i class="fa-solid fa-house scale-125"></i>
                    </a>
                    <p class="text-center">Konut</p>
                </li>
                <li>
                    <a href="/search?search_input=isyeri" name="quick-access-link" class="flex items-center justify-center size-12 shadow-sm text-sm font-medium hover:text-white focus:outline-none bg-white rounded-full hover:bg-blue-500 text-blue-500 border border-blue-500 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        <i class="fa-solid fa-building scale-125"></i>
                    </a>
                    <p class="text-center">İşyeri</p>
                </li>
                <li>
                    <a href="/search?search_input=kiralık" name="quick-access-link" class="flex items-center justify-center size-12 shadow-sm text-sm font-medium hover:text-white focus:outline-none bg-white rounded-full hover:bg-teal-500 text-teal-500 border border-teal-500 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        <i class="fa-solid fa-money-bill-wave scale-125"></i>
                    </a>
                    <p class="text-center">kiralık</p>
                </li>
                <li>
                    <a href="/search?search_input=satılık" name="quick-access-link" class="flex items-center justify-center size-12 shadow-sm text-sm font-medium hover:text-white focus:outline-none bg-white rounded-full hover:bg-emerald-500 text-emerald-500 border border-emerald-500 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        <i class="fa-solid fa-key scale-125"></i>
                    </a>
                    <p class="text-center">Satılık</p>
                </li>
                <li>
                    <a href="/search?search_input=arsa" name="quick-access-link" class="flex items-center justify-center size-12 shadow-sm text-sm font-medium hover:text-white focus:outline-none bg-white rounded-full hover:bg-yellow-300 text-yellow-300 border border-yellow-300 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        <i class="fa-solid fa-mountain-sun scale-125"></i>
                    </a>
                    <p class="text-center">Arsa</p>
                </li>
                <li>
                    <a href="/search?search_input=residans" name="quick-access-link" class="flex items-center justify-center size-12 mx-auto shadow-sm text-sm font-medium hover:text-white focus:outline-none bg-white rounded-full hover:bg-orange-500 text-orange-500 border border-orange-500 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        <i class="fa-solid fa-building-user scale-125"></i>
                    </a>
                    <p class="text-center">Residans</p>
                </li>
                <li>
                    <a href="/search?search_input=dükkan" name="quick-access-link" class="flex items-center justify-center size-12 shadow-sm text-sm font-medium hover:text-white focus:outline-none bg-white rounded-full hover:bg-red-500 text-red-500 border border-red-500 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        <i class="fa-solid fa-house-chimney-user scale-125"></i>
                    </a>
                    <p class="text-center">Dükkan</p>
                </li>
            </ul>
        </div>
    </div>

    {{-- new posts --}}
    <div class="w-full lg:w-4/5 mx-auto mt-20">
        <h2 class="text-4xl font-bold pl-5">Yeni ilanlar</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 py-7 lg:py-12 px-5">
            {{-- list cards --}}
            @if(count($posts) != 0)
                @forEach($posts as $i => $post)
                    {{-- card --}}
                    <div class="w-full bg-white border border-gray-200 overflow-hidden rounded-lg shadow">
    
                        {{-- gallery --}}
                        <div id="default-carousel" class="relative" data-carousel="static">
                            {{-- images --}}
                            <div class="overflow-hidden relative h-52 md:h-60 rounded-lg">
                                @forEach($post_images[$i] as $image)
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="{{asset('storage/'. $image->image)}}" alt="" class="block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
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
                            <p class="mb-6 h-12 font-normal text-gray-500 overflow-y-auto">{{ $post->description }}</p>
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
            @endif
        </div>
    </div>

    {{-- card --}}
    <div class="bg-white mt-16 shadow">
        <div class="w-full lg:w-3/5 flex flex-col md:flex-row items-center md:mx-auto">
            <div class="w-full p-4 md:p-7">
                <h3 class="text-3xl md:text-4xl font-semibold text-slate-700">Hiç Beklemeden</h3>
                <h3 class="text-3xl md:text-4xl font-semibold text-blue-700 pb-6">Hemen İlanını Ver</h3>
                <p class="text-slate-600">
                    İstediğiniz emlak ilanını ücretsiz olarak hemen verebilirisiniz. 'Hemen ilan Ver' butonuna tıklayarak ilan formunu doldurabilisiniz.<br>
                    Hesabınız yok mu? 'Üye Ol' butonuna tıklayarak hemen üye olabilirsiniz
                </p>
                <div class="flex gap-2 pt-8">
                    <a href="{{route('posts.create')}}" class="block py-2 px-4 text-[16px] rounded-md shadow text-white bg-blue-700 hover:bg-blue-800">Hemen İlan Ver</a>
                    <a href="{{route('register')}}" class="block py-2 px-4 text-[16px] rounded-md shadow text-slate-600 border border-gray-200 hover:bg-gray-100">Üye Ol</a>
                </div>
            </div>
            <div class="w-4/5">
                <img src="{{URL('images/man_with_phone.png')}}" class="hidden md:block w-full filter grayscale mx-auto md:mx-0" style="user-select: none" alt="img">
            </div>
        </div>
    </div>

    {{-- card --}}
    <div class="w-full relative my-32 px-2">
        <a href="{{route('search-map')}}" class="block w-full lg:w-3/4 mx-auto group/card" target="_blank">
            <img src="{{URL('images/turkey_map.png')}}" class="w-full opacity-10 group-hover/card:opacity-20 transition-opacity duration-150 delay-0" alt="map">
            <p class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-100 text-2xl md:text-5xl text-slate-700 text-center font-semibold">
                Harita Üzerinden Ara
                <i class="fa-solid fa-location-dot fa-bounce text-blue-600 text-xl md:text-5xl pl-3"></i>
            </p>
        </a>
    </div>

    {{-- card --}}
    <div class="w-full lg:w-3/4 mx-auto p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="/search?search_input=istanbul" class="group/city h-44 md:h-auto relative rounded-2xl overflow-hidden shadow-lg">
            <div>
                <img src="{{URL('images/istanbul.jpg')}}" alt="istanbul" class="rounded-2xl group-hover/city:scale-110 transition-all delay-0 duration-150">
            </div>
            <h3 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-5xl font-semibold text-white z-20">İstanbul</h3>
            <div class="absolute w-full h-full top-0 left-0 font-semibold bg-black/20 rounded-2xl z-10"></div>
        </a>
        <a href="/search?search_input=antalya" class="group/city h-44 md:h-auto relative rounded-2xl overflow-hidden shadow-lg">
            <div>
                <img src="{{URL('images/antalya.jpg')}}" alt="antalya" class="rounded-2xl group-hover/city:scale-110 transition-all delay-0 duration-150">
            </div>
            <h3 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-5xl font-semibold text-white z-20">Antalya</h3>
            <div class="absolute w-full h-full top-0 left-0 font-semibold bg-black/20 rounded-2xl z-10"></div>
        </a>
        <a href="/search?search_input=trabzon" class="group/city h-44 md:h-auto relative rounded-2xl overflow-hidden shadow-lg">
            <div>
                <img src="{{URL('images/trabzon.jpg')}}" alt="trabzon" class="rounded-2xl group-hover/city:scale-110 transition-all delay-0 duration-150">
            </div>
            <h3 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-5xl font-semibold text-white z-20">Trabzon</h3>
            <div class="absolute w-full h-full top-0 left-0 font-semibold bg-black/20 rounded-2xl z-10"></div>
        </a>
    </div>


    {{-- card --}}
    <div class="bg-white mt-16 shadow">
        <div class="w-full lg:w-3/5 flex flex-col md:flex-row items-center md:mx-auto">
            <div class="w-full p-4 md:p-7">
                <h3 class="text-3xl md:text-4xl font-semibold text-slate-700">Emlak Kurumunuz mu var?</h3>
                <h3 class="text-3xl md:text-4xl font-semibold text-blue-700 pb-6">Hemen İlan Verin</h3>
                <p class="text-slate-600">
                    İstediğiniz emlak ilanını ücretsiz olarak hemen verebilirisiniz. 'Hemen ilan Ver' butonuna tıklayarak ilan formunu doldurabilisiniz.<br>
                    Hesabınız yok mu? 'Üye Ol' butonuna tıklayarak hemen üye olabilirsiniz
                </p>
                <div class="flex gap-2 pt-8">
                    <a href="{{route('posts.create')}}" class="block py-2 px-4 text-[16px] rounded-md shadow text-white bg-blue-700 hover:bg-blue-800">Hemen İlan Ver</a>
                    <a href="{{route('register')}}" class="block py-2 px-4 text-[16px] rounded-md shadow text-slate-600 border border-gray-200 hover:bg-gray-100">Üye Ol</a>
                </div>
            </div>
            <div class="w-4/5">
                <img src="{{URL('images/house.png')}}" class="hidden md:block w-full filter grayscale mx-auto md:mx-0" style="user-select: none" alt="img">
            </div>
        </div>
    </div>

</div>

<script>
    let words = ['Ev', 'Ofis', 'Arsa', 'Villa', 'Dükkan', 'Konut', 'Çiftlik', 'Tarla']
    $(document).ready(function() {
        let i = 0
        setInterval(() => {
            $('#word-carousel').html(words[i])
            if(i == words.length) i = 0
            else i++
        }, 2000);

        // live search
        $('#search-btn').attr('disabled', 'disabled');
        $('#search_input').on('keyup', function() {
            if($(this).val()) {
                $('#search-btn').removeAttr('disabled');

                var query = $(this).val();
                $.ajax({
                    url:"search-list",
                    type:"GET",
                    data:{"search":query},
                    success:function(data) {
                        $('#search_list').html(data);
                    }
                });
            } else {
                $('#search_list').html("");
                $('#search-btn').attr('disabled', 'disabled');
            }
        });
    });
</script>

@endsection