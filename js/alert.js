const alert = $('.alert').data('flashdata');
const link = $('.link').data('flashdata');

if (alert == "Registrasi Akun Berhasil") {
    Swal.fire({
        title: alert,
        text: 'Silahkan aktivasi akun melalui Email sebelum Login!',
        type: 'success'
    }).then((result) => {
        window.location.href = 'login.php';
    });

} else if (alert == "Registrasi Akun Gagal") {
    Swal.fire({
        title: alert,
        text: 'Silahkan coba lagi!',
        type: 'error'
    }).then((result) => {
        window.location.href = 'registrasi.php';
    });

} else if (alert == "Email Sudah Terdaftar") {
    Swal.fire({
        title: alert,
        text: 'Silahkan login dengan email tersebut',
        type: 'error'
    }).then((result) => {
        window.location.href = 'login.php';
    });

} else if (alert == "Verifikasi Berhasil") {
    Swal.fire({
        title: alert,
        text: '',
        type: 'success'
    }).then((result) => {
        window.location.href = 'login.php';
    });

} else if (alert == "Password Verifikasi Salah") {
    Swal.fire({
        title: 'Password Salah',
        text: 'Masukan password dengan benar',
        type: 'error'
    });

} else if (alert == "Email Tidak Terdaftar") {
    Swal.fire({
        title: alert,
        text: 'Silahkan registrasi dahulu!',
        type: 'error'
    }).then((result) => {
        window.location.href = 'registrasi.php';
    });

} else if (alert == "Email Belum Aktif") {
    Swal.fire({
        title: alert,
        text: 'Silahkan verifikasi email dahulu',
        type: 'error'
    }).then((result) => {
        window.location.href = 'login.php';
    });

} else if (alert == "Password Salah") {
    Swal.fire({
        title: alert,
        text: 'Masukan password dengan benar',
        type: 'error'
    }).then((result) => {
        window.location.href = 'login.php';
    });

} else if (alert == "Permintaan Reset Password") {
    Swal.fire({
        title: 'Berhasil',
        text: 'Silahkan cek email anda',
        type: 'success'
    });

} else if (alert == "Edit User Berhasil") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        type: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Edit User Gagal") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: 'Silahkan Coba Lagi',
        type: 'error',
        showConfirmButton: false,
        timer: 1000
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Server Mikrotik Berhasil Ditambahkan") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: '',
        type: 'success',
        showConfirmButton: false,
        timer: 1000
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Server Mikrotik Gagal Ditambahkan") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: 'Silahkan Coba Lagi',
        type: 'error',
        showConfirmButton: false,
        timer: 1000
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Server Mikrotik Berhasil Diedit") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: '',
        type: 'success',
        showConfirmButton: false,
        timer: 1000
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Server Mikrotik Gagal Diedit") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: 'Silahkan Coba Lagi',
        type: 'error',
        showConfirmButton: false,
        timer: 1000
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Registrasi Akun Hotspot Berhasil") {
    Swal.fire({
        title: alert,
        text: 'Notifikasi pengaktifan akun hotspot akan dikirim melalui email dalam 1 x 24 jam',
        type: 'success'
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Registrasi Akun Hotspot Gagal") {
    Swal.fire({
        title: alert,
        text: 'Silahkan coba lagi',
        type: 'error'
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Akun Hotspot Sudah Ada") {
    Swal.fire({
        title: alert,
        text: 'Silahkan coba lagi',
        type: 'error'
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Perbaikan Registrasi Hotspot Berhasil") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: 'Perbaikan akan dicek kembali dalam 1 x 24 jam',
        type: 'success',
        showConfirmButton: false,
        timer: 2000
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Perbaikan Registrasi Hotspot Gagal") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: 'Silahkan Coba Lagi',
        type: 'error',
        showConfirmButton: false,
        timer: 1000
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Pembaharuan Akun Hotspot Berhasil") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: 'Aktivasi akun dalam 1 x 24 jam',
        type: 'success',
        showConfirmButton: false,
        timer: 2000
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Pembaharuan Akun Hotspot Gagal") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: 'Silahkan Coba Lagi',
        type: 'error',
        showConfirmButton: false,
        timer: 1000
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Data Berhasil Dihapus") {
    Swal.fire({
        title: alert,
        position: '',
        text: '',
        type: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Akun Hotspot Berhasil Disetujui") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: '',
        type: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Akun Hotspot Gagal Disetujui") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: 'Silahkan Coba Lagi',
        type: 'error',
        showConfirmButton: false,
        timer: 1500
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Password Berhasil Di Ubah") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: '',
        type: 'success',
        showConfirmButton: false,
        timer: 1500
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Password Gagal Di Ubah") {
    Swal.fire({
        title: alert,
        position: 'top-end',
        text: 'Silahkan Coba Lagi',
        type: 'error',
        showConfirmButton: false,
        timer: 1500
    }).then((result) => {
        window.location.href = link;
    });

} else if (alert == "Logout Berhasil") {
    Swal.fire({
        title: alert,
        text: '',
        type: 'success'
    });

} else {


}

$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Yakin?',
        text: "Menghapus data yang dipilih",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});