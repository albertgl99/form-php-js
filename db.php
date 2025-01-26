<?php
$host = 'localhost';
$user = 'root'; // Cambia si tienes otro usuario
$password = 'root'; // Cambia si tienes una contraseña configurada
$db = 'reservations_db';

try {
    // Conexión al servidor MySQL
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Comprobar si la base de datos existe
    $result = $pdo->query("SHOW DATABASES LIKE '$db'");
    if ($result->rowCount() == 0) {
        // Crear la base de datos si no existe
        $pdo->exec("CREATE DATABASE $db");
        echo "Database '$db' created successfully.<br>";
    }

    // Usar la base de datos
    $pdo->exec("USE $db");

    // Crear la tabla 'reservations' si no existe
    $tableSql = "
        CREATE TABLE IF NOT EXISTS reservations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            reservation_date DATE NOT NULL,
            people_count INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ";
    $pdo->exec($tableSql);
    echo "Table 'reservations' is ready to use.<br>";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
