@extends('layouts.auth_page', ['title' => 'Üye Ol'])

@section('content')

<form actoin="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="sm:max-w-xl max-w-full m-5 mt-8 mb-6 sm:p-8 p-4 rounded-md mx-auto shadow border border-gray-100 bg-white">
    
    @csrf
    
    <h2 class="w-fit text-4xl font-semibold mx-auto pb-10">Üye Ol</h2>
    
    {{-- registering errors --}}
    @if (session()->has('error'))
        <div id="alert-additional-content-2" class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
            <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium">Kayıt işlemi başarısız</h3>
            </div>
            <div class="mt-2 mb-4 text-sm">
                {{ session()->get('error') }}
            </div>
            <button type="button" class="text-red-800 bg-transparent border border-red-800 hover:bg-red-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center" data-dismiss-target="#alert-additional-content-2" aria-label="Close">
                Tamam
            </button>
        </div>
    @endif

    {{-- kullanici_tipi --}}
    <h3 class="mb-4 font-semibold text-gray-900">Üyelik Tipi</h3>
    <ul class="items-center w-full mb-4 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex overflow-hidden">
        
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
            <div class="flex items-center ps-3">
                <input id="default-radio-1" type="radio" value="bireysel" name="kullanici_tipi" @if(old('kullanici_tipi') == 'bireysel') checked @endif class="cursor-pointer hidden w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-50">
                <label for="default-radio-1" class="cursor-pointer w-full py-3 ms-2 text-sm font-medium text-gray-900">Bireysel</label>
            </div>
        </li>
       
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
            <div class="flex items-center ps-3">
                <input id="default-radio-2" type="radio" value="kurum" name="kullanici_tipi" @if(old('kullanici_tipi') == 'kurum') checked @endif class="cursor-pointer hidden w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-50">
                <label for="default-radio-2" class="cursor-pointer w-full py-3 ms-2 text-sm font-medium text-gray-900">Kurum</label>
            </div>
        </li>
    </ul>
        
    {{-- errors --}}
    @if ($errors->has('kullanici_tipi'))
        <div class="flex items-center p-3 mt-2 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                {{ $errors->first('kullanici_tipi') }}
            </div>
        </div>
    @endif
    
    {{-- ad, soyad --}}
    <div class="if_bireysel grid md:grid-cols-2 md:gap-6">
        <div class="mb-5">
            <label for="ad" class="block mb-2 text-sm font-medium text-gray-900">Ad</label>
            <input type="text" id="ad" value="{{ old('ad') }}" name="ad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
            
            {{-- errors --}}
            @if ($errors->has('ad'))
                <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        {{ $errors->first('ad') }}
                    </div>
                </div>
            @endif
        </div>


        <div class="mb-5">
            <label for="soyad" class="block mb-2 text-sm font-medium text-gray-900">Soyad</label>
            <input type="text" id="soyad" value="{{ old('soyad') }}" name="soyad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
    
            {{-- errors --}}
            @if ($errors->has('soyad'))
                <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        {{ $errors->first('soyad') }}
                    </div>
                </div>
            @endif
        </div>

    </div>

    {{-- email --}}
    <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Eposta</label>
        <input type="text" id="email" value="{{ old('email') }}" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  placeholder="isim@emlakbul.com" />
        
        {{-- errors --}}
        @if ($errors->has('email'))
            <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    {{ $errors->first('email') }}
                </div>
            </div>
        @endif
    </div>

    {{-- password --}}
    <div class="mb-5">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Yeni Şifre</label>
        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
        
        {{-- errors --}}
        @if ($errors->has('password'))
            <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    {{ $errors->first('password') }}
                </div>
            </div>
        @endif
    </div>

    {{-- confirm_password --}}
    <div class="mb-5">
        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Yeni Şifre (Tekrar)</label>
        <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
        
        {{-- errors --}}
        @if ($errors->has('confirm_password'))
            <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    {{ $errors->first('confirm_password') }}
                </div>
            </div>
        @endif
    </div>

    {{-- il, ilce --}}
    <div class="if_kurum grid md:grid-cols-2 md:gap-6 mt-4">
        <div class="mb-5">
            <label for="il" class="block mb-2 text-sm font-medium text-gray-900">İl</label>
            <select id="il" name="il" class="bg-gray-50 cursor-pointer border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                {{-- cities --}}
                <option value=""></option>
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
            <select id="ilce" name="ilce" class="bg-gray-50 cursor-pointer border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                {{-- districts --}}
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
    </div>
    
    {{-- kurum_adi --}}
    <div class="if_kurum mb-5">
        <label for="kurum_adi" class="block mb-2 text-sm font-medium text-gray-900">Kurum Adı</label>
        <input type="text" id="kurum_adi" name="kurum_adi" value="{{old('kurum_adi')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
    
                    
        {{-- errors --}}
        @if ($errors->has('kurum_adi'))
        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                {{ $errors->first('kurum_adi') }}
            </div>
        </div>
        @endif
    </div>

    {{-- tel --}}
    <div class="if_kurum mb-5">
        <label for="tel" class="block mb-2 text-sm font-medium text-gray-900">Tel</label>
        <input type="number" id="tel" name="tel" value="{{old('tel')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="(053x xxx xxxx)" />
                 
        {{-- errors --}}
        @if ($errors->has('tel'))
        <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                {{ $errors->first('tel') }}
            </div>
        </div>
        @endif
    </div>
    
    {{-- avatar --}}
    <div class="if_kurum">
        <label for="dropzone-file" class="block mb-2 text-sm font-medium text-gray-900">Logo</label>
        <input id="dropzone-file" name="image" type="file"/>
                            
        {{-- errors --}}
        @if ($errors->has('image'))
            <div class="flex items-center p-3 mt-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    {{ $errors->first('image') }}
                </div>
            </div>
        @endif
    </div>

    {{-- submit --}}
    <div class="mt-7">
        <input type="submit" value="Kaydet" class="shadow-md cursor-pointer ms:mr-3 mr-3 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 sm:mb-0 mb-2 text-center">
        <p class="inline">
            Üye misiniz? <a href="{{ route('login') }}" class="underline text-blue-700">Giriş Yap</a>
        </p>
    </div>

</form>

@vite('resources/js/cities_fetch.js')
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

<script>
    const inputElement = document.querySelector('input[type="file"]');
    FilePond.registerPlugin(FilePondPluginImagePreview);

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

    $(document).ready(function() {

        $('.if_kurum').hide();

        // select radio btn 1
        if($('#default-radio-1').attr('checked')) {
            $('.if_bireysel').show(0);
            $('.if_kurum').hide(0);
            $('#default-radio-1').parent().parent().css('background-color', '#eee');
        }

        $('#default-radio-1').click(function() {
            $('.if_bireysel').show(500);
            $('.if_kurum').hide(500);
            $(this).parent().parent().css('background-color', '#eee');
            $('#default-radio-2').parent().parent().css('background-color', '#fff');
        });

        // select radio btn 2
        if($('#default-radio-2').attr('checked')) {
            $('.if_bireysel').hide(0);
            $('.if_kurum').show(0);
            $('#default-radio-2').parent().parent().css('background-color', '#eee');
        }

        $('#default-radio-2').click(function() {
            $('.if_bireysel').hide(500);
            $('.if_kurum').show(500);
            $(this).parent().parent().css('background-color', '#eee');
            $('#default-radio-1').parent().parent().css('background-color', '#fff');
        });
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