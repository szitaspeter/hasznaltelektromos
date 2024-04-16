<?php
include 'profile_process.php';
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználói profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Elektromos Jármű Hirdetések</h1>
    <nav>
        <a href="index.php">Főoldal</a>
        <a href="create_ad.php">Hirdetésfeladás</a>
        <a href="search.php">Keresés</a>
    </nav>
</header>

<section id="main-content">
    <h2>Felhasználói profil</h2>
    <?php if (!$success && !empty($message)): ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="profile.php" method="post">
        <label for="fullname">Teljes név:</label>
        <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" required>

        <label for="phone">Telefonszám:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>

        <label for="address">Cím:</label>
        <textarea name="address" required><?php echo htmlspecialchars($address); ?></textarea>

        <label for="password">Új jelszó (opcionális):</label>
        <input type="password" name="password" placeholder="Új jelszó">

        <button type="submit">Mentés</button>
    </form>
</section>

<footer>
    <p>&copy; 2024 Elektromos Jármű Hirdetések</p>
</footer>
</body>
</html>


