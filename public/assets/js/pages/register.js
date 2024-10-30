document.addEventListener("DOMContentLoaded", function () {
    AOS.init({
        duration: 700, // Durasi animasi dalam milidetik
        easing: "ease-in-out", // Easing animasi
        offset: -100,
    });
});

function togglePassword() {
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("bi-eye-slash-fill");
        toggleIcon.classList.add("bi-eye-fill");
        passwordInput.placeholder = "Masukan Password";
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("bi-eye-fill");
        toggleIcon.classList.add("bi-eye-slash-fill");
        passwordInput.placeholder = "••••••••";
    }
}

function togglePasswordConfirm(){
    const passwordInput = document.getElementById("password_confirmation");
    const toggleIcon = document.getElementById("toggleIconC");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("bi-eye-slash-fill");
        toggleIcon.classList.add("bi-eye-fill");
        passwordInput.placeholder = "Masukan Password";
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("bi-eye-fill");
        toggleIcon.classList.add("bi-eye-slash-fill");
        passwordInput.placeholder = "••••••••";
    }
}
