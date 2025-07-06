<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Feature;
use App\Models\Building;
use App\Models\Location;
use App\Models\Land;
use App\Models\Image;
use App\Models\TemporaryFile;
use App\Models\User;
use App\Models\Favorite;

class PostController extends Controller
{

    public function show($post_id) {

        // get the user
        $user = Auth::user();

        // get the post
        $post = Post::find($post_id);
        
        if ($post) {
            $features = [];
            $building = [];
            $land = [];

            if($post->kategori != 'arsa') {
                $features = Feature::where('post_id', $post_id)->first();
                $building = Building::where('post_id', $post_id)->first();
            } else {
                $land = Land::where('post_id', $post_id)->first();
            }

            $location = Location::where('post_id', $post_id)->first();
            $images = Image::where('post_id', $post_id)->get();

            // get the publisher
            $publisher = User::find($post->user_id);

            // check favorites
            $favorite_post = false;
            if($user) {
                $favorite_post = Favorite::where('post_id', $post_id)->where('user_id', $user->id)->first();
                if($favorite_post) $favorite_post = true;
            }

            return view('posts.show', [ 'user' => $user, 
                                        'post' => $post, 
                                        'favorite_post' => $favorite_post, 
                                        'features' => $features, 
                                        'building' => $building, 
                                        'land' => $land, 
                                        'location' => $location, 
                                        'images' => $images,
                                        'publisher' => $publisher]);
        }
        else abort(404);

    }

    public function create()
    {
        $user = Auth::user();

        if($user) return view('posts.create')->with(['user' => $user]);
        else return to_route('login');
    }

