function viewFullImage(url) {
    const modal = document.getElementById("imageModal");
    const fullImage = document.getElementById("fullImage");
    fullImage.src = url;
    modal.style.display = "flex";
}

function closeFullImage() {
    document.getElementById("imageModal").style.display = "none";
}
document.addEventListener("DOMContentLoaded", () => {
    const theme = localStorage.getItem("theme") || "light";
    document.documentElement.setAttribute("data-bs-theme", theme);
});