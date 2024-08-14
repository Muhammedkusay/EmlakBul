@extends('layouts.main', ['user' => $user ?? '', 'title' => 'Arama Sonuçları'])

@section('content')

    <div class="min-h-svh w-full lg:w-3/4 mx-auto flex flex-col lg:flex-row relative">

        {{-- back --}}
        <a href="{{route('feed')}}" class="size-[50px] absolute ml-4 left-0 lg:left-1/4 top-4 text-white bg-blue-600 hover:bg-blue-800 rounded-full flex items-center justify-center shadow">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        {{-- filters --}}
        <div class="w-full lg:w-1/4 h-fit bg-white shadow p-4 mt-20 lg:mt-0 rounded-bl-lg rounded-br-lg border border-gray-200">
            <div class="flex items-center justify-between pt-0 lg:pt-2 pb-0 lg:pb-6">
                <h3 class="w-fit lg:mx-auto text-2xl lg:text-3xl font-semibold">Filtreleme</h3>
                <button id="filters-btn" class="lg:hidden size-11 flex items-center justify-center rounded-full bg-gray-200">
                    <i class="fa-solid fa-angle-down"></i>
                </button>
            </div>

            <form id="filters-form" action="{{route('search')}}" method="GET" class="lg:h-[507px] pr-4 pl-1 overflow-y-auto">
                @csrf
                {{-- kategori --}}
                <div class="mb-5">
                    <label class="block mb-2 text-lg font-medium text-gray-900">Kategori</label>
                    <div class="flex items-center mb-3">
                        <input id="default-radio-1" checked type="radio" @if(request()->kategori == "konut") checked @endif value="konut" name="kategori" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="default-radio-1" class="w-full ms-2 text-sm font-medium text-gray-700 cursor-pointer">Konut</label>
                    </div>
                    <div class="flex items-center mb-3">
                        <input id="default-radio-2" type="radio" @if(request()->kategori == "isyeri") checked @endif value="isyeri" name="kategori" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="default-radio-2" class="w-full ms-2 text-sm font-medium text-gray-700 cursor-pointer">İşyeri</label>
                    </div>
                    <div class="flex items-center mb-3">
                        <input id="default-radio-3" type="radio" @if(request()->kategori == "arsa") checked @endif value="arsa" name="kategori" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="default-radio-3" class="w-full ms-2 text-sm font-medium text-gray-700 cursor-pointer">Arsa</label>
                    </div>
                    <div class="flex items-center mb-3">
                        <input id="default-radio-4" type="radio" @if(request()->kategori == "turistik") checked @endif value="turistik" name="kategori" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                        <label for="default-radio-4" class="w-full ms-2 text-sm font-medium text-gray-700 cursor-pointer">Turistik</label>
                    </div>
                </div>

                {{-- yayin_tipi --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Yayın Tipi</label>
                    <select id="yayin_tipi" name="yayin_tipi" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value=""></option>
                        <option value="Kiralık" @if(request()->yayin_tipi == "Kiralık") selected @endif>Kiralık</option>
                        <option value="Satılık" @if(request()->yayin_tipi == "Satılık") selected @endif>Satılık</option>
                    </select>
                </div>

                {{-- il, ilce --}}
                <div class="mb-5 flex gap-2">
                    <div class="w-full">
                        <label for="il" class="block mb-2 text-sm font-medium text-gray-900">İl</label>
                        <select id="il" name="il" class="w-full cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            <option value=""></option>
                        </select>
                    </div>
    
                    <div class="w-full">
                        <label for="ilce" class="block mb-2 text-sm font-medium text-gray-900">İlçe</label>
                        <select id="ilce" name="ilce" class="w-full cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                {{-- oda_sayisi, salon_sayisi --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Oda Sayısı</label>
                    <div class="flex gap-2">
                        <input type="number" name="oda_sayisi" @if(request()->oda_sayisi) value="{{request()->oda_sayisi}}" @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Oda"/>
                        <input type="number" name="salon_sayisi" @if(request()->salon_sayisi) value="{{request()->salon_sayisi}}" @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Salon"/>
                    </div>
                </div>

                {{-- brut_metrekare, net_metrekare --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Alan m<sup>2</sup></label>
                    <div class="flex gap-2">
                        <input type="number" name="brut_metrekare"  @if(request()->brut_metrekare) value="{{request()->brut_metrekare}}" @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Brüt"/>
                        <input type="number" name="net_metrekare"  @if(request()->net_metrekare) value="{{request()->net_metrekare}}" @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Net"/>
                    </div>
                </div>

                {{-- esya_durumu --}}
                <div class="mb-5">
                    <label for="esya_durumu" class="block mb-2 text-sm font-medium text-gray-900">Eşya Durumu</label>
                    <select id="esya_durumu" name="esya_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value=""></option>
                        <option value="Eşyalı" @if(request()->esya_durumu == "Eşyalı") selected @endif>Eşyalı</option>
                        <option value="Eşyasız" @if(request()->esya_durumu == "Eşyasız") selected @endif>Eşyasız</option>
                    </select>
                </div>

                {{-- isitma_tipi --}}
                <div class="mb-5">
                    <label for="isitma_tipi" class="block mb-2 text-sm font-medium text-gray-900">Isıtma Tipi</label>
                    <select id="isitma_tipi" name="isitma_tipi" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value=""></option>
                        <option value="Merkezi Isıtma"  @if(request()->isitma_tipi == "Merkezi Isıtma") selected @endif>Merkezi Isıtma</option>
                        <option value="Bireysel Isıtma"  @if(request()->isitma_tipi == "Bireysel Isıtma") selected @endif>Bireysel Isıtma</option>
                        <option value="Yerden Isıtma"  @if(request()->isitma_tipi == "Yerden Isıtma") selected @endif>Yerden Isıtma</option>
                        <option value="Radyatör Isıtma"  @if(request()->isitma_tipi == "Radyatör Isıtma") selected @endif>Radyatör Isıtma</option>
                        <option value="Jeotermal Isıtma"  @if(request()->isitma_tipi == "Jeotermal Isıtma") selected @endif>Jeotermal Isıtma</option>
                        <option value="Güneş Enerjisi ile Isıtma"  @if(request()->isitma_tipi == "Güneş Enerjisi ile Isıtma") selected @endif>Güneş Enerjisi ile Isıtma</option>
                        <option value="Elektrikli Isıtma"  @if(request()->isitma_tipi == "Elektrikli Isıtma") selected @endif>Elektrikli Isıtma</option>
                        <option value="Isı Pompası"  @if(request()->isitma_tipi == "Isı Pompası") selected @endif>Isı Pompası</option>
                        <option value="Soba Isıtma"  @if(request()->isitma_tipi == "Soba Isıtma") selected @endif>Soba Isıtma</option>
                        <option value="Şömine Isıtma"  @if(request()->isitma_tipi == "Şömine Isıtma") selected @endif>Şömine Isıtma</option>
                    </select>
                </div>

                {{-- manzara --}}
                <div class="konut arsa mb-5">
                    <label for="manzara" class="block mb-2 text-sm font-medium text-gray-900">Manzara</label>
                    <select id="manzara" name="manzara" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value=""></option>
                        <option value="Manzara Yok"  @if(request()->manzara == "Manzara Yok") selected @endif>Manzara Yok</option>
                        <option value="Deniz Manzarası"  @if(request()->manzara == "Deniz Manzarası") selected @endif>Deniz Manzarası</option>
                        <option value="Dağ Manzarası"  @if(request()->manzara == "Dağ Manzarası") selected @endif>Dağ Manzarası</option>
                        <option value="Orman Manzarası"  @if(request()->manzara == "Orman Manzarası") selected @endif>Orman Manzarası</option>
                        <option value="Şehir Manzarası"  @if(request()->manzara == "Şehir Manzarası") selected @endif>Şehir Manzarası</option>
                    </select>
                </div>

                {{-- kullanim_durumu --}}
                <div class="mb-5">
                    <label for="kullanim_durumu" class="block mb-2 text-sm font-medium text-gray-900">Kullanım Durumu</label>
                    <select id="kullanim_durumu" name="kullanim_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value=""></option>
                        <option value="Boş"  @if(request()->kullanim_durumu == "Boş") selected @endif>Boş</option>
                        <option value="Dolu"  @if(request()->kullanim_durumu == "Dolu") selected @endif>Dolu</option>
                        <option value="Yapım Aşamasında" @if(request()->kullanim_durumu == "Yapım Aşamasında") selected @endif>Yapım Aşamasında</option>
                        <option value="Yeni Bina" @if(request()->kullanim_durumu == "Yeni Bina") selected @endif>Yeni Bina</option>
                        <option value="Yenilenmiş"  @if(request()->kullanim_durumu == "Yenilenmiş") selected @endif>Yenilenmiş</option>
                        <option value="Tadilat Gerektirir" @if(request()->kullanim_durumu == "Tadilat Gerektirir") selected @endif>Tadilat Gerektirir</option>
                    </select>
                </div>

                {{-- hasar_durumu --}}
                <div class="mb-5">
                    <label for="hasar_durumu" class="block mb-2 text-sm font-medium text-gray-900">Hasar Durumu</label>
                    <select id="hasar_durumu" name="hasar_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value=""></option>
                        <option value="Hasarsız" @if(request()->hasar_durumu == "Hasarsız") selected @endif>Hasarsız</option>
                        <option value="Küçük Hasarlı" @if(request()->hasar_durumu == "Küçük Hasarlı") selected @endif>Küçük Hasarlı</option>
                        <option value="Orta Derecede Hasarlı" @if(request()->hasar_durumu == "Orta Derecede Hasarlı") selected @endif>Orta Derecede Hasarlı</option>
                        <option value="Ağır Hasarlı" @if(request()->hasar_durumu == "Ağır Hasarlı") selected @endif>Ağır Hasarlı</option>
                        <option value="Onarım Aşamasında" @if(request()->hasar_durumu == "Onarım Aşamasında") selected @endif>Onarım Aşamasında</option>
                    </select>
                </div>

                {{-- guvenlik --}}
                <div class="mb-5">
                    <label for="guvenlik" class="block mb-2 text-sm font-medium text-gray-900">Güvenlik</label>
                    <select id="guvenlik" name="guvenlik" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value=""></option>
                        <option value="Yok" @if(request()->guvenlik == "Yok") selected @endif>Yok</option>
                        <option value="24 Saat Güvenlik" @if(request()->guvenlik == "24 Saat Güvenlik") selected @endif>24 Saat Güvenlik</option>
                        <option value="CCTV" @if(request()->guvenlik == "CCTV") selected @endif>CCTV</option>
                    </select>
                </div>

                {{-- asansor --}}
                <div class="mb-5">
                    <label for="asansor" class="block mb-2 text-sm font-medium text-gray-900">Asansör</label>
                    <select id="asansor" name="asansor" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value=""></option>
                        <option value="Yok" @if(request()->asansor == "Yok") selected @endif>Yok</option>
                        <option value="Var" @if(request()->asansor == "Var") selected @endif>Var</option>
                    </select>
                </div>

                {{-- otopark --}}
                <div class="mb-5">
                    <label for="otopark" class="block mb-2 text-sm font-medium text-gray-900">Otopark</label>
                    <select id="otopark" name="otopark" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value=""></option>
                        <option value="Yok" @if(request()->otopark == "Yok") selected @endif>Yok</option>
                        <option value="Var" @if(request()->otopark == "Var") selected @endif>Var</option>
                        <option value="Kapalı Otopark" @if(request()->otopark == "Kapalı Otopark") selected @endif>Kapalı Otopark</option>
                    </select>
                </div>

                {{-- fiyat --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Fiyat ₺</label>
                    <div class="flex gap-2">
                        <input type="number" name="min_fiyat" @if(request()->min_fiyat) value={{request()->min_fiyat}} @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Min"/>
                        <input type="number" name="max_fiyat" @if(request()->max_fiyat) value={{request()->max_fiyat}} @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Max"/>
                    </div>
                </div>
                
                {{-- submit --}}
                <button type="submit" name="filter_submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Sonuçları Listele</button>

            </form>

        </div>

        <div class="w-full lg:w-3/4">
            {{-- search section --}}
            <div class="flex items-center justify-end p-4">
                {{-- map search --}}
                <a href="search/map?il={{$posts[0]->il ?? $lands[0]->il ?? ''}}" target="_blank" class="bg-white py-3 px-4 mr-2 lg:mr-4 shadow-sm rounded-full border border-slate-300 hover:bg-gray-100">
                    <i class="fa-solid fa-map-location-dot text-lg text-slate-700"></i><span class="hidden lg:inline ml-3 text-gray-700">Harita</span>
                </a>
                {{-- search bar --}}
                <form action="{{route('search')}}" method="GET" class="w-full lg:w-1/2 flex relative">
                    @csrf
                    <div class="w-full flex relative rounded-full shadow-sm border border-slate-300">
                        <input type="text" id="search_input" name="search_input" @if(request()->search_input) value="{{request()->search_input}}" @endif autocomplete="off" class="w-full py-3 px-4 pl-5 rounded-full focus:border-none border-none focus:ring-0 placeholder-gray-400 bg-white" placeholder="Arama Yap">
                        <button type="submit" id="search-btn" aria-label="search" name="search">
                            <i class="fa-solid fa-magnifying-glass absolute top-0 right-0 py-4 pl-6 px-7 rounded-br-full rounded-tr-full hover:bg-gray-100 cursor-pointer"></i>
                        </button>
                    </div>
                    <div id="search_list" class="absolute w-full top-full bg-white rounded-lg shadow-sm z-50">
                        {{-- suggestions --}}
                    </div>
                </form>
            </div>

            {{-- if posts length is 0 --}}
            @if(count($posts) == 0 && count($lands) == 0)
                <div class="w-full lg:w-1/2 lg:mx-auto mx-4 mt-10 flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-500" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        Hiç bir ilan bulunmamıştır
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 py-7 lg:py-12 px-5">
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
                    @if(count($lands) != 0)
                        {{-- list lands cards --}}
                        @forEach($lands as $i => $land)
                            {{-- card --}}
                            <div class="w-full bg-white border border-gray-200 overflow-hidden rounded-lg shadow">

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
                                    <p class="mb-6 h-12 font-normal text-gray-500 overflow-y-auto">{{ $land->description }}</p>
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
                    @endif
                </div>
            @endif
        </div>

    </div>

    @vite('resources/js/cities_fetch.js')
    <script>
        $(document).ready(function() {
    
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

            // filters expand and compress
            var rotation = 0;
            let width = $(window).width();
            
            if(width <= 1025) {
                $('#filters-form').slideUp();
                $('#filters-btn').click(function() {
                    $('#filters-form').toggle(300);
                    rotation += 180;
                    $(this).rotate(rotation);
                });

                jQuery.fn.rotate = function(degrees) {
                    $(this).css({'transform' : 'rotate('+ degrees +'deg)'});
                    return $(this);
                };
            } 
            else $('#filters-form').slideDown();

        });
    </script>
    

@endsection
