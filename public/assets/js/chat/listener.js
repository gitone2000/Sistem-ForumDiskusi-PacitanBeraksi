// ID user yang sedang login
// const authUserId = {{ auth()->id() }};
const authUserId = window.authUserId;
const channelId = window.channelId;
let isAppending = false;

console.log("🔊 Echo listening to: chat." + channelId);

// listening channel
window.Echo.private(`chat.${channelId}`).listen(".ChatMessageSent", (e) => {
    if (isAppending) return;
    isAppending = true;
    console.log("Pesan baru:", e);
    // console.log("📎 e.file_path =", e.file_path);
    // console.log("📄 e.file_type =", e.file_type);

    const box = document.getElementById("chat-message-container");
    const msg = window.renderMessageBubble(e);
    // const msg = document.createElement("div");

    // let filePreview = "";
    // if (e.file_path) {
    //     console.log("✅ Jenis file:", e.file_type);
    //     console.log("✅ filePreview:", filePreview);

    //     const fileType = e.file_type;

    //     if (fileType.startsWith("image/")) {
    //         filePreview = `
    //                             <div class="mt-2">
    //                                 <img src="${e.file_path}" alt="gambar" class="img-fluid rounded mb-2 previewable-file"
    //                                 data-file-url="${e.file_path}"
    //                                 data-file-type="${e.file_type}"
    //                                 data-file-name="${e.file_name}"
    //                                 style="max-height: 200px;">
    //                             </div>`;
    //     } else if (fileType.startsWith("video/")) {
    //         filePreview = `
    //                             <div class="mt-2">
    //                                 <video controls style="max-width: 100%; max-height: 300px;">
    //                                     <source src="${e.file_path}" type="${fileType}">
    //                                     Browser tidak mendukung video.
    //                                     </video>
    //                             </div>`;
    //     } else if (fileType === "application/pdf") {
    //         filePreview = `
    //                             <div class="text-center">
    //                                 <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 3rem;"></i>
    //                                     <p class="small text-muted">${e.file_path
    //                                         .split("/")
    //                                         .pop()}</p>
    //                                     <a href="${
    //                                         e.file_path
    //                                     }" target="_blank" class="btn btn-sm btn-outline-danger">Buka PDF</a>
    //                             </div>`;
    //     } else if (
    //         [
    //             "application/msword",
    //             "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    //         ].includes(fileType)
    //     ) {
    //         filePreview = `
    //                             <div class="text-center">
    //                                 <i class="bi bi-file-earmark-word-fill text-primary" style="font-size: 3rem;"></i>
    //                                     <p class="small text-muted">${e.file_path
    //                                         .split("/")
    //                                         .pop()}</p>
    //                                     <a href="${
    //                                         e.file_path
    //                                     }" target="_blank" class="btn btn-sm btn-outline-primary">Buka Word</a>
    //                             </div>`;
    //     } else if (
    //         [
    //             "application/vnd.ms-excel",
    //             "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    //         ].includes(fileType)
    //     ) {
    //         filePreview = `
    //                             <div class="text-center">
    //                                 <i class="bi bi-file-earmark-excel-fill text-success" style="font-size: 3rem;"></i>
    //                                     <p class="small text-muted">${e.file_path
    //                                         .split("/")
    //                                         .pop()}</p>
    //                                     <a href="${
    //                                         e.file_path
    //                                     }" target="_blank" class="btn btn-sm btn-outline-success">Buka Excel</a>
    //                             </div>`;
    //     } else if (
    //         [
    //             "application/vnd.ms-powerpoint",
    //             "application/vnd.openxmlformats-officedocument.presentationml.presentation",
    //         ].includes(fileType)
    //     ) {
    //         filePreview = `
    //                             <div class="text-center">
    //                                 <i class="bi bi-file-earmark-ppt-fill text-warning" style="font-size: 3rem;"></i>
    //                                     <p class="small text-muted">${e.file_path
    //                                         .split("/")
    //                                         .pop()}</p>
    //                                     <a href="${
    //                                         e.file_path
    //                                     }" target="_blank" class="btn btn-sm btn-outline-warning">Buka PPT</a>
    //                             </div>`;
    //     } else if (
    //         [
    //             "application/zip",
    //             "application/x-rar-compressed",
    //             "application/x-zip-compressed",
    //         ].includes(fileType)
    //     ) {
    //         filePreview = `
    //                             <div class="text-center">
    //                                 <i class="bi bi-file-zip-fill text-secondary" style="font-size: 3rem;"></i>
    //                                     <p class="small text-muted">${e.file_path
    //                                         .split("/")
    //                                         .pop()}</p>
    //                                     <a href="${
    //                                         e.file_path
    //                                     }" target="_blank" class="btn btn-sm btn-outline-secondary">Download File</a>
    //                             </div>`;
    //     } else {
    //         filePreview = `
    //                             <a href="${
    //                                 e.file_path
    //                             }" target="_blank" class="text-decoration-underline">
    //                                 📎 ${e.file_path.split("/").pop()}
    //                             </a>`;
    //     }
    // }

    // // Cek apakah pesan ini dikirim oleh user yang sedang login
    // const isMe = e.user.id === authUserId;
    // if (isMe) {
    //     // Pesan dari diri sendiri (bubble kanan)
    //     msg.innerHTML = `
    //             <div class="row no-margin right-chat justify-content-end">
    //                 <div class="col-12">
    //                     <div class="chat-block">
    //                         <div class="row">
    //                             <div class="col">
    //                                 ${e.message || ""}
    //                                 ${filePreview}
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //                 <div class="col-12 text-end">
    //                     <p class="text-muted small time">
    //                         <i class="text-white"></i> ${e.created_at}
    //                     </p>
    //                 </div>
    //             </div>
    //             `;
    // } else {
    //     // Pesan dari user lain (bubble kiri)
    //     msg.innerHTML = `
    //             <div class="row no-margin left-chat">
    //                 <div class="col-12 d-flex align-items-center gap-2 mb-1">
    //                     <div class="avatar avatar-36 rounded-circle">
    //                         <img src="${
    //                             e.user.foto_diri_url
    //                         }" alt="avatar" class="rounded-circle" style="width: 32px; height: 32px;">
    //                     </div>
    //                     <strong class="small">${e.user.nama}</strong>
    //                 </div>
    //                 <div class="col-12">
    //                     <div class="chat-block">
    //                         <div class="row">
    //                             <div class="col">
    //                                 ${e.message || ""}
    //                                 ${filePreview}
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //                 <div class="col-12">
    //                     <p class="text-muted small time">
    //                         <i class=""></i> ${e.created_at}
    //                     </p>
    //                 </div>
    //             </div>
    //             `;
    // }

    // Cek apakah scroll dekat dengan bawah
    const isScrolledToBottom =
        box.scrollHeight - box.clientHeight <= box.scrollTop + 50;

    // Tambahkan bubble ke container
    box.appendChild(msg);

    // Tampilkan alert jika tidak sedang scroll di bawah
    if (!isScrolledToBottom) {
        const alert = document.getElementById("new-message-alert");
        alert.classList.remove("d-none");
        alert.onclick = () => {
            box.scrollTop = box.scrollHeight;
            alert.classList.add("d-none");
        };
    }

    // Auto scroll jika posisi sebelumnya di bawah
    if (isScrolledToBottom) {
        box.scrollTop = box.scrollHeight;
    }
    // Trigger fungsi scroll tambahan jika ada
    if (typeof window.handleNewChatMessage === "function") {
        window.handleNewChatMessage();
    }

    isAppending = false;
});

// Debug koneksi Pusher
Echo.connector.pusher.connection.bind("connected", function () {
    console.log("✅ Echo terhubung ke Pusher");
});
Echo.connector.pusher.connection.bind("error", function (err) {
    console.error("❌ Error Echo:", err);
});
