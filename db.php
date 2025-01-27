<?php
// Datos de conexión al servidor MySQL
$host = 'localhost';
$user = 'root'; // Cambia si usas un usuario diferente
$password = 'root'; // Cambia si tienes una contraseña configurada
$db = 'reservations_db'; // Nombre de la base de datos

try {
    // Establece una conexión al servidor MySQL utilizando PDO
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilita el modo de errores para excepciones

    // Verifica si la base de datos ya existe
    $result = $pdo->query("SHOW DATABASES LIKE '$db'");
    if ($result->rowCount() == 0) { // Si no encuentra la base de datos
        // Crea la base de datos
        $pdo->exec("CREATE DATABASE $db");
        echo "Database '$db' created successfully.<br>";
    }

    // Selecciona la base de datos creada o existente
    $pdo->exec("USE $db");

    // Define el SQL para crear la tabla 'reservations' si no existe
    $tableSql = "
        CREATE TABLE IF NOT EXISTS reservations (
            id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único para cada reserva
            name VARCHAR(255) NOT NULL, -- Nombre del cliente (obligatorio)
            email VARCHAR(255) NOT NULL, -- Correo electrónico del cliente (obligatorio)
            reservation_date DATE NOT NULL, -- Fecha de la reserva (obligatorio)
            people_count INT NOT NULL, -- Número de personas en la reserva (obligatorio)
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha y hora de creación del registro
        );
    ";

    // Ejecuta la consulta para crear la tabla si no existe
    $pdo->exec($tableSql);
    echo "Table 'reservations' is ready to use.<br>"; // Mensaje de éxito
} catch (PDOException $e) {
    // Manejo de errores: muestra el mensaje y detiene la ejecución
    die("Error: " . $e->getMessage());
}
?>
