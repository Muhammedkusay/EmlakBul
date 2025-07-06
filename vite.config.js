import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [                
                'resources/css/main.css',
                'resources/css/app.css',
                'resources/css/all.min.css',
                'resources/js/app.js', 
                'resources/js/location_map.js', 
                'resources/js/add_post_location.js', 
                'resources/js/add_post.js', 
                'resources/js/cities_fetch.js', 
                'resources/js/map_search.js', 
                'resources/js/map_search.js', 
            ],
            refresh: true,
        }),
    ],
});
