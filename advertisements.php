<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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

// Hirdetések lekérdezése csak bejelentkezett felhasználók számára
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT advertisements.id, advertisements.title, advertisements.description, advertisements.type, users.fullname, GROUP_CONCAT(images.file_path) AS image_paths
              FROM advertisements
              JOIN users ON advertisements.user_id = users.id
              LEFT JOIN images ON advertisements.id = images.ad_id
              WHERE advertisements.user_id = '$user_id'
              GROUP BY advertisements.id
              LIMIT 10"; // Csak az első 10 hirdetést kérjük le
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='advertisement-container'>";
            echo "<div class='advertisement'>";
            echo "<h2><a href='advertisement_details.php?id={$row['id']}'>{$row['title']}</a></h2>";
            echo "<p>{$row['description']}</p>";
            echo "<p>Típus: {$row['type']}</p>";
            echo "<p>Feladó: {$row['fullname']}</p>";
            if ($row['image_paths']) {
                echo "<div class='image-container'>";
                $image_paths = explode(',', $row['image_paths']);
                foreach ($image_paths as $image_path) {
                    echo "<img src='{$image_path}' alt='Hirdetés kép'>";
                }
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Nincsenek hirdetések.</p>";
    }
} else {
    echo "<p>Kérjük, jelentkezzen be a hirdetések megtekintéséhez.</p>";
}

$conn->close();
?>



