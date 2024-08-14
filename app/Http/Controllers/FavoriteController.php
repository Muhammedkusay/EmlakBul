<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Post;
use App\Models\Feature;
use App\Models\Location;
use App\Models\Land;
use App\Models\Image;


class FavoriteController extends Controller
{
    
    public function index() {

        $user = Auth::user();

        $favorite_posts_id = [];

        if(!Favorite::exists()) {
            return view('favorites.index', ['user' => $user, 'posts' => $posts, 'features' => $features, 'lands' => $lands, 'locations' => $locations, 'images' => $images]);   
        }

        $favorite_posts = Favorite::where('user_id', $user->id)->get();
        
        foreach($favorite_posts as $favorite_post) {
            array_push($favorite_posts_id, $favorite_post->post_id);
        }

        $posts = DB::table('posts')
                ->join('features', 'posts.id', '=', 'features.post_id')
                ->join('buildings', 'posts.id', '=', 'buildings.post_id')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->select('features.*', 'buildings.*', 'locations.*', 'posts.*')
                ->whereIn('posts.id', $favorite_posts_id)
                ->get();
        
        $lands = DB::table('posts')
                ->join('lands', 'posts.id', '=', 'lands.post_id')
                ->join('locations', 'posts.id', '=', 'locations.post_id')
                ->select('lands.*', 'locations.*', 'posts.*')
                ->whereIn('posts.id', $favorite_posts_id)
                ->get();

        $post_images = [];
        $land_images = [];
        
        foreach($posts as $post) {
            array_push($post_images, Image::where('post_id', $post->id)->get());
        }
        
        foreach($lands as $land) {
            array_push($land_images, Image::where('post_id', $land->id)->get());
        }

        return view('favorites.index', ['user' => $user, 'posts' => $posts, 'lands' => $lands, 'post_images' => $post_images, 'land_images' => $land_images]);

    }

    public function store($user_id, $post_id) {

        $favorite_post = Favorite::where('post_id', $post_id)->where('user_id', $user_id)->first();

        if($favorite_post) return to_route('posts.show', $post_id)->with('error', 'Favorilerede Bulunuyor');

        $result = Favorite::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
        ]);

        if($result) return to_route('posts.show', $post_id)->with('success', 'Favorilere Eklendi');
        else return to_route('posts.show', $post_id)->with('error', 'Bir Hata Oluştu');
    }

    public function delete($user_id, $post_id) {

        $post = Favorite::where('post_id', $post_id)->where('user_id', $user_id)->first();
        $post->delete();

        return to_route('posts.show', $post_id);
    }
}
