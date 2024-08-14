<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Models\Land;
use App\Models\Image;
use App\Models\Location;

class FeedController extends Controller
{
    public function feed() {
        $user = Auth::user();

        // get the newest posts
        $posts = DB::table('posts')
            ->join('features', 'posts.id', '=', 'features.post_id')
            ->join('buildings', 'posts.id', '=', 'buildings.post_id')
            ->join('locations', 'posts.id', '=', 'locations.post_id')
            ->select('locations.*', 'features.*', 'buildings.*', 'posts.*')
            ->orderBy('posts.created_at', 'desc')
            ->limit(3)
            ->get();

        $post_images = [];
        
        foreach($posts as $post) {
            array_push($post_images, Image::where('post_id', $post->id)->get());
        }

        if($user) return view('feed.index', ['user' => $user, 'posts' => $posts, 'post_images' => $post_images]);
        else return view('feed.index', ['posts' => $posts, 'post_images' => $post_images]);
    }

    public function searchList(Request $request) {

        if($request->ajax()) {

            $data = DB::table('posts')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->select('locations.*', 'posts.*')
                ->where('posts.title', 'like', '%'.$request->search.'%')
                ->orwhere('posts.description', 'like', '%'.$request->search.'%')
                ->orwhere('posts.kategori', 'like', '%'.$request->search.'%')
                ->orwhere('posts.yayin_tipi', 'like', '%'.$request->search.'%')
                ->orwhere('posts.emlak_turu', 'like', '%'.$request->search.'%')
                ->orwhere('locations.il', 'like', '%'.$request->search.'%')
                ->orwhere('locations.ilce', 'like', '%'.$request->search.'%')
                ->orwhere('locations.mahalle', 'like', '%'.$request->search.'%')
                ->limit(5)
                ->get();
        }

        $output = '';
        if(count($data) > 0) {
            $output = '<div class="p-3 border border-gray-200 rounded-lg">';

                foreach($data as $row) {
                    $output .= '<a href="search?location='.$row->il.'&type='.$row->yayin_tipi.'&kategory='.$row->kategori.'" class="block relative py-2 px-4 hover:bg-gray-100 rounded-lg">'
                                    .'<p>'.$row->title.'</p>'
                                    .'<p class="text-gray-500 text-sm font-semibold"><i class="fa-solid fa-location-pin pr-2 text-slate-600"></i>'.$row->il.' \\ '.$row->ilce.'</p>'
                                    .'<i class="fa-solid fa-arrow-right absolute top-1/2 right-0 -translate-y-1/2 mr-3 text-gray-500"></i>'.
                                '</a>';
                }

            $output .= '</div>';
        }
        else {
            $output .= "<p class='block py-2 px-4 rounded-lg'>Sonuç Yok</p>";
        }

        return $output;
    }

