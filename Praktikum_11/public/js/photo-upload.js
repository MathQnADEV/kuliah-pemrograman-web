const fileInput = document.getElementById("file-input");
const photoContainer = document.getElementById("photo-container");
const addPhotoButton = document.getElementById("add-photo");
const removePhotoButton = document.getElementById("remove-photo");
const defaultPhoto = "assets/images/icons/default-avatar.svg"; // Default photo path

// Trigger file input click when "Add" button is clicked
addPhotoButton.addEventListener("click", () => {
    fileInput.click();
});

// Handle file input change
fileInput.addEventListener("change", (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = () => {
            photoContainer.src = reader.result; // Update photo preview
            toggleButtons(true); // Show remove button, hide add button
        };
        reader.readAsDataURL(file);
    }
});

// Handle remove photo button
removePhotoButton.addEventListener("click", () => {
    photoContainer.src = defaultPhoto; // Reset to default photo
    fileInput.value = ""; // Clear file input
    toggleButtons(false); // Show add button, hide remove button
});

// Function to toggle buttons
function toggleButtons(photoAdded) {
    if (photoAdded) {
        addPhotoButton.classList.add("hidden");
        removePhotoButton.classList.remove("hidden");
    } else {
        addPhotoButton.classList.remove("hidden");
        removePhotoButton.classList.add("hidden");
    }
}