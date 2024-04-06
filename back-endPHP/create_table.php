<?php
include("connect_db.php");

$sql = "CREATE TABLE IF NOT EXISTS jokes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    joke_text TEXT
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'jokes' created successfully.<br>";
} else {
    echo "Error creating table 'jokes': " . mysqli_error($conn) . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS user_votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    joke_id INT,
    vote ENUM('like', 'dislike'),
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (joke_id) REFERENCES jokes(id)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table 'user_votes' created successfully.<br>";
} else {
    echo "Error creating table 'user_votes': " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
?>
