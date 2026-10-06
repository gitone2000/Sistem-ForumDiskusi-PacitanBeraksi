document.addEventListener("DOMContentLoaded", function () {
    const loadBtn = document.getElementById("load-more-btn");
    const messageContainer = document.getElementById("chat-message-container");

    if (!loadBtn || !messageContainer) return;

    let isLoading = false;

    loadBtn.addEventListener("click", function () {
        if (isLoading || window.loadingOldMessages) return;

        isLoading = true;
        window.loadingOldMessages = true;

        const lastMessageId = loadBtn.dataset.lastId;
        const channelId = window.channelId;

        // Simpan posisi scroll sebelum fetch
        const prevScrollHeight = messageContainer.scrollHeight;

        fetch(`/dashboard/forum/${channelId}/messages?before=${lastMessageId}`)
            .then((res) => res.json())
            .then((data) => {
                // console.log("Data pesan lama:", data);
                if (data.messages.length === 0) {
                    loadBtn.classList.add("d-none");
                    return;
                }
                // Sisipkan pesan lama satu per satu
                data.messages.forEach((msg) => {
                    const bubble = window.renderMessageBubble(msg);
                    messageContainer.prepend(bubble);
                });

                // Update posisi scroll
                setTimeout(() => {
                    const newScrollHeight = messageContainer.scrollHeight;
                    messageContainer.scrollTop =
                        newScrollHeight - prevScrollHeight;
                    window.loadingOldMessages = false;
                }, 50);

                // Update data-last-id
                loadBtn.dataset.lastId =
                    data.messages[data.messages.length - 1].id;
            })
            .catch(console.error)
            .finally(() => {
                isLoading = false;
            });
    });
});
