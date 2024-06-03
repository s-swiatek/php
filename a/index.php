<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sebastian Świątek">
    <meta name="description" content="Ksiegarnia internetowa">
    <meta name="keywords" content="ksiegarnia, ksiazki, zakupy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ksiegarnia Internetowa</title>
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
        <h2>Witamy w ksiegarni!</h2>
        <p><img src="like.jpeg"></p>
    </main>
    <footer>
        <p>Sebastian Świątek 2TP</p>
    </footer>
</body>
</html>
<?php

?>

