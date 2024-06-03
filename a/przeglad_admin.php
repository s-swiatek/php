<?php
session_start();
require 'baza.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if (isset($_POST['add_client'])) {
    $name = $_POST['name'];
    $surname = $_POST['nazwisko'];
    $data_ur = $_POST['urodziny'];
    $email = $_POST['email'];
    $telefon = $_POST['tel'];
    $login = $_POST['log'];
    $password = ($_POST['password']);
    
    
    $query = $db->prepare("INSERT INTO klient (imie, nazwisko, data_urodzenia, email, telefon, log_in, haslo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->execute([$name, $surname, $data_ur, $email, $telefon, $login, $password]);
}

if (isset($_POST['delete_client'])) {
    $client_id = $_POST['client_id'];
    
    $query = $db->prepare("DELETE FROM klient WHERE id_klienta = ?");
    $query->execute([$client_id]);
}

if (isset($_POST['add_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $wydawnictwo = $_POST['wyd'];
    $rok_wyd = $_POST['rok'];
    $ilosc = $_POST['ile'];
    $cena = $_POST['cen'];

    
    $query = $db->prepare("INSERT INTO ksiazka (tytul, autor, wydawnictwo, rok_wydania, ilosc, cena) VALUES (?, ?, ?, ?, ?, ?)");
    $query->execute([$title, $author, $wydawnictwo, $rok_wyd, $ilosc, $cena]);
}

if (isset($_POST['delete_book'])) {
    $book_id = $_POST['book_id'];
    
    $query = $db->prepare("DELETE FROM ksiazka WHERE id_ksiazki = ?");
    $query->execute([$book_id]);
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

$clients = $db->query("SELECT * FROM klient")->fetchAll();

$books = $db->query("SELECT * FROM ksiazka")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sebastian Świątek">
    <meta name="description" content="Panel administratora">
    <meta name="keywords" content="ksiegarnia, administracja">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administratora</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Panel Administratora</h1>
        <nav>
            <ul>
                <li><a href="index.php">Strona glowna</a></li>
                <li><a href="przeglad.php">Przegladaj zasoby</a></li>
                <li><a href="przeglad_admin.php">Panel administratora</a></li>
                <li><a href="wyloguj.php">Wyloguj</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Dodaj Klienta</h2>
        <form method="POST" action="przeglad_admin.php">
            <label for="name">Imie:</label>
            <input type="text" id="name" name="name" required>
            <label for="name">Nazwisko:</label>
            <input type="text" id="nazwisko" name="nazwisko" required>
            <label for="name">Data urodzenia:</label>
            <input type="date" id="urodziny" name="urodziny" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="name">Numer telefonu:</label>
            <input type="text" id="tel" name="tel" required>
            <label for="name">Login:</label>
            <input type="text" id="log" name="log" required>
            <label for="password">Haslo:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit" name="add_client">Dodaj klienta</button>
        </form>

        <h2>Usun Klienta</h2>
        <form method="POST" action="przeglad_admin.php">
            <label for="client_id">ID Klienta:</label>
            <input type="number" id="client_id" name="client_id" required>
            <button type="submit" name="delete_client">Usun klienta</button>
        </form>

        <h2>Dodaj Ksiazke</h2>
        <form method="POST" action="przeglad_admin.php">
            <label for="title">Tytul:</label>
            <input type="text" id="title" name="title" required>
            <label for="author">Autor:</label>
            <input type="text" id="author" name="author" required>
            <label for="name">Wydawnictwo:</label>
            <input type="text" id="wyd" name="wyd" required>
            <label for="name">Rok wydania:</label>
            <input type="number" id="rok" name="rok" required>
            <label for="ile">Ilosc:</label>
            <input type="number" id="ile" name="ile" required>
            <label for="cen">Cena:</label>
            <input type="number" step="0.01" id="cen" name="cen" required>
            <button type="submit" name="add_book">Dodaj ksiazke</button>
        </form>

        <h2>Usun Ksiazke</h2>
        <form method="POST" action="przeglad_admin.php">
            <label for="book_id">ID Ksiazki:</label>
            <input type="number" id="book_id" name="book_id" required>
            <button type="submit" name="delete_book">Usun ksiazke</button>
        </form>

        <h2>Lista Klientow</h2>
        <ul>
            <?php foreach ($clients as $client): ?>
                <li>ID: <?php echo htmlspecialchars($client['id_klienta']); ?>, Imie: <?php echo htmlspecialchars($client['imie']); ?>, Nazwisko: <?php echo htmlspecialchars($client['nazwisko']); ?>, Data urodzenia: <?php echo htmlspecialchars($client['data_urodzenia']); ?>, Email: <?php echo htmlspecialchars($client['email']); ?>, Telefon: <?php echo htmlspecialchars($client['telefon']); ?>, Login: <?php echo htmlspecialchars($client['log_in']); ?>, Haslo: <?php echo htmlspecialchars($client['haslo']); ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Lista Ksiazek</h2>
        <ul>
            <?php foreach ($books as $book): ?>
                <li>ID: <?php echo htmlspecialchars($book['id_ksiazki']); ?>, Tytul: <?php echo htmlspecialchars($book['tytul']); ?>, Autor: <?php echo htmlspecialchars($book['autor']); ?></li>
            <?php endforeach; ?>
        </ul>
        <form method="POST" action="przeglad_admin.php">
            <button type="submit" name="logout">Wyloguj</button>
        </form>
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
