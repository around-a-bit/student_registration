function previewImage(input, previewId) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            preview.src = e.target.result;
            preview.classList.remove("d-none");
        };
        reader.readAsDataURL(file);
    }
}
function previewImage(input, previewId, originalSrc){
    const file = input.files[0];
    const preview = document.getElementById(previewId);
    if (!preview) {
        console.error(`Preview element (${previewId}) not found!`);
        return;
    }

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove("d-none");
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = originalSrc;
        preview.classList.add("d-none");
    }
}