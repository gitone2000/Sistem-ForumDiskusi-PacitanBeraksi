// Fungsi pembantu: buat URL preview dari path file
function getPreviewUrl(filePath) {
    if (!filePath) return null;
    const filename = filePath.split("/").pop();
    return `/dashboard/forum/file/preview/${filename}`;
}

window.renderMessageBubble = function (msg) {
    const box = document.createElement("div");

    const isMe = msg.user.id === window.authUserId;
    const fileUrl = getPreviewUrl(msg.file_path);
    const fileType = msg.file_type || null;
    const fileName =
        msg.file_name || (msg.file_path ? msg.file_path.split("/").pop() : "");
    let filePreview = "";

    // Preview file
    if (fileUrl) {
        if (fileType.startsWith("image/")) {
            filePreview = `
                <div class="mt-2">
                    <img src="${fileUrl}" class="img-fluid rounded mb-2 previewable-file"
                        style="max-height: 200px;"
                        data-file-url="${fileUrl}" 
                        data-file-type="${fileType}" 
                        data-file-name="${fileName}">
                </div>`;
        } else if (fileType.startsWith("video/")) {
            filePreview = `
                <div class="mt-2">
                    <video controls style="max-width: 100%; max-height: 300px;">
                        <source src="${fileUrl}" type="${fileType}">
                        Browser tidak mendukung video.
                    </video>
                </div>`;
        } else if (fileType === "application/pdf") {
            filePreview = `
                <div class="text-center">
                    <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 3rem;"></i>
                    <p class="small text-muted">${fileName}</p>
                    <a href="${fileUrl}" target="_blank" class="btn btn-sm btn-outline-danger">Buka PDF</a>
                </div>`;
        } else if (
            [
                "application/msword",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            ].includes(fileType)
        ) {
            filePreview = `
                <div class="text-center">
                    <i class="bi bi-file-earmark-word-fill text-primary" style="font-size: 3rem;"></i>
                    <p class="small text-muted">${fileName}</p>
                    <a href="${fileUrl}" target="_blank" class="btn btn-sm btn-outline-primary">Buka Word</a>
                </div>`;
        } else if (
            [
                "application/vnd.ms-excel",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            ].includes(fileType)
        ) {
            filePreview = `
                <div class="text-center">
                    <i class="bi bi-file-earmark-excel-fill text-success" style="font-size: 3rem;"></i>
                    <p class="small text-muted">${fileName}</p>
                    <a href="${fileUrl}" target="_blank" class="btn btn-sm btn-outline-success">Buka Excel</a>
                </div>`;
        } else if (
            [
                "application/vnd.ms-powerpoint",
                "application/vnd.openxmlformats-officedocument.presentationml.presentation",
            ].includes(fileType)
        ) {
            filePreview = `
                <div class="text-center">
                    <i class="bi bi-file-earmark-ppt-fill text-warning" style="font-size: 3rem;"></i>
                    <p class="small text-muted">${fileName}</p>
                    <a href="${fileUrl}" target="_blank" class="btn btn-sm btn-outline-warning">Buka PPT</a>
                </div>`;
        } else if (
            [
                "application/zip",
                "application/x-rar-compressed",
                "application/x-zip-compressed",
            ].includes(fileType)
        ) {
            filePreview = `
                <div class="text-center">
                    <i class="bi bi-file-zip-fill text-secondary" style="font-size: 3rem;"></i>
                    <p class="small text-muted">${fileName}</p>
                    <a href="${fileUrl}" target="_blank" class="btn btn-sm btn-outline-secondary">Download File</a>
                </div>`;
        } else {
            filePreview = `
                <a href="${fileUrl}" target="_blank" class="text-decoration-underline">
                    📎 ${fileName}
                </a>`;
        }
    }

    const messageText = msg.message || "";
    const createdAt = msg.created_at || "";
    let createdAtHtml = `<p class="text-muted small time"><i class=""></i> ${createdAt}</p>`;

    if (isMe) {
        // Bubble dari diri sendiri
        box.innerHTML = `
        <div class="row no-margin right-chat justify-content-end">
            <div class="col-12">
                <div class="chat-block">
                    <div class="row">
                        <div class="col">${messageText}${filePreview}</div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-end">
                <p class="text-muted small time"><i class="text-white"></i> ${createdAtHtml}</p>
            </div>
        </div>`;
    } else {
        // Bubble dari orang lain
        const avatar = msg.user.foto_diri_url || "/assets/img/decaa.png";
        const nama = msg.user.nama || "User";

        box.innerHTML = `
        <div class="row no-margin left-chat">
            <div class="col-12 d-flex align-items-center gap-2 mb-1">
                <div class="avatar avatar-36 rounded-circle">
                    <img src="${avatar}" alt="avatar" class="rounded-circle" style="width: 32px; height: 32px;">
                </div>
                <strong class="small">${nama}</strong>
            </div>
            <div class="col-12">
                <div class="chat-block">
                    <div class="row">
                        <div class="col">${messageText}${filePreview}</div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <p class="text-muted small time">
                <i class=""></i> ${createdAtHtml}
                </p>
            </div>
        </div>`;
    }

    return box;
};
