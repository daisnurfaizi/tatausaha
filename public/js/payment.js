var baseUrl;
var csrfToken ;
document.addEventListener('DOMContentLoaded', function() {
     baseUrl = document.querySelector('meta[name="base-url"]').content;
    console.log(baseUrl); // Pastikan ini menampilkan URL yang benar
        csrfToken = document.querySelector('meta[name="csrf-token"]').content;
});
function editPayment(id) {
    
    $('#paymentedit').modal('show');
    $.ajax({
        url: baseUrl + '/dashboard/getDataPayment/' + id,
        type: 'GET',
        success: function(response) {
            console.log(response);
            // $('#paymentedit #id').val(response.id);
            $('#idedit').val(response.id);
            $('#nisnedit').val(response.nisn);
            $('#namasiswaedit').val(response.student.name);
            $('#jumlahpembayaranedit').val(formatRupiah(response.payment_amount, 'Rp. '));
            $('#bulanedit').val(response.month);
            $('#dateedit').val(response.payment_date);
            $('#metodepembayaranedit').val(response.payment_method);
            $('#keteranganedit').val(response.note);
        }
    });
}

function cancelPembayaran(id){
    $.ajax({
        url: baseUrl + '/pembayaran/cancelPembayaran/' + id,
        type: 'GET',
        success: function(response) {
            if(response.status == 'success'){
                Toastify({
                    text: "Pembayaran berhasil dibatalkan",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#00CC00",
                    stopOnFocus: true,
                }).showToast();
            } else {
                Toastify({
                    text: "Pembayaran gagal dibatalkan",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#FF0000",
                    stopOnFocus: true,
                }).showToast();
            }
            $('#paymentdata').DataTable().ajax.reload();
            $('#kartupembayaran').DataTable().ajax.reload();
        }        
    });
}
$('#editJumlahTagihan').on('keyup', function() {
    var inputVal = $(this).val();

    var formatValue = formatRupiah(inputVal, 'Rp. ');
    $(this).val(formatValue);
    
}
);

// parsing data-id ke modal
function editPembayaran(id,tagihan,metode,note,tglpembayaran) {
    // console.log(data);
    $('#editPembayaranModalgrid').modal('show');
    $('#editJumlahTagihan').val(formatRupiah(tagihan, 'Rp. '));
    $('#idpembayaran').val(id);
    $('#metodepembayaranedit').val(metode);
    $('#keteranganedit').val(note);
    $('#tglpembayaranedit').val(tglpembayaran);


}

function prosesEditPembayaran(){
    let id = $('#idpembayaran').val();
    let jumlah = parseRupiah($('#editJumlahTagihan').val());
    let metode = $('#metodepembayaranedit').val();
    let note = $('#keteranganedit').val();
    let tglpembayaran = $('#tglpembayaranedit').val();
    let jumlahpembayaran = parseRupiah($('#editJumlahTagihan').val());
    console.log(jumlahpembayaran);
    $.ajax({
        url: baseUrl + '/pembayaran/editPembayaran',
        type: 'POST',
        data: {
            _token: csrfToken,
            tagihan_id: id,
            jumlah_pembayaran: jumlahpembayaran,
            metode: metode,
            keterangan: note,
            tanggal_pembayaran: tglpembayaran
        },
        success: function(response) {
            if(response.status == 'success'){
                Toastify({
                    text: "Pembayaran berhasil diubah",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#00CC00",
                    stopOnFocus: true,
                }).showToast();
            } else {
                Toastify({
                    text: "Pembayaran gagal diubah",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#FF0000",
                    stopOnFocus: true,
                }).showToast();
            }
            $('#paymentdata').DataTable().ajax.reload();
            $('#kartupembayaran').DataTable().ajax.reload();
            $('#editPembayaranModalgrid').modal('hide');
        }
    });
}

