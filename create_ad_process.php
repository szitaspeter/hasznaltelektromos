<?php
session_start();

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Kapcsolódás az adatbázishoz
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elektromos_jarmuvek";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hirdetés feladása adatok kezelése
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $type = $_POST["type"];
    $brand = $_POST["brand"];
    $user_id = $_SESSION['user_id'];

    // Hirdetés hozzáadása az adatbázishoz
    $insert_ad_query = "INSERT INTO advertisements (title, description, type, brand, user_id) 
                        VALUES ('$title', '$description', '$type', '$brand', '$user_id')";

    if ($conn->query($insert_ad_query) === TRUE) {
        $ad_id = $conn->insert_id;

        // Képek feltöltése és hozzárendelése a hirdetéshez
        $uploads_dir = "uploads/";

        // Minden feltöltött fájlra ciklus
        foreach ($_FILES["images"]["error"] as $key => $error) 
        {
            if ($error == UPLOAD_ERR_OK) 
            {
                $tmp_name = $_FILES["images"]["tmp_name"][$key];
                $file_name = basename($_FILES["images"]["name"][$key]);
                $target_file = $uploads_dir . $file_name;

                if (move_uploaded_file($tmp_name, $target_file)) 
                {
                    // Kép hozzáadása az adatbázishoz
                    $insert_image_query = "INSERT INTO images (ad_id, file_path) VALUES ('$ad_id', '$target_file')";
                    $conn->query($insert_image_query);
                } else 
                {
                    echo "Hiba a képfeltöltés során: " . $_FILES["images"]["error"][$key];
                }
            }
        }

        echo "Sikeres hirdetésfeladás!";
        
        // Visszatérés a főoldalra
        header("Location: index.php");
        exit();
    } else {
        echo "Hiba a hirdetésfeladás során: " . $conn->error;
    }
}

$conn->close();
?>