    public function search(Request $request) {

        $user = Auth::user();

        if($request->search_input) {
            $posts = DB::table('posts')
                ->join('features', 'posts.id', '=', 'features.post_id')
                ->join('buildings', 'posts.id', '=', 'buildings.post_id')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->select('locations.*', 'features.*', 'buildings.*', 'posts.*')
                ->where('posts.title', 'like', '%'.$request->search_input.'%')
                ->orwhere('posts.emlak_turu', 'like', '%'.$request->search_input.'%')
                ->orwhere('posts.kategori', 'like', '%'.$request->search_input.'%')
                ->orwhere('locations.il', 'like', '%'.$request->search_input.'%')
                ->orwhere('locations.ilce', 'like', '%'.$request->search_input.'%')
                ->get();
    
            $lands = DB::table('posts')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->join('lands', 'posts.id', '=', 'lands.post_id')
                ->select('locations.*', 'lands.*', 'posts.*')
                ->where('posts.title', 'like', '%'.$request->search_input.'%')
                ->orwhere('posts.kategori', 'like', '%'.$request->search_input.'%')
                ->orwhere('posts.emlak_turu', 'like', '%'.$request->search_input.'%')
                ->orwhere('locations.il', 'like', '%'.$request->search_input.'%')
                ->orwhere('locations.ilce', 'like', '%'.$request->search_input.'%')
                ->get();
        }

        // add filters
        else if($request->kategori) {
            $posts = DB::table('posts')
                ->join('features', 'posts.id', '=', 'features.post_id')
                ->join('buildings', 'posts.id', '=', 'buildings.post_id')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->select('locations.*', 'features.*', 'buildings.*', 'posts.*')
                ->where('posts.kategori', 'like', '%'.$request->kategori.'%')
                ->where('posts.yayin_tipi', 'like', '%'.$request->yayin_tipi.'%')
                ->where('posts.fiyat', '>=', $request->min_fiyat ?? 0)
                ->where('posts.fiyat', '<=', $request->max_fiyat ?? 1000_000_000)
                ->where('features.oda_sayisi', 'like', '%'.$request->oda_sayisi.'%')
                ->where('features.salon_sayisi', 'like', '%'.$request->salon_sayisi.'%')
                ->where('features.brut_metrekare', 'like', '%'.$request->brut_metrekare.'%')
                ->where('features.net_metrekare', 'like', '%'.$request->net_metrekare.'%')
                ->where('features.esya_durumu', 'like', '%'.$request->esya_durumu.'%')
                ->where('features.isitma_tipi', 'like', '%'.$request->isitma_tipi.'%')
                ->where('features.manzara', 'like', '%'.$request->manzara.'%')
                ->where('buildings.kullanim_durumu', 'like', '%'.$request->kullanim_durumu.'%')
                ->where('buildings.hasar_durumu', 'like', '%'.$request->hasar_durumu.'%')
                ->where('buildings.guvenlik', 'like', '%'.$request->guvenlik.'%')
                ->where('buildings.asansor', 'like', '%'.$request->asansor.'%')
                ->where('buildings.otopark', 'like', '%'.$request->otopark.'%')
                ->where('locations.il', 'like', '%'.$request->il.'%')
                ->where('locations.ilce', 'like', '%'.$request->ilce.'%')
                ->get();
            $lands = DB::table('posts')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->join('lands', 'posts.id', '=', 'lands.post_id')
                ->select('locations.*', 'lands.*', 'posts.*')
                ->where('posts.kategori', 'like', '%'.$request->kategori.'%')
                ->where('posts.yayin_tipi', 'like', '%'.$request->yayin_tipi.'%')
                ->where('locations.il', 'like', '%'.$request->il.'%')
                ->where('locations.ilce', 'like', '%'.$request->ilce.'%')
                ->get();
        }
        
        else {
            $posts = DB::table('posts')
                ->join('features', 'posts.id', '=', 'features.post_id')
                ->join('buildings', 'posts.id', '=', 'buildings.post_id')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->select('locations.*', 'features.*', 'buildings.*', 'posts.*')
                ->where('posts.kategori', 'like', '%'.$request->kategory.'%')
                ->where('posts.yayin_tipi', 'like', '%'.$request->type.'%')
                ->where('locations.il', 'like', '%'.$request->location.'%')
                ->get();
    
            $lands = DB::table('posts')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->join('lands', 'posts.id', '=', 'lands.post_id')
                ->select('locations.*', 'lands.*', 'posts.*')
                ->where('posts.kategori', 'like', '%'.$request->kategori.'%')
                ->where('posts.yayin_tipi', 'like', '%'.$request->type.'%')
                ->where('locations.il', 'like', '%'.$request->location.'%')
                ->get();
        }

        $post_images = [];
        $land_images = [];
        
        foreach($posts as $post) {
            array_push($post_images, Image::where('post_id', $post->id)->get());
        }
        
        foreach($lands as $land) {
            array_push($land_images, Image::where('post_id', $land->id)->get());
        }

        if($user) return view('feed.search', ['user' => $user, 'posts' => $posts, 'lands' => $lands, 'post_images' => $post_images, 'land_images' => $land_images]);
        else return view('feed.search', ['posts' => $posts, 'lands' => $lands, 'post_images' => $post_images, 'land_images' => $land_images]);
    }

    public function searchMap(Request $request) {
        $user = Auth::user();

        if($request->il) {
            $posts = DB::table('posts')
                    ->join('locations', 'locations.post_id', '=', 'posts.id')
                    ->select('locations.*', 'posts.*')
                    ->where('locations.il', '=', $request->il)
                    ->get();
        } 
        else {
            $posts = DB::table('posts')
                ->join('locations', 'locations.post_id', '=', 'posts.id')
                ->select('locations.*', 'posts.*')
                ->where('locations.il', '=', 'istanbul')
                ->get();
        }

        if($user) return view('feed.map', ['user' => $user, 'posts' => $posts, 'il' => $request->il ?? 'istanbul']);
        else return view('feed.map', ['posts' => $posts, 'il' => $request->il ?? 'istanbul']);
    }
}
