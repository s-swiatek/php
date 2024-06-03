<?php
require 'baza.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $data_ur = $_POST['urodziny'];
    $telefon = $_POST['tel'];
    $login = $_POST['login'];

    $query = $db->prepare("INSERT INTO klient (email, haslo, imie, nazwisko, data_urodzenia, telefon, log_in) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->execute([$email, $password, $name, $surname, $data_ur, $telefon, $login]);
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sebastian Świątek">
    <meta name="description" content="Rejestracja">
    <meta name="keywords" content="ksiegarnia, rejestracja">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
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
        <h2>Rejestracja</h2>
        <form method="POST" action="register.php">
            <label for="name">Imie:</label>
            <input type="text" id="name" name="name" required>
            <label for="name">Nazwisko:</label>
            <input type="text" id="surname" name="surname" required>
            <label for="name">Data urodzenia:</label>
            <input type="date" id="urodziny" name="urodziny" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="name">Numer telefonu:</label>
            <input type="text" id="tel" name="tel" required>
            <label for="email">Login:</label>
            <input type="text" id="login" name="login" required>
            <label for="password">Haslo:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Zarejestruj</button>
        </form>
    </main>
    <footer>
        <p>Sebastian Świątek 2TP</p>
    </footer>
</body>
</html>
