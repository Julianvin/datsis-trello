const dropArea = document.getElementById("drop-area");
const fileUploadMessage = document.getElementById("file-upload-message");
const uploadButton = document.getElementById("upload-button");
const fileInput = document.getElementById("gambar");

dropArea.addEventListener("dragover", (event) => {
    event.preventDefault();
    dropArea.style.borderColor = "blue"; // Mengubah border menjadi biru
});

dropArea.addEventListener("dragleave", () => {
    dropArea.style.borderColor = ""; // Kembalikan warna border ke default
});

// Menangani saat file di-drop
dropArea.addEventListener("drop", (event) => {
    event.preventDefault();
    dropArea.style.borderColor = ""; // Kembalikan warna border ke default

    const files = event.dataTransfer.files;
    if (files.length > 0) {
        fileUploadMessage.textContent = `${files.length} file telah dipilih`;
        // Panggil fungsi untuk menangani file
        handleFiles(files);
    }
});

// Fungsi untuk menangani file
// Fungsi untuk menangani file
function handleFiles(files) {
    const file = files[0]; // Ambil file pertama
    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            // Tambahkan preview gambar
            const preview = document.getElementById("preview-image");
            if (!preview) {
                // Jika tidak ada elemen preview, buat elemen baru
                const img = document.createElement("img");
                img.id = "preview-image";
                img.src = event.target.result;
                img.classList.add("w-full", "h-auto", "mt-4"); // Styling opsional
                dropArea.appendChild(img);
            } else {
                // Jika ada, ganti gambar yang sudah ada
                preview.src = event.target.result;
            }

            fileUploadMessage.textContent = `Gambar berhasil diunggah: ${file.name}`;
            dropArea.classList.remove("border-blue-500");
            dropArea.classList.add("border-gray-300");
        };
        reader.readAsDataURL(file); // Membaca file sebagai URL data
        fileInput.files = files; // Set file input dengan file yang di-drag
    }
}
// Memilih gambar melalui tombol
uploadButton.addEventListener("click", () => {
    fileInput.click(); // Menyimulasikan klik pada input file
});


/* sweetalert untuk menyimpan data*/
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.btn-ubah').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah form langsung submit

        // Ambil form
        const form = document.querySelector('.form-ubah');

        // Cek validitas form sebelum menampilkan SweetAlert
        if (form.checkValidity()) {
            Swal.fire({
                title: "Apakah kamu ingin menyimpan data siswa ini?",
                icon: "info",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Simpan",
                denyButtonText: `Jangan Simpan`
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
