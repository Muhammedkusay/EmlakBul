
// add emlak turu
let emlakTuru = document.querySelector('#emlak_turu');
let selectedEmlakTuru;

const kategoriler = {
    konut:     ['Daire', 'Müstakil Ev', 'Villa', 'Residans', 'Yazlık', 'Çiftlik'],
    isyeri:    ['Ofis', 'Dükkan', 'Depo/Antrepo', 'Plaza Katı', 'Büfe'],
    arsa:      ['Tarla', 'Bahçe', 'Ticari Arsa', 'Tarım Arsası', 'İmarlı Arsa', 'Sanayi Arsası'],
    turistik:  ['Otel', 'Motel', 'Pansiyon', 'Kamp Alanı'],
};

function addEmlakTuru() {
    emlakTuru.innerHTML = '';

    selectedEmlakTuru.forEach(e => {
        let option = document.createElement('option');
        option.innerHTML = e;
        option.setAttribute('value', e);
        emlakTuru.appendChild(option);
    });
}

function hideSections() {
    $('.konut').hide();
    $('.isyeri').hide();
    $('.arsa').hide();
    $('.post-info').hide();
    $('.location-info').hide();
    $('.building-features').hide();
    $('.images').hide();
    $('.tel').hide();
    $('.submit-btn').hide();
}

function modifySections() {
    $('.temp-text').hide();
    $('.post-info').show();
    $('.location-info').show();
    $('.images').show();
    $('.tel').show();
    $('.submit-btn').show();

    if($('#kategori').val() == 'konut' || $('#kategori').val() == 'turistik') {
        $('.isyeri').hide();
        $('.arsa').hide();
        $('.konut').show();
        $('.building-features').show();
    }
    else if($('#kategori').val() == 'isyeri') {
        $('.konut').hide();
        $('.arsa').hide();
        $('.isyeri').show();
        $('.building-features').show();
    }
    else if($('#kategori').val() == 'arsa') {
        $('.konut').hide();
        $('.isyeri').hide();
        $('.building-features').hide();
        $('.arsa').show();
    }
}

$(document).ready(function() {

    if($('#kategori').val() != 'none') {
        selectedEmlakTuru = [];
        selectedEmlakTuru = kategoriler[$('#kategori').val()];
        addEmlakTuru();
    }
    else {
        emlakTuru.innerHTML = '';
        selectedEmlakTuru = [];
    }

    // add emlak turu
    $('#kategori').click(function() {
        if($(this).val() != 'none') {
            selectedEmlakTuru = [];
            selectedEmlakTuru = kategoriler[$(this).val()];
            addEmlakTuru();
        }
        else {
            emlakTuru.innerHTML = '';
            selectedEmlakTuru = [];
        }
    });

    // hide sections
    hideSections();

    $('#kategori').change(function() {
        if($(this).val() != 'none') {
            modifySections();
        }
        else {
            $('.temp-text').show();
            hideSections();
        }
    });

    if($('#kategori').val() != 'none') {
        modifySections();
    }
});