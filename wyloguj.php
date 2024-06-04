<!DOCTYPE HTML>
<html>
    <head>
        <title> Koniec_sesji</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
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
    <p>Wylogowałeś się ze strony.</p>
        <a href="index.php"></a>
    </main>
    <footer>
        <p>Sebastian Świątek 2TP</p>
    </footer>
    </body>
</html>
<?php

session_start();
if(!isset($_SESSION['user_id']))
{
    header("Location: index.php");
}
$s = session_destroy();

?>

