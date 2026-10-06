document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("chat-message-container");
    if (!container) return;

    const SCROLL_THRESHOLD = 50;

    // Fungsi scroll ke bawah
    function scrollToBottom() {
        container.scrollTop = container.scrollHeight;
    }

    // Fungsi cek apakah user dekat dengan bawah
    function isNearBottom() {
        return (
            container.scrollHeight -
                container.scrollTop -
                container.clientHeight <=
            SCROLL_THRESHOLD
        );
    }

    // Ambil semua elemen yang berpotensi butuh waktu render
    const mediaElements = container.querySelectorAll("img, video");

    if (mediaElements.length === 0) {
        scrollToBottom();
    } else {
        let loadedCount = 0;
        mediaElements.forEach((el) => {
            // Video case
            if (el.tagName.toLowerCase() === "video") {
                el.addEventListener("loadeddata", checkDone, { once: true });
            }
            // Gambar case
            else if (el.tagName.toLowerCase() === "img") {
                if (el.complete) {
                    checkDone();
                } else {
                    el.addEventListener("load", checkDone, { once: true });
                }
            }
        });

        function checkDone() {
            loadedCount++;
            if (loadedCount === mediaElements.length) {
                scrollToBottom();
            }
        }
    }
    // scrollToBottom();

    // Event listener untuk pesan baru
    window.handleNewChatMessage = function () {
        if (isNearBottom()) {
            setTimeout(scrollToBottom, 100);
        }
        // Jika tidak dekat bawah, biarkan user baca pesan lama
    };
});

// document.addEventListener("DOMContentLoaded", function () {
//     const container = document.getElementById("chat-message-container");
//     if (container) {
//         container.scrollTop = container.scrollHeight;
//     }
// });
