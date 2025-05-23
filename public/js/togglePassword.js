function togglePassword(fieldId, iconId) {
    var passwordField = document.getElementById(fieldId);
    var eyeIcon = document.getElementById(iconId);

    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    }
    document.activeElement.blur();
}