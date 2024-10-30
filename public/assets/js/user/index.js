function confirmLogout(event) {
    event.preventDefault(); // Mencegah link melakukan logout langsung

    Swal.fire({
        title: 'Apakah Anda yakin ingin keluar?',
        text: "Anda akan keluar dari sesi ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, keluar',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/logout";
        }
    });
}
