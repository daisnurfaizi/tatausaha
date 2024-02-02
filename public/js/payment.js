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
