<?php
require 'db.php'; // Incluye el archivo de conexión a la base de datos

header('Content-Type: application/json'); // Establece el tipo de contenido como JSON para la respuesta

// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene y limpia los datos enviados desde el formulario
    $name = trim($_POST['name']); // Elimina espacios en blanco al inicio y final del nombre
    $email = trim($_POST['email']); // Elimina espacios en blanco al inicio y final del correo
    $reservation_date = $_POST['reservation_date']; // Obtiene la fecha de reserva
    $people_count = intval($_POST['people_count']); // Convierte el número de personas a un entero

    // Valida que los campos requeridos no estén vacíos y que el número de personas sea válido
    if (empty($name) || empty($email) || empty($reservation_date) || $people_count <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']); // Responde con error si los datos son inválidos
        exit; // Termina la ejecución del script
    }

    try {
        // Prepara la consulta SQL para insertar los datos en la tabla "reservations"
        $stmt = $pdo->prepare("INSERT INTO reservations (name, email, reservation_date, people_count) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $reservation_date, $people_count]); // Ejecuta la consulta con los datos proporcionados

        // Responde con éxito si la inserción fue realizada correctamente
        echo json_encode(['success' => true, 'message' => 'Reservation saved successfully!.']);
    } catch (Exception $e) { // Manejo de excepciones en caso de error
        // Responde con un mensaje de error si ocurre algún problema al guardar la reserva
        echo json_encode(['success' => false, 'message' => 'Error saving reservation: ' . $e->getMessage()]);
    }
}
?>
