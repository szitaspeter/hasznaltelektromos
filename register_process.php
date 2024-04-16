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

// Regisztráció adatok kezelése
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Felhasználónév ellenőrzése
    $check_username_query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_username_query);

    if ($result->num_rows > 0) {
        echo "Ez a felhasználónév már foglalt!";
    } else {
        // Felhasználó hozzáadása az adatbázishoz
        $insert_user_query = "INSERT INTO users (fullname, username, email, password) 
                              VALUES ('$fullname', '$username', '$email', '$password')";

        if ($conn->query($insert_user_query) === TRUE) {
            echo "Sikeres regisztráció!";
        } else {
            echo "Hiba a regisztráció során: " . $conn->error;
        }
    }
}

$conn->close();
?>
