CREATE DATABASE reservations_db;

USE reservations_db;

CREATE TABLE reservations {
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    reservation_date DATE NOT NULL,
    people_count INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
};