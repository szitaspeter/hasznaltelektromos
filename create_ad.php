<?php
session_start();

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hirdetésfeladás</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Hirdetésfeladás</h1>
        <nav>
            <a href="index.php">Főoldal</a>
            <a href="create_ad.php">Hirdetésfeladás</a>
            <form method="post" action="index.php">
                <button type="submit" name="logout">Kijelentkezés</button>
            </form>
        </nav>
    </header>

    <section id="main-content">
        <form action="create_ad_process.php" method="post" enctype="multipart/form-data">
            <label for="title">Cím:</label>
            <input type="text" name="title" required>

            <label for="description">Leírás:</label>
            <textarea name="description" rows="4" required></textarea>

            <label for="type">Típus:</label>
            <select name="type" required>
                <option value="car">Elektromos Autó</option>
                <option value="battery">Bontott Akkumulátor</option>
            </select>

            <label for="brand">Márka:</label>
            <select name="brand" required>
                <?php
                // Itt listázzuk ki az összes márkát az ABC sorrendben
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "elektromos_jarmuvek";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $brand_query = "SELECT name FROM brands ORDER BY name";
                $result = $conn->query($brand_query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['name']}'>{$row['name']}</option>";
                    }
                }

                $conn->close();
                ?>
            </select>

            <label for="images">Képek (maximum 6 db):</label>
            <input type="file" name="images[]" accept="image/*" multiple required>

            <button type="submit">Hirdetésfeladás</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Elektromos Jármű Hirdetések</p>
    </footer>
</body>
</html>

