<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="EmlakBul, emlak bulmak için en uygun yol.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  @vite('resources/css/main.css')
  @vite('resources/css/app.css')
  @vite('resources/css/all.min.css')
  <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
  <title>Emlak Bul | {{ $title }}</title>
</head>
<body class="bg-gray-100">

  <nav class="border-gray-200 bg-white shadow-sm border border-b-gray-100">
    <div class="w-full lg:w-3/4 flex flex-wrap items-center justify-between mx-auto p-4">
      
    <a href="{{ route('feed') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="{{ URL('images/logo.png') }}" class="h-6 sm:h-7" alt="Logo" />
    </a>

    <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
    
      <ul class="flex items-center">
          @auth
            <li>
              <button type="button" name="user-menu-btn" class="flex text-sm rounded-full md:me-0" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                @if($user->kullanici_tipi == 'bireysel')
                  <div class="shadow-sm hover:bg-slate-200 border border-gray-400 relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full">
                    <span class="font-medium text-gray-600">{{ substr($user->ad, 0, 1).substr($user->soyad, 0, 1) }}</span>
                  </div>
                @else
                  <div class="shadow-sm hover:bg-slate-200 border border-gray-400 relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full">
                    <span class="font-medium text-gray-600">{{ substr($user->kurum_adi, 0, 2) }}</span>
                  </div>
                @endif
              </button>
            </li>
          @endauth
          @guest
            <li>
              <a href="{{ route('login') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2">Giriş Yap</a>
            </li>
          @endguest
            <li>
              <a href="{{ route('posts.create') }}" class="shadow-md sm:block hidden ml-2.5 bg-blue-600 text-white px-4 py-2 rounded-lg font-medium text-sm hover:bg-blue-700">Hemen İlan Ver</a>
            </li>
      </ul>   

      <!-- Dropdown menu -->
      @auth
        <div class="min-w-48 z-50 border border-gray-200 hidden my-4 mx-2 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
          
          <div class="px-4 py-3">
            <span class="block text-md text-gray-900">
                @if($user->kullanici_tipi == 'bireysel') {{ $user->ad.' '.$user->soyad }}
                @else {{ $user->kurum_adi }}
                @endif
            </span>
            <span class="block text-sm  text-gray-500 truncate">{{ $user->email }}</span>
          </div>

          <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
              <a href="{{ route('posts.create') }}" aria-label="hemen ilan ver" class="flex items-center px-4 py-2 text-md text-gray-900 hover:bg-gray-100">
                <i class="text-lg pt-1 pr-4 text-slate-900 text-md fa-regular fa-square-plus"></i>
                <p>Hemen İlan Ver</p>
              </a>
            </li>
            <li>
              <a href="{{route('favorites.index')}}" aria-label="favoriler" class="flex items-center px-4 py-2 text-md text-gray-900 hover:bg-gray-100">
                <i class="text-lg pt-1 pr-4 text-slate-900 text-md fa-regular fa-heart"></i>
                <p>Favorilerim</p>
              </a>
            </li>
            <li>
              <a href="{{ route('profile.edit') }}" aria-label="profil" class="flex items-center px-4 py-2 text-md text-gray-900 hover:bg-gray-100">
                <i class="text-lg pr-5 text-slate-900 text-md fa-regular fa-user"></i>
                <p>Profilim</p>
              </a>
            </li>
            <li class="pb-3">
              <a href="{{ URL('/profile#posts') }}" aria-label="ilanlarım" class="flex items-center px-4 py-2 text-md text-gray-900 hover:bg-gray-100">
                <i class="text-lg pr-4 text-slate-900 text-md fa-regular fa-paste"></i>
                <p>İlanlarım</p>
              </a>
            </li>
            <li class="border-t border-t-gray-100">
              <form action="{{ route('logout') }}" method="POST" class="flex text-md items-center hover:bg-red-100">
                @csrf
                  <label for="logout-btn">
                    <i class="text-lg pl-4 pr-3 text-red-500 text-md cursor-pointer fa-solid fa-right-from-bracket"></i>
                  </label>
                  <input id="logout-btn" type="submit" value="Çıkış yap" class="w-full text-sm text-start cursor-pointer py-3 text-gray-700">
              </form>
            </li>
          </ul>
        </div>
      @endauth

    </div>
    </div>
  </nav>


  @yield('content')

  <footer class="bg-white mt-4">
    <div class="mx-auto w-full lg:w-3/4 p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="{{URL('/feed')}}" aria-label="logo" class="flex items-center">
                  <img src="{{URL('images/logo.png')}}" class="h-8 me-3" alt="Logo" />
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">KAYNAKLAR</h2>
                  <ul class="text-gray-500 font-medium">
                      <li class="mb-4">
                          <a href="#" aria-label="emlak bul ana sayfa" class="hover:underline">EmlakBul</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">BİZİ TAKİP EDİN</h2>
                  <ul class="text-gray-500 font-medium">
                      <li class="mb-4">
                          <a href="https://github.com/themesberg/flowbite" aria-label="bizi takip edin" class="hover:underline ">Facebook</a>
                      </li>
                      <li>
                          <a href="https://discord.gg/4eeurUVvTy" aria-label="bizi takip edin" class="hover:underline">Instagram</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">YASAL</h2>
                  <ul class="text-gray-500 font-medium">
                      <li class="mb-4">
                          <a href="#" aria-label="politika ve koşullar" class="hover:underline">Gizlilik Politikası</a>
                      </li>
                      <li>
                          <a href="#" aria-label="politika ve koşullar" class="hover:underline">Şartlar &amp; Koşullar</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center">© <span class="copyright-year"></span> <a href="{{URL('/feed')}}" class="hover:underline">EmlakBul</a>
          </span>
          <div class="flex mt-4 sm:justify-center sm:mt-0">
              <a href="#" aria-label="facebook hesabımız" class="text-gray-500 hover:text-gray-900">
                <i class="fa-brands fa-facebook-f"></i>
              </a>
              <a href="#" aria-label="instagram hesabımız" class="text-gray-500 hover:text-gray-900 ms-5">
                <i class="fa-brands fa-instagram"></i>
              </a>
              <a href="#" aria-label="x-twitter hesabımız" class="text-gray-500 hover:text-gray-900 ms-5">
                <i class="fa-brands fa-x-twitter"></i>
              </a>
              <a href="#" aria-label="youtube kanalımız" class="text-gray-500 hover:text-gray-900 ms-5">
                <i class="fa-brands fa-youtube"></i>
              </a>
          </div>
      </div>
    </div>
  </footer>

  <script>
      let date = new Date;
      let copyrightYear = document.querySelector('.copyright-year');
      copyrightYear.innerHTML = date.getFullYear();
  </script>

</body>
</html>