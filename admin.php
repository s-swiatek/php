<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

$books = $db->query("SELECT * FROM ksiazki")->fetchAll();
$orders = $db->query("SELECT * FROM zamowienia")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sebastian Świątek">
    <meta name="description" content="Panel administracyjny">
    <meta name="keywords" content="ksi�garnia, administracja">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administracyjny</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Panel administracyjny</h1>
        <nav>
            <ul>
                <li><a href="index.php">Strona g��wna</a></li>
                <li><a href="przeglad.php">Przegl�daj zasoby</a></li>
                <li><a href="wyloguj.php">Wyloguj</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Zarz�dzaj ksi��kami</h2>
        <ul>
            <?php foreach ($books as $book): ?>
                <li><?php echo htmlspecialchars($book['tytul']); ?> - <?php echo htmlspecialchars($book['autor']); ?> - <?php echo htmlspecialchars($book['ilosc']); ?> szt.</li>
            <?php endforeach; ?>
        </ul>
        <h2>Zarz�dzaj zam�wieniami</h2>
        <ul>
            <?php foreach ($orders as $order): ?>
                <li>Zam�wienie ID: <?php echo htmlspecialchars($order['id']); ?> - Ksiazka ID: <?php echo htmlspecialchars($order['book_id']); ?> - Ilo��: <?php echo htmlspecialchars($order['quantity']); ?></li>
            <?php endforeach; ?>
        </ul>
    </main>
    <footer>
        <p>Sebastian Świątek 2TP</p>
    </footer>
</body>
</html>
<?php

session_start();
if (isset($_SESSION['log'])) {
    unset($_SESSION['log']);
} else {
    header('location: index.php');
    exit();
}
$s = session_destroy();

?>
