// Select all buttons that will trigger the modal
const modalButtons = document.querySelectorAll('.show-modal-btn');
const modal = document.getElementById('Gallery-Modal');
const modalContent = document.getElementById('Modal-Content');
const modalImage = modal.querySelector('img'); // Select the image inside the modal
const closeModalButton = document.getElementById('closeModal');

// Add event listeners to all modal buttons
modalButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const imgSrc = button.querySelector('img').getAttribute('src'); // Get the image source from the button
        modalImage.setAttribute('src', imgSrc); // Update the modal image source
        
        // Show the modal with GSAP animation
        modal.style.display = 'flex';
        document.body.classList.add('overflow-hidden'); // Add overflow-hidden to body
        
        gsap.fromTo(modalContent,
            { scale: 0.5, opacity: 0 },
            { scale: 1, opacity: 1, duration: 0.5, ease: 'power2.out' }
        );
    });
});

// Function to close the modal
closeModalButton.addEventListener('click', () => {
    gsap.to(modalContent,
        {
            scale: 0.5, opacity: 0, duration: 0.4, ease: 'power2.in', onComplete: () => {
                modal.style.display = 'none';
                document.body.classList.remove('overflow-hidden'); // Remove overflow-hidden from body
            }
        }
    );
});
