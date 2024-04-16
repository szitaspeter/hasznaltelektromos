<?php include 'register_process.php'; ?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Regisztráció</h1>
        <nav>
            <a href="index.php">Főoldal</a>
            <a href="login.php">Bejelentkezés</a>
        </nav>
    </header>

    <section id="main-content">
        <form action="register.php" method="post">
            <label for="fullname">Teljes név:</label>
            <input type="text" name="fullname" required>

            <label for="username">Felhasználónév:</label>
            <input type="text" name="username" required>

            <label for="email">Email cím:</label>
            <input type="email" name="email" required>

            <label for="password">Jelszó:</label>
            <input type="password" name="password" required>

            <button type="submit">Regisztráció</button>
        </form>
        <p>Már van fiókja? <a href="login.php">Jelentkezzen be</a>.</p>
    </section>

    <footer>
        <p>&copy; 2024 Elektromos Jármű Hirdetések</p>
    </footer>
</body>
</html>
