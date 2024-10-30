// JAVASCRIPT INI DI PERUNTUKAN UNTUK 2 LAYOUT YANG SAMA


function toggleDropdown() {
    var dropdown = document.getElementById("dropdown");
    dropdown.classList.toggle("hidden"); // Toggle class 'hidden' untuk menampilkan/menghilangkan dropdown
}

// Menutup dropdown jika klik di luar elemen dropdown
window.addEventListener("click", function (e) {
    var dropdown = document.getElementById("dropdown");
    if (!dropdown.contains(e.target) && !e.target.closest("button")) {
        dropdown.classList.add("hidden");
    }
});

function toggleMobileSidebar() {
    const sidebar = document.getElementById("mobileSidebar");
    sidebar.classList.toggle("-translate-x-full");
}

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
}

// function toggleDropdown() {
//     const dropdown = document.getElementById("dropdown");
//     dropdown.classList.toggle("hidden");
// }

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

