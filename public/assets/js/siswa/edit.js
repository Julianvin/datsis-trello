const dropArea = document.getElementById("drop-area");
const fileUploadMessage = document.getElementById("file-upload-message");
const uploadButton = document.getElementById("upload-button");
const fileInput = document.getElementById("gambar");
const dropText = document.getElementById("drop-text");

dropArea.addEventListener("dragover", (event) => {
    event.preventDefault();
    dropArea.style.borderColor = "blue";
});

dropArea.addEventListener("dragleave", () => {
    dropArea.style.borderColor = "";
});

dropArea.addEventListener("drop", (event) => {
    event.preventDefault();
    dropArea.style.borderColor = "";
    const files = event.dataTransfer.files;
    if (files.length > 0) {
        handleFiles(files);
    }
});

uploadButton.addEventListener("click", () => {
    fileInput.click();
});

fileInput.addEventListener("change", (event) => {
    const files = event.target.files;
    if (files.length > 0) {
        handleFiles(files);
    }
});

function handleFiles(files) {
    const file = files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            const preview = document.getElementById("preview-image");
            preview.src = event.target.result;
            preview.classList.remove("hidden");

            fileUploadMessage.textContent = `Gambar berhasil diunggah: ${file.name}`;
            dropText.style.display = "none"; // Sembunyikan teks dan tombol
        };
        reader.readAsDataURL(file);
        fileInput.files = files; // Update input file
    }
}

// Memilih gambar melalui tombol
uploadButton.addEventListener("click", () => {
    fileInput.click(); // Menyimulasikan klik pada input file
});

/* sweetalert untuk menyimpan data*/
document.addEventListener("DOMContentLoaded", function () {
    document
        .querySelector(".btn-ubah")
        .addEventListener("click", function (event) {
            event.preventDefault(); // Mencegah form langsung submit

            // Ambil form
            const form = document.querySelector(".form-ubah");

            // Cek validitas form sebelum menampilkan SweetAlert
            if (form.checkValidity()) {
                Swal.fire({
                    title: "Apakah kamu ingin menyimpan data siswa ini?",
                    icon: "info",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Simpan",
                    denyButtonText: `Jangan Simpan`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form jika user mengklik "Save"
                        form.submit();
                        Swal.fire("Saved!", "", "success");
                    } else if (result.isDenied) {
                        Swal.fire("Tidak tersimpan", "", "info");
                    }
                });
            } else {
                // Tampilkan pesan validasi HTML5 jika form tidak valid
                form.reportValidity();
            }
        });
});
