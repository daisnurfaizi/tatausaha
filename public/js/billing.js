// get csrf token from meta tag
var CSRFTOKEN;
document.addEventListener('DOMContentLoaded', function() {    
    CSRFTOKEN = document.querySelector('meta[name="csrf-token"]').content;
});
const monthNames = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
];


$(document).ready(function() {
    $('#tagihanbulanini').on('keyup', function() {
        var inputVal = $(this).val();

        var formatValue = formatRupiah(inputVal, 'Rp. ');
        $(this).val(formatValue);
        
    }
    );
    $('#jumlahtagihanbulanini').on('keyup', function() {
        var inputVal = $(this).val();

        var formatValue = formatRupiah(inputVal, 'Rp. ');
        $(this).val(formatValue);
        
    }
    );
});
function createTagihanBulanan() {
    // get data bulan ini
    const month = new Date().getMonth();
    let tagihanbulanini = $('#jumlahtagihanbulanini').val();
    // get data 
    $.ajax({
        url: base_url + '/tagihan/generateTagihan',
        type: "POST",
        dataType: "JSON",
        data: {
            _token: CSRFTOKEN,
            bulan: monthNames[month],
            jumlah: parseRupiah(tagihanbulanini)
        },
        success: function(data) {
            console.log(data);
            if (data.status == 'success') {
                Toastify({
                    text: "Tagihan bulan ini berhasil dibuat",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#00CC00",
                    stopOnFocus: true,
                }).showToast();
                $('#kartupembayaran').ajax.reload();
            } else {
                Toastify({
                    text: "Tagihan bulan ini Sudah ada",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#FF0000",
                    stopOnFocus: true,
                }).showToast();
            }
        },
        error: function(data) {
            // alert(data.responseJSON.message)
            Toastify({
                text: data.responseJSON.message,
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "#FF0000",
                stopOnFocus: true,
            }).showToast();
        }
    });
}

function createTagihanBulanSpesifik(){
    const month = $('#bulantagihan').val();
    const jumlah = $('#tagihanbulanini').val();
    var bulan = month.split('-')
    $.ajax({
        url: base_url + '/tagihan/generateTagihan',
        type: "POST",
        dataType: "JSON",
        data: {
            _token: CSRFTOKEN,
            bulan:  monthNames[parseInt(bulan[1],10)-1],
            jumlah: parseRupiah(jumlah)
        },
        success: function(data) {
            console.log(data);
            if (data.status == 'success') {
                Toastify({
                    text: "Tagihan bulan" + month + " berhasil dibuat",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#00CC00",
                    stopOnFocus: true,
                }).showToast();
                $('#kartupembayaran').ajax.reload();
            } else {
                Toastify({
                    text: "Tagihan bulan" + month + " Sudah ada",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#FF0000",
                    stopOnFocus: true,
                }).showToast();
            }
        },
        error: function(data) {
            // alert(data.responseJSON.message)
            Toastify({
                text: data.responseJSON.message,
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "#FF0000",
                stopOnFocus: true,
            }).showToast();
        }
    });
}

