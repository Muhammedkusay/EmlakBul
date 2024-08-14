@extends('layouts.main', ['user' => $user ?? '', 'title' => 'Harita Üzerinedn Arama'])

@section('content')

    <div class="w-full min-h-96 relative">

        <div class="flex">
            {{-- back --}}
            <a href="{{route('feed')}}" class="size-[40px] lg:size-[50px] ml-2 mt-5 mr-0 lg:mr-3 text-white bg-blue-600 hover:bg-blue-800 rounded-full flex items-center justify-center shadow">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            {{-- il --}}
            <form action="{{route('search-map')}}" method="GET" class="w-[85%] lg:w-1/2 flex flex-col lg:flex-row items-end gap-2 p-4">
                @csrf
                <div class="w-full">
                    <label for="il" class="block mb-2 text-sm font-medium text-gray-900">İl</label>
                    <select id="il" name="il" class="w-full cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <option value="">İl seçiniz</option>
                    </select>
                </div>

                {{-- submit --}}
                <button class="w-full lg:w-3/4 h-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-0.5">Sonuçları Listele</button>
            </form>
        </div>

        {{-- location and posts lat, lng --}}
        @if(count($posts) != 0)
            <span id="selected-location" location="{{ $il }}" lat="{{ $posts[0]->lat }}" lng="{{ $posts[0]->lng }}" class="hidden"></span>
            @foreach ($posts as $post)
                <div class="post" id="{{$post->id}}" kategori="{{$post->emlak_turu}}" fiyat="{{$post->fiyat}}" lat="{{$post->lat}}" lng="{{$post->lng}}" class="hidden"></div>
            @endforeach
            <div class="h-svh w-full p-5 bg-white">
                <div class="h-[72vh] shadow rounded-lg border border-gray-200" id="search_map"></div>
            </div>

        {{-- error --}}
        @else
            <div class="w-full lg:w-1/2 lg:mx-auto mx-4 mt-10 flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-500" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    Hiç bir ilan bulunmamıştır
                </div>
            </div>
        @endif


    </div>

    @vite('resources/js/cities_fetch.js')
    @vite('resources/js/map_search.js')
@endsection