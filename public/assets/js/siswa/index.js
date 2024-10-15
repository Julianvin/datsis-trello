
// SweetAlert2 untuk tombol hapus
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Mencegah submit form langsung

            const form = this.closest('.form-delete'); // Mendapatkan form terkait tombol ini

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data siswa ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();  // Jika dikonfirmasi, submit form
                    Swal.fire({
                        title: 'Terhapus!',
                        text: 'Data siswa berhasil dihapus.',
                        icon: 'success',
                        timer: 1000,  
                        showConfirmButton: false
                    });
                }
            });
        });
    });
});
