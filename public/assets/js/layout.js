function toggleDropdown() {
    var dropdown = document.getElementById('dropdown');
    dropdown.classList.toggle('hidden');  // Toggle class 'hidden' untuk menampilkan/menghilangkan dropdown
}

// Menutup dropdown jika klik di luar elemen dropdown
window.addEventListener('click', function(e) {
    var dropdown = document.getElementById('dropdown');
    if (!dropdown.contains(e.target) && !e.target.closest('button')) {
        dropdown.classList.add('hidden');
    }
});

function toggleMobileSidebar() {
    const sidebar = document.getElementById('mobileSidebar');
    sidebar.classList.toggle('-translate-x-full');
}

function toggleDropdown() {
    const dropdown = document.getElementById('dropdown');
    dropdown.classList.toggle('hidden');
}
