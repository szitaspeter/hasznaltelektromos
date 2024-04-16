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

// Keresési feltételek kezelése
$where_conditions = array();
if (!empty($_POST['brand'])) {
    $brand = $_POST['brand'];
    $where_conditions[] = "brand = '$brand'";
}
if (!empty($_POST['type'])) {
    $type = $_POST['type'];
    $where_conditions[] = "type = '$type'";
}

// WHERE feltétel összeállítása
$where_clause = implode(" AND ", $where_conditions);

// Hirdetések lekérdezése a feltételek alapján
$query = "SELECT * FROM advertisements";
if (!empty($where_clause)) {
    $query .= " WHERE $where_clause";
}

$result = $conn->query($query);

// Oldal fejléc része
echo "<!DOCTYPE html>";
echo "<html lang='hu'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Hirdetés Keresése</title>";
echo "<link rel='stylesheet' href='style.css'>";
echo "</head>";
echo "<body>";
echo "<header>";
echo "<h1>Hirdetés Keresése</h1>";
echo "<nav>";
echo "<a href='index.php'>Főoldal</a>";
echo "<a href='create_ad.php'>Hirdetésfeladás</a>";
echo "<a href='search.php'>Új keresés</a>";
echo "<form method='post' action='index.php'>";
echo "<button type='submit' name='logout'>Kijelentkezés</button>";
echo "</form>";
echo "</nav>";
echo "</header>";

// Oldal tartalmának megjelenítése
echo "<section id='main-content'>";
if ($result->num_rows > 0) {
    echo "<div class='advertisement-container'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='advertisement'>";
        echo "<h2><a href='advertisement_details.php?id={$row['id']}'>{$row['title']}</a></h2>";
        echo "<p>{$row['description']}</p>";
        echo "<p>Típus: {$row['type']}</p>";
        echo "<p>Márka: {$row['brand']}</p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>Nincs találat a keresésre.</p>";
}
echo "</section>";

// Oldal lábléc része
echo "<footer>";
echo "<p>&copy; 2024 Elektromos Jármű Hirdetések</p>";
echo "</footer>";

echo "</body>";
echo "</html>";

$conn->close();
?>
