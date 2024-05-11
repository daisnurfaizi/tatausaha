$('#bulan').on('change', function() {
    let month = $(this).val();
    let studentId = $('#siswa').val();
    console.log(studentId);
    getDataTagihan(studentId, month);
});

$('#siswa').on('change', function() {
    let studentId = $(this).val();
    let month = $('#bulan').val();
    getDataTagihan(studentId, month);
});


function getDataTagihan(studentId,bulan) {
    // convert month indonesia to english
    let months = {
        'januari': 'January',
        'februari': 'February',
        'maret': 'March',
        'april': 'April',
        'mei': 'May',
        'juni': 'June',
        'juli': 'July',
        'agustus': 'August',
        'september': 'September',
        '0ktober': 'October',
        'november': 'November',
        'desember': 'December'
    };
    let monthEnglish = months[bulan];
    
    $.ajax({
        url: base_url + '/tagihan/getTagihan/' + studentId + '/' + monthEnglish,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            var response = data.data;
            console.log(response);
            if(response == null) {
                $('#jumlahtagihan').val('Rp. 0');
                return;
            }else{
                response.sisa_tagihan = parseFloat(response.sisa_tagihan);
            
                $('#jumlahtagihan').val(formatRupiah(response.sisa_tagihan, 'Rp. '));
                $('#idtagihan').val(response.id);
            }
            // convert double to float

        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}