<?php
require 'db.php'; // Conexión a la base de datos

// Obtener las reservas desde la base de datos
try {
    $stmt = $pdo->query("SELECT * FROM reservations ORDER BY created_at DESC");
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching reservations: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Reservation Form</h1>
    <form id="reservationForm" method="POST" action="process.php">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="reservation_date">Reservation Date:</label><br>
        <input type="date" id="reservation_date" name="reservation_date" required><br><br>

        <label for="people_count">Number of People:</label><br>
        <input type="number" id="people_count" name="people_count" min="1" required><br><br>

        <button type="submit">Submit</button>
    </form>

    <h2>Reservations</h2>
    <?php if (count($reservations) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Reservation Date</th>
                    <th>Number of People</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation['id']) ?></td>
                        <td><?= htmlspecialchars($reservation['name']) ?></td>
                        <td><?= htmlspecialchars($reservation['email']) ?></td>
                        <td><?= htmlspecialchars($reservation['reservation_date']) ?></td>
                        <td><?= htmlspecialchars($reservation['people_count']) ?></td>
                        <td><?= htmlspecialchars($reservation['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No reservations found.</p>
    <?php endif; ?>
</body>
</html>
