document
    .getElementById("message-form")
    .addEventListener("submit", function (e) {
        e.preventDefault(); // Cegah reload

        const form = e.target;
        const messageInput = document.getElementById("message");
        const fileInput = document.getElementById("file-upload");
        const formData = new FormData(form);

        // Kirim ke backend
        axios
            .post(form.action, formData)
            .then((response) => {
                // Kosongkan input dan file
                messageInput.value = "";
                fileInput.value = "";

                // Ambil data pesan dari respons (asumsikan respons JSON)
                const e = response.data;
                const box = document.getElementById("chat-message-container");
                const msg = document.createElement("div");

                if (e.file_url) {
                    const filename = e.file_url.split("/").pop();
                    const previewUrl = `/dashboard/forum/file/preview/${filename}`;
                    e.file_path = previewUrl;
                }

                const bubble = renderMessageBubble(e);
                box.appendChild(bubble);
                box.scrollTop = box.scrollHeight;

                // let filePreview = "";
                // if (e.file_url) {
                //     const fileType = e.file_type;

                //     if (fileType.startsWith("image/")) {
                //         filePreview = `
                //                 <div class="mt-2">
                //                     <img src="${e.file_url}" alt="gambar" class="img-fluid rounded mb-2 previewable-file"
                //                     data-file-url="${e.file_url}"
                //                     data-file-type="${e.file_type}"
                //                     data-file-name="${e.file_name}"
                //                     style="max-height: 200px;">
                //                 </div>`;
                //     } else if (fileType.startsWith("video/")) {
                //         filePreview = `
                //                 <div class="mt-2">
                //                     <video controls style="max-width: 100%; max-height: 300px;">
                //                         <source src="${e.file_url}" type="${fileType}">
                //                         Browser tidak mendukung video.
                //                         </video>
                //                 </div>`;
                //     } else if (fileType === "application/pdf") {
                //         filePreview = `
                //                 <div class="text-center">
                //                     <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 3rem;"></i>
                //                         <p class="small text-muted">${e.file_url
                //                             .split("/")
                //                             .pop()}</p>
                //                         <a href="${
                //                             e.file_url
                //                         }" target="_blank" class="btn btn-sm btn-outline-danger">Buka PDF</a>
                //                 </div>`;
                //     } else if (
                //         [
                //             "application/msword",
                //             "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                //         ].includes(fileType)
                //     ) {
                //         filePreview = `
                //                 <div class="text-center">
                //                     <i class="bi bi-file-earmark-word-fill text-primary" style="font-size: 3rem;"></i>
                //                         <p class="small text-muted">${e.file_url
                //                             .split("/")
                //                             .pop()}</p>
                //                         <a href="${
                //                             e.file_url
                //                         }" target="_blank" class="btn btn-sm btn-outline-primary">Buka Word</a>
                //                 </div>`;
                //     } else if (
                //         [
                //             "application/vnd.ms-excel",
                //             "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                //         ].includes(fileType)
                //     ) {
                //         filePreview = `
                //                 <div class="text-center">
                //                     <i class="bi bi-file-earmark-excel-fill text-success" style="font-size: 3rem;"></i>
                //                         <p class="small text-muted">${e.file_url
                //                             .split("/")
                //                             .pop()}</p>
                //                         <a href="${
                //                             e.file_url
                //                         }" target="_blank" class="btn btn-sm btn-outline-success">Buka Excel</a>
                //                 </div>`;
                //     } else if (
                //         [
                //             "application/vnd.ms-powerpoint",
                //             "application/vnd.openxmlformats-officedocument.presentationml.presentation",
                //         ].includes(fileType)
                //     ) {
                //         filePreview = `
                //                 <div class="text-center">
                //                     <i class="bi bi-file-earmark-ppt-fill text-warning" style="font-size: 3rem;"></i>
                //                         <p class="small text-muted">${e.file_url
                //                             .split("/")
                //                             .pop()}</p>
                //                         <a href="${
                //                             e.file_url
                //                         }" target="_blank" class="btn btn-sm btn-outline-warning">Buka PPT</a>
                //                 </div>`;
                //     } else if (
                //         [
                //             "application/zip",
                //             "application/x-rar-compressed",
                //             "application/x-zip-compressed",
                //         ].includes(fileType)
                //     ) {
                //         filePreview = `
                //                 <div class="text-center">
                //                     <i class="bi bi-file-zip-fill text-secondary" style="font-size: 3rem;"></i>
                //                         <p class="small text-muted">${e.file_url
                //                             .split("/")
                //                             .pop()}</p>
                //                         <a href="${
                //                             e.file_url
                //                         }" target="_blank" class="btn btn-sm btn-outline-secondary">Download File</a>
                //                 </div>`;
                //     } else {
                //         filePreview = `
                //                 <a href="${
                //                     e.file_url
                //                 }" target="_blank" class="text-decoration-underline">
                //                     📎 ${e.file_url.split("/").pop()}
                //                 </a>`;
                //     }
                // }

                // // Tampilkan langsung pesan dari diri sendiri
                // msg.innerHTML = `
                //     <div class="row no-margin right-chat justify-content-end">
                //         <div class="col-12">
                //             <div class="chat-block">
                //                 <div class="row">
                //                     <div class="col">
                //                         ${e.message || ""}
                //                         ${filePreview}
                //                     </div>
                //                 </div>
                //             </div>
                //     </div>
                //     <div class="col-12 text-end">
                //         <p class="text-muted small time">
                //             <i class="text-white"></i> ${e.created_at}
                //         </p>
                //     </div>
                //     </div>
                //     `;
                // box.appendChild(msg);
                // box.scrollTop = box.scrollHeight;
            })
            .catch((error) => {
                console.error("Gagal kirim pesan:", error);
            });
    });
