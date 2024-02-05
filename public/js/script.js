var baseUrl;
var csrfToken ;
document.addEventListener('DOMContentLoaded', function() {
     baseUrl = document.querySelector('meta[name="base-url"]').content;
    console.log(baseUrl); // Pastikan ini menampilkan URL yang benar
        csrfToken = document.querySelector('meta[name="csrf-token"]').content;
});


function mintaOtp(){
    var countDownDate = localStorage.getItem("countDownDate");
    if (countDownDate) {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        if (distance > 0) {
            // Jika countdown masih berlangsung, tampilkan alert
            Toastify({
                text: "Tunggu " + document.getElementById("countDown").innerHTML + " lagi untuk mengirim OTP",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "#FF8800",
                stopOnFocus: true,
            }).showToast();
            return; // Keluar dari fungsi tanpa mengirim OTP
        }
    }
    sendOtp();
    // Lanjutkan proses OTP jika tidak dalam countdown
    // Reset countdown
    

}

function countDown(){
    // countDown 5 menit
    var countDownDate;
    if (localStorage.getItem("countDownDate")) {
        // Gunakan waktu yang tersimpan jika sudah ada
        countDownDate = localStorage.getItem("countDownDate");
    } else {
        // Atur waktu baru dan simpan jika belum ada
        countDownDate = new Date().getTime() + 300000;
        localStorage.setItem("countDownDate", countDownDate);
    }

    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)); 
        var seconds = Math.floor((distance % (1000 * 60)) / 1000); 
        document.getElementById("countDown").innerHTML = minutes + "m " + seconds + "s ";
        
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countDown").innerHTML = "";
            // Hapus waktu yang tersimpan di localStorage
            localStorage.removeItem("countDownDate");
        }
    }, 1000);

}

window.onload = function() {
    if (localStorage.getItem("countDownDate")) {
        countDown();
    }
};

function sendOtp(){
    // validate email
    let email = $('#email').val();
    if (!email) {
        alert('Email harus diisi');
        return;
    }

    $.ajax({
        url: baseUrl + '/send-otp',
        type: 'POST',
        data: {
            'email': $('#email').val()
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        beforeSend: function(){
           Toastify({
                text: "Sedang mengirim OTP",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "#FF8800",
                stopOnFocus: true,
            }).showToast();
        },
        success: function(response){
            if (response.status == 'success') {
                Toastify({
                    text: "OTP berhasil dikirim",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#00CC00",
                    stopOnFocus: true,
                }).showToast();
                countDown();
            } else {
                alert('OTP gagal dikirim');
            }
        },
        error: function(xhr, status, error) {
            Toastify({
                text: "Terjadi kesalahan: " + xhr.responseJSON.message,
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "#FF0000",
                stopOnFocus: true,
            }).showToast();
        },
        
    });
}
