document.getElementById('reservationForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const responseMessage = document.getElementById('responseMessage');

    try {
        const response = await fetch('process.php', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();

        if (result.success) {
            responseMessage.textContent = result.message;
            responseMessage.style.color = 'green';
            this.reset(); // Reset the form
        } else {
            responseMessage.textContent = result.message;
            responseMessage.style.color = 'red';
        }
    } catch (error) {
        responseMessage.textContent = 'An error occurred. Please try again.';
        responseMessage.style.color = 'red';
    }
});
