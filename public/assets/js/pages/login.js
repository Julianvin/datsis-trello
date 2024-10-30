

function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye-slash-fill');
        toggleIcon.classList.add('bi-eye-fill');
        passwordInput.labels[0].textContent = "Masukan Password";
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-fill');
        toggleIcon.classList.add('bi-eye-slash-fill');
        passwordInput.labels[0].textContent = "••••••••";
    }
}

/* dara aos */
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 700, // Durasi animasi dalam milidetik
        easing: 'ease-in-out', // Easing animasi
    });
});
