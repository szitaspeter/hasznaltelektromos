<?php
// Kapcsolódás az adatbázishoz
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elektromos_jarmuvek";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Bejelentkezés adatok kezelése
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Felhasználó ellenőrzése
    $check_user_query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_user_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Sikeres bejelentkezés
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
            exit();
        } else {
            // Hibás jelszó
            logAction($conn, $row['id'], "Failed login attempt");
            echo "Hibás jelszó!";
        }
    } else {
        // Nincs ilyen felhasználó
        echo "Nincs ilyen felhasználó!";
    }
}

$conn->close();

// Naplózás funkció
function logAction($conn, $userId, $action) {
    $log_query = "INSERT INTO logs (user_id, action) VALUES ('$userId', '$action')";
    $conn->query($log_query);
}
?>
