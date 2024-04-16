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
    <title>Hirdetés Keresése</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Hirdetés Keresése</h1>
        <nav>
            <a href="index.php">Főoldal</a>
            <a href="create_ad.php">Hirdetésfeladás</a>
            <a href="search.php">Hirdetés Keresése</a>
            <form method="post" action="index.php">
                <button type="submit" name="logout">Kijelentkezés</button>
            </form>
        </nav>
    </header>

    <section id="main-content">
        <form action="search_process.php" method="post">
            <label for="brand">Márka:</label>
            <select name="brand">
                <option value="">Válassz márkát</option>
                <?php
                // Márkák lekérdezése az adatbázisból
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "elektromos_jarmuvek";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $brand_query = "SELECT DISTINCT brand FROM advertisements";
                $result = $conn->query($brand_query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['brand']}'>{$row['brand']}</option>";
                    }
                }

                $conn->close();
                ?>
            </select>

            <label for="type">Típus:</label>
            <select name="type">
                <option value="">Válassz típust</option>
                <option value="car">Elektromos Autó</option>
                <option value="battery">Bontott Akkumulátor</option>
            </select>

            <button type="submit">Keresés</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Elektromos Jármű Hirdetések</p>
    </footer>
</body>
</html>
