import { Loader } from "@googlemaps/js-api-loader"

let lat, lng;
let mapCenter;

// define arrays
let cities = [];
let citiesLatLng = [];
let districts = [];

function addCities() {
    let i = 0;
    cities.forEach(city => {
        let option = document.createElement('option');
        option.setAttribute('value', city);
        option.setAttribute('lat', citiesLatLng[i]['latitude']);
        option.setAttribute('lng', citiesLatLng[i]['longitude']);
        option.innerHTML = city;
        document.getElementById('il').appendChild(option);
        i++
    });
}

function addDistricts() {
    document.getElementById('ilce').innerHTML = "";

    districts.forEach(district => {
        let option = document.createElement('option');
        option.setAttribute('value', district);
        option.innerHTML = district;
        document.getElementById('ilce').appendChild(option);
    });
}

async function getCities() {

    await fetch(`https://turkiyeapi.dev/api/v1/provinces`)
    .then((response) => {
        return response.json();
    })
    .then((response) => {
        response['data'].forEach(element => {
            cities.push(element['name']);
        });
        response['data'].forEach(element => {
            citiesLatLng.push(element['coordinates']);
        });

        addCities();
    })

}

async function getDistricts(city) {

    await fetch(`https://turkiyeapi.dev/api/v1/provinces?name=${city}`)
    .then((response) => {
        return response.json();
    })
    .then((response) => {
        districts = [];

        response['data'][0]['districts'].forEach(district => {
            districts.push(district['name']);
        });
        addDistricts();
    })

}

getCities();

$(document).ready(function() {
    $('.location-success').hide();
    $('.location-error').hide();
    $('select#il').click(function() {
        if($(this).val() != 'none') {
            getDistricts($(this).val());
        }
    });
});

const loader = new Loader({
    apiKey: "AIzaSyCbEeKMDhs0LaWRQEVy2fIlTdsvucgy4Og",
    version: "weekly",
  });

loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");
    const map = new Map(document.getElementById("map_container"), {
      zoom: 13,
    //   disableDefaultUI: true,
      center:  mapCenter ?? { lat: 41.015137 , lng: 28.979530}
    });
    
    let infoWindow = new google.maps.InfoWindow();
  
    infoWindow.open(map);
    map.addListener("click", (mapsMouseEvent) => {
      infoWindow.close();

      infoWindow.setContent(
        JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
      );

      infoWindow.open(map);
      
      let koo = infoWindow.getContent();
      lat = JSON.parse(koo)['lat'];
      lng = JSON.parse(koo)['lng'];

      new google.maps.Marker({
        position: {lat: lat, lng: lng},
        label: '',
        map: map,
      });

    });

    $(document).ready(function() {
        $('select#il').change(function() {
            if($(this).val() != 'none') {
    
                // change the lat & lng in select element
                let selectedOption = $(this).find('option:selected');
                let selectedLat = Number.parseFloat(selectedOption.attr('lat'))
                let selectedLng = Number.parseFloat(selectedOption.attr('lng'))
    
                mapCenter = { lat: selectedLat, lng: selectedLng }
    
                map.setCenter(mapCenter);
            }
        });
    
        $('.add-location-btn').click(function() {
            if(lat) {
                $('.location-success').show();
                $('.location-error').hide();
                $('.post-location-error').hide();
    
                $('input#lat').attr('value', lat);
                $('input#lng').attr('value', lng);
    
            } else {
                $('.location-success').hide();
                $('.location-error').show();
            }
        })
    });
    
});
