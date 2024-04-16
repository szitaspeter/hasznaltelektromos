<?php
session_start();
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

// Adatbázis kapcsolati információk
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elektromos_jarmuvek";

// Adatbáziskapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Adatbáziskapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$fullname = $phone = $address = '';

// Profiladatok lekérdezése adatbázisból
$query = "SELECT * FROM profiles WHERE user_id = $user_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fullname = $row['fullname'];
    $phone = $row['phone'];
    $address = $row['address'];
}

$message = '';
$success = true;

// Profiladatok mentése
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"] ?? $fullname;
    $phone = $_POST["phone"] ?? $phone;
    $address = $_POST["address"] ?? $address;
    $password = $_POST["password"];

    // Profiladatok frissítése az adatbázisban
    $update_query = "UPDATE profiles SET fullname=?, phone=?, address=? WHERE user_id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssi", $fullname, $phone, $address, $user_id);
    if (!$stmt->execute()) {
        $message = 'Hiba történt a profil frissítése közben: ' . $stmt->error;
        $success = false;
    }

    // Jelszó frissítése, ha szükséges
    if ($success && !empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $update_pass_query = "UPDATE users SET password=? WHERE id=?";
        $stmt = $conn->prepare($update_pass_query);
        $stmt->bind_param("si", $password_hash, $user_id);
        if (!$stmt->execute()) {
            $message = 'Hiba történt a jelszó frissítése közben: ' . $stmt->error;
            $success = false;
        }
    }

    $stmt->close();

    // Sikeres mentés esetén vissza a főoldalra
    if ($success) {
        header("Location: index.php");
        exit();
    }
}

$conn->close();
?>

