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

// Ellenőrizzük, hogy az id paraméter meg lett-e adva az URL-ben
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Lekérdezzük a hirdetés részleteit az adatbázisból
    $query = "SELECT advertisements.*, users.fullname, GROUP_CONCAT(images.file_path) AS image_paths
              FROM advertisements
              JOIN users ON advertisements.user_id = users.id
              LEFT JOIN images ON advertisements.id = images.ad_id
              WHERE advertisements.id = '$id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<header style='background-color: #333; color: white; padding: 25px; text-align: center;'>";
        echo "<h1>{$row['title']}</h1>";
        echo "<nav>";
        echo "<a href='index.php' style='color: #4CAF50; text-decoration: none; margin-right: 20px; font-family: Arial, sans-serif; font-size: 16px;'>Főoldal</a>";
        echo "<a href='create_ad.php' style='color: #4CAF50; text-decoration: none; margin-right: 20px; font-family: Arial, sans-serif; font-size: 16px;'>Hirdetésfeladás</a>";
        echo "<a href='search.php' style='color: #4CAF50; text-decoration: none; margin-right: 20px; font-family: Arial, sans-serif; font-size: 16px;'>Új keresés</a>";
        echo "<form method='post' action='index.php'>";
        echo "<button type='submit' name='logout' style='background-color: #333; color: white; border: none; cursor: pointer; font-family: Arial, sans-serif; font-size: 16px;'>Kijelentkezés</button>";
        echo "</form>";
        echo "</nav>";
        echo "</header>";

        echo "<section id='main-content' style='margin: 20px auto; text-align: center;'>";
        echo "<div class='advertisement-container'>";
        echo "<div class='advertisement' style='margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 8px;'>";
        echo "<p>{$row['description']}</p>";
        echo "<p>Típus: {$row['type']}</p>";
        echo isset($row['year']) ? "<p>Évjárat: {$row['year']}</p>" : "<p>Évjárat: Nincs adat</p>";
        echo "<p>Feladó: {$row['fullname']}</p>";

        // Hirdetéshez tartozó képek megjelenítése
        if ($row['image_paths']) {
            $image_paths = explode(',', $row['image_paths']);
            $num_images = count($image_paths);
            echo "<div class='image-container'>";
            for ($i = 0; $i < min(3, $num_images); $i++) {
                echo "<img class='small-image' src='{$image_paths[$i]}' alt='Hirdetés kép' style='max-width: 100px; height: auto; margin-right: 10px; border: 1px solid #ddd; padding: 5px;'>";
            }
            if ($num_images > 3) {
                echo "<button onclick='openGallery(" . json_encode($image_paths) . ")' id='show-more' style='background-color: #4CAF50; color: white; padding: 10px; cursor: pointer; border: none; border-radius: 4px; font-family: Arial, sans-serif; font-size: 16px;'>További képek</button>";
            }
            echo "</div>";
        }

        // További adatok megjelenítése...
        echo "</div>";
        echo "</div>";
        echo "</section>";
    } else {
        echo "<p>A hirdetés nem található.</p>";
    }
} else {
    echo "<p>Nincs megadva hirdetés azonosító.</p>";
}

$conn->close();
?>

<script>
// Függvény a képek megjelenítésére az új ablakban
function openGallery(imagePaths) {
    // Létrehozzuk az új ablakot
    var galleryWindow = window.open("", "_blank", "width=800,height=600");

    // Megjelenítjük az első képet kisebb méretben
    galleryWindow.document.write("<div style='text-align: center;'>");
    galleryWindow.document.write("<img id='gallery-image' src='" + imagePaths[0] + "' style='max-width: 400px; height: auto; display: block;'>");
    galleryWindow.document.write("</div>");

   

    // A többi kép megjelenítése
    galleryWindow.document.write("<div style='text-align: center; margin-top: 20px;'>");
    for (var i = 0; i < imagePaths.length; i++) {
        if (i !== 0) {
            galleryWindow.document.write("<img class='small-image' src='" + imagePaths[i] + "' style='max-width: 100px; height: auto; margin-right: 10px; border: 1px solid #ddd; padding: 5px;' onclick='showImage(" + JSON.stringify(imagePaths) + "," + i + ")'>");
        }
    }
    galleryWindow.document.write("</div>");
}



// Kattintott kép megjelenítése
function showImage(imagePaths, index) {
    var galleryImage = galleryWindow.document.getElementById('gallery-image');
    galleryImage.src = imagePaths[index];
}
</script>

