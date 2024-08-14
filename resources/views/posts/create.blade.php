@extends('layouts.main', ['user' => $user ?? '', 'title' => 'İlan ver'])

@section('content')

    <div class="w-full sm:p-6 p-5 m-5 mb-20 mx-auto lg:w-1/2 bg-white shadow-sm rounded-lg border border-gray-100">
        
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
            {{-- kategori --}}
            <h4 class="text-2xl font-bold pb-5">Kategori Bilgileri</h4>

            {{-- kategori, emlak_turu, yayin_tipi --}}
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="mb-5">
                    <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                    <select id="kategori" name="kategori" class="bg-gray-50 cursor-pointer border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        
                        <option value="none" {{old('kategori') == 'none' ? 'selected' : ''}} ></option>
                        <option value="konut" {{old('kategori') == 'konut' ? 'selected' : ''}} >Konut</option>
                        <option value="isyeri" {{old('kategori') == 'isyeri' ? 'selected' : ''}} >İşyeri</option>
                        <option value="arsa" {{old('kategori') == 'arsa' ? 'selected' : ''}} >Arsa</option>
                        <option value="turistik" {{old('kategori') == 'turistik' ? 'selected' : ''}} >Turistik</option>
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('kategori'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('kategori') }}
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mb-5">
                    <label for="emlak_turu" class="block mb-2 text-sm font-medium text-gray-900">Emlak Türü</label>
                    <select id="emlak_turu" name="emlak_turu" class="bg-gray-50 cursor-pointer border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('emlak_turu'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('emlak_turu') }}
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mb-5">
                    <label for="yayin_tipi" class="block mb-2 text-sm font-medium text-gray-900">Yayın Tipi</label>
                    <select id="yayin_tipi" name="yayin_tipi" class="bg-gray-50 cursor-pointer border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Kiralık" {{old('yayin_tipi') == 'Kiralık' ? 'selected' : ''}}>Kiralık</option>
                        <option value="Satılık" {{old('yayin_tipi') == 'Satılık' ? 'selected' : ''}}>Satılık</option>
                    </select>
                </div>
            </div>
    
            <h2 class="temp-text w-fit text-slate-400 text-lg py-8 mx-auto mt-4">Lütfen emlak kategorisini seçiniz</h2>

            {{-- ilan info --}}
            <div class="post-info">
                <h4 class="post-info text-2xl font-bold pt-8 pb-5">İlan Bilgileri</h4>

                {{-- title --}}
                <div class="mb-5">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">İlan Başlığı</label>
                    <input type="text" id="title" name="title" value="{{old('title')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    
                    {{-- errors --}}
                    @if ($errors->has('title'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('title') }}
                            </div>
                        </div>
                    @endif
                </div>

                {{-- description --}}
                <div class="mb-5">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Açıklama</label>
                    <textarea id="description" name="description" class="min-h-24 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />{{old('description')}}</textarea>
                    
                    {{-- errors --}}
                    @if ($errors->has('description'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('description') }}
                            </div>
                        </div>
                    @endif
                </div>

                {{-- fiyat --}}
                <div class="mb-5">
                    <label for="fiyat" class="block mb-2 text-sm font-medium text-gray-900">Fiyat</label>
                    <input type="text" id="fiyat" name="fiyat" value="{{old('fiyat')}}" inputmode="numeric" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    
                    {{-- errors --}}
                    @if ($errors->has('fiyat'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('fiyat') }}
                            </div>
                        </div>
                    @endif
                </div>

                {{-- tel --}}
                <div class="tel grid md:grid-cols-2 md:gap-6">
                    <div class="mb-5">
                        <label for="tel_1" class="block mb-2 text-sm font-medium text-gray-900">Tel 1 <span class="text-red-500">*</span></label>
                        <input type="text" id="tel_1" name="tel_1" value="{{old('tel_1')}}" inputmode="numeric" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="53x xxx xxxx">
    
                        {{-- errors --}}
                        @if ($errors->has('tel_1'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('tel_1') }}
                            </div>
                        </div>
                        @endif
                    </div>
    
                    <div class="mb-5">
                        <label for="tel_2" class="block mb-2 text-sm font-medium text-gray-900">Tel 2</label>
                        <input type="text" id="tel_2" name="tel_2" value="{{old('tel_2')}}" inputmode="numeric" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="53x xxx xxxx">
    
                        {{-- errors --}}
                        @if ($errors->has('tel_2'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('tel_2') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- features --}}
            <div class="features">
                <h4 class="konut text-2xl font-bold pt-8 pb-5">Konut Özellikleri</h4>
                <h4 class="isyeri text-2xl font-bold pt-8 pb-5">İşyeri Özellikleri</h4>
                <h4 class="arsa text-2xl font-bold pt-8 pb-5">Arsa Özellikleri</h4>

                {{-- brut_metrekare, net_metrekare  --}}
                <div class="konut isyeri grid md:grid-cols-2 md:gap-6">
                    <div class="mb-5">
                        <label for="brut_metrekare" class="block mb-2 text-sm font-medium text-gray-900">Brüt m<sup>2</sup></label>
                        <input type="text" id="brut_metrekare" name="brut_metrekare" inputmode="numeric" value="{{old('brut_metrekare')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        
                        {{-- errors --}}
                        @if ($errors->has('brut_metrekare'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('brut_metrekare') }}
                            </div>
                        </div>
                        @endif
                    </div>
    
                    <div class="mb-5">
                        <label for="net_metrekare" class="block mb-2 text-sm font-medium text-gray-900">Net m<sup>2</sup></label>
                        <input type="text" id="net_metrekare" name="net_metrekare" inputmode="numeric" value="{{old('net_metrekare')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        
                        {{-- errors --}}
                        @if ($errors->has('net_metrekare'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('net_metrekare') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- oda_sayisi, salon_sayisi, banyo_sayisi --}}
                <div class="konut grid md:grid-cols-3 md:gap-6">
                    <div class="mb-5">
                        <label for="oda_sayisi" class="block mb-2 text-sm font-medium text-gray-900">Oda Sayısı</label>
                        <input type="text" id="oda_sayisi" name="oda_sayisi" value="{{old('oda_sayisi')}}" inputmode="numeric" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        
                        {{-- errors --}}
                        @if ($errors->has('oda_sayisi'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('oda_sayisi') }}
                            </div>
                        </div>
                        @endif
                    </div>
    
                    <div class="mb-5">
                        <label for="salon_sayisi" class="block mb-2 text-sm font-medium text-gray-900">Salon Sayısı</label>
                        <input type="text" id="salon_sayisi" name="salon_sayisi" value="{{old('salon_sayisi')}}" inputmode="numeric" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        
                        {{-- errors --}}
                        @if ($errors->has('salon_sayisi'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('salon_sayisi') }}
                            </div>
                        </div>
                        @endif
                    </div>
    
                    <div class="mb-5">
                        <label for="banyo_sayisi" class="block mb-2 text-sm font-medium text-gray-900">Banyo Sayısı</label>
                        <input type="text" id="banyo_sayisi" name="banyo_sayisi" value="{{old('banyo_sayisi')}}" inputmode="numeric" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    
                        {{-- errors --}}
                        @if ($errors->has('banyo_sayisi'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('banyo_sayisi') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- kat --}}
                <div class="konut isyeri mb-5">
                    <label for="kat" class="block mb-2 text-sm font-medium text-gray-900">Bulunduğu Kat</label>
                    <input type="text" id="kat" name="kat" value="{{old('kat')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    
                    {{-- errors --}}
                    @if ($errors->has('kat'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('kat') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- esya_durumu --}}
                <div class="konut mb-5">
                    <label for="esya_durumu" class="block mb-2 text-sm font-medium text-gray-900">Eşya Durumu</label>
                    <select id="esya_durumu" name="esya_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Eşyalı" {{old('esya_durumu') == 'Eşyalı' ? 'selected' : ''}}>Eşyalı</option>
                        <option value="Eşyasız" {{old('esya_durumu') == 'Eşyasız' ? 'selected' : ''}}>Eşyasız</option>
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('esya_durumu'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('esya_durumu') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- isitma_tipi --}}
                <div class="konut isyeri mb-5">
                    <label for="isitma_tipi" class="block mb-2 text-sm font-medium text-gray-900">Isıtma Tipi</label>
                    <select id="isitma_tipi" name="isitma_tipi" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Merkezi Isıtma"  {{old('isitma_tipi') == 'Merkezi Isıtma' ? 'selected' : ''}}>Merkezi Isıtma</option>
                        <option value="Bireysel Isıtma"  {{old('isitma_tipi') == 'Bireysel Isıtma' ? 'selected' : ''}}>Bireysel Isıtma</option>
                        <option value="Yerden Isıtma"  {{old('isitma_tipi') == 'Yerden Isıtma' ? 'selected' : ''}}>Yerden Isıtma</option>
                        <option value="Radyatör Isıtma"  {{old('isitma_tipi') == 'Radyatör Isıtma' ? 'selected' : ''}}>Radyatör Isıtma</option>
                        <option value="Jeotermal Isıtma"  {{old('isitma_tipi') == 'Jeotermal Isıtma' ? 'selected' : ''}}>Jeotermal Isıtma</option>
                        <option value="Güneş Enerjisi ile Isıtma"  {{old('isitma_tipi') == 'Güneş Enerjisi ile Isıtma' ? 'selected' : ''}}>Güneş Enerjisi ile Isıtma</option>
                        <option value="Elektrikli Isıtma"  {{old('isitma_tipi') == 'Elektrikli Isıtma' ? 'selected' : ''}}>Elektrikli Isıtma</option>
                        <option value="Isı Pompası"  {{old('isitma_tipi') == 'Isı Pompası' ? 'selected' : ''}}>Isı Pompası</option>
                        <option value="Soba Isıtma"  {{old('isitma_tipi') == 'Soba Isıtma' ? 'selected' : ''}}>Soba Isıtma</option>
                        <option value="Şömine Isıtma"  {{old('isitma_tipi') == 'Şömine Isıtma' ? 'selected' : ''}}>Şömine Isıtma</option>
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('isitma_tipi'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('isitma_tipi') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- balkon, teras, cephe --}}
                <div class="konut grid md:grid-cols-3 md:gap-6">
                    <div class="mb-5">
                        <label for="balkon" class="block mb-2 text-sm font-medium text-gray-900">Balkon Sayısı</label>
                        <input type="text" id="balkon" name="balkon" value="{{old('balkon')}}" inputmode="numeric" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        
                        {{-- errors --}}
                        @if ($errors->has('balkon'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('balkon') }}
                            </div>
                        </div>
                        @endif
                    </div>
    
                    <div class="mb-5">
                        <label for="teras" class="block mb-2 text-sm font-medium text-gray-900">Teras</label>
                        <select id="teras" name="teras" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="Yok" {{old('teras') == 'Yok' ? 'selected' : ''}}>Yok</option>
                            <option value="Var" {{old('teras') == 'Var' ? 'selected' : ''}}>Var</option>
                        </select>

                        {{-- errors --}}
                        @if ($errors->has('teras'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('teras') }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="mb-5">
                        <label for="cephe" class="block mb-2 text-sm font-medium text-gray-900">Cephe</label>
                        <select id="cephe" name="cephe" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="Batı"  {{old('cephe') == 'Batı' ? 'selected' : ''}}>Batı</option>
                            <option value="Doğu"  {{old('cephe') == 'Doğu' ? 'selected' : ''}}>Doğu</option>
                            <option value="Kuzey"  {{old('cephe') == 'Kuzey' ? 'selected' : ''}}>Kuzey</option>
                            <option value="Güney"  {{old('cephe') == 'Güney' ? 'selected' : ''}}>Güney</option>
                        </select>

                        {{-- errors --}}
                        @if ($errors->has('cephe'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('cephe') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- arsa_alani --}}
                <div class="arsa mb-5">
                    <label for="arsa_alani" class="block mb-2 text-sm font-medium text-gray-900">Arsa Alanı m<sup>2</sup></label>
                    <input type="text" id="arsa_alani" name="arsa_alani" inputmode="numeric" value="{{old('arsa_alani')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    
                    {{-- errors --}}
                    @if ($errors->has('arsa_alani'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('arsa_alani') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- manzara --}}
                <div class="konut arsa mb-5">
                    <label for="manzara" class="block mb-2 text-sm font-medium text-gray-900">Manzara</label>
                    <select id="manzara" name="manzara" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Manzara Yok" {{old('manzara') == 'Manzara Yok' ? 'selected' : ''}}>Manzara Yok</option>
                        <option value="Deniz Manzarası" {{old('manzara') == 'Deniz Manzarası' ? 'selected' : ''}}>Deniz Manzarası</option>
                        <option value="Dağ Manzarası" {{old('manzara') == 'Dağ Manzarası' ? 'selected' : ''}}>Dağ Manzarası</option>
                        <option value="Orman Manzarası" {{old('manzara') == 'Orman Manzarası' ? 'selected' : ''}}>Orman Manzarası</option>
                        <option value="Şehir Manzarası" {{old('manzara') == 'Şehir Manzarası' ? 'selected' : ''}}>Şehir Manzarası</option>
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('manzara'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('manzara') }}
                        </div>
                    </div>
                    @endif
                </div>
                
                {{-- imar_durumu --}}
                <div class="arsa mb-5">
                    <label for="imar_durumu" class="block mb-2 text-sm font-medium text-gray-900">İmar Durumu</label>
                    <select id="imar_durumu" name="imar_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Konut" {{old('imar_durumu') == 'Konut' ? 'selected' : ''}}>Konut</option>
                        <option value="Ticari" {{old('imar_durumu') == 'Ticari' ? 'selected' : ''}}>Ticari</option>
                        <option value="Karma" {{old('imar_durumu') == 'Karma' ? 'selected' : ''}}>Karma</option>
                        <option value="Tarım" {{old('imar_durumu') == 'Tarım' ? 'selected' : ''}}>Tarım</option>
                        <option value="Sanayi" {{old('imar_durumu') == 'Sanayi' ? 'selected' : ''}}>Sanayi</option>
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('imar_durumu'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('imar_durumu') }}
                        </div>
                    </div>
                    @endif
                </div>
                
                {{-- yol_durumu --}}
                <div class="arsa mb-5">
                    <label for="yol_durumu" class="block mb-2 text-sm font-medium text-gray-900">Yol Durumu</label>
                    <select id="yol_durumu" name="yol_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Yol Yok" {{old('yol_durumu') == 'Yol Yok' ? 'selected' : ''}}>Yol Yok</option>
                        <option value="Toprak Yol" {{old('yol_durumu') == 'Toprak Yol' ? 'selected' : ''}}>Toprak Yol</option>
                        <option value="Stabilize Yol" {{old('yol_durumu') == 'Stabilize Yol' ? 'selected' : ''}}>Stabilize Yol</option>
                        <option value="Asfalt Yol" {{old('yol_durumu') == 'Asfalt Yol' ? 'selected' : ''}}>Asfalt Yol</option>
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('yol_durumu'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('yol_durumu') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- altyapi_durumu --}}
                <div class="arsa mb-5">
                    <label for="altyapi_durumu" class="block mb-2 text-sm font-medium text-gray-900">Altyapı Durumu</label>
                    <select id="altyapi_durumu" name="altyapi_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Altyapı Mevcut" {{old('altyapi_durumu') == 'Altyapı Mevcut' ? 'selected' : ''}}>Altyapı Mevcut</option>
                        <option value="Altyapı Yok" {{old('altyapi_durumu') == 'Altyapı Yok' ? 'selected' : ''}}>Altyapı Yok</option>
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('altyapi_durumu'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('altyapi_durumu') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- arazi_egimi --}}
                <div class="arsa mb-5">
                    <label for="arazi_egimi" class="block mb-2 text-sm font-medium text-gray-900">Arazi Eğimi</label>
                    <select id="arazi_egimi" name="arazi_egimi" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Düz">Düz</option>
                        <option value="Hafif Eğimli" {{old('arazi_egimi') == 'Hafif Eğimli' ? 'selected' : ''}}>Hafif Eğimli</option>
                        <option value="Orta Eğimli" {{old('arazi_egimi') == 'Orta Eğimli' ? 'selected' : ''}}>Orta Eğimli</option>
                        <option value="Yüksek Eğimli" {{old('arazi_egimi') == 'Yüksek Eğimli' ? 'selected' : ''}}>Yüksek Eğimli</option>
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('arazi_egimi'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('arazi_egimi') }}
                        </div>
                    </div>
                    @endif
                </div>
                
                {{-- hukuki_durumu --}}
                <div class="arsa mb-5">
                    <label for="hukuki_durumu" class="block mb-2 text-sm font-medium text-gray-900">Hukuki Durumu</label>
                    <select id="hukuki_durumu" name="hukuki_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Tapu" {{old('hukuki_durumu') == 'Tapu' ? 'selected' : ''}}>Tapu</option>
                        <option value="Hisseli Tapu" {{old('hukuki_durumu') == 'Hisseli Tapu' ? 'selected' : ''}}>Hisseli Tapu</option>
                        <option value="Tahsis" {{old('hukuki_durumu') == 'Tahsis' ? 'selected' : ''}}>Tahsis</option>
                        <option value="Kiralanabilir" {{old('hukuki_durumu') == 'Kiralanabilir' ? 'selected' : ''}}>Kiralanabilir</option>
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('hukuki_durumu'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('hukuki_durumu') }}
                        </div>
                    </div>
                    @endif
                </div>
                
                {{-- pazarlik_durumu --}}
                <div class="arsa mb-5">
                    <label for="pazarlik_durumu" class="block mb-2 text-sm font-medium text-gray-900">Pazarlık Durumu</label>
                    <select id="pazarlik_durumu" name="pazarlik_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Evet" {{old('pazarlik_durumu') == 'Evet' ? 'selected' : ''}}>Evet</option>
                        <option value="Hayır" {{old('pazarlik_durumu') == 'Hayır' ? 'selected' : ''}}>Hayır</option>
                    </select>
                    
                    {{-- errors --}}
                    @if ($errors->has('pazarlik_durumu'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('pazarlik_durumu') }}
                        </div>
                    </div>
                    @endif
                </div>
                
            </div>

            {{-- building features --}}
            <div class="building-features">
                <h4 class="text-2xl font-bold pt-8 pb-5">Bina Özellikleri</h4>

                {{-- bina_yasi --}}
                <div class="mb-5">
                    <label for="bina_yasi" class="block mb-2 text-sm font-medium text-gray-900">Bina Yaşı</label>
                    <input type="text" id="bina_yasi" name="bina_yasi" value="{{old('bina_yasi')}}" inputmode="numeric" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    
                    {{-- errors --}}
                    @if ($errors->has('bina_yasi'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('bina_yasi') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- kat_sayisi --}}
                <div class="mb-5">
                    <label for="kat_sayisi" class="block mb-2 text-sm font-medium text-gray-900">Kat Sayısı</label>
                    <input type="text" id="kat_sayisi" name="kat_sayisi" value="{{old('kat_sayisi')}}" inputmode="numeric" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    
                    {{-- errors --}}
                    @if ($errors->has('kat_sayisi'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('kat_sayisi') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- kullanim_durumu --}}
                <div class="mb-5">
                    <label for="kullanim_durumu" class="block mb-2 text-sm font-medium text-gray-900">Kullanım Durumu</label>
                    <select id="kullanim_durumu" name="kullanim_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Boş" {{old('kullanim_durumu') == 'none' ? 'Boş' : ''}}>Boş</option>
                        <option value="Dolu" {{old('kullanim_durumu') == 'none' ? 'Dolu' : ''}}>Dolu</option>
                        <option value="Yapım Aşamasında" {{old('kullanim_durumu') == 'Yapım Aşamasında' ? 'selected' : ''}}>Yapım Aşamasında</option>
                        <option value="Yeni Bina" {{old('kullanim_durumu') == 'Yeni Bina' ? 'selected' : ''}}>Yeni Bina</option>
                        <option value="Yenilenmiş" {{old('kullanim_durumu') == 'Yenilenmiş</' ? 'selected' : ''}}>Yenilenmiş</option>
                        <option value="Tadilat Gerektirir" {{old('kullanim_durumu') == 'Tadilat Gerektirir' ? 'selected' : ''}}>Tadilat Gerektirir</option>
                    </select>

                    {{-- errors --}}
                    @if ($errors->has('kullanim_durumu'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('kullanim_durumu') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- hasar_durumu --}}
                <div class="mb-5">
                    <label for="hasar_durumu" class="block mb-2 text-sm font-medium text-gray-900">Hasar Durumu</label>
                    <select id="hasar_durumu" name="hasar_durumu" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Hasarsız" {{old('hasar_durumu') == 'Hasarsız' ? 'selected' : ''}}>Hasarsız</option>
                        <option value="Küçük Hasarlı" {{old('hasar_durumu') == 'Küçük Hasarlı' ? 'selected' : ''}}>Küçük Hasarlı</option>
                        <option value="Orta Derecede Hasarlı" {{old('hasar_durumu') == 'Orta Derecede Hasarlı' ? 'selected' : ''}}>Orta Derecede Hasarlı</option>
                        <option value="Ağır Hasarlı" {{old('hasar_durumu') == 'Ağır Hasarlı' ? 'selected' : ''}}>Ağır Hasarlı</option>
                        <option value="Onarım Aşamasında" {{old('hasar_durumu') == 'Onarım Aşamasında' ? 'selected' : ''}}>Onarım Aşamasında</option>
                    </select>

                    {{-- errors --}}
                    @if ($errors->has('hasar_durumu'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('hasar_durumu') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- guvenlik --}}
                <div class="mb-5">
                    <label for="guvenlik" class="block mb-2 text-sm font-medium text-gray-900">Güvenlik</label>
                    <select id="guvenlik" name="guvenlik" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="Yok" {{old('guvenlik') == 'Yok' ? 'selected' : ''}}>Yok</option>
                        <option value="24 Saat Güvenlik" {{old('guvenlik') == '24 Saat Güvenlik' ? 'selected' : ''}}>24 Saat Güvenlik</option>
                        <option value="CCTV" {{old('guvenlik') == 'CCTV' ? 'selected' : ''}}>CCTV</option>
                    </select>

                    {{-- errors --}}
                    @if ($errors->has('guvenlik'))
                    <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            {{ $errors->first('guvenlik') }}
                        </div>
                    </div>
                    @endif
                </div>

                {{-- asansor, otopark --}}
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="mb-5">
                        <label for="asansor" class="block mb-2 text-sm font-medium text-gray-900">Asansör</label>
                        <select id="asansor" name="asansor" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="Yok"  {{old('asansor') == 'Yok' ? 'selected' : ''}}>Yok</option>
                            <option value="Var"  {{old('asansor') == 'Var' ? 'selected' : ''}}>Var</option>
                        </select>
    
                        {{-- errors --}}
                        @if ($errors->has('asansor'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('asansor') }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="mb-5">
                        <label for="otopark" class="block mb-2 text-sm font-medium text-gray-900">Otopark</label>
                        <select id="otopark" name="otopark" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="Yok" {{old('otopark') == 'Yok' ? 'selected' : ''}}>Yok</option>
                            <option value="Var" {{old('otopark') == 'Var' ? 'selected' : ''}}>Var</option>
                            <option value="Kapalı Otopark" {{old('otopark') == 'Kapalı Otopark' ? 'selected' : ''}}>Kapalı Otopark</option>
                        </select>
    
                        {{-- errors --}}
                        @if ($errors->has('otopark'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('otopark') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- location info --}}
            <div class="location-info">
                <h4 class="text-2xl font-bold pt-8 pb-5">Konum Bilgileri</h4>

                {{-- il, ilce, mahalle --}}
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="mb-5">
                        <label for="il" class="block mb-2 text-sm font-medium text-gray-900">İl</label>
                        <select id="il" name="il" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="none"></option>
                        </select>

                        {{-- errors --}}
                        @if ($errors->has('il'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('il') }}
                            </div>
                        </div>
                        @endif
                    </div>
    
                    <div class="mb-5">
                        <label for="ilce" class="block mb-2 text-sm font-medium text-gray-900">İlçe</label>
                        <select id="ilce" name="ilce" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </select>

                        {{-- errors --}}
                        @if ($errors->has('ilce'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('ilce') }}
                            </div>
                        </div>
                        @endif
                    </div>
    
                    <div class="mb-5">
                        <label for="mahalle" class="block mb-2 text-sm font-medium text-gray-900">Mahalle</label>
                        <input type="text" id="mahalle" name="mahalle" value="{{old('mahalle')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                        {{-- errors --}}
                        @if ($errors->has('mahalle'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('mahalle') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- adres --}}
                <div class="mb-5">
                    <label for="adres" class="block mb-2 text-sm font-medium text-gray-900">Adres</label>
                    <textarea id="adres" name="adres" class="min-h-20 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />{{old('adres')}}</textarea>
                    
                    {{-- errors --}}
                    @if ($errors->has('adres'))
                        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('adres') }}
                            </div>
                        </div>
                    @endif
                </div>

                {{-- alert --}}
                <div id="toast-warning" class="flex items-center w-full p-3 mb-4 text-gray-500 bg-white rounded-lg border border-orange-200" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                        </svg>
                        <span class="sr-only">Warning icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">Seçtiğiniz son konum geçerli sayılacaktır</div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-warning" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>

                {{-- map & inputs --}}
                <div> 
                    {{-- success --}}
                    <div class="location-success flex items-center p-4 my-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            Emlak konumu başarıyla eklendi
                        </div>
                    </div>
                    {{-- error --}}
                    <div class="location-error flex items-center p-4 my-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Uyarı!</span> Lütfen emlak konumunu seçiniz
                        </div>
                    </div>
                    
                    {{-- errors --}}
                    @if ($errors->has('lat'))
                        <div class="post-location-error flex items-center p-3 my-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                {{ $errors->first('lat') }}
                            </div>
                        </div>
                    @endif

                    <div class="map_parent shadow-sm border border-gray-100 w-full mx-auto rounded-lg overflow-hidden">
                        <div id="map_container"></div>
                    </div>
    
                    <input type="text" id="lat" name="lat" hidden>
                    <input type="text" id="lng" name="lng" hidden>

                    <div class="add-location-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 text-center cursor-pointer font-medium rounded-lg text-sm px-5 py-2.5 my-4 mb-2 shadow">Konumu Kesinleştir</div>

                </div>
            </div>

            {{-- images --}}
            <div class="images">
                <h4 class="text-2xl font-bold pt-8 pb-5">Görseller</h4>

                {{-- input --}}
                <input type="file" multiple name="image">

            </div>

            {{-- submit --}}
            <div class="submit-btn">
                <input type="submit" value="Kaydet ve İlanı Yayınla" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 text-center cursor-pointer font-medium rounded-lg text-md px-4 py-2.5 mt-12 mb-2 shadow-md">
            
                {{-- info --}}
                <div id="alert-1" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        Butona bastığınızda ilanınıza tüm kullanıcılar erişebilecektir.
                    </div>
                      <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-1" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                  </div>
            </div>

        </form>
    </div>

    @vite('resources/js/add_post.js')
    @vite('resources/js/add_post_location.js')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        const inputElement = document.querySelector('input[type="file"]');
    
        // Create a FilePond instance
        const pond = FilePond.create((inputElement), {
            labelIdle: 'Dosya bırakabilirsiniz veya <span class="filepond--label-action">Taratın</span>',
            labelFileProcessingComplete: 'Yükleme Tamamlandı',
            labelFileProcessingError: 'Yüklerken Bir Hata Oluştu',
            labelTapToCancel: 'İptal',
            labelTapToRetry: 'Tekrar Dene',
            labelTapToUndo: 'İptal',
            labelFileLoading: 'Yükleniyor...',
            labelFileProcessing: 'Yükleniyor...',
            labelFileProcessingAbort: 'İptal Edildi',
        });

        FilePond.setOptions({
            server: {
                process: './tmp-upload',
                revert: './tmp-delete',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            },
        });
    </script>

    <style>
        .filepond--drop-label {
        cursor: pointer;
        }

        .filepond--panel-root {
        background: #f9fafb;
        border: 1px solid #e3e3e3;
        }
    </style>

@endsection