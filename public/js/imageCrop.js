let cropper;
let currentInput;

document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function(event) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('cropperImage').src = e.target.result;
                document.getElementById('cropModal').style.display = 'flex';

                // Destroy previous Cropper instance if it exists
                if (cropper) {
                    cropper.destroy();
                }

                // Initialize Cropper.js
                let image = document.getElementById('cropperImage');
                cropper = new Cropper(image, {
                    aspectRatio: NaN, // Free crop
                    viewMode: 1,
                    autoCropArea: 0.8
                });

                // Store the current input element
                currentInput = event.target;
                console.log("Current input set:", currentInput.id);
            };
            reader.readAsDataURL(file);
        }
    });
});

// Crop and save
document.getElementById('cropImage').addEventListener('click', function() {
    if (cropper) {
        let croppedImage = cropper.getCroppedCanvas()?.toDataURL("image/png");

        if (croppedImage) {
            console.log("Cropped Image Generated");

            if (currentInput) {
                let inputId = currentInput.id;

                if (inputId === 'photo_input') {
                    document.getElementById('photo').value = croppedImage;
                    document.getElementById('photo_preview').src = croppedImage;
                    document.getElementById('photo_preview').classList.remove('d-none');
                } else if (inputId === 'signature_input') {
                    document.getElementById('signature').value = croppedImage;
                    document.getElementById('signature_preview').src = croppedImage;
                    document.getElementById('signature_preview').classList.remove('d-none');
                }

                console.log(`Saved cropped image to: ${inputId}`);
            } else {
                console.error("currentInput is null");
            }
        } else {
            console.error("Cropper failed to generate cropped image");
        }

        // Close modal
        document.getElementById('cropModal').style.display = 'none';
    }
});

// Close cropper without saving
document.getElementById('closeCropper').addEventListener('click', function() {
    document.getElementById('cropModal').style.display = 'none';
});