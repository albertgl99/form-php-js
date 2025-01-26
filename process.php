<?php
require 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $reservation_date = $_POST['reservation_date'];
    $people_count = intval($_POST['people_count']);

    if (empty($name) || empty($email) || empty($reservation_date) || $people_count <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO reservations (name, email, reservation_date, people_count) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $reservation_date, $people_count]);
    
        echo json_encode(['success' => true, 'message' => 'Reservation saved successfully!.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error saving reservation: ' . $e->getMessage()]);
    }
}

?>