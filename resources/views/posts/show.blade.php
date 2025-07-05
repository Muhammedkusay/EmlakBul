@extends('layouts.main', ['user' => $user ?? '', 'title' => $post->title])

@section('content')

    <div class="w-full md:w-3/4 p-4 mx-auto flex flex-col lg:flex-row">
        {{-- post --}}
        <div class="w-full lg:w-3/4 shadow-sm bg-white border border-gray-200 rounded-xl">

            {{-- gallery --}}
            <div id="default-carousel" class="relative" data-carousel="static">
                {{-- images --}}
                <div class="overflow-hidden relative h-52 md:h-72 rounded-lg">
                    @forEach($images as $image)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{asset('storage/'. $image->image)}}" alt="" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2">
                        </div>
                    @endforEach
                </div>
                {{-- buttons --}}
                <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                    @for($btn = 1; $btn <= count($images); $btn++)
                        <button class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    @endfor
                </div>
                {{-- fullscreen --}}
                <button id="fullscreen-btn" type="button" class="flex absolute bottom-0 right-0 z-40 justify-center items-center p-4 h-fit cursor-pointer group focus:outline-none">
                    <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-black/50 hover:bg-black/30 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                        <i class="fa-solid fa-expand text-white"></i>
                    </span>
                    <span class="hidden">fullscreen</span>
                </button>
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

            <div class="p-4 pt-8">
                {{-- post info --}}
                <div class="flex flex-wrap items-center justify-between pb-3">
                    <h1 class="text-3xl font-semibold">{{$post->title}}</h1>
                    <p class="text-3xl font-semibold">{{$post->fiyat}}₺</p>
                </div>
                <h1 class="text-slate-500">{{$post->description}}</h1>

                {{-- features --}}
                <div class="pt-8">
                    @if($post->kategori == 'konut' || $post->kategori == 'turistik')
                        <h2 class="text-2xl font-semibold mb-5">Konut Özellikeri</h2>
                    @elseif($post->kategori == 'arsa')
                        <h2 class="text-2xl font-semibold mb-5">Arsanın Özellikeri</h2>
                    @elseif($post->kategori == 'isyeri')
                        <h2 class="text-2xl font-semibold mb-5">İşyeri Özellikeri</h2>
                    @endif    

                    {{-- features table --}}
                    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <tbody>
                                <tr class="odd:bg-white even:bg-gray-50 border-b">
                                    <th scope="row" class="w-1/2 px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        İlan No
                                    </th>
                                    <td class="px-6 py-4">{{$post['id']}}</td>
                                </tr>
                                <tr class="odd:bg-white even:bg-gray-50 border-b">
                                    <th scope="row" class="w-1/2 px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Yayınlama Tarihi
                                    </th>
                                    <td class="px-6 py-4">{{$post['created_at']}}</td>
                                </tr>
                                <tr class="odd:bg-white even:bg-gray-50 border-b">
                                    <th scope="row" class="w-1/2 px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Yayın Tipi
                                    </th>
                                    <td class="px-6 py-4">{{$post['yayin_tipi']}}</td>
                                </tr>
                                <tr class="odd:bg-white even:bg-gray-50 border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        Emlak Türü
                                    </th>
                                    <td class="px-6 py-4">{{$post['emlak_turu']}}</td>
                                </tr>
                                @if($post->kategori == 'konut' || $post->kategori == 'turistik')
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Brüt Metrekare
                                        </th>
                                        <td class="px-6 py-4">{{$features['brut_metrekare']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Net Metrekare
                                        </th>
                                        <td class="px-6 py-4">{{$features['net_metrekare']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Oda Sayısı
                                        </th>
                                        <td class="px-6 py-4">{{$features['oda_sayisi'] . ' + ' . $features['salon_sayisi']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Banyo Sayısı
                                        </th>
                                        <td class="px-6 py-4">{{$features['banyo_sayisi']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Bulunduğu Kat
                                        </th>
                                        <td class="px-6 py-4">{{$features['kat']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Isıtma Tipi
                                        </th>
                                        <td class="px-6 py-4">{{$features['isitma_tipi']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Eşya Durumu
                                        </th>
                                        <td class="px-6 py-4">{{$features['esya_durumu']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Manzara
                                        </th>
                                        <td class="px-6 py-4">{{$features['manzara']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Balkon
                                        </th>
                                        <td class="px-6 py-4">{{$features['balkon']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Teras
                                        </th>
                                        <td class="px-6 py-4">{{$features['teras']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Cephe
                                        </th>
                                        <td class="px-6 py-4">{{$features['cephe']}}</td>
                                    </tr>
                                @elseif($post->kategori == 'isyeri')
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Brüt Metrekare
                                        </th>
                                        <td class="px-6 py-4">{{$features['brut_metrekare']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Net Metrekare
                                        </th>
                                        <td class="px-6 py-4">{{$features['net_metrekare']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Bulunduğu Kat
                                        </th>
                                        <td class="px-6 py-4">{{$features['kat']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Isıtma Tipi
                                        </th>
                                        <td class="px-6 py-4">{{$features['isitma_tipi']}}</td>
                                    </tr>
                                @elseif($post->kategori == 'arsa')
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Arsa Alanı
                                        </th>
                                        <td class="px-6 py-4">{{$land['arsa_alani']}}m<sup>2</sup></td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            İmar Durum
                                        </th>
                                        <td class="px-6 py-4">{{$land['imar_durumu']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Yol Durum
                                        </th>
                                        <td class="px-6 py-4">{{$land['yol_durumu']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Altyapı Durum
                                        </th>
                                        <td class="px-6 py-4">{{$land['altyapi_durumu']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Arazi Eğimi
                                        </th>
                                        <td class="px-6 py-4">{{$land['arazi_egimi']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Manzara
                                        </th>
                                        <td class="px-6 py-4">{{$land['manzara']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Hukuki Durumu
                                        </th>
                                        <td class="px-6 py-4">{{$land['hukuki_durumu']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Pazarlık Durumu
                                        </th>
                                        <td class="px-6 py-4">{{$land['pazarlik_durumu']}}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- building table --}}
                    @if($post->kategori == 'konut' || $post->kategori == 'turistik' || $post->kategori == 'isyeri')
                        <h2 class="text-2xl font-semibold mt-10 mb-5">Bina Özellikeri</h2>
                        <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <tbody>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="w-1/2 px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Bina Yaşı
                                        </th>
                                        <td class="px-6 py-4">{{$building['bina_yasi']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Kat Sayısı
                                        </th>
                                        <td class="px-6 py-4">{{$building['kat_sayisi']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Kullanım Durumu
                                        </th>
                                        <td class="px-6 py-4">{{$building['kullanim_durumu']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Hasar Durumu
                                        </th>
                                        <td class="px-6 py-4">{{$building['hasar_durumu']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Güvenlik
                                        </th>
                                        <td class="px-6 py-4">{{$building['guvenlik']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Asansör
                                        </th>
                                        <td class="px-6 py-4">{{$building['asansor']}}</td>
                                    </tr>
                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            Otopark
                                        </th>
                                        <td class="px-6 py-4">{{$building['otopark']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>

                {{-- location --}}
                <div>
                    <h2 class="text-2xl font-semibold mt-20 mb-5">Konum ve Adres Bilgileri</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p>İl</p>
                            <p class="p-3 rounded-lg bg-gray-100 mb-2">{{ $location->il }}</p>
                        </div>
                        <div>
                            <p>İlce</p>
                            <p class="p-3 rounded-lg bg-gray-100 mb-2">{{ $location->ilce }}</p>
                        </div>
                        <div>
                            <p>Mahalle</p>
                            <p class="p-3 rounded-lg bg-gray-100 mb-2">{{ $location->mahalle }}</p>
                        </div>
                    </div>
                    <div class="mb-4 mt-2">
                        <p>Adres</p>
                        <p class="p-3 rounded-lg bg-gray-100 mt-2">{{ $location->adres }}</p>
                    </div>

                    <div class="w-full rounded-xl overflow-hidden shadow-sm border border-gray-100">
                        <div id="location_map"></div>
                    </div>
                    <p id="location_lat" class="hidden">{{$location->lat}}</p>
                    <p id="location_lng" class="hidden">{{$location->lng}}</p>
                </div>

                {{-- contact info --}}
                <h2 class="text-2xl font-semibold mt-20 mb-5">İletişim Bilgileri</h2>
                <div class="flex flex-wrap">
                    <div class="mr-3">
                        <p>Tel</p>
                        <div class="flex items-center">
                            <i class="fa-solid fa-phone pr-0 p-4 text-green-400 bg-gray-100 rounded-tl-lg rounded-bl-lg"></i>
                            <p class="copy-text-1 mt-2 p-3 pr-4 bg-gray-100 mb-2">{{$post->tel_1 ?? 'Numara Bulunmadı'}}</p>
                            <button class="copy-btn-1 w-12 h-12 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-tr-lg rounded-br-lg cursor-pointer">
                                <i class="fa-regular fa-clipboard"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <p>Tel 2</p>
                        <div class="flex items-center">
                            <i class="fa-solid fa-phone pr-0 p-4 text-green-400 bg-gray-100 rounded-tl-lg rounded-bl-lg"></i>
                            <p class="copy-text-2 mt-2 p-3 bg-gray-100 mb-2">{{$post->tel_2 ?? 'Numara Bulunmadı'}}</p>
                            <button @if(!$post->tel_2) disabled @endif class="copy-btn-2 copy-text w-12 h-12 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-tr-lg rounded-br-lg cursor-pointer">
                                <i class="fa-regular fa-clipboard"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="w-full h-fit lg:w-1/4">
            {{-- publisher --}}
            <div class="w-full p-4 pb-5 ml-0 mt-4 lg:ml-4 lg:mt-0 bg-white border border-gray-200 rounded-xl">
                <div class="flex flex-row lg:flex-col flex-wrap items-center justify-between">
                    
                    <div class="w-24 h-24 bg-slate-200 flex items-center justify-center rounded-full overflow-hidden shadow-sm">
                        @if($publisher->kullanici_tipi == 'bireysel')
                            <img class="w-fit h-fit" src="{{ asset('images/default_profile_picture.png') }}" alt="profile_picture">
                        @else
                            <img class="w-fit h-fit" src="{{ asset('storage/'. $publisher->avatar) }}" alt="profile_picture">
                        @endif
                    </div>
                    <div class="sm:pt-0 lg:pt-4">
                        @if($publisher->kullanici_tipi == 'bireysel')
                            <p class="text-lg font-semibold">{{ $publisher->ad . ' ' . $publisher->soyad }}</p>
                        @else
                            <p class="text-lg font-semibold">{{ $publisher->kurum_adi }}</p>
                        @endif
                            <p class="text-slate-500">{{ $publisher->email }}</p>
                        <p class="pt-2"><i class="fa-solid fa-phone pr-2 text-green-400"></i> {{ $publisher->tel ?? $post->tel_1 }}</p>
                    </div>
                
                </div>
                <a href="{{route('profile.show', $publisher)}}" class="w-full block text-center text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4">Profili Göster</a>
            </div>

            {{-- list --}}
            <div class="w-full ml-0 mt-4 lg:ml-4">
                {{-- add to favorite --}}
                @if($favorite_post)
                    <a @auth href="{{route('favorites.delete', [$user->id, $post->id])}}" @endauth href="{{route('login.get')}}" @guest @endguest class="favorite-btn w-full flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                        <div class="favorite-heart-2 text-2xl mr-4 mt-1"><i class="fa-solid fa-heart text-red-600"></i></div>
                        <p class="scale-110">Favorilere Eklendi</p>
                    </a>
                @else
                    <a @auth href="{{route('favorites.store', [$user->id, $post->id])}}" @endauth href="{{route('login.get')}}" @guest @endguest class="favorite-btn w-full flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                        <div class="favorite-heart-1 text-2xl mr-4 mt-1"><i class="fa-regular fa-heart text-gray-600"></i></div>
                        <p class="scale-110">Favorilere Ekle</p>
                    </a>
                @endif
                {{-- success --}}
                @if(session()->has('success'))
                <div id="alert-3" class="flex items-center border border-green-700 p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{session()->get('success')}}
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                      <span class="sr-only">Close</span>
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                    </button>
                </div>
                @endif
                {{-- error --}}
                @if(session()->has('error'))
                <div id="alert-3" class="flex items-center border border-red-700 p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{session()->get('error')}}
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                      <span class="sr-only">Close</span>
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                    </button>
                </div>
                @endif

                {{-- delete post --}}
                @auth
                    @if($publisher->id == $user->id) 
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="w-full flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-red-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2" type="button">
                            <div class="favorite-heart-2 text-xl mr-4 mt-1"><i class="fa-solid fa-trash-can pr-1"></i></div>
                            <p class="scale-110">İlanı Sil</p>
                        </button>
                            
                        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500">İlanı silmek istediğinizden emin misiniz?</h3>
                                        <form action="{{route('posts.delete', $post->id)}}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Evet, sil" data-modal-hide="popup-modal" class="cursor-pointer text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        </form>
                                        <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Hayır, silme</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

    </div>

    {{-- fullscreen gallery --}}
    <div id="fullscreen-gallery" class="w-full h-svh mx-auto absolute top-0 left-1/2 -translate-x-1/2 z-50 bg-black/70">
        <div id="default-carousel" class="relative" data-carousel="static">
            {{-- images --}}
            <div class="overflow-hidden relative h-svh rounded-lg md:rounded-none">
                @forEach($images as $image)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{asset('storage/'. $image->image)}}" alt="" class="block absolute top-1/2 left-1/2  -translate-x-1/2 -translate-y-1/2">
                    </div>
                @endforEach
            </div>
            {{-- buttons --}}
            <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                @for($btn = 1; $btn <= count($images); $btn++)
                    <button class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                @endfor
            </div>
            {{-- compress --}}
            <button id="compress-btn" type="button" class="flex absolute bottom-0 right-0 z-40 justify-center items-center p-4 h-fit cursor-pointer group focus:outline-none">
                <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-black/50 hover:bg-black/30 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                    <i class="fa-solid fa-compress text-white"></i>
                </span>
                <span class="hidden">fullscreen</span>
            </button>
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
    </div>

    @vite("resources/js/location_map.js")
    <script>
        $(document).ready(function() {
            // open & close fullscreen
            $('#fullscreen-gallery').hide();

            $('#fullscreen-btn').click(function() {
                $('#fullscreen-gallery').show();
            });

            $('#compress-btn').click(function() {
                $('#fullscreen-gallery').hide();
            })

            // copy to clipboard
            $('.copy-btn-1').click(function() {
                navigator.clipboard.writeText($('.copy-text-1').html())
                $(this).html('<i class="fa-solid fa-check"></i>')
                setTimeout(() => {
                    $(this).html('<i class="fa-regular fa-clipboard"></i>')
                }, 2000);
            })
            $('.copy-btn-2').click(function() {
                navigator.clipboard.writeText($('.copy-text-2').html())
                $(this).html('<i class="fa-solid fa-check"></i>')
                setTimeout(() => {
                    $(this).html('<i class="fa-regular fa-clipboard"></i>')
                }, 1500);
            })

            // favorite btn
            // $('.favorite-heart-1').show()
            // $('.favorite-heart-2').hide()
            // $('.favorite-btn').click(function() {
            //     $('.favorite-heart-1').toggle();
            //     $('.favorite-heart-2').toggle();
            // })
        });



    </script>

    <style>
        #location_map {
            height: 50vh;
        }
    </style>

@endsection