// define arrays
let cities = [];
let districts = [];

// add cities to the dom
function addCities() {
    cities.forEach(city => {
        let option = document.createElement('option');
        option.setAttribute('value', city);
        option.innerHTML = city;
        document.getElementById('il').appendChild(option);
    });
}

// add districts to the dom
function addDistricts() {
    document.getElementById('ilce').innerHTML = "";

    districts.forEach(district => {
        let option = document.createElement('option');
        option.setAttribute('value', district);
        option.innerHTML = district;
        document.getElementById('ilce').appendChild(option);
    });
}

// implement the function to access all cities
function getCities() {

    fetch(`https://turkiyeapi.dev/api/v1/provinces`)
    .then((response) => {
        return response.json();
    })
    .then((response) => {
        response['data'].forEach(element => {
            cities.push(element['name']);
        });
        addCities();
    })

}
// call the function
getCities();


// implement the function to access all districts
function getDistricts(city) {

    fetch(`https://turkiyeapi.dev/api/v1/provinces?name=${city}`)
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

$(document).ready(function() {

    $('select#il').change(function() {
        if($(this).val() != '')
            getDistricts($(this).val());
        else {
            districts = []
            addDistricts()
        }
    });
});
