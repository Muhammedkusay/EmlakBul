<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Feature;
use App\Models\Location;
use App\Models\Land;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function show($publisher_id) {
        
        $user = Auth::user();

        $publisher = User::findOrFail($publisher_id);

        // find publisher's posts       
        $posts = DB::table('posts')
                ->join('features', 'posts.id', '=', 'features.post_id')
                ->join('buildings', 'posts.id', '=', 'buildings.post_id')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->select('features.*', 'buildings.*', 'locations.*', 'posts.*')
                ->where('user_id', $publisher->id)
                ->get();
        
        $lands = DB::table('posts')
                ->join('lands', 'posts.id', '=', 'lands.post_id')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->select('lands.*', 'locations.*', 'posts.*')
                ->where('user_id', $publisher->id)
                ->get();

        $post_images = [];
        $land_images = [];
        
        foreach($posts as $post) {
            array_push($post_images, Image::where('post_id', $post->id)->get());
        }
        
        foreach($lands as $land) {
            array_push($land_images, Image::where('post_id', $land->id)->get());
        }

        return view('profile.show', ['user' => $user, 'publisher' => $publisher, 'posts' => $posts, 'lands' => $lands, 'post_images' => $post_images, 'land_images' => $land_images]);
    }

    // edit and show users posts
    public function edit() {
        $user = Auth::user();
        
        $posts = DB::table('posts')
                ->join('features', 'posts.id', '=', 'features.post_id')
                ->join('buildings', 'posts.id', '=', 'buildings.post_id')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->select('features.*', 'buildings.*', 'locations.*', 'posts.*')
                ->where('user_id', $user->id)
                ->get();
        
        $lands = DB::table('posts')
                ->join('lands', 'posts.id', '=', 'lands.post_id')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->select('lands.*', 'locations.*', 'posts.*')
                ->where('user_id', $user->id)
                ->get();

        $post_images = [];
        $land_images = [];
        
        foreach($posts as $post) {
            array_push($post_images, Image::where('post_id', $post->id)->get());
        }
        
        foreach($lands as $land) {
            array_push($land_images, Image::where('post_id', $land->id)->get());
        }

        return view('profile.edit', ['user' => $user, 'posts' => $posts, 'lands' => $lands, 'post_images' => $post_images, 'land_images' => $land_images]);
    }

    public function update(Request $request) {
        $user = Auth::user();

        if($user->kullanici_tipi == 'bireysel') {
            $request->validate([
                'ad' => ['required'], 
                'soyad' => ['required'],
                'email' => ['required', 'email'],
                'tel' => ['max:11'],
            ], 
            [
                'ad.required' => 'Ad alanını boş bırakmayın',
                'soyad.required' => 'Soyad alanını boş bırakmayın',
                'email.required' => 'E-posta alanını boş bırakmayın',
                'email.email' => 'Lütfen geçerli E-posta giriniz',
                'tel.min' => 'Lütfen geçerli bir telefon numarasını giriniz',
                'tel.max' => 'Lütfen geçerli bir telefon numarasını giriniz',
            ]);

            $user = User::find($user->id);
    
            $user->ad = $request->ad;
            $user->soyad = $request->soyad;
            $user->email = $request->email;
            $user->tel = $request->tel;
            $user->save();
        }

        else {
            $request->validate([
                'kurum_adi' => ['required'], 
                'email' => ['required', 'email'],
                'tel' => ['required', 'min:10', 'max:11'],
            ], 
            [
                'kurum_adi.required' => 'Lütfen kurum adı lanını boş bırakmayın',
                'email.required' => 'E-posta alanını boş bırakmayın',
                'email.email' => 'Lütfen geçerli E-posta giriniz',
                'tel.required' => 'Lütfen telefon numarasını giriniz',
                'tel.min' => 'Lütfen geçerli bir telefon numarasını giriniz',
                'tel.max' => 'Lütfen geçerli bir telefon numarasını giriniz',
            ]);
    
            $user = User::find($user->id);
    
            $user->kurum_adi = $request->kurum_adi;
            $user->email = $request->email;
            $user->tel = $request->tel;
            $user->save();
        }

        return to_route('profile.edit')->with(['user' => $user])->with('success', 'Profil bilgileriniz başarıyla güncellendi');
    }
}
