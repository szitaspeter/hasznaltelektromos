<?php
session_start();

// Felhasználó bejelentkezésének ellenőrzése
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Kijelentkezés feldolgozása
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elektromos Jármű Hirdetések</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="nav-left">
        <h1>Elektromos Jármű Hirdetések</h1>
    </div>
    <nav>
        <a href="index.php">Főoldal</a>
        <a href="create_ad.php">Hirdetésfeladás</a>
        <a href="search.php">Keresés</a>
    </nav>
    <div class="nav-right">
        <div class="dropdown">
            <button class="dropbtn">Profil</button>
            <div class="dropdown-content">
                <a href="profile.php">Profil</a>
                
                <form method="post" action="index.php">   
                <button type="submit" name="logout">Kijelentkezés</button>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Fő tartalom -->
<section id="main-content">
    <?php include 'advertisements.php'; ?>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Elektromos Jármű Hirdetések</p>
</footer>

</body>
</html>