    public function store(Request $request)
    {
        // delete tmp images from database and folders
        function deleteTmpImage() {
            $temporaryImages = TemporaryFile::all();
            if($temporaryImages) {
                Storage::deleteDirectory('images/tmp');
                TemporaryFile::truncate();
            }
        }

        // validate post info
        function validate_post(Request $request) {
            $validator = Validator::make($request->all(), [
                'kategori' => 'required',
                'emlak_turu' => 'required',
                'title' => 'required',
                'description' => 'required',
                'fiyat' => ['required', 'numeric', 'min:0'],
                'tel_1' => ['required', 'min:10' ,'max:11'],
                'tel_2' => 'max:11',
            ]);

            if($validator->fails()) deleteTmpImage();

            $request->validate([
                'kategori' => 'required',
                'emlak_turu' => 'required',
                'title' => 'required',
                'description' => 'required',
                'fiyat' => ['required', 'numeric', 'min:0'],
                'tel_1' => ['required', 'min:10' ,'max:11'],
                'tel_2' => 'max:11',
            ], 
            [
                'kategori.required' => 'Lütfen kategori seçiniz',
                'emlak_turu.required' => 'Lütfen emlak türünü seçiniz',
                'title.required' => 'Başlık alanını boş bırakmayın',
                'description.required' => 'Açıklama alanını boş bırakmayın',
                'fiyat.required' => 'Fiyat alanını boş bırakmayın',
                'fiyat.numeric' => 'Geçersiz fiyat',
                'fiyat.min' => 'Geçersiz fiyat',
                'tel_1.required' => 'Tel numarasını giriniz',
                'tel_1.min' => 'Geçersiz Telefon numarası',
                'tel_1.max' => 'Geçersiz Telefon numarası',
                'tel_2.max' => 'Geçersiz Telefon numarası',
            ]);
    
        }

        // validate building info
        function validate_building(Request $request) {
            $validator = Validator::make($request->all(), [
                'bina_yasi' => ['required', 'numeric', 'min:0'],
                'kat_sayisi' => ['required', 'numeric', 'min:0'],
            ]);

            if($validator->fails()) deleteTmpImage();

            $request->validate([
                'bina_yasi' => ['required', 'numeric', 'min:0'],
                'kat_sayisi' => ['required', 'numeric', 'min:0'],
            ], 
            [
                'bina_yasi.required' => 'Lütfen bina yaşını giriniz',
                'bina_yasi.numeric' => 'Geçersiz değer',
                'bina_yasi.min' => 'Negatif değer geçersizdir',
                'kat_sayisi.required' => 'Lütfen kat sayısını giriniz',
                'kat_sayisi.numeric' => 'Geçersiz değer',
                'kat_sayisi.min' => 'Negatif değer geçersizdir',
            ]);
        }
  
        // validate location info
        function validate_location(Request $request) {
            $validator = Validator::make($request->all(), [
                'il' => 'required',
                'ilce' => 'required',
                'mahalle' => 'required',
                'adres' => 'required',
                'lat' => 'required',
            ]);

            if($validator->fails()) deleteTmpImage();

            $request->validate([
                'il' => 'required',
                'ilce' => 'required',
                'mahalle' => 'required',
                'adres' => 'required',
                'lat' => 'required',
            ], 
            [
                'il.required' => 'Lütfen İl giriniz',
                'ilce.required' => 'Lütfen İlçe giriniz',
                'mahalle.required' => 'Lütfen Mahalle giriniz',
                'adres.required' => 'Lütfen Adres giriniz',
                'lat.required' => 'Lütfen Geçerli konum giriniz',
            ]);
        }

        // store images
        function store_images(Request $request, $post_id) {
            $validator = Validator::make($request->all(), [
                'image.*' => ['required', 'image', 'mimes:jpg,png,jpeg']
            ]);

            if($validator->fails()) deleteTmpImage();

            $request->validate([
                'image.*' => ['required', 'image', 'mimes:jpg,png,jpeg']
            ], 
            [
                'image.required' => 'En az bir görsel girmeniz gerekmektedir',
                'image.image' => 'Lütfen geçerli bir dosysa tipi giriniz',
                'image.mimes' => 'Lütfen geçerli bir dosysa tipi giriniz',
            ]);

            $temporary_images = TemporaryFile::all();

            foreach($temporary_images as $temporary_image) {
                // Correctly copy the image to the public disk
                $destinationPath = 'post_images/' . $temporary_image->folder . '_' . $temporary_image->file;
                Storage::disk('public')->copy(
                    'images/tmp/' . $temporary_image->folder . '/' . $temporary_image->file,
                    $destinationPath
                );

                // Save the image path in the database, relative to the public storage
                Image::create([
                    'image' => $destinationPath,
                    'post_id' => $post_id
                ]);

                // Clean up the temporary files and directories
                Storage::deleteDirectory('images/tmp/' . $temporary_image->folder);
                $temporary_image->delete();
            }

        }

        // store konut features
        if($request->kategori == 'konut' || $request->kategori == 'turistik') {

            validate_post($request);
            $validator = Validator::make($request->all(), [
                'brut_metrekare' => ['required', 'numeric', 'min:0'],
                'net_metrekare' => ['required', 'numeric', 'min:0'],
                'oda_sayisi' => ['required', 'numeric', 'min:0'],
                'salon_sayisi' => ['required', 'numeric', 'min:0'],
                'banyo_sayisi' => ['required', 'numeric', 'min:0'],
                'kat' => 'required',
                'balkon' => ['required', 'numeric', 'min:0'],
            ]);

            if($validator->fails()) deleteTmpImage();

            $request->validate([
                'brut_metrekare' => ['required', 'numeric', 'min:0'],
                'net_metrekare' => ['required', 'numeric', 'min:0'],
                'oda_sayisi' => ['required', 'numeric', 'min:0'],
                'salon_sayisi' => ['required', 'numeric', 'min:0'],
                'banyo_sayisi' => ['required', 'numeric', 'min:0'],
                'kat' => 'required',
                'balkon' => ['required', 'numeric', 'min:0'],
            ],
            [
                'brut_metrekare.required' => 'Lütfen brüt m2 giriniz',
                'brut_metrekare.numeric' => 'Geçersiz değer',
                'brut_metrekare.min' => 'Negatif değer geçersizdir',
                'net_metrekare.required' => 'Lütfen net m2 giriniz',
                'net_metrekare.numeric' => 'Geçersiz değer',
                'net_metrekare.min' => 'Negatif değer geçersizdir',
                'oda_sayisi.required' => 'Oda sayısını giriniz',
                'oda_sayisi.numeric' => 'Geçersiz değer',
                'oda_sayisi.min' => 'Negatif değer geçersizdir',
                'salon_sayisi.required' => 'Salon sayısını giriniz',
                'salon_sayisi.numeric' => 'Geçersiz değer',
                'salon_sayisi.min' => 'Negatif değer geçersizdir',
                'banyo_sayisi.required' => 'Banyo sayısını giriniz',
                'banyo_sayisi.numeric' => 'Geçersiz değer',
                'banyo_sayisi.min' => 'Negatif değer geçersizdir',
                'kat.required' => 'Lütfen  bulunduğu katı giriniz',
                'balkon.required' => 'Balkon sayısını giriniz',
                'balkon.numeric' => 'Geçersiz değer',
                'balkon.min' => 'Negatif değer geçersizdir',
            ]);
            validate_building($request);
            validate_location($request);

            $user = Auth::user();

            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'tel_1' => $request->tel_1,
                'tel_2' => $request->tel_2,
                'fiyat' => $request->fiyat,
                'kategori' => $request->kategori,
                'emlak_turu' => $request->emlak_turu,
                'yayin_tipi' => $request->yayin_tipi,
                'user_id' => $user->id,
            ]);

            Feature::create([
                'net_metrekare' => $request->net_metrekare,
                'brut_metrekare' => $request->brut_metrekare,
                'oda_sayisi' => $request->oda_sayisi,
                'salon_sayisi' => $request->salon_sayisi,
                'banyo_sayisi' => $request->banyo_sayisi,
                'kat' => $request->kat,
                'isitma_tipi' => $request->isitma_tipi,
                'esya_durumu' => $request->esya_durumu,
                'manzara' => $request->manzara,
                'balkon' => $request->balkon,
                'teras' => $request->teras,
                'cephe' => $request->cephe,
                'post_id' => $post->id,
            ]);

