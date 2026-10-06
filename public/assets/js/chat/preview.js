const fileInput = document.getElementById("file-upload");
const previewBox = document.getElementById("file-preview-box");
const thumb = document.getElementById("file-preview-thumb");
const nameText = document.getElementById("file-preview-name");
const typeText = document.getElementById("file-preview-type");
const cancelBtn = document.getElementById("cancel-preview-btn");

fileInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (!file) return;

    if (file.size > 10 * 1024 * 1024) {
        alert("File terlalu besar. Maksimal 10MB.");
        fileInput.value = "";
        return;
    }

    selectedFile = file;
    const fileType = file.type;

    nameText.textContent = file.name;
    typeText.textContent = fileType;

    // let element = "";

    // if (fileType.startsWith("image/")) {
    //     element = `<img src="${URL.createObjectURL(
    //         file
    //     )}" class="rounded" style="height: 60px;">`;
    // } else if (fileType.startsWith("video/")) {
    //     element = `<i class="bi bi-camera-video-fill fs-1 text-primary"></i>`;
    // } else if (fileType === "application/pdf") {
    //     element = `<i class="bi bi-file-earmark-pdf-fill fs-1 text-danger"></i>`;
    // } else {
    //     element = `<i class="bi bi-paperclip fs-1 text-muted"></i>`;
    // }
    const sizeKB = (file.size / 1024).toFixed(1) + " KB";

    const iconHtml = (() => {
        if (fileType.startsWith("image/")) {
            return `<img src="${URL.createObjectURL(
                file
            )}" class="rounded" style="height: 60px;">`;
        } else if (fileType.startsWith("video/")) {
            return `<i class="bi bi-camera-video-fill fs-1 text-primary"></i>`;
        } else if (fileType === "application/pdf") {
            return `<i class="bi bi-file-earmark-pdf-fill fs-1 text-danger"></i>`;
        } else if (
            [
                "application/msword",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            ].includes(fileType)
        ) {
            return `<i class="bi bi-file-earmark-word-fill fs-1 text-primary"></i>`;
        } else if (
            [
                "application/vnd.ms-excel",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            ].includes(fileType)
        ) {
            return `<i class="bi bi-file-earmark-excel-fill fs-1 text-success"></i>`;
        } else if (
            [
                "application/vnd.ms-powerpoint",
                "application/vnd.openxmlformats-officedocument.presentationml.presentation",
            ].includes(fileType)
        ) {
            return `<i class="bi bi-file-earmark-ppt-fill fs-1 text-warning"></i>`;
        } else if (
            [
                "application/zip",
                "application/x-rar-compressed",
                "application/x-zip-compressed",
            ].includes(fileType)
        ) {
            return `<i class="bi bi-file-zip-fill fs-1 text-secondary"></i>`;
        }
        return `<i class="bi bi-paperclip fs-1 text-muted"></i>`;
    })();

    thumb.innerHTML = iconHtml;
    nameText.textContent = file.name;
    typeText.textContent = `${fileType} – ${sizeKB}`;
    previewBox.classList.remove("d-none");

    // thumb.innerHTML = element;
    // previewBox.classList.remove("d-none");

    // Buka modal saat diklik preview
    thumb.onclick = () => {
        fullscreenModalContent.innerHTML = ""; // Kosongkan isi dulu

        let previewElement;

        if (fileType.startsWith("image/")) {
            previewElement = document.createElement("img");
            previewElement.src = URL.createObjectURL(file);
            previewElement.className = "img-fluid";
            previewElement.style.maxHeight = "90vh";
        } else if (fileType.startsWith("video/")) {
            previewElement = document.createElement("video");
            previewElement.src = URL.createObjectURL(file);
            previewElement.controls = true;
            previewElement.style.maxHeight = "70vw";
        } else if (fileType === "application/pdf") {
            previewElement = document.createElement("div");
            const blobUrl = URL.createObjectURL(file);
            previewElement.innerHTML = `
                                <p class="text-white fs-4">📄 Dokumen PDF: ${file.name}</p>
                                <p class="text-white"> Pratinjau PDF tidak tersedia. Klik tombol di bawah untuk membuka.</p>
                                <a href="${blobUrl}" target="_blank" class="btn btn-light">Buka PDF</a>
                            `;
        } else if (
            fileType === "application/msword" ||
            fileType ===
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
        ) {
            previewElement = document.createElement("div");
            const blobUrl = URL.createObjectURL(file);
            previewElement.innerHTML = `
                                <p class="text-white fs-4">📄 Dokumen Word: ${file.name}</p>
                                <p class="text-white"> Pratinjau Word tidak tersedia. Klik tombol di bawah untuk membuka.</p>
                                <a href="${blobUrl}" target="_blank" class="btn btn-light">Buka Word</a>
                            `;
        } else if (
            fileType === "application/vnd.ms-excel" ||
            fileType ===
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        ) {
            previewElement = document.createElement("div");
            const blobUrl = URL.createObjectURL(file);
            previewElement.innerHTML = `
                                <p class="text-white fs-4">📊 Excel File: ${file.name}</p>
                                <p class="text-white"> Pratinjau Excel tidak tersedia. Klik tombol di bawah untuk membuka.</p>
                                <a href="${blobUrl}" target="_blank" class="btn btn-light">Buka Excel</a>
                            `;
        } else if (
            fileType === "application/vnd.ms-powerpoint" ||
            fileType ===
                "application/vnd.openxmlformats-officedocument.presentationml.presentation"
        ) {
            previewElement = document.createElement("div");
            const blobUrl = URL.createObjectURL(file);
            previewElement.innerHTML = `
                                <p class="text-white fs-4">📄 PowerPoint: ${file.name}</p>
                                <p class="text-white">Pratinjau tidak tersedia. Klik tombol di bawah untuk membuka.</p>
                                <a href="${blobUrl}" target="_blank" class="btn btn-light">Buka PPT</a>
                            `;
        } else if (
            fileType === "application/zip" ||
            fileType === "application/x-rar-compressed" ||
            fileType === "application/x-zip-compressed"
        ) {
            previewElement = document.createElement("div");
            const blobUrl = URL.createObjectURL(file);
            previewElement.innerHTML = `
                                <p class="text-white fs-4">🗜️ File Arsip: ${file.name}</p>
                                <p class="text-white">Klik tombol di bawah untuk download.</p>
                                <a href="${blobUrl}" target="_blank" class="btn btn-light">Download</a>
                            `;
        } else {
            previewElement = document.createElement("p");
            previewElement.className = "text-white";
            previewElement.textContent = "📎 " + file.name;
        }

        fullscreenModalContent.appendChild(previewElement);

        const previewModal = new bootstrap.Modal(
            document.getElementById("fileFullscreenModal"),
            {
                backdrop: false,
                keyboard: true,
                focus: false,
            }
        );
        previewModal.show();
    };
});

