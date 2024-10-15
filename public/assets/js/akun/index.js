document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Mencegah submit form langsung

            const form = this.closest('.form-delete'); // Mendapatkan form terkait tombol ini

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akun ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();  // Jika dikonfirmasi, submit form
                    Swal.fire(
                        'Terhapus!',
                        'Data akun berhasil dihapus.',
                        'success'
                    );
                }
            });
        });
    });
});
