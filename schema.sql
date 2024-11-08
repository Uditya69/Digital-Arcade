CREATE DATABASE digital_arcade;

USE digital_arcade;

CREATE TABLE scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_name VARCHAR(50),
    player_name VARCHAR(50),
    score INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
