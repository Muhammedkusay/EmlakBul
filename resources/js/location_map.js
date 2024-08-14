
import { Loader } from "@googlemaps/js-api-loader"

let locationLat = parseFloat(document.querySelector("#location_lat").innerHTML)
let locationLng = parseFloat(document.querySelector("#location_lng").innerHTML)

const loader = new Loader({
    apiKey: "AIzaSyCbEeKMDhs0LaWRQEVy2fIlTdsvucgy4Og",
    version: "weekly",
});

loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");

    const map = new Map(document.getElementById("location_map"), {
        center: {lat: locationLat, lng: locationLng},
        zoom: 13,
    });

    new google.maps.Marker({
        position: {lat: locationLat, lng: locationLng},
        label: '',
        map: map,
    });

});