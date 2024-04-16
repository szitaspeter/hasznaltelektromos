<?php
session_start();

// Ellenőrizzük, hogy a felhasználó már be van jelentkezve
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include 'login_process.php';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bejelentkezés</h1>
        <nav>
            <a href="index.php">Főoldal</a>
            <a href="register.php">Regisztráció</a>
        </nav>
    </header>

    <section id="main-content">
        <form action="login.php" method="post">
            <label for="username">Felhasználónév:</label>
            <input type="text" name="username" required>

            <label for="password">Jelszó:</label>
            <input type="password" name="password" required>

            <button type="submit">Bejelentkezés</button>
        </form>
        <p>Még nincs fiókja? <a href="register.php">Regisztráljon</a>.</p>
    </section>

    <footer>
        <p>&copy; 2024 Elektromos Jármű Hirdetések</p>
    </footer>
</body>
</html>
