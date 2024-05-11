// membuat formar rupiah
function formatRupiah(angka, prefix){
    var number_string = angka.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function parseRupiah(rupiah) {
    // Hilangkan karakter 'Rp.' dan semua karakter selain digit dan koma
    var number_string = rupiah.replace(/[^\d,]/g, '');

    // Hilangkan semua titik (pemisah ribuan)
    number_string = number_string.replace(/\./g, '');

    // Konversi string menjadi nilai angka
    var angka = parseFloat(number_string.replace(',', '.'));

    return angka;
}

$('#jumlahpembayaran').keyup(function(){
    $(this).val(formatRupiah($(this).val(), 'Rp. '));
});

$('#jumlahpembayaranedit').keyup(function(){
    $(this).val(formatRupiah($(this).val(), 'Rp. '));
}
);