            Building::create([
                'bina_yasi' => $request->bina_yasi,
                'kat_sayisi' => $request->kat_sayisi,
                'kullanim_durumu' => $request->kullanim_durumu,
                'hasar_durumu' => $request->hasar_durumu,
                'guvenlik' => $request->guvenlik,
                'asansor' => $request->asansor,
                'otopark' => $request->otopark,
                'post_id' => $post->id,
            ]);

            Location::create([
                'adres' => $request->adres,
                'il' => $request->il,
                'ilce' => $request->ilce,
                'mahalle' => $request->mahalle,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'post_id' => $post->id,
            ]);

            // store images
            store_images($request, $post->id);

        }

        // store isyeri features
        if($request->kategori == 'isyeri') {
            validate_post($request);
            
            $validator = Validator::make($request->all(), [
                'brut_metrekare' => ['required', 'numeric', 'min:0'],
                'net_metrekare' => ['required', 'numeric', 'min:0'],
                'kat' => 'required',
            ]);

            if($validator->fails()) deleteTmpImage();            

            $request->validate([
                'brut_metrekare' => ['required', 'numeric', 'min:0'],
                'net_metrekare' => ['required', 'numeric', 'min:0'],
                'kat' => 'required',
            ],
            [
                'brut_metrekare.required' => 'Lütfen brüt m2 giriniz',
                'brut_metrekare.numeric' => 'Geçersiz değer',
                'brut_metrekare.min' => 'Negatif değer geçersizdir',
                'net_metrekare.required' => 'Lütfen net m2 giriniz',
                'net_metrekare.numeric' => 'Geçersiz değer',
                'net_metrekare.min' => 'Negatif değer geçersizdir',
                'kat.required' => 'Lütfen bulunduğu katı giriniz',
            ]);
            validate_building($request);
            validate_location($request);
            
            $user = Auth::user();

            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'tel_1' => $request->tel_1,
                'tel_2' => $request->tel_2,
                'fiyat' => $request->fiyat,
                'kategori' => $request->kategori,
                'emlak_turu' => $request->emlak_turu,
                'yayin_tipi' => $request->yayin_tipi,
                'user_id' => $user->id,
            ]);

            Feature::create([
                'net_metrekare' => $request->net_metrekare,
                'brut_metrekare' => $request->brut_metrekare,
                'kat' => $request->kat,
                'isitma_tipi' => $request->isitma_tipi,
                'post_id' => $post->id,
            ]);

            Building::create([
                'bina_yasi' => $request->bina_yasi,
                'kat_sayisi' => $request->kat_sayisi,
                'kullanim_durumu' => $request->kullanim_durumu,
                'hasar_durumu' => $request->hasar_durumu,
                'guvenlik' => $request->guvenlik,
                'asansor' => $request->asansor,
                'otopark' => $request->otopark,
                'post_id' => $post->id,
            ]);

            Location::create([
                'adres' => $request->adres,
                'il' => $request->il,
                'ilce' => $request->ilce,
                'mahalle' => $request->mahalle,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'post_id' => $post->id,
            ]);

            // store images
            store_images($request, $post->id);
        }

        // store arsa features
        if($request->kategori == 'arsa') {
            validate_post($request);

            $validator = Validator::make($request->all(), [
                'arsa_alani' => ['required', 'numeric', 'min:0'],
            ]);

            if($validator->fails()) deleteTmpImage();
            
            $request->validate([
                'arsa_alani' => ['required', 'numeric', 'min:0'],
            ],
            [
                'arsa_alani.required' => 'Lütfen arsanın alanını giriniz',
                'arsa_alani.numeric' => 'Geçersiz değer',
                'arsa_alani.min' => 'Negatif değer geçersizdir',
            ]);
            validate_location($request);

            $user = Auth::user();

            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'tel_1' => $request->tel_1,
                'tel_2' => $request->tel_2,
                'fiyat' => $request->fiyat,
                'kategori' => $request->kategori,
                'emlak_turu' => $request->emlak_turu,
                'yayin_tipi' => $request->yayin_tipi,
                'user_id' => $user->id,
            ]);

            Land::create([
                'arsa_alani' => $request->arsa_alani,
                'imar_durumu' => $request->imar_durumu,
                'yol_durumu' => $request->yol_durumu,
                'altyapi_durumu' => $request->altyapi_durumu,
                'manzara' => $request->manzara,
                'arazi_egimi' => $request->arazi_egimi,
                'hukuki_durumu' => $request->hukuki_durumu,
                'pazarlik_durumu' => $request->pazarlik_durumu,
                'post_id' => $post->id,
            ]);

            Location::create([
                'adres' => $request->adres,
                'il' => $request->il,
                'ilce' => $request->ilce,
                'mahalle' => $request->mahalle,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'post_id' => $post->id,
            ]);

            // store images
            store_images($request, $post->id);
        }

        return to_route('profile.edit');
        
    }

    public function delete($post_id) {

        $post = Post::find($post_id);
        $post->delete();

        return redirect('/feed');
    }

}
