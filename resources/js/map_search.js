
import { Loader } from "@googlemaps/js-api-loader"

let selectedLocation = document.querySelector('#selected-location')
let posts = document.querySelectorAll('.post')

let locationLat = parseFloat(selectedLocation.getAttribute('lat'))
let locationLng = parseFloat(selectedLocation.getAttribute('lng'))


const loader = new Loader({
    apiKey: "AIzaSyCbEeKMDhs0LaWRQEVy2fIlTdsvucgy4Og",
    version: "weekly",
});

loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");

    const map = new Map(document.getElementById("search_map"), {
        center: {lat: locationLat, lng: locationLng},
        zoom: 13,
    });

    if(posts) {
        posts.forEach(post => {
            let lat = parseFloat(post.getAttribute('lat'))
            let lng = parseFloat(post.getAttribute('lng'))
            let marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map,
            });
    
            // Create an info window with a URL link
            let infoWindow = new google.maps.InfoWindow({
                content: `<div class="min-h-16 text-[16px]">
                            <div>${post.getAttribute('kategori')}</div>
                            <div>${post.getAttribute('fiyat')}₺</div>
                            <a href="/posts/${parseInt(post.getAttribute('id'))}" target="_blank" class="block text-white bg-blue-700 hover:bg-blue-800 px-3 py-1 mt-2">İlanı Göster</a>
                          </div>`,
            });
    
            // Add a click event listener to the marker to open the info window
            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });
        })
    }

});