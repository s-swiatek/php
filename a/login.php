<?php
session_start();
require 'baza.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['log_id'];
    $password = $_POST['password'];
    
    if ($login === 'admin' && $password === 'zsme1234') {
        $_SESSION['user_id'] = 'admin';
        header('Location: przeglad_admin.php');
        exit();
    }
    $query = $db->prepare("SELECT * FROM klient WHERE log_in = ? AND haslo = ?");
    $query->execute([$login, $password]);
    $user = $query->fetch();
    
    if ($user) {
        $_SESSION['user_id'] = $user['id_klienta'];
        header('Location: index.php');
    } else {
        $error = "Nieprawidlowy login lub haslo.";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sebastian Świątek">
    <meta name="description" content="Logowanie">
    <meta name="keywords" content="ksiegarnia, logowanie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Ksiegarnia Internetowa</h1>
        <nav>
            <ul>
                <li><a href="index.php">Strona glowna</a></li>
                <li><a href="login.php">Zaloguj</a></li>
                <li><a href="register.php">Zarejestruj</a></li>
                <li><a href="przeglad.php">Przegladaj zasoby</a></li>
                <li><a href="wyloguj.php">Wyloguj</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Logowanie</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label for="login_id">Login:</label>
            <input type="text" id="log_id" name="log_id" required>
            <label for="password">Haslo:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Zaloguj</button>
        </form>
    </main>
    <footer>
        <p>Sebastian Świątek 2TP</p>
    </footer>
</body>
</html>