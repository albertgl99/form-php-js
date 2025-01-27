// Selecciona el formulario por su ID y añade un event listener para el evento 'submit'
document.getElementById('reservationForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // Evita el comportamiento por defecto del formulario (recarga de la página)

    const formData = new FormData(this); // Crea un objeto FormData con los datos del formulario
    const responseMessage = document.getElementById('responseMessage'); // Selecciona el elemento donde se mostrará el mensaje de respuesta

    try {
        // Envía una solicitud POST al archivo 'process.php' con los datos del formulario
        const response = await fetch('process.php', {
            method: 'POST',
            body: formData, // Pasa los datos del formulario como el cuerpo de la solicitud
        });

        const result = await response.json(); // Convierte la respuesta en formato JSON

        if (result.success) { // Si la respuesta indica éxito
            responseMessage.textContent = result.message; // Muestra el mensaje de éxito
            responseMessage.style.color = 'green'; // Cambia el color del mensaje a verde
            this.reset(); // Reinicia los campos del formulario
        } else { // Si la respuesta indica un error
            responseMessage.textContent = result.message; // Muestra el mensaje de error
            responseMessage.style.color = 'red'; // Cambia el color del mensaje a rojo
        }
    } catch (error) { // Manejo de errores en caso de fallo en la solicitud
        responseMessage.textContent = 'An error occurred. Please try again.'; // Mensaje genérico en caso de error
        responseMessage.style.color = 'red'; // Cambia el color del mensaje a rojo
    }
});