cancelBtn.addEventListener("click", function () {
    fileInput.value = "";
    previewBox.classList.add("d-none");
    thumb.innerHTML = "";
    nameText.textContent = "";
    typeText.textContent = "";
});

// Reset setelah form dikirim
document.getElementById("message-form").addEventListener("submit", function () {
    previewBox.classList.add("d-none");
    thumb.innerHTML = "";
    nameText.textContent = "";
    typeText.textContent = "";

    // Tutup modal preview jika sedang terbuka
    const modalEl = document.getElementById("fileFullscreenModal");
    const modalInstance = bootstrap.Modal.getInstance(modalEl);
    if (modalInstance) {
        modalInstance.hide();
    }
});

// Preview Gambar
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("previewable-file")) {
        const fileUrl = e.target.dataset.fileUrl;
        const fileType = e.target.dataset.fileType;
        const fileName = e.target.dataset.fileName;

        const fullscreenModalContent = document.getElementById(
            "fullscreenModalContent"
        );
        fullscreenModalContent.innerHTML = ""; // Kosongkan isi sebelumnya
        fullscreenModalContent.style.maxHeight = "90vh";
        fullscreenModalContent.style.overflowY = "auto";

        let previewElement;

        if (fileType.startsWith("image/")) {
            previewElement = document.createElement("img");
            previewElement.src = fileUrl;
            previewElement.className = "img-fluid";
            previewElement.style.maxHeight = "80vh";
            previewElement.style.objectFit = "contain";
            previewElement.style.display = "block";
            previewElement.style.margin = "0 auto";
        } else {
            previewElement = document.createElement("div");
            previewElement.innerHTML = `
                    <p class="text-white">Tidak bisa menampilkan file ini. Silakan unduh.</p>
                    <a href="${fileUrl}" target="_blank" class="btn btn-light">Download</a>
                `;
        }

        fullscreenModalContent.appendChild(previewElement);

        const previewModal = new bootstrap.Modal(
            document.getElementById("fileFullscreenModal"),
            {
                backdrop: false,
                keyboard: true,
                focus: false,
            }
        );
        previewModal.show();
    }
});
