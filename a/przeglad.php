<?php
session_start();
require 'baza.php';

$search = $_POST['search'] ?? '';
$query = $db->prepare("SELECT * FROM ksiazka WHERE tytul LIKE ?");
$query->execute(['%' . $search . '%']);
$books = $query->fetchAll();
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id']) && isset($_POST['quantity'])) {
    if (!isset($_SESSION['user_id'])) {
        $error = "Musisz byc zalogowany, aby zlozyc zamowienie";
    } else {
        $user_id = $_SESSION['user_id'];
        $book_id = $_POST['book_id'];
        $quantity = $_POST['quantity'];
        
        $check_query = $db->prepare("SELECT ilosc, cena FROM ksiazka WHERE id_ksiazki = ?");
        $check_query->execute([$book_id]);
        $book = $check_query->fetch();
        
        $cena = $book['cena'] * $quantity;
        if ($book && $book['ilosc'] >= $quantity) {
            $ilosc = $book['ilosc']-$quantity;
            $cena = $book['cena'];
            
            $insert_query = $db->prepare("INSERT INTO zamowienie (id_klienta, id_ksiazki, liczba_egzemplarzy) VALUES (?, ?, ?)");
            $insert_query->execute([$user_id, $book_id, $quantity]);
        } else {
            $error = "Niewystarczajaca ilosc ksiazek na stanie.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sebastian Świątek">
    <meta name="description" content="Przegladanie ksiazek">
    <meta name="keywords" content="ksiegarnia, ksiazki, przegladanie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przegladaj zasoby</title>
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
        <h2>Przegladaj zasoby</h2>
        <form method="POST" action="przeglad.php">
            <label for="search">Wyszukaj ksiazke:</label>
            <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Wyszukaj</button>
        </form>
        <ul>
            <?php foreach ($books as $book): ?>
                <li>ID: <?php echo htmlspecialchars($book['id_ksiazki']); ?>, Tytul: <?php echo htmlspecialchars($book['tytul']); ?>, Autor: <?php echo htmlspecialchars($book['autor']); ?></li>
            <?php endforeach; ?>
        </ul>
        <h2>Zloz zamowienie</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="przeglad.php">
            <label for="book_id">ID ksiazki:</label>
            <input type="number" id="book_id" name="book_id" required>
            <label for="quantity">Ilosc:</label>
            <input type="number" id="quantity" name="quantity" required>
            <button type="submit">Zloz zamowienie</button>
        </form>
    </main>
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
