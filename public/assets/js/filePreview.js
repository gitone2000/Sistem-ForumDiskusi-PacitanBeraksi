function previewImage(input, targetId) {
    const file = input.files[0];
    const target = document.getElementById(targetId);

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            target.src = e.target.result;
            target.classList.remove("d-none");
        };
        reader.readAsDataURL(file);
    } else {
        target.src = "";
        target.classList.add("d-none");
    }
}
