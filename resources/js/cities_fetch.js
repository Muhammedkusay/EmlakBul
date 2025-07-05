// define arrays
let cities = [];
let districts = [];

function addCities() {
    cities.forEach(city => {
        let option = document.createElement('option');
        option.setAttribute('value', city);
        option.innerHTML = city;
        document.getElementById('il').appendChild(option);
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
getCities();


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
